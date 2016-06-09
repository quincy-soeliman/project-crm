<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Student;
use App\College;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class StudentController extends Controller {

  /**
   * Returns the students view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $current_user = User::find(Auth::id());
    $college = College::find($current_user->college->id);
    $students = $college->students;

    return view('pages.studenten', [
      'students' => $students,
    ]);
  }

}
