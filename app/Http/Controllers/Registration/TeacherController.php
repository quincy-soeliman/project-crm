<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Teacher;
use App\College;
use App\Http\Controllers\Auth\AuthController as Auth;
use Validator;
use App\Http\Controllers\Controller;
use Mail;

class TeacherController extends Controller {
  
  /**
   * Get the teacher form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $colleges = College::get();

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
      'email' => 'required|max:255|min:3|unique:users',
      'password' => 'required|min:6',
      'college_id' => 'required|max:255|min:1',
      'first_name' => 'required|max:255|min:1',
      'last_name' => 'required|max:255|min:1',
      'telephone_number' => 'max:255|min:1',
    ]);
  }

  /**
   * Create an user with the student role.
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
      return redirect('registreer/docent')->with('status', 'Voer alle verplichte velden in.');
    }

    /**
     * Creates a new user.
     */
    $user = new User();
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->role = 'teacher';
    $user->active = 0;
    $user->save();

    /**
     * Creates a new teacher.
     */
    $teacher = new Teacher();
    $teacher->user_id = $user->id;
    $teacher->college_id = $request['college_id'];
    $teacher->first_name = $request['first_name'];
    $teacher->last_name = $request['last_name'];
    $teacher->telephone_number = $request['telephone_number'];
    $teacher->save();

//    /**
//     * Sends mail to the registered user for verification.
//     */
//    Mail::send('emails.registration', [
//      'user' => $user,
//      'teacher' => $teacher,
//    ], function ($m) use ($user, $teacher) {
//      $teacher = $teacher->first_name . ' ' . $teacher->last_name;
//
//      $m->from('hello@world.com', 'Your Application');
//      $m->to($user->email, $teacher)
//        ->subject('Project-CRM | Account registratie');
//    });
//
//    /**
//     * Sends mail to the admin for activation.
//     */
//    Mail::send('emails.user_registrated', [
//      'user' => $user,
//      'teacher' => $teacher,
//    ], function ($m) use ($user, $teacher) {
//      $teacher_name = $teacher->first_name . ' ' . $teacher->last_name;
//      $college = Auth::getCollege($teacher->college_id);
//
//      $m->from('hello@world.com', 'Your Application');
//      $m->to($college[0]->email, $college[0]->name)
//        ->subject('Project-CRM | Nieuwe docent gebruiker: ' . $teacher_name);
//    });
    
    return redirect('/geregistreerd');
  }
  
}
