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

  /**
   * Returns the analyses view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $id = Auth::id();
    $role = User::find($id)->role;
    $analyses = Analysis::get();

    return view('pages.analyses', [
      'analyses' => $analyses,
      'role' => $role
    ]);
  }

  /**
   * Returns the analysis form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
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

  /**
   * Creates an Analysis.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function create(Request $request) {
    if (Analysis::where('title', '=', $request['title'])->exists()) {
      return back()->with('status', 'De analyse bestaat al.');
    }

    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('analyses/aanmaken')->with('status', 'Voer alle verplichte velden in.');
    }

    $analysis = new Analysis();

    $analysis->title = $request['title'];

    if (empty($request['coretasks'])) {
      return back()->with('status', 'U moet nog kerntaken aanmaken.');
    }

    if (empty($request['workprocesses'])) {
      return back()->with('status', 'U moet nog werkprocessen selecteren.');
    }

    $analysis->save();

    // Links the analysis with the coretasks
    $coretasks = $this->syncData($request['coretasks']);
    $analysis->coretasks()->sync($coretasks);

    // Links the analysis with the workprocesses
    $workprocesses = $this->syncData($request['workprocesses']);
    $analysis->workprocesses()->sync($workprocesses);

    return back()->with('status', $request['title'] . ' is aangemaakt.');
  }

  /**
   * Returns the link reviewers view.
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function linkReviewersForm($id) {
    $reviewers = Reviewer::get();

    return view('pages.analysis_link_reviewers', [
      'reviewers' => $reviewers,
      'id' => $id
    ]);
  }

  /**
   * Links the Analysis with the reviewer(s).
   *
   * @param $id
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function linkReviewers($id, Request $request) {
    $analysis = Analysis::find($id);

    if (empty($request['reviewers'])) {
      return redirect('analyses/' . $id . '/beoordelaars')->with('status', 'U heeft geen beoordelaar geselecteerd');
    }

    // Links the Analysis with the reviewer(s).
    $reviewers = $this->syncData($request['reviewers']);
    $analysis->reviewers()->sync($reviewers);

    $analyses_array = [];
    $workprocesses_array = [];

    // Puts the analyses and workprocesses of the reviewer(s) in arrays.
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

    // Links the analyses and workprocesses with the students that are linked to the reviewer(s).
    foreach ($request['reviewers'] as $reviewer_id) {
      $reviewer = Reviewer::find($reviewer_id);

      foreach ($reviewer->students()->get() as $student) {
        $student->analyses()->sync($analyses_array);
        $student->workprocesses()->sync($workprocesses_array);
      }
    }

    return redirect('analyses')->with('status', 'De beoordelaar is succesvol gekoppeld aan de analyse.');
  }

  /**
   * Returns the Request $request in an array.
   *
   * @param $request
   * @return array
   */
  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }
  
}
