<?php

namespace App\Http\Controllers\Registration;

use Mail;
use App\User;
use App\Student;
use App\Http\Controllers\Auth\AuthController as Auth;
use DB;
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
  public function index() {
    $colleges = DB::table('colleges')->get();

    return view('auth.registration.student', [
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
      'ov_number' => 'required|max:255|unique:students',
      'college_id' => 'required|max:255',
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

    /**
     * Creates a new user.
     */
    $user = new User();
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->role = 'student';
    $user->active = 0;
    $user->save();

    /**
     * Creates a new student.
     */
    $student = new Student();
    $student->user_id = $user->id;
    $student->college_id = $request['college_id'];
    $student->ov_number = $request['ov_number'];
    $student->first_name = $request['first_name'];
    $student->last_name = $request['last_name'];
    $student->save();

    /**
     * Sends mail to the registered user for verification.
     */
    Mail::send('emails.registration', [
      'user' => $user,
      'student' => $student,
    ], function ($m) use ($user, $student) {
      $student_name = $student->first_name . ' ' . $student->last_name;

      $m->from('hello@world.com', 'Your Application');
      $m->to($user->email, $student_name)
        ->subject('Project-CRM | Account registratie');
    });

    /**
     * Sends mail to the admin for activation.
     */
    Mail::send('emails.user_registrated', [
      'user' => $user,
      'student' => $student,
    ], function ($m) use ($user, $student) {
      $student_name = $student->first_name . ' ' . $student->last_name;
      $college = Auth::getCollege($student->college_id);

      $m->from('hello@world.com', 'Your Application');
      $m->to($college[0]->email, $college[0]->name)
        ->subject('Project-CRM | Nieuwe student gebruiker: ' . $student_name);
    });

    // TODO: Redirect to message
    return redirect('/');
  }

}
