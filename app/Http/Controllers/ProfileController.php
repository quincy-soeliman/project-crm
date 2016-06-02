<?php

namespace App\Http\Controllers;

use App\Reviewer;
use App\Student;
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
    ]);
  }

  public function update(User $user, EditProfileRequest $request) {
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

    foreach ($reviewers as $reviewer) {
      if (!empty($reviewer->analyses()->get())) {
        foreach ($reviewer->analyses()->get() as $key => $analyses) {
          array_push($analyses_array, $analyses->id);
        }
      }
    }

    $student->analyses()->sync($analyses_array);

    return redirect('profiel/' . $user->id)->with('status', 'Uw profiel is bijgewerkt.');
  }

  public function show_edit_form($id) {
    $user_id = Auth::id();

    if ($user_id != $id) {
      return back()->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
    }

    $user = User::find($id);
    $colleges = College::get();

    switch ($user->role) {
      case 'student':
        $data = $user->student()->get();
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
      'colleges' => $colleges,
      'reviewers' => $reviewers,
    ]);
  }

  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }

}
