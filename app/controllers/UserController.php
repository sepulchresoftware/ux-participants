<?php

use Illuminate\Support\MessageBag;

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to user profile and confirmed study display.
	|
	*/

	/**
	 * Constructs a new UserController object.
	 */
	public function __construct() {
		parent::__construct('my-profile');

		// ensure the user is authenticated
		$this->beforeFilter('auth');
	}

	/**
	 * Render and return all studies with the user ID as a participant.
	 *
	 * @param integer $id The user ID to use when searching
	 * @return View
	 */
	public function studies($id) {
		$this->updateActiveNavItem('my-studies');
		$studies = User::find($id)->studies()->orderBy("name", "ASC")->get();

		return View::make('pages.users.studies', compact('studies'));
	}
}