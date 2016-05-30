<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Analysis;
use Validator;

class AnalysisController extends Controller {

  public function index() {
    $analyses = Analysis::get();

    return view('pages.analyses', [
      'analyses' => $analyses,
    ]);
  }

  public function showForm() {
    return view('pages.analyses_form');
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
      $analysis->coretasks()->attach([]);
    }

    if (!empty($request['workprocesses'])) {
      $analysis->workprocesses()->attach([]);
    }

    $analysis->save();
  }
  
}
