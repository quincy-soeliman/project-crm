<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Workprocess;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use Auth;

class CoretaskController extends Controller {

  /**
   * Returns the coretasks view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $id = Auth::id();
    $role = User::find($id)->role;

    return view('pages.kerntaken', [
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
    if (Coretask::where('title', '=', $request['title'])->exists()) {
      return back()->with('status', 'De kerntaak bestaat al.');
    }

    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('kerntaak')->with('status', 'Voer alle verplichte velden in.');
    }

    $coretask = new Coretask();
    $coretask->title = $request['title'];
    $coretask->save();

    return redirect('kerntaak')->with('status' , $request['title'] . ' is aangemaakt.');
  }

}
