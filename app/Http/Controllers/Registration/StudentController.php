<?php

namespace App\Http\Controllers\Registration;

use App\User;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class StudentController extends Controller {

  /**
   * Get the student form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showStudentForm() {
    return view('auth.registration.student');
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
      'ov_number' => 'required|max:255|unique:students',
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
    ]);
  }

  /**
   * Create an user with the student role.
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
    $user->role = 'student';
    $user->active = 0;
    $user->save();

    // Creates a new student
    $student = new Student();
    $student->user_id = $user->id;
    $student->ov_number = $request['ov_number'];
    $student->first_name = $request['first_name'];
    $student->last_name = $request['last_name'];
    $student->save();

    // TODO: Redirect to profile
    return redirect('/');
  }

}
