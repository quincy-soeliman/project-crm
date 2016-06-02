<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Workprocess;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;

class WorkprocessController extends Controller {

  public function index() {
    $id = Auth::id();
    $role = User::find($id)->role;
    $coretasks = Coretask::get();
    $workprocesses = Workprocess::all();

    return view('pages.werkprocessen', [
      'coretasks' => $coretasks,
      'workprocesses' => $workprocesses,
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
      'coretask_id' => 'required|min:1',
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
    if (Workprocess::where('title', '=', $request['title'])->exists()) {
      return back()->with('status', 'De werkproces bestaat al');
    }

    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('werkproces')->with('status', 'Voer alle verplichte velden in.');
    }

    $workprocess = new Workprocess();
    $workprocess->coretask_id = $request['coretask_id'];
    $workprocess->title = $request['title'];
    $workprocess->description = $request['description'];
    $workprocess->save();

    return redirect('werkproces')->with('status', $request['title'] . ' is aangemaakt.');
  }

}
