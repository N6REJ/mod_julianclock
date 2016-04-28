<?php
/**
 * @package jdate for Joomla 3.0
 * @version 1.5
 * @author Troy T. Hall (http://jowwow.me)
 * @copyright (C) 2013 JowWow
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

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
		var now = new Date();
		var day = now.getUTCDate();
		var month = now.getUTCMonth() + 1;
		var year = now.getUTCFullYear();
		var hours = now.getUTCHours();
		var minutes = now.getUTCMinutes();
		var seconds = now.getUTCSeconds();
		var a = Math.floor((14 - month) / 12);
		var y = year + 4800 - a;
		var m = month + (12 * a) - 3;
		var JDN = day + Math.floor(((153 * m) + 2) / 5) + (365 * y) + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
		var JulianDate = JDN + ((hours - 12) / 24) + (minutes / 1440) + (seconds / 86400);

		jQuery(".jdate_<?php echo $moduleTitle; ?>").html('<?php echo $preText; ?>' + JulianDate + '<?php echo $postText; ?>');
	}

	// Lets call the clock the so display it the first time before the counter starts
	getJulian_<?php echo $moduleTitle; ?>();

	// Update the displayed time after x period
	jQuery(document).ready(function ()
	{
		setInterval(getJulian_<?php echo $moduleTitle; ?>, <?php echo $params->get('updateInterval'); ?>);
	});

</script>
