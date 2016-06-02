<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller {

  public function index() {
    $users = User::get();

    return view('pages.users', [
      'users' => $users,
    ]);
  }

  public function update(User $id, Request $request) {
    if (empty($request['active'])) {
      return back()->with('status', 'Request: "active" is leeg.');
    }

    $user = User::find($id);

    $user->update([
      'active' => $request['active'],
    ]);

    return back()->with('status', '');
  }

  public function destroy(User $id) {
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
  }

}
