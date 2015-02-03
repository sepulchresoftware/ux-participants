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

	/**
	 * Displays an edit screen for the study with the specified ID.
	 *
	 * @param integer $id The ID of the study to edit
	 * @return View
	 */
	public function edit($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();
		return View::make('pages.studies.edit', compact('study'));
	}

	/**
	 * Handles the submission and modification of an existing study.
	 *
	 * @param integer $id The ID of the study to update
	 * @return View
	 */
	public function update($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();

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
		$study->fill($input);
		$study->save();
		$study->touch();

		// show the success message and the confirmation screen
		$success = "Successfully updated study named <strong>" . e($input['name']) . "</strong>.";
		return View::make('pages.studies.edit', compact('success', 'study'));
	}

	/**
	 * Handles the display of the delete confirmation screen.
	 *
	 * @param integer $id The ID of the study for which to confirm deletion
	 * @return View
	 */
	public function delete($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();
		return View::make('pages.studies.destroy', compact('study'));
	}

	/**
	 * Handles the deletion operation for the specified study ID.
	 *
	 * @param integer $id The ID of the study to delete
	 * @return View
	 */
	public function destroy($id) {
		$study = Study::where('id', '=', $id)->firstOrFail();

		// delete all participants for this study
		$study->participants()->detach();

		// now delete the study
		$study->delete();

		// show the success message and the confirmation screen
		$success = "Successfully deleted study named <strong>" . e($study->name) . "</strong>.";
		return View::make('pages.studies.destroy', compact('success'));
	}
}
