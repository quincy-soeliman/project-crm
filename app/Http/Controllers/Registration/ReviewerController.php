<?php

namespace App\Http\Controllers\Registration;

use App\User;
use App\Reviewer;
use App\Company;
use App\Http\Controllers\Auth\AuthController as Auth;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ReviewerController extends Controller {

  /**
   * Get the reviewer form view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $companies = Company::get();

    return view('auth.registration.reviewer', [
      'companies' => $companies,
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
      'email' => 'required|max:255|unique:users|min:3',
      'password' => 'required|min:6',
      'company_id' => 'required|max:255|min:1',
      'first_name' => 'required|max:255|min:1',
      'last_name' => 'required|max:255|min:1',
      'telephone_number' => 'max:255|min:1',
    ]);
  }

  /**
   * Create an user with the reviewer role.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function create(Request $request) {
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
      return redirect('registreer/beoordelaar')->with('status', 'Voer alle verplichte velden in.');
    }

    // Creates a new user
    $user = new User();
    $user->email = $request['email'];
    $user->password = bcrypt($request['password']);
    $user->role = 'reviewer';
    $user->active = 0;
    $user->save();

    // Creates a new reviewer
    $reviewer = new Reviewer();
    $reviewer->user_id = $user->id;
    $reviewer->company_id = $request['company_id'];
    $reviewer->company = $this->getCompanyName($request['company_id']);
    $reviewer->first_name = $request['first_name'];
    $reviewer->last_name = $request['last_name'];
    $reviewer->telephone_number = $request['telephone_number'];
    $reviewer->save();

    /**
     * Sends mail to the registered user for verification.
     */
    Mail::send('emails.registration', [
      'user' => $user,
      'reviewer' => $reviewer,
    ], function ($m) use ($user, $reviewer) {
      $reviewer_name = $reviewer->first_name . ' ' . $reviewer->last_name;

      $m->from('hello@world.com', 'Your Application');
      $m->to($user->email, $reviewer_name . $reviewer->company_id)
        ->subject('Project-CRM | Account registratie');
    });

    /**
     * Sends mail to the admin for activation.
     */
    Mail::send('emails.user_registrated', [
      'user' => $user,
      'reviewer' => $reviewer,
    ], function ($m) use ($user, $reviewer) {
      $reviewer_name = $reviewer->first_name . ' ' . $reviewer->last_name;
      $company = Auth::getCompany($reviewer->company_id);

      $m->from('hello@world.com', 'Your Application');
      $m->to($company[0]->email, $company[0]->name)
        ->subject('Project-CRM | Nieuwe beoordelaar gebruiker: ' . $reviewer_name);
    });

    // TODO: Redirect to message
    return redirect('/');
  }

  /**
   * Gets the college name.
   *
   * @param $id
   * @return mixed
   */
  public function getCompanyName($id) {
    $college = Company::find($id);

    return $college->name;
  }

}
