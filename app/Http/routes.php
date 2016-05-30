<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', 'HomeController@index');

// Authentication Routes...
Route::get('login', 'Auth\AuthController@index');
Route::post('login', 'Auth\AuthController@authenticate');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

/**
 * Registration Routes...
 */
Route::get('registreer', 'Registration\RoleController@index');

// Registration Student Routes...
Route::get('registreer/student', 'Registration\StudentController@index' );
Route::post('registreer/student', 'Registration\StudentController@create');

// Registration Teacher Routes...
Route::get('registreer/docent', 'Registration\TeacherController@index');
Route::post('registreer/docent', 'Registration\TeacherController@create');

// Registration Reviewer Routes...
Route::get('registreer/beoordelaar', 'Registration\ReviewerController@index');
Route::post('registreer/beoordelaar', 'Registration\ReviewerController@create');

// Registration College Routes...
Route::get('registreer/school', 'Registration\CollegeController@index');
Route::post('registreer/school', 'Registration\CollegeController@create');

// Registration Company Routes...
Route::get('registreer/bedrijf', 'Registration\CompanyController@index');
Route::post('registreer/bedrijf', 'Registration\CompanyController@create');

// Registration Administrator Routes...
Route::get('registreer/administrator', 'Registration\AdministratorController@index');
Route::post('registreer/administrator', 'Registration\AdministratorController@create');


/**
 * Authenticated Routes...
 */
Route::group(['middleware' => 'auth'], function() {

  // Profile Routes...
  Route::get('profiel/{id}', 'ProfileController@index');
  Route::get('profiel/{id}/bewerk', 'ProfileController@show_edit_form');
  Route::put('profiel/{user}/update', 'ProfileController@update');

  // Authentication Routes...
  Route::get('logout', 'Auth\AuthController@logout');

});

/**
 * College Routes...
 */
Route::group(['middleware' => ['role:college']], function() {

  // Analyses Routes...

});

/**
 * Administrator Routes...
 */
Route::group(['middleware' => ['role:administrator']], function() {

  // Coretasks Routes...
  Route::get('kerntaak', 'CoretaskController@index');
  Route::post('kerntaak', 'CoretaskController@create');

  // Workprocesses Routes...
  Route::get('werkproces', 'WorkprocessController@index');
  Route::post('werkproces', 'WorkprocessController@create');

});