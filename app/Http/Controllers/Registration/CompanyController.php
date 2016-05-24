<?php

namespace App\Http\Controllers\Registration;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class CompanyController extends Controller {

  /**
   * Get the company form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    return view('auth.registration.company');
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
      'name' => 'required|max:255',
      'address' => 'required|max:255',
      'zip_code' => 'required|max:255',
      'telephone_number' => 'max:255',
      'iso_number' => 'required|max:255',
    ]);
  }

  /**
   * Create an user with the company role.
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
    $user->role = 'company';
    $user->active = 0;
    $user->save();

    // Creates a new student
    $company = new Company();
    $company->user_id = $user->id;
    $company->name = $request['name'];
    $company->address = $request['address'];
    $company->zip_code = $request['zip_code'];
    $company->telephone_number = $request['telephone_number'];
    $company->iso_number = $request['iso_number'];
    $company->save();

    // TODO: Redirect to profile
    return redirect('/');
  }

}
