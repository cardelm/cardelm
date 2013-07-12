<?php

/**
*	卡益联盟程序
*	文件名：base_setting.inc.php  创建时间：2013-7-12 14:23  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=base_setting';

$subac = getgpc('subac');
$subacs = array('settingedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$settingid = getgpc('settingid');
$setting_info = $settingid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_base_setting')." WHERE settingid=".$settingid) : array();

if($subac == 'settingedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','setting_edit_tips'));
		showformheader($this_page.'&subac=settingedit','enctype');
		showtableheader(lang('plugin/cardelm','setting_edit'));
		$settingid ? showhiddenfields(array('settingid'=>$settingid)) : '';
		showsetting(lang('plugin/cardelm','settingname'),'setting_info[settingname]',$setting_info['settingname'],'text','',0,lang('plugin/cardelm','settingname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['setting_info']['settingname']))) {
			cpmsg(lang('plugin/cardelm','settingname_nonull'));
		}
		$datas = $_GET['setting_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_base_setting')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_base_setting')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($settingid) {
			DB::update('cardelm_base_setting',$data,array('settingid'=>$settingid));
		}else{
			DB::insert('cardelm_base_setting',$data);
		}
		cpmsg(lang('plugin/cardelm', 'setting_edit_succeed'), 'action='.$this_page.'&subac=settinglist', 'succeed');
	}
}

?>