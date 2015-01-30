<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Authentication Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to authentication functionality.
	|
	*/

	/**
	 * Performs a re-direct to the login screen.
	 *
	 * @return Redirect
	 */
	public function getIndex() {
		return Redirect::action('AuthController@getLogin');
	}

	/**
	 * Renders and returns the login screen.
	 *
	 * @return View
	 */
	public function getLogin() {
		return View::make('pages.auth.login');
	}

	/**
	 * Handles the authentication operation and performs a redirect.
	 *
	 * @return Redirect
	 */
	public function postLogin() {
		// handle the authentication request
	}

	/**
	 * Handles the logout operation and performs a redirect.
	 *
	 * @return Redirect
	 */
	public function getLogout() {
		// handle the logout request
	}
}
