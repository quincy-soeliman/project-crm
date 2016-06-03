<?php

namespace App\Http\Controllers\Registration;

use App\User;
use App\College;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class CollegeController extends Controller {

  /**
   * Get the student form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    return view('auth.registration.college');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'email' => 'required|max:255|min:3|unique:users',
      'password' => 'required|min:6',
      'name' => 'required|max:255|min:1',
    ]);
  }

  /**
   * Create an user with the student role.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    if (User::where('email', '=', $request['email'])->exists()) {
      return back()->with('status', 'Dit e-mail bestaat al.');
    }
    
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('registreer/school')->with('status', 'Voer alle verplichte velden in.');
    }

    // Creates a new user
    $user = new User();
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->role = 'college';
    $user->active = 0;
    $user->save();

    // Creates a new student
    $college = new College();
    $college->user_id = $user->id;
    $college->name = $request['name'];
    $college->save();
    
    return redirect('/geregistreerd');
  }

}
