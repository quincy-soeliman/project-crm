<?php

namespace App\Http\Controllers;

use App\User;
use App\Reviewer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ReviewerController extends Controller {

  /**
   * Get the reviewer form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showReviewerForm() {
    return view('auth.registration.reviewer');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'email' => 'required|max:255|unique:users',
      'password' => 'required|min:6',
      'ov_number' => 'required|max:255|unique:reviewers',
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'telephone_number' => 'max:255',
    ]);
  }

  /**
   * Create an user with the reviewer role.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      // TODO: Return back with error input
      return redirect('404');
    }

    // Creates a new user
    $user = new User();
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->role = 'reviewer';
    $user->active = 0;
    $user->save();

    // Creates a new reviewer
    $reviewer = new Reviewer();
    $reviewer->user_id = $user->id;
    $reviewer->ov_number = $request['ov_number'];
    $reviewer->first_name = $request['first_name'];
    $reviewer->last_name = $request['last_name'];
    $reviewer->save();

    // TODO: Redirect to profile
    return redirect('/');
  }

}
