<?php

use Illuminate\Support\MessageBag;

class StudyController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Study Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to study creation and signup functionality.
	|
	*/

	/**
	 * Constructs a new StudyController object.
	 */
	public function __construct() {
		parent::__construct('studies');

		// ensure the user is authenticated or an admin for certain operations
		$this->beforeFilter('auth.admin', array(
			'on' => ['create', 'store', 'edit', 'update', 'destroy']
		));
		$this->beforeFilter('auth');
	}

	/**
	 * Performs a re-direct to the administration screen.
	 *
	 * @return Redirect
	 */
	public function index() {
		return View::make('pages.studies.index');
	}
}
