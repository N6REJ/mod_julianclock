<?php
/**
 * @package JowJulianClock for Joomla 3.0
 * @version 1.0
 * @author Troy T. Hall (http://jowwow.net)
 * @copyright (C) 2016 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

class modJowJulianClockHelper
{   
    public static function getTime( $params )
    {
		date_default_timezone_set('UTC'); 
		//$time=date("y,m,d,H,i,s");
		$time=date("F d, Y H:i:s");
        return $time;
    }
}