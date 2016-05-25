<?php

namespace App\Http\Controllers;

use App\CoreTask;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class CoreTaskController extends Controller {

  public function __construct() {
    $this->middleware('role:administrator');
  }

  public function index() {
    $core_tasks = CoreTask::get();

    return view('pages.core_tasks', [
      'core_tasks' => $core_tasks,
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
      'title' => 'required|max:255|unique:core_tasks',
    ]);
  }

  /**
   * Creates a new CoreTask.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('404');
    }

    $core_task = new CoreTask();
    $core_task->title = $request['title'];
    $core_task->save();

    return redirect('kerntaken');
  }

}
