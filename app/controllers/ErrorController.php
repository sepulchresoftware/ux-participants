<?php

class ErrorController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Error Controller
	|--------------------------------------------------------------------------
	|
	| Handles operations related to error display functionality.
	|
	*/

	/**
	 * Handles a 404 error with the provided exception.
	 *
	 * @param Exception $exception The generated exception during the request
	 * @return Response
	 */
	public static function get404($exception) {
		return Response::make(View::make('pages.errors.404'), 404);
	}
}
