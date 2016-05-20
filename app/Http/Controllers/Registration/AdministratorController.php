<?php

namespace App\Http\Controllers\Registration;

use App\User;
use App\Administrator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class AdministratorController extends Controller {

  /**
   * Get the administrator form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showAdministratorForm() {
    return view('auth.registration.administrator');
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
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'telephone_number' => 'required|max:255',
    ]);
  }

  /**
   * Create an user with the administrator role.
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
    $user->role = 'administrator';
    $user->active = 0;
    $user->save();

    // Creates a new administrator
    $administrator = new Administrator();
    $administrator->user_id = $user->id;
    $administrator->first_name = $request['first_name'];
    $administrator->last_name = $request['last_name'];
    $administrator->telephone_number = $request['telephone_number'];
    $administrator->save();

    // TODO: Redirect to profile
    return redirect('/');
  }

}