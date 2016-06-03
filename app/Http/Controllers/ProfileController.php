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

  function __construct() {
    $this->middleware('edit-profile', ['only' => ['update']]);
  }

  public function index($id) {
    $user = User::find($id);
    $user_id = Auth::id();
    $current_user = User::find($user_id);

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

  public function update(User $user, EditProfileRequest $request) {
    switch ($user->role) {
      case 'student':
        $student_user = User::find($user->id)->student()->get();
        $student_id = $student_user[0]->id;
        $student = Student::find($student_id);

        $user->update([
          'email' => $request['email'],
        ]);

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

  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }

  public function setWorkprocessToDone($student_id, $workprocess_id) {
    $current_user = User::find(Auth::id());

    if ($current_user->role !== 'reviewer') {
      return back()->with('U heeft hier geen rechten voor.');
    }

    $reviewer = Reviewer::where('user_id', '=', $current_user->id)->first();

    $student = Student::find($student_id);
    $student_workprocess = Workprocess::find($workprocess_id);

    foreach ($reviewer->workprocesses as $workprocess) {
      if ($student_workprocess->id == $workprocess->id) {
        $student->workprocesses()->updateExistingPivot($workprocess_id, [
          'done' => 1
        ]);

        return back()->with('status', 'Werkproces ' . $workprocess_id . ' is voltooid.');
      }
    }

    return back()->with('status', 'U heeft geen rechten om dit werkproces te voltooien.');
  }

  public function setWorkprocessToNotDone($student_id, $workprocess_id) {
    $current_user = User::find(Auth::id());

    if ($current_user->role !== 'reviewer') {
      return back()->with('U heeft hier geen rechten voor.');
    }

    $reviewer = Reviewer::where('user_id', '=', $current_user->id)->first();

    $student = Student::find($student_id);
    $student_workprocess = Workprocess::find($workprocess_id);

    foreach ($reviewer->workprocesses as $workprocess) {
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
