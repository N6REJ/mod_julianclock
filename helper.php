<?php

/**
 * @package julianClock for Joomla 3.0
 * @version 1.0
 * @author Troy T. Hall (http://jowwow.net)
 * @copyright (C) 2016 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Restricted access');

class modJulianClockHelper {

	public static function getTime($params) {
		date_default_timezone_set('UTC');
		//Get array of current date and time
		// http://php.net/manual/en/function.getdate.php
		$clockarray = getdate();

		// Convert to Julian date
		$julianDate = juliantojd($clockarray[mon], $clockarray[mday], $clockarray[year]);

		//now set the fraction of a day 
		$UTFrac = (3600 * $clockarray[hours] + 60 * $clockarray[minutes] + $clockarray[seconds]) / 86400;

// Gregorian is 13 days ahead of Julian so lets subtract it
		$julianDate = $julianDate - '13.5' + $UTFrac;
		// return extended julian date
		return $julianDate;
	}

}
