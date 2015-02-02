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

// default route for the landing screen
Route::get('/', 'HomeController@getIndex');

// define the global ModelNotFoundException handler
App::error(function(Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
	return ErrorController::make404($exception);
});

// define the catch-all for 404 pages
App::missing(function($exception) {
	return ErrorController::make404($exception);
});