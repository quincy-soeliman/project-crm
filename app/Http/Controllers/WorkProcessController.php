<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Workprocess;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class WorkprocessController extends Controller {

  public function __construct() {
    $this->middleware('role:administrator');
  }

  public function index() {
    $id = Auth::id();
    $role = User::find($id)->role;
    $coretasks = Coretask::get();

    return view('pages.werkprocessen', [
      'coretasks' => $coretasks,
      'role' => $role,
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
      'title' => 'required|max:255|min:1|unique:workprocesses',
      'description' => 'required|min:1',
    ]);
  }
  /**
   * Creates a new Workprocess.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('werkproces/aanmaken')->with('status', 'Voer alle verplichte velden in.');
    }

    $workprocess = new Workprocess();
    $workprocess->core_task_id = $request['core_task_id'];
    $workprocess->title = $request['title'];
    $workprocess->description = $request['description'];
    $workprocess->save();

    return redirect('workprocessen')->with('status', 'Het werkproces is aangemaakt.');
  }

}
