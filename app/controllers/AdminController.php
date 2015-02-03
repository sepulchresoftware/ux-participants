<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Administration Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to administrative functionality.
	|
	*/

	/**
	 * Constructs a new AdminController object.
	 */
	public function __construct() {
		parent::__construct('admin');
		
		// ensure the user is authenticated and an admin
		$this->beforeFilter('auth.admin');
	}

	/**
	 * Renders and returns the admin landing page.
	 *
	 * @return View
	 */
	public function getIndex() {
		return View::make('pages.admin.index');
	}
}
