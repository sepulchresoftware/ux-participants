<?php

/**
 * Handles operations related to the display of a basic calendar.
 */
class CalendarBasic extends AbstractCalendar
{
	// documentation provided in parent class
	protected function renderCellContent($cellId, $startDay) {
		if($cellId >= $startDay) {
			return (($cellId - $startDay) + 1);
		}

		return "";
	}
}