<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Teacher;
use DB;
use Validator;
use App\Http\Controllers\Controller;

class TeacherController extends Controller {
  /**
   * Get the teacher form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showTeacherForm() {
    $colleges = DB::table('colleges')->get();

    return view('auth.registration.teacher', [
      'colleges' => $colleges,
    ]);
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
      'college_id' => 'required|max:255',
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'telephone_number' => 'max:255',
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
    $user->role = 'teacher';
    $user->active = 0;
    $user->save();

    // Creates a new teacher
    $teacher = new Teacher();
    $teacher->user_id = $user->id;
    $teacher->college_id = $request['college_id'];
    $teacher->first_name = $request['first_name'];
    $teacher->last_name = $request['last_name'];
    $teacher->telephone_number = $request['telephone_number'];
    $teacher->save();

    // TODO: Redirect to profile
    return redirect('/');
  }
}
