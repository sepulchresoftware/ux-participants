<?php

class BaseController extends Controller {

	protected $activeNavItem;

	/**
	 * Constructs a new BaseController object with the desired active item in
	 * the nav bar if any.
	 *
	 * @param string $activeNavItem The active nav item in the navigation
	 */
	public function __construct($activeNavItem="") {
		$this->updateActiveNavItem($activeNavItem);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Updates the active item on the navigation bar.
	 *
	 * @param string $activeNavItem The new navigation element to use
	 */
	protected function updateActiveNavItem($activeNavItem="") {
		$this->activeNavItem = $activeNavItem;
		View::share('active_nav', $this->activeNavItem);
	}

}
