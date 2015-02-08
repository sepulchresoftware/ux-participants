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
			'except' => ['doSignup', 'signup']
		));
		$this->beforeFilter('auth');

		// if the logged-in user is an administrator, activate the Calendars item
		// in the navigation bar instead
		if(Auth::check()) {
			if(Auth::user()->isAdmin()) {
				$this->updateActiveNavItem('calendars');
			}
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
		$study = Study::with('participants')->where('id', '=', $id)->firstOrFail();

		// ensure we are rendering the proper calendar
		if(Input::has('month') && Input::has('year')) {
			$calendar = new CalendarParticipants(
				Input::get('month'),
				1,
				Input::get('year')
			);
		}
		else
		{
			$calendar = new CalendarParticipants();
		}

		// create the participants calendar with the specified study
		$calendar->setStudy($study);
		return View::make('pages.calendars.show', compact('study', 'calendar'));
	}

	/**
	 * Renders and returns the view page for a calendar to specify availability.
	 *
	 * @return integer $id The ID of the calendar to use
	 * @return View
	 */
	public function signup($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();
		return View::make('pages.calendars.signup', compact('study'));
	}

	/**
	 * Performs the signup operation on the specified calendar ID.
	 *
	 * @param integer $id The ID of the calendar to use for signups
	 * @return View
	 */
	public function doSignup($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();

		// make sure this study is not locked
		if($study->locked) {
			return Redirect::back();
		}

		// set up the validation
		$slots = ["first", "second", "third"];
		$input = [];
		$rules = [];
		foreach($slots as $slot) {
			$input["{$slot}-slot"] = Input::get("{$slot}-slot");
			$rules["{$slot}-slot"] = 'date_format:m/d/Y g:i A|after:' . date("m/d/Y g:i A");
		}

		// bounce back if the validator failed
		$validator = Validator::make($input, $rules);
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// iterate over the time slots and add the records to the DB as signups
		$added = 0;
		foreach($slots as $slot) {
			if(!empty($input["{$slot}-slot"])) {
				// add the availability to the pivot table
				$study->participants()->attach($study->id, array(
					'user_id' => Auth::user()->id,
					'timestamp' => $input["{$slot}-slot"],
					'confirmed' => FALSE,
					'confirmed_on' => 0,
					'confirmed_by' => 0,
				));

				$added++;
			}
		}

		// show the success message
		$success = "You have successfully submitted {$added} available time slot(s) for <strong>" . e($study->name) . "</strong>.";
		return View::make('pages.calendars.signup', compact('study', 'success'));
	}
}