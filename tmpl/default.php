<?php
/**
 * Bears Julian Clock
 * @version 2025.06.09.2
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

	// --- Pause/Resume logic ---
	let julianClockInterval = null;
	const updateInterval = <?php echo $params->get('updateInterval'); ?>;
	const clockSelector = '.jdate_<?php echo $moduleTitle; ?>';

	function startJulianClock() {
		if (julianClockInterval === null) {
			julianClockInterval = setInterval(getJulian_<?php echo $moduleTitle; ?>, updateInterval);
		}
	}

	function stopJulianClock() {
		if (julianClockInterval !== null) {
			clearInterval(julianClockInterval);
			julianClockInterval = null;
		}
	}

	document.addEventListener('DOMContentLoaded', function () {
		startJulianClock();
		// Add pause/resume on hover (desktop) and touch (mobile)
		document.querySelectorAll(clockSelector).forEach(function(el) {
			// Desktop hover
			el.addEventListener('mouseenter', stopJulianClock);
			el.addEventListener('mouseleave', function() {
				getJulian_<?php echo $moduleTitle; ?>();
				startJulianClock();
			});
			// Mobile touch
			el.addEventListener('touchstart', function(e) {
				stopJulianClock();
				// Prevent scrolling while paused
				e.preventDefault();
			}, {passive: false});
			el.addEventListener('touchend', function() {
				getJulian_<?php echo $moduleTitle; ?>();
				startJulianClock();
			});
			el.addEventListener('touchcancel', function() {
				getJulian_<?php echo $moduleTitle; ?>();
				startJulianClock();
			});
		});
	});

</script>
