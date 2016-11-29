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

Route::controllers([
   'password' => 'Auth\PasswordController',
]);

//Home
Route::get('/home', 'HomeController@index');

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('usertype', 'Auth\AuthController@userType');
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

//Verify User Route
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
]);

//Password Reset Routes
Route::get('profile/resetPassword', 'ProfileController@editPassword');
Route::post('profile/resetPassword', 'ProfileController@resetPassword');

//Student Profile Routes
Route::get('profile/student', 'ProfileController@index');
Route::get('profile/student/edit', 'ProfileController@editStudentProfile');
Route::post('profile/student/edit','ProfileController@updateStudentProfile');
//Faculty Profile Routes
Route::get('profile/faculty', 'ProfileController@index');
Route::get('profile/faculty/edit', 'ProfileController@editFacultyProfile');
Route::post('profile/faculty/edit','ProfileController@updateFacultyProfile');

//Admin Routes
Route::get('admin/database', 'AdminController@databaseAdmin');
Route::get('admin/site', 'AdminController@siteAdmin');

Route::resource('departments', 'DepartmentController');
Route::resource('subjects', 'SubjectController');