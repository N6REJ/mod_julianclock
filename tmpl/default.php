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
<div id="<?php echo "julianclock_" . $moduleTitle . '"';
if($moduleSuffix){ echo 'class=" ' . $moduleSuffix . '"'; } ?>">&nbsp;
</div>
<!-- END LAYOUT -->
<script type="text/javascript" >
    var currentTime_<?php echo $moduleTitle; ?> = new Date("<?php echo $time; ?>");
    var jstime_<?php echo $moduleTitle; ?> = new Date().getTime() - 1000;
    function julianclockUpdate_<?php echo $moduleTitle; ?>()
    {

       
        // Update the time display
        document.getElementById("julianclockTime_<?php echo $moduleTitle; ?>").innerHTML = currentTimeString_<?php echo $moduleTitle; ?>;
    }
    julianclockUpdate_<?php echo $moduleTitle; ?>();
    setInterval('julianclockUpdate_<?php echo $moduleTitle; ?>()', 1000);
</script>