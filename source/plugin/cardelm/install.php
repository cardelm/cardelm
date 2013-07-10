<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$sitekey = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='cardelm_sitekey'");



?>