<?php

use Illuminate\Support\MessageBag;

class CalendarController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Calendar Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to the viewing of study calendars.
	|
	*/

	/**
	 * Constructs a new CalendarController object.
	 */
	public function __construct() {
		parent::__construct('studies');

		// ensure the user is authenticated or an admin for certain operations
		$this->beforeFilter('auth.admin', array(
			'on' => ['index']
		));
		$this->beforeFilter('auth');

		// if the logged-in user is an administrator, activate the Calendars item
		// in the navigation bar instead
		if(Auth::user()->isAdmin()) {
			$this->updateActiveNavItem('calendars');
		}
	}

	/**
	 * Renders and returns the index page showing all available calendars.
	 *
	 * @return View
	 */
	public function index() {
		$studies = Study::where('locked', '=', '0')->orderBy('name', 'ASC')->get();
		$lockedStudies = Study::where('locked', '=', '1')->orderBy('name', 'ASC')->get();
		return View::make('pages.calendars.index', compact('studies', 'lockedStudies'));
	}

	/**
	 * Renders and returns the view page for a specific calendar.
	 *
	 * @return integer $id The ID of the calendar to display
	 * @return View
	 */
	public function show($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();
		return View::make('pages.calendars.show', compact('study'));
	}
}