<?php
/**
 * @package julianclock for Joomla 3.0
 * @version 1.0
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
?>
<!-- BEGIN LAYOUT -->

<div class="<?php echo "julianclock_" . $moduleTitle . '"';
if ($moduleSuffix) {
	echo 'class=" ' . $moduleSuffix . '">';
} else {
	echo ">";
}
?>
</div>
	 <!-- END LAYOUT -->
	 <script type="text/javascript" >
	 function julianclockUpdate_<?php echo $moduleTitle; ?>()
	 {
	 if(<?php echo $params->get('positionText'); ?> == 1) {
	 jQuery(".julianclock_<?php echo $moduleTitle; ?>").html(<?php echo $julianDate; ?>).prepend('<?php echo $params->get('clockText'); ?> ');
	 } else	 {
	 jQuery(".julianclock_<?php echo $moduleTitle; ?>").html(<?php echo $julianDate; ?>).append(' <?php echo $params->get('clockText'); ?>');
	 }
	 }

	 // Update the time display
	 jQuery(document).ready(function ()
	 {
	 setInterval('julianclockUpdate_<?php echo $moduleTitle; ?>()', <?php echo $params->get('updateInterval'); ?>);
	 });

</script>