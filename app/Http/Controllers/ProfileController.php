<?php

namespace App\Http\Controllers;

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
    $user_id = Auth::id();

    if ($user_id != $id) {
      return redirect('profile/' . $user_id)->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
    }

    $user = User::find($id);

    switch ($user->role) {
      case 'student':
        $data = $user->student()->get();
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
      'data' => $data,
      'role' => $user->role,
      'email' => $user->email
    ]);
  }

  public function update(User $user, EditProfileRequest $request) {
    $user->update([
      'email' => $request['email'],
    ]);

    $user->student()->update([
      'college_id' => $request['college_id'],
      'first_name' => $request['first_name'],
      'last_name' => $request['last_name'],
      'college' => $request['college'],
    ]);

    return redirect('profile/' . $user->id);
  }

  public function show_edit_form($id) {
    $user_id = Auth::id();

    if ($user_id != $id) {
      return redirect('profile/' . $user_id)->with('status', 'U heeft geen rechten om de pagina te bezoeken.');
    }

    $user = User::find($id);
    $colleges = College::get();

    switch ($user->role) {
      case 'student':
        $data = $user->student()->get();
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
      'colleges' => $colleges
    ]);
  }

}
