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
   * Returns the administrator form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
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
      'email' => 'required|max:255|min:1|unique:users',
      'password' => 'required|min:6',
      'first_name' => 'required|max:255|min:1',
      'last_name' => 'required|max:255|min:1',
      'telephone_number' => 'required|max:255|min:1',
    ]);
  }

  /**
   * Create an user with the administrator role.
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
      return redirect('registreer/administrator')->with('status', 'Voer alle verplichte velden in.');
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

    return redirect('/geregistreerd');
  }

}
