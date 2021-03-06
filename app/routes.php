<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 Authentication controller handles these routes:
 - /auth
 - /auth/login
 - /auth/logout
 */
Route::controller('/auth', 'AuthController');

/*
 Administration controller handles these routes:
 - /admin
 */
Route::controller('/admin', 'AdminController');

// controller for user-related actions
Route::get('/users/{id}/studies', 'UserController@studies');
Route::resource('/users', 'UserController');

// resource for calendars related to studies
Route::get('/calendars/{id}/slot/{slot}/clear', 'CalendarController@clearConfirm');
Route::get('/calendars/{id}/slot/{slot}/confirm', 'CalendarController@confirm');
Route::get('/calendars/{id}/participants', 'CalendarController@participants');
Route::get('/calendars/{id}/signup', 'CalendarController@signup');
Route::post('/calendars/{id}/signup', 'CalendarController@doSignup');
Route::resource('/calendars', 'CalendarController');

// resource for studies and associated actions
Route::get('/studies/{id}/delete', 'StudyController@delete');
Route::get('/studies/{id}/lock', 'StudyController@lock');
Route::get('/studies/{id}/unlock', 'StudyController@unlock');
Route::resource('/studies', 'StudyController');

// default route for the landing screen
Route::get('/', 'HomeController@getIndex');

// define the global exception handler
App::error(function($exception) {
	if($exception instanceof Illuminate\Database\Eloquent\ModelNotFoundException ||
		$exception instanceof BadMethodCallException) {
		return ErrorController::make404($exception);
	}
});

// define the catch-all for 404 pages
App::missing(function($exception) {
	return ErrorController::make404($exception);
});