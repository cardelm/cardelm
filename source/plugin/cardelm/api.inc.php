<?php

/**
*	拉益联盟平台程序
*	文件名：api.inc.php  创建时间：2013-7-12 15:25  杨文
*
*/

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$indata = addslashes($_GET['indata']);
$sign = addslashes($_GET['sign']);
$apiaction = addslashes($_GET['apiaction']);


$outdata = array();

if($sign != md5(md5($indata))) {
	$outdata[] = lang('plugin/yiqixueba_server','api_sign_error');
}
if(!$apiaction) {
	$outdata[] = lang('plugin/yiqixueba_server','api_apiaction_error');
}


$indata = base64_decode($indata);
$indata = dunserialize($indata);

if($base_setting['siteurl'] = $indata['siteurl'] && $base_setting['sitekey'] = $indata['sitekey']){
	if($apiaction == 'addwxjilu'){
		$insertdata['time'] = time();
//		$insertdata['fromusername'] = $indata['fromusername'];
//		$insertdata['tousername'] = $indata['tousername'];
//		$insertdata['inputtype'] = $indata['inputtype'];
//		$insertdata['keyword'] = $indata['keyword'];
		$insertdata['keyword'] = $indata['postxml'];
		DB::insert('yiqixueba_wxq123_jilu', $insertdata);
		//$outdata = $insertdata;
	}
}else{
	$outdata = '权限错误';
}


////

if(is_array($outdata)){
	require_once libfile('class/xml');
	$filename = $apiaction.'.xml';
	$plugin_export = array2xml($outdata, 1);
	ob_end_clean();
	dheader('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	dheader('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	dheader('Cache-Control: no-cache, must-revalidate');
	dheader('Pragma: no-cache');
	dheader('Content-Encoding: none');
	dheader('Content-Length: '.strlen($plugin_export));
	dheader('Content-Disposition: attachment; filename='.$filename);
	dheader('Content-Type: text/xml');
	echo $plugin_export;
	define('FOOTERDISABLED' , 1);
	exit();
}else{
	echo $outdata;
}





?>
