<?php

namespace App\Http\Controllers;

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

  public function create() {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('analyses/aanmaken')->with('status', 'Voer alle verplichte velden in.');
    }

    $analysis = new Analysis();
    $analysis->title = $request['title'];

    if (!empty($request['coretasks'])) {
      $reviewers = $this->syncData($request['coretasks']);

      $analysis->reviewers()->sync($reviewers);
    }

    if (!empty($request['workprocesses'])) {
      $workprocesses = $this->syncData($request['workprocesses']);

      $analysis->workprocesses()->sync($workprocesses);
    }

    if (!empty($request['students'])) {
      $students = $this->syncData($request['students']);

      $analysis->students()->sync($students);
    }

    $analysis->save();
  }

  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }
  
}
