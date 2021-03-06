<?php

namespace App\Http\Controllers;

use App\Coretask;
use App\Reviewer;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class ReviewerController extends Controller {

  /**
   * Returns the reviewers view.
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index() {
    $reviewers = Reviewer::get();
    $id = Auth::id();
    $current_user = User::find($id);

    return view('pages.reviewers', [
      'reviewers' => $reviewers,
      'current_user' => $current_user,
    ]);
  }

  public function getReviewersByCompany() {
    $current_user = User::find(Auth::id());

    if ($current_user->role !== 'company') {
      return back()->with('status', 'U heeft hier geen rechten voor.');
    }

    $company = $current_user->company;
    $reviewers = $company->reviewers;

    return view('pages.reviewers_overzicht', [
      'company' => $company,
      'reviewers' => $reviewers,
    ]);
  }

  /**
   * Returns the link reviewers view.
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function link($id) {
    $reviewer = Reviewer::find(Auth::id());
    $coretasks = Coretask::get();

    return view('pages.reviewers_link', [
      'reviewer' => $reviewer,
      'coretasks' => $coretasks,
      'id' => $id
    ]);
  }

  /**
   * Links the reviewer with the workprocesses.
   *
   * @param $id
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function linkUpdate($id, Request $request) {
    $reviewer = Reviewer::where('user_id', '=', $id)->first();

    if (!empty($request['workprocesses'])) {
      $workprocesses = $this->syncData($request['workprocesses']);

      $reviewer->workprocesses()->sync($workprocesses);
    }

    return redirect('beoordelaars')->with('status', 'De KT/WP is gekoppeld aan de beoordelaar.');
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

}
