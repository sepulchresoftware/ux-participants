<?php

use Illuminate\Support\MessageBag;

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
	 * Constructs a new AuthController.
	 */
	public function __construct() {
		parent::__construct('login');
	}

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
		$rules = [
			'username' => 'required',
		];

		// if we don't allow blank passwords then add the validator rule
		if(!Config::get('app.ldap.allow_no_pass')) {
			$rules['password'] = 'required';
		}

		// create the validator for the login attempt
		$validator = Validator::make(
			$input = [
				'username' => Input::get('username'),
				'password' => Input::get('password')
			],
			$rules
		);

		// check to see if the validator fails
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// the validator passed so now attempt to perform the login
		if(Auth::attempt($input)) {
			// auth successful, so re-direct back to the landing page unless
			// we have a return URL specified
			if(Input::has('return')) {
				return Redirect::to(urldecode(Input::get('return')));
			}

			// if no explicit return URL, use the intended route before we
			// were re-directed to the login page (used when you have the
			// "before auth" filter on a route); if intended route cannot
			// be retrieved for some reason, just redirect to the landing
			// page instead.
			return Redirect::intended('/');
		}
		
		// set the errors and redirect back to the login screen
		$errorBag = new MessageBag(array(
			"invalid" => "Invalid username / password combination",
		));
		return Redirect::back()->with('errors', $errorBag);
	}

	/**
	 * Handles the logout operation and performs a redirect.
	 *
	 * @return Redirect
	 */
	public function getLogout() {
		// handle the logout request
		Auth::logout();
		return Redirect::to('/');
	}
}
