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
  public function index() {
    return view('auth.login');
  }

  /**
   * Attempts to authenticate an user.
   */
  public function authenticate(Request $request) {
    $credentials = [
      'email' => $request['email'], 
      'password' => $request['password'], 
      'role' => $request['role']
    ];

    if (!Auth::attempt($credentials)) {
      return redirect('login')->with('status', 'De email en/of wachtwoord is incorrect.');
    }

    if ($this->getStatus()) {
      $user = Auth::user();

      return redirect('profile/' . $user->id);
    }

    return redirect('login')->with('status', 'Het account is niet actief.');
  }

  /**
   * Gets the status of the current user.
   */
  public function getStatus() {
    $user = Auth::user();

    return $user->active;
  }

  /**
   * Attempts to disconnect an user.
   */
  public function logout() {
    if (!Auth::check()) {
      return redirect('/login');
    }

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
