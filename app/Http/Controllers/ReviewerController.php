<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Reviewer;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class ReviewerController extends Controller {

  public function index() {
    $reviewers = Reviewer::get();
    $id = Auth::id();
    $current_user = User::find($id);

    return view('pages.reviewers', [
      'reviewers' => $reviewers,
      'current_user' => $current_user,
    ]);
  }

  public function link($id) {
    $coretasks = Coretask::get();

    return view('pages.reviewers_link', [
      'coretasks' => $coretasks,
      'id' => $id
    ]);
  }

  public function linkUpdate($id, Request $request) {
    $reviewer = Reviewer::where('user_id', '=', $id)->first();

    if (!empty($request['workprocesses'])) {
      $workprocesses = $this->syncData($request['workprocesses']);

      $reviewer->workprocesses()->sync($workprocesses);
    }

    return redirect('beoordelaars')->with('status', 'De KT/WP is gekoppeld aan de beoordelaar.');
  }

  public function syncData($request) {
    $array = [];

    foreach ($request as $key => $data) {
      array_push($array, $data);
    }

    return $array;
  }

}
