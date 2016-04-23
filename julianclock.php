<?php

/**
 * @package julianClock for Joomla 3.0
 * @version 1.0
 * @author Troy T. Hall (http://jowwow.net)
 * @copyright (C) 2016 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( dirname(__FILE__) . '/helper.php' );

// Get default .css file
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_julianclock/css/mod_julianclock.css');
$time = modJowClockHelper::getTime($params);
require( JModuleHelper::getLayoutPath('mod_julianclock') );
