<?php

namespace App\Http\Controllers;

use App\WorkProcess;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class WorkProcessController extends Controller {

  public function __construct() {
    $this->middleware('role:administrator');
  }

  public function index() {
    $work_processes = WorkProcess::get();

    return $this->view('pages.work_processes', [
      'work_processes' => $work_processes,
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
      'description' => 'required',
    ]);
  }

  /**
   * Creates a new WorkProcess.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('404');
    }

    $work_process = new WorkProcess();
    $work_process->core_task_id = $request['core_task_id'];
    $work_process->title = $request['title'];
    $work_process->description = $request['description'];
    $work_process->save();

    return redirect('workprocessen');
  }

}
