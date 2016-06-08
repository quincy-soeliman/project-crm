<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller {

  /**
   * Returns the users view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $users = User::get();

    return view('pages.users', [
      'users' => $users,
    ]);
  }

  /**
   * Updates the user when the ID is equal to the given wildcard.
   *
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update($id) {
    $user = User::find($id);

    $user->update([
      'active' => 1,
    ]);

    return back()->with('status', $user->email . ' is geactiveerd.');
  }

  /**
   * Deletes the user and it's profile data depending on the role.
   *
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id) {
    $user = User::find($id);

    switch ($user->role) {
      case 'student':
        $student = $user->student();
        $student->delete();
        break;
      case 'teacher':
        $teacher = $user->teacher();
        $teacher->delete();
        break;
      case 'college':
        $college = $user->college();
        $college->delete();
        break;
      case 'reviewer':
        $reviewer = $user->reviewer();
        $reviewer->delete();
        break;
      case 'company':
        $company = $user->company();
        $company->delete();
        break;
      case 'administrator':
        $administrator = $user->administrator();
        $administrator->delete();
        break;
    }

    $user->delete();

    return back()->with('status', 'U heeft de gebruiker succesvol verwijderd.');
  }

}
