<?php

/**
 * Handler class for participant calendar operations.
 */
class CalendarParticipants extends AbstractCalendar
{
	protected $study;
	protected $participants;

	// documentation provided in parent class
	protected function renderCellContent($cellId, $startDay) {
		$available = 0;
		$confirmed = 0;
		$markup = "";

		$participantsLink = url('calendars/' . $this->study->id . '/participants') .
			"?month=" . $this->carbon->month . "&year=" . $this->carbon->year;

		// ensure we are operating on a cell ID that isn't a spacer
		if($cellId >= $startDay) {
			// figure out how many participants are available or confirmed
			foreach($this->participants as $participant) {
				$entry = new Carbon($participant->pivot->timestamp);
				if($entry->month == $this->carbon->month &&
				   $entry->day == ($cellId - $startDay + 1) &&
				   $entry->year == $this->carbon->year) {
					if($participant->pivot->confirmed) {
						$confirmed++;
					}
					else
					{
						$available++;
					}
				}
			}

			// render the day of the month
			$markup .= (($cellId - $startDay) + 1);

			// render the number of available participants
			if($available > 0) {
				$markup .= <<<AVAILABLE
					<br />
					<a href='{$participantsLink}'>
						<span class='label label-default'>
							$available Available
						</span>
					</a>
AVAILABLE;
			}

			// render the number of confirmed participants
			if($confirmed > 0) {
				$markup .= <<<CONFIRMED
					<br />
					<a href='{$participantsLink}'>
						<span class='label label-primary'>
							<i class='fa fa-check'></i> $confirmed Confirmed
						</span>
					</a>
CONFIRMED;
			}
		}

		return $markup;
	}

	/**
	 * Sets the study to be represented with this calendar.
	 *
	 * @param Study $study The study to use with this calendar
	 */
	public function setStudy($study) {
		$this->study = $study;
		$this->participants = $study->participants;
	}
}