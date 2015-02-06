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
		$calendar = new Calendar();
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

		// perform the validation first
		$validator = Validator::make(
			$input = [
				'first-slot' => Input::get('first-slot'),
				'second-slot' => Input::get('second-slot'),
				'third-slot' => Input::get('third-slot')
			],
			$rules = [
				'first-slot' => 'date_format:m/d/Y g:i A|after:' . date("m/d/Y g:i A"),
				'second-slot' => 'date_format:m/d/Y g:i A|after:' . date("m/d/Y g:i A"),
				'third-slot' => 'date_format:m/d/Y g:i A|after:' . date("m/d/Y g:i A"),
			]
		);

		// perform extra validation on the dates to ensure some semblance of sanity
		/*$validator->after(function($validator) use $input {
		    if ($this->somethingElseIsInvalid()) {
		        $validator->errors()->add('field', 'Something is wrong with this field!');
		    }
		});*/

		// bounce back if the validator failed
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		dd("FUCK YISSS");
	}
}