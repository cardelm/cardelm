<?php

/**
*	卡益联盟程序
*	文件名：brand_setting.inc.php  创建时间：2013-7-18 22:32  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=brand_setting';

$subac = getgpc('subac');
$subacs = array('settinglist','settingedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$settingid = getgpc('settingid');
$setting_info = $settingid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_brand_setting')." WHERE settingid=".$settingid) : array();

if($subac == 'settinglist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','setting_list_tips'));
		showformheader($this_page.'&subac=settinglist');
		showtableheader(lang('plugin/cardelm','setting_list'));
		showsubtitle(array('', lang('plugin/cardelm','settingname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','settingquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_brand_setting')." order by settingid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[settingid]\">",
			$row['settingname'],
			$row['settingname'],
			$row['settingname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['settingid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=settingedit&settingid=$row[settingid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=settingedit" class="addtr">'.lang('plugin/cardelm','add_setting').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'settingedit') {
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
			if(!DB::result_first("describe ".DB::table('cardelm_brand_setting')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_brand_setting')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($settingid) {
			DB::update('cardelm_brand_setting',$data,array('settingid'=>$settingid));
		}else{
			DB::insert('cardelm_brand_setting',$data);
		}
		cpmsg(lang('plugin/cardelm', 'setting_edit_succeed'), 'action='.$this_page.'&subac=settinglist', 'succeed');
	}
}

?>