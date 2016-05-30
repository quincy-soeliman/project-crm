<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Workprocess;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class CoretaskController extends Controller {

  public function __construct() {
    $this->middleware('role:administrator');
  }

  public function index() {
    return view('pages.kerntaken');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'title' => 'required|max:255|min:1|unique:coretasks',
    ]);
  }

  /**
   * Creates a new Coretask.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('kerntaak/aanmaken')->with('status', 'Voer alle verplichte velden in.');
    }

    $coretask = new Coretask();
    $coretask->title = $request['title'];
    $coretask->save();

    return redirect('kerntaken')->with('status' , 'De kerntaak is aangemaakt.');
  }

}
