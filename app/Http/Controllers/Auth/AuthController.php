<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Mail;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data) {
    return Validator::make($data, [
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6|confirmed',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array $data
   * @return User
   */
  protected function create(array $data) {
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
    ]);
  }

  /**
   * Gets college info of the currently registered user.
   *
   * @param $id
   * @return mixed
   */
  public static function getCollege($id) {
    $college = DB::table('users')
      ->join('colleges', function ($join) use ($id) {
        $join->on('users.id', '=', 'colleges.user_id')
          ->where('colleges.user_id', '=', $id);
      })
      ->select('users.email', 'colleges.name')
      ->get();

    return $college;
  }

  /**
   * Gets company info of the currently registered user.
   *
   * @param $id
   * @return mixed
   */
  public static function getCompany($id) {
    $company = DB::table('users')
      ->join('companies', function ($join) use ($id) {
        $join->on('users.id', '=', 'companies.user_id')
          ->where('companies.id', '=', $id);
      })
      ->select('users.email', 'companies.name')
      ->get();

    return $company;
  }
}
