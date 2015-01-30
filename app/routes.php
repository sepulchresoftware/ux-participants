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

// default route for the landing screen
Route::get('/', 'HomeController@getIndex');

// define the catch-all for 404 pages
App::missing(function($exception) {
	return ErrorController::get404($exception);
});