<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Subject;
use App\Course;
use App\Category;
use App\Profile;
use App\Notification_Model;
use App\User;
use Illuminate\Support\Facades\Response;
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
Route::get('profile/student/{id}', 'ProfileController@showProfile');

//Faculty Profile Routes
Route::get('profile/faculty', 'ProfileController@index');
Route::get('profile/faculty/edit', 'ProfileController@editFacultyProfile');
Route::post('profile/faculty/edit','ProfileController@updateFacultyProfile');
Route::get('profile/filtercourses', function(){
  	$input = Input::get('option');
  	$department = Department::where('name', '=', $input)->first();
  	$course = Course::where('department', '=', $department->id);
	return Response::make($course->get(['idcourses','course_number', 'name']));
});
Route::get('profile/filtercategories', function(){
  	$input = Input::get('option');
  	$department = Department::where('name', '=', $input)->first();
  	$category = Category::where('department', '=', $department->id);
	return Response::make($category->get(['id', 'name']));
});



Route::get('profile/search', 'ProfileController@profileSearch');

Route::post('profile/search','ProfileController@profileSearchResult');





//Admin Routes
Route::get('admin/database', 'AdminController@databaseAdmin');
Route::get('admin/site', 'AdminController@siteAdmin');

Route::resource('departments', 'DepartmentController');
Route::resource('subjects', 'SubjectController');

//Notification Routes
Route::post('notification/delete/{id}', 'NotificationController@delete');
Route::post('notification/read/{id}', 'NotificationController@markRead');
Route::get('notification/count', function(){
    $notification = Notification_Model::where([
      ['user_id', '=', Auth::user()->id],
      ['is_read', '=', 0]
      ]);
    
  return Response::make($notification->get(['title_html', 'body_html']));
});

//Research Routes
Route::resource('research', 'Research_OpportunitiesController');
//Route::post('research/save/{id}', 'Saved_OpportunitiesController@markSaved');
//Route::get('saved/research', 'Saved_OpportunitiesController@showSaved');
//Route::post('saved/delete/{id}', 'Saved_OpportunitiesController@deleteSaved');
Route::get('createR/filterfaculty', function(){
    $input = Input::get('option');
    $matched = new \Illuminate\Database\Eloquent\Collection;
    $department = Department::where('id', '=', $input)->first();
    $profiles = Profile::where('department', '=', $department->name)->get();
    foreach ($profiles as $profile) {
      $user = $profile->user;
      $matched->add($user);
    }
    
  return Response::make($matched);
});
Route::get('createR/filtercategories', function(){
    $input = Input::get('option');
    $department = Department::where('id', '=', $input)->first();
    $category = Category::where('department', '=', $department->id);
  return Response::make($category->get(['id', 'name']));
});
