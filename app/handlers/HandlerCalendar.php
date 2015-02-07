<?php

/**
 * Handler class for Calendar operations.
 */
class HandlerCalendar
{
	private $carbon;
	private $firstDay;

	private $month;
	private $months;

	private $day;
	private $days;

	private $year;

	private $disableWeekends;

	/**
	 * Constructs a new HandlerCalendar class.
	 *
	 * @param integer $month Optional month for the calendar
	 * @param integer $day Optional day for the calendar
	 * @param integer $year Optional year for the calendar
	 */
	public function __construct($month=null, $day=null, $year=null) {
		$this->disableWeekends = true;

		// construct a Carbon object based on the parameters
		$month = (!empty($month) ? $month : date("m"));
		$day = (!empty($day) ? $day : date("d"));
		$year = (!empty($year) ? $year : date("Y"));
		$this->carbon = new Carbon("{$month}/{$day}/{$year}");

		// assign the values
		$this->month = $month;
		$this->day = $day;
		$this->year = $year;
		$this->firstDay = new Carbon("{$month}/01/{$year}");
		
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
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December"
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
	 * Returns the name of the day.
	 *
	 * @return string
	 */
	public function getDay() {
		return $this->days[$this->carbon->dayOfWeek];
	}

	/**
	 * Returns the number of days in the month.
	 *
	 * @return integer
	 */
	public function getDaysInMonth() {
		return $this->carbon->daysInMonth;
	}

	/**
	 * Returns the name of the month.
	 *
	 * @return array
	 */
	public function getMonth() {
		return $this->months[$this->carbon->month - 1];
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
	 * Returns the day on which the month started.
	 *
	 * @return string
	 */
	public function getStartDayOfMonth() {
		return $this->days[$this->firstDay->dayOfWeek];
	}

	/**
	 * Returns the index of the start day for the month.
	 *
	 * @return integer
	 */
	public function getStartDayOfMonthIndex() {
		return $this->firstDay->dayOfWeek;
	}

	/**
	 * Renders and returns the markup to display the calendar.
	 *
	 * @return string
	 */
	public function render() {
		$markup = <<<MARKUP
			<table class="table">
				<thead>
					<tr>
						<th colspan="7">{$this->getMonth()}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
MARKUP;

		// display the set of days
		foreach($this->getDays() as $day) {
			$markup .= "<td>{$day}</td>";
		}
		$markup .= "</tr>";

		// iterate over the days and build the calendar
		$startDay = $this->getStartDayOfMonthIndex();
		
		// figure out the body of the calendar
		for($i = 0; $i < $this->getDaysInMonth() + $startDay; $i++) {
			// week rows start on the first day of the week
			if($i % 7 == 0) {
				$markup .= "<tr>";
			}

			// add the cell for the day
			$markup .= "<td>";
			if($i >= $startDay) {
				$markup .= (($i - $startDay) + 1);
			}
			$markup .= "</td>";

			// end the row if we know the next day will be the start of a new week
			if(($i + 1) % 7 == 0) {
				$markup .= "</tr>";
			}
		}

		// close the table and return the markup
		$markup .= "</tbody></table>";
		return $markup;
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