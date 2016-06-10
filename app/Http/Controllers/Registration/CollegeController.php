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
   * Returns the college form view.
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
      'first_name' => 'required|max:255|min:2',
      'last_name' => 'required|max:255|min:2',
      'telephone_number' => 'required|min:10|max:10'
    ]);
  }

  /**
   * Create an user with the college role.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    if (User::where('email', '=', $request['email'])->exists()) {
      return back()->with('status', 'Dit e-mail bestaat al.');
    }

    if (strlen($request['password']) < 6) {
      return back()->with('status', 'Het wachtwoord moet minimaal 6 tekens bevatten.');
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

    // Creates a new College
    $college = new College();
    $college->user_id = $user->id;
    $college->name = $request['name'];
    $college->first_name = $request['first_name'];
    $college->last_name = $request['last_name'];
    $college->telephone_number = $request['telephone_number'];
    $college->save();
    
    return redirect('/geregistreerd');
  }

}
