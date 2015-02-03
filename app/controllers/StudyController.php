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
	 * Renders and returns the index page showing all available studies.
	 *
	 * @return View
	 */
	public function index() {
		$studies = Study::where('active', '=', '1')->orderBy('name', 'ASC')->get();
		return View::make('pages.studies.index', compact('studies'));
	}

	/**
	 * Renders and returns the page allowing a user to create a new study.
	 *
	 * @return View
	 */
	public function create() {
		return View::make('pages.studies.create');
	}

	/**
	 * Handles the submission and creation of a new study.
	 *
	 * @return View
	 */
	public function store() {
		$validator = Validator::make(
			$input = [
				'name'        => Input::get('name'),
				'description' => Input::get('description')
			],
			$rules = [
				'name'        => 'required'
			]
		);

		// if the validator failed go back to the input screen
		if($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// the input passed validation so we can perform the DB operation
		$study = new Study();
		$study->fill($input);
		$study->author_id = Auth::user()->id;
		$study->save();
		$study->touch();

		// show the success message and redirect back
		$success = "Successfully created study named <strong>" . e($input['name']) . "</strong>.";
		return View::make('pages.studies.create', compact('success'));
	}

	/**
	 * Displays the study with the given ID.
	 *
	 * @param integer $id The ID of the study to display
	 * @return View
	 */
	public function show($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();
		return View::make('pages.studies.show', compact('study'));
	}
}
