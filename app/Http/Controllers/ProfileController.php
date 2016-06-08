<?php

namespace App\Http\Controllers;

use App\Company;
use App\Reviewer;
use App\Student;
use App\Workprocess;
use Auth;
use App\User;
use Validator;
use App\College;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileRequest;

class ProfileController extends Controller {

  /**
   * Sets the edit-profile middleware when a new instance is created.
   */
  function __construct() {
    $this->middleware('edit-profile', ['only' => ['update']]);
  }

  /**
   * Returns the profile view with the user/profile data depending on the given wildcard.
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function index($id) {
    $user = User::find($id);
    $user_id = Auth::id();
    $current_user = User::find($user_id);

    if (!$user) {
      return back()->with('status', 'Dit gebruiker bestaat niet');
    }

    if (!$user->active) {
      return back()->with('status', 'Dit gebruiker bestaat niet');
    }

    // Shows all profiles if role is one of the cases.
    switch($current_user->role) {
      case 'teacher':
        break;
      case 'administrator':
        break;
      case 'college':
        break;
      case 'reviewer':
        break;
      case 'student':
        break;
      default:
        if ($user_id != $id) {
          return back()->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
        }
    }

    // Change data of the view depending on the wildcard id.
    switch ($user->role) {
      case 'student':
        $data = $user->student()->get();

        $student_user = User::find($user->id)->student()->get();
        $student_id = $student_user[0]->id;
        $student = Student::find($student_id);

        $reviewers = $student->reviewers;
        $analyses = $student->analyses;
        $workprocesses = $student->workprocesses;
        break;
      case 'teacher':
        $data = $user->teacher()->get();
        break;
      case 'college':
        $data = $user->college()->get();
        break;
      case 'reviewer':
        $data = $user->reviewer()->get();
        break;
      case 'company':
        $data = $user->company()->get();
        break;
      case 'administrator':
        $data = $user->administrator()->get();
        break;
    }

    return view('pages.profile', [
      'data' => !empty($data) ? $data : '',
      'role' => $user->role,
      'email' => $user->email,
      'reviewers' => !empty($reviewers) ? $reviewers : '',
      'analyses' => !empty($analyses) ? $analyses : '',
      'workprocesses' => !empty($workprocesses) ? $workprocesses : '',
    ]);
  }

  /**
   * Updates the user depending on the role.
   *
   * @param \App\User $user
   * @param \App\Http\Requests\EditProfileRequest $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(User $user, EditProfileRequest $request) {
    switch ($user->role) {
      case 'student':
        $student_user = User::find($user->id)->student()->get();
        $student_id = $student_user[0]->id;
        $student = Student::find($student_id);

        $user->student()->update([
          'college_id' => $request['college_id'],
          'first_name' => $request['first_name'],
          'last_name' => $request['last_name'],
          'college' => $request['college'],
        ]);

        if (!empty($request['reviewers'])) {
          $reviewers = $this->syncData($request['reviewers']);

          $student->reviewers()->sync($reviewers);
        }

        $reviewers = $student->reviewers()->get();

        $analyses_array = [];
        $workprocesses_array = [];

        foreach ($reviewers as $reviewer) {
          if (!empty($reviewer->analyses()->get())) {
            foreach ($reviewer->analyses()->get() as $key => $analysis) {
              array_push($analyses_array, $analysis->id);

              foreach ($analysis->workprocesses()->get() as $key => $workprocess) {
                array_push($workprocesses_array, $workprocess->id);
              }
            }
          }
        }

        $student->analyses()->sync($analyses_array);
        $student->workprocesses()->sync($workprocesses_array);
        break;
      case 'teacher':
        break;
      case 'college':
        break;
      case 'reviewer':
        break;
      case 'company':
        break;
      case 'administrator':
        break;
    }

    return redirect('profiel/' . $user->id)->with('status', 'Uw profiel is bijgewerkt.');
  }

  /**
   * Returns the user edit form view.
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function show_edit_form($id) {
    $user_id = Auth::id();

    if ($user_id != $id) {
      return back()->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
    }

    $user = User::find($id);

    switch ($user->role) {
      case 'student':
        $data = $user->student()->get();
        $colleges = College::get();
        $reviewers = Reviewer::get();
        break;
      case 'teacher':
        $colleges = College::get();
        $data = $user->teacher()->get();
        break;
      case 'college':
        $data = $user->college()->get();
        break;
      case 'reviewer':
        $data = $user->reviewer()->get();
        $companies = Company::get();
        break;
      case 'company':
        $data = $user->company()->get();
        break;
      case 'administrator':
        $data = $user->administrator()->get();
        break;
    }

    return view('pages.edit_profile', [
      'data' => $data,
      'role' => $user->role,
      'email' => $user->email,
      'colleges' => !empty($colleges) ? $colleges : '',
      'reviewers' => !empty($reviewers) ? $reviewers : '',
      'companies' => !empty($companies) ? $companies : '',
    ]);
  }

  /**
   * Returns the Request $request in an array.
   *
   * @param $request
   * @return array
   */
  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }

  /**
   * Sets the workprocess to done of a student.
   *
   * @param $student_id
   * @param $workprocess_id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function setWorkprocessToDone($student_id, $workprocess_id) {
    $current_user = User::find(Auth::id());

    if ($current_user->role !== 'reviewer') {
      return back()->with('U heeft hier geen rechten voor.');
    }

    $reviewer = Reviewer::where('user_id', '=', $current_user->id)->first();

    $student = Student::find($student_id);
    $student_workprocess = Workprocess::find($workprocess_id);

    foreach ($reviewer->workprocesses as $workprocess) {
      // Checks if the workprocess is linked to the student
      if ($student_workprocess->id == $workprocess->id) {
        $student->workprocesses()->updateExistingPivot($workprocess_id, [
          'done' => 1
        ]);

        return back()->with('status', 'Werkproces ' . $workprocess_id . ' is voltooid.');
      }
    }

    return back()->with('status', 'U heeft geen rechten om dit werkproces te voltooien.');
  }

  /**
   * Sets the workprocess to not done of a student.
   *
   * @param $student_id
   * @param $workprocess_id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function setWorkprocessToNotDone($student_id, $workprocess_id) {
    $current_user = User::find(Auth::id());

    if ($current_user->role !== 'reviewer') {
      return back()->with('U heeft hier geen rechten voor.');
    }

    $reviewer = Reviewer::where('user_id', '=', $current_user->id)->first();

    $student = Student::find($student_id);
    $student_workprocess = Workprocess::find($workprocess_id);

    foreach ($reviewer->workprocesses as $workprocess) {
      // Checks if the workprocess is linked to the student
      if ($student_workprocess->id == $workprocess->id) {
        $student->workprocesses()->updateExistingPivot($workprocess_id, [
          'done' => 0
        ]);

        return back()->with('status', 'Werkproces ' . $workprocess_id . ' is onvoltooid.');
      }
    }

    return back()->with('status', 'U heeft geen rechten om dit werkproces te onvoltooien.');
  }

}
