<?php
/**
 * Bears Julian Clock
 * @version 2025.06.05.3 
 * @package mod_julianclock
 * @author N6REJ 
 * @email troy@hallhome.us 
 * @website https://www.hallhome.us 
 * @copyright Copyright (c) 2025 N6REJ 
 * @license GNU General Public License version 3 or later; see LICENSE.txt 
 * @since 2025.5.10
 *
 * @var array $displayData Contains the variables passed from the module entry file
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Joomla 5: Use $displayData['module'] and $displayData['params']
$module = $displayData['module'];
$params = $displayData['params'];
/** @var Joomla\CMS\Module\Module $module */
/** @var Joomla\Registry\Registry $params */

/* we need some basic parameters */
$moduleTitle = $module->title;
$moduleTitle = strtolower($moduleTitle);
$moduleTitle = preg_replace('/[^a-z0-9]/i', '_', $moduleTitle);
$moduleSuffix = $params->get('moduleclass_sfx');
$icon = '<span class="' . $params->get('icon') . '"></span>';

/* lets set the text for pre and post time */
if ($params->get('position')) {
	$preText = $icon . $params->get('clockText') . " ";
	$postText = '';
} else {
	$postText = " " . $params->get('clockText');
	$preText = '';
}

// Construct the CSS class string.
$baseClass = 'jdate_' . $moduleTitle;
$classes = $baseClass . ($moduleSuffix ? ' ' . $moduleSuffix : ' ');
?>

<!-- BEGIN LAYOUT -->
<div class="<?php echo $classes; ?>">
</div>
<!-- END LAYOUT -->

<!-- formula derived from https://en.wikipedia.org/wiki/Julian_day -->
<script type="text/javascript" >

	function getJulian_<?php echo $moduleTitle; ?>()
	{
		const now = new Date();
		const day = now.getUTCDate();
		const month = now.getUTCMonth() + 1;
		const year = now.getUTCFullYear();
		const hours = now.getUTCHours();
		const minutes = now.getUTCMinutes();
		const seconds = now.getUTCSeconds();
		const a = Math.floor((14 - month) / 12);
		const y = year + 4800 - a;
		const m = month + (12 * a) - 3;
		const JDN = day + Math.floor(((153 * m) + 2) / 5) + (365 * y) + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
		const JulianDate = (JDN + ((hours - 12) / 24) + (minutes / 1440) + (seconds / 86400)).toFixed(<?php echo $params->get('precision');?>);

	
document.querySelectorAll('.jdate_<?php echo $moduleTitle; ?>').forEach(el => {
		el.innerHTML = '<?php echo $preText; ?>' + JulianDate + '<?php echo $postText; ?>';
	});
	}

	// Lets call the clock so display it the first time before the counter starts
	getJulian_<?php echo $moduleTitle; ?>();

	// Update the displayed time after x period
	document.addEventListener('DOMContentLoaded', function () {
		setInterval(getJulian_<?php echo $moduleTitle; ?>, <?php echo $params->get('updateInterval'); ?>);
	});

</script>
