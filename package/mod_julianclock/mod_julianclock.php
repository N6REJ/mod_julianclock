<?php

/** 
 * Bears Julian Clock
 * @version 2025.07.20
 * @package mod_julianclock
 * @author N6REJ 
 * @email troy@hallhome.us 
 * @website https://www.hallhome.us 
 * @copyright Copyright (C) 2025 Troy Hall (N6REJ)
 * @license GNU General Public License version 3 or later; see LICENSE.txt 
 * @since 2025.5.10
 *
 * @var Joomla\CMS\Module\Module $module
 * @var Joomla\Registry\Registry $params
 */

// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$layoutPath = ModuleHelper::getLayoutPath($module->module);
$displayData = [
    'module' => $module,
    'params' => $params,
];
include $layoutPath;
