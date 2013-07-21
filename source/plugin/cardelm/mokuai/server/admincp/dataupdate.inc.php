<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$subac = getgpc('subac');
$subacs = array('settingedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

echo $subac;
?>