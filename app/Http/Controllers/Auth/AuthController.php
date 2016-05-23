<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller {

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Returns the login form.
   */
  public function showLoginForm() {
    return view('auth.login');
  }

  /**
   * Attempts to authenticate an user.
   */
  public function authenticate(Request $request) {
    if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => $request['role']])) {
      return redirect('/loggedin');
    }
  }

  /**
   * Attempts to disconnect an user.
   */
  public function logout() {
    Auth::logout();

    return redirect('/login');
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
