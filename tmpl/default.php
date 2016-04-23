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
<p  onload="julianclockUpdate_<?php echo $moduleTitle;?>()"></p>
<div id="<?php echo "julianclock_" . $moduleTitle . '"';
if($moduleSuffix){ echo 'class=" ' . $moduleSuffix . '"'; } ?>"></div>
<!-- END LAYOUT -->
<script type="text/javascript" >
    function julianclockUpdate_<?php echo $moduleTitle; ?>()
    {
        // Update the time display
        document.getElementById("julianclock_<?php echo $moduleTitle; ?>").innerHTML = <?php echo $julianDate; ?>;
var t = setTimeout(julianclockUpdate_<?php echo $moduleTitle; ?>,500);
}

</script>