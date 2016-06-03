<?php

namespace App\Http\Controllers;

use App\Reviewer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Analysis;
use App\Coretask;
use App\Workprocess;
use App\User;
use Validator;
use Auth;

class AnalysisController extends Controller {

  public function index() {
    $id = Auth::id();
    $role = User::find($id)->role;
    $analyses = Analysis::get();

    return view('pages.analyses', [
      'analyses' => $analyses,
      'role' => $role
    ]);
  }

  public function showForm() {
    $id = Auth::id();
    $role = User::find($id)->role;
    $coretasks = Coretask::all();
    $workprocesses = Workprocess::all();

    return view('pages.add-analyse', [
      'role' => $role,
      'coretasks' => $coretasks,
      'workprocesses' => $workprocesses,
    ]);
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'title' => 'required|max:255|min:1|unique:analyses',
    ]);
  }

  public function create(Request $request) {
    if (Analysis::where('title', '=', $request['title'])->exists()) {
      return back()->with('status', 'De analyse bestaat al.');
    }

    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('analyses/aanmaken')->with('status', 'Voer alle verplichte velden in.');
    }

    /**
     * Creating an analysis.
     */
    $analysis = new Analysis();

    $analysis->title = $request['title'];

    if (empty($request['coretasks'])) {
      return back()->with('status', 'U moet nog kerntaken aanmaken.');
    }

    if (empty($request['workprocesses'])) {
      return back()->with('status', 'U moet nog werkprocessen selecteren.');
    }

    $analysis->save();

    /**
     * Syncing the many to many relationships.
     */
    $coretasks = $this->syncData($request['coretasks']);
    $analysis->coretasks()->sync($coretasks);

    $workprocesses = $this->syncData($request['workprocesses']);
    $analysis->workprocesses()->sync($workprocesses);

    return back()->with('status', $request['title'] . ' is aangemaakt.');
  }

  public function linkReviewersForm($id) {
    $reviewers = Reviewer::get();

    return view('pages.analysis_link_reviewers', [
      'reviewers' => $reviewers,
      'id' => $id
    ]);
  }

  public function linkReviewers($id, Request $request) {
    $analysis = Analysis::find($id);

    if (empty($request['reviewers'])) {
      return redirect('analyses/' . $id . '/beoordelaars')->with('status', 'U heeft geen beoordelaar geselecteerd');
    }

    $reviewers = $this->syncData($request['reviewers']);
    $analysis->reviewers()->sync($reviewers);

    $analyses_array = [];
    $workprocesses_array = [];

    foreach (Reviewer::get() as $reviewer) {
      if (!empty($reviewer->analyses()->get())) {
        foreach ($reviewer->analyses()->get() as $key => $analysis) {
          array_push($analyses_array, $analysis->id);

          foreach ($analysis->workprocesses()->get() as $key => $workprocess) {
            array_push($workprocesses_array, $workprocess->id);
          }
        }
      }
    }

    foreach ($request['reviewers'] as $reviewer_id) {
      $reviewer = Reviewer::find($reviewer_id);

      foreach ($reviewer->students()->get() as $student) {
        $student->analyses()->sync($analyses_array);
        $student->workprocesses()->sync($workprocesses_array);
      }
    }

    return redirect('analyses')->with('status', 'De beoordelaar is succesvol gekoppeld aan de analyse.');
  }

  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }
  
}
