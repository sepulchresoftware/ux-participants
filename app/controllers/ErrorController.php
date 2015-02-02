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
	 * Handles a 401 error with the provided exception.
	 *
	 * @param Exception $exception The generated exception during the request, if any
	 * @return Response
	 */
	public static function make401($exception=null) {
		return Response::make(View::make('pages.errors.401'), 401);
	}

	/**
	 * Handles a 404 error with the provided exception.
	 *
	 * @param Exception $exception The generated exception during the request
	 * @return Response
	 */
	public static function make404($exception) {
		return Response::make(View::make('pages.errors.404'), 404);
	}
}
