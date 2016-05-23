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
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

/**
 * Registration Routes...
 */
Route::get('registreer', 'Registration\RoleController@showRoleSelectionForm');

// Registration Student Routes...
Route::get('registreer/student', 'Registration\StudentController@showStudentForm');
Route::post('registreer/student', 'Registration\StudentController@create');

// Registration Teacher Routes...
Route::get('registreer/docent', 'Registration\TeacherController@showTeacherForm');
Route::post('registreer/docent', 'Registration\TeacherController@create');

// Registration Reviewer Routes...
Route::get('registreer/beoordelaar', 'Registration\ReviewerController@showReviewerForm');
Route::post('registreer/beoordelaar', 'Registration\ReviewerController@create');

// Registration College Routes...
Route::get('registreer/school', 'Registration\CollegeController@showCollegeForm');
Route::post('registreer/school', 'Registration\CollegeController@create');

// Registration Company Routes...
Route::get('registreer/bedrijf', 'Registration\CompanyController@showCompanyForm');
Route::post('registreer/bedrijf', 'Registration\CompanyController@create');

// Registration Administrator Routes...
Route::get('registreer/administrator', 'Registration\AdministratorController@showAdministratorForm');
Route::post('registreer/administrator', 'Registration\AdministratorController@create');

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@authenticate');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');
