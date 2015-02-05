<?php

/**
 * Handler class for Calendar operations.
 */
class HandlerCalendar
{
	private $months;

	private $days;

	private $disableWeekends;

	/**
	 * Constructs a new HandlerCalendar class.
	 */
	public function __construct() {
		$this->disableWeekends = true;
		
		$this->days = array(
			"Sunday",
			"Monday",
			"Tuesday",
			"Wednesday",
			"Thursday",
			"Friday",
			"Saturday"
		);

		$this->months = array(
			array(
				"name" => "January",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "February",
				"days" => 28,
				"leapdays" => 29,
				"holidays" => array(),
			),
			array(
				"name" => "March",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "April",
				"days" => 30,
				"holidays" => array(),
			),
			array(
				"name" => "May",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "June",
				"days" => 30,
				"holidays" => array(),
			),
			array(
				"name" => "July",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "August",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "September",
				"days" => 30,
				"holidays" => array(),
			),
			array(
				"name" => "October",
				"days" => 31,
				"holidays" => array(),
			),
			array(
				"name" => "November",
				"days" => 30,
				"holidays" => array(),
			),
			array(
				"name" => "December",
				"days" => 31,
				"holidays" => array(),
			),
		);
	}

	/**
	 * Set whether weekends are disabled on the calendar.
	 *
	 * @param boolean $disable Whether to disable weekends
	 */
	public function disableWeekends($disable) {
		$this->disableWeekends = $disable;
	}

	/**
	 * Returns the name of the current day.
	 *
	 * @return string
	 */
	public function getCurrentDay() {
		return $this->days[Carbon::now()->dayOfWeek];
	}

	/**
	 * Returns the array matching the current month.
	 *
	 * @return array
	 */
	public function getCurrentMonth() {
		return $this->months[Carbon::now()->month - 1];
	}

	/**
	 * Returns the array containing names of days.
	 *
	 * @return array:string
	 */
	public function getDays() {
		return $this->days;
	}

	/**
	 * Returns an array containing arrays for each month.
	 *
	 * @return array:array
	 */
	public function getMonths() {
		return $this->months;
	}

	/**
	 * Returns whether weekends are disabled on the calendar.
	 *
	 * @return boolean
	 */
	public function weekendsDisabled() {
		return $this->disableWeekends;
	}
}