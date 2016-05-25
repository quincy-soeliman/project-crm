<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProfileController extends Controller {
    
	public function index($id) {
		$user_id = Auth::User()->id;

		if ($user_id != $id) {
			return redirect('profile/' . $user_id);
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
		]);
	}

	public function update($id, Request $request) {
		$user_id = Auth::User()->id;

		if ($user_id != $id) {
			return redirect('profile/' . $user_id);
		}

		$user = User::find($user_id);

		switch ($user->role) {
			case 'student':
				$user->update([
					'email' => $request['email'],
				]);
				$user->student()->update([
					'college_id' => $request['college_id'],
					'first_name' => $request['first_name'],
					'last_name' => $request['last_name'],
					'college' => $request['college'],
				]);
				break;
		}

		return redirect('profile/' . $user_id);
	}

}
