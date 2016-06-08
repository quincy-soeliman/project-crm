<?php

namespace App\Http\Controllers\Registration;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller {

  /**
   * Returns the role selection view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    return view('auth.registration.role_selection');
  }

}
