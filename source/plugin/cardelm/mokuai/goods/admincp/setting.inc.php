<?php

/**
*	卡益联盟程序
*	文件名：goods_setting.inc.php  创建时间：2013-7-18 22:58  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=goods_setting';

$subac = getgpc('subac');
$subacs = array('goodssettinglist','goodssettingedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$goodssettingid = getgpc('goodssettingid');
$goodssetting_info = $goodssettingid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_goods_setting')." WHERE goodssettingid=".$goodssettingid) : array();

if($subac == 'goodssettinglist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodssetting_list_tips'));
		showformheader($this_page.'&subac=goodssettinglist');
		showtableheader(lang('plugin/cardelm','goodssetting_list'));
		showsubtitle(array('', lang('plugin/cardelm','goodssettingname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','goodssettingquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_goods_setting')." order by goodssettingid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[goodssettingid]\">",
			$row['goodssettingname'],
			$row['goodssettingname'],
			$row['goodssettingname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['goodssettingid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=goodssettingedit&goodssettingid=$row[goodssettingid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=goodssettingedit" class="addtr">'.lang('plugin/cardelm','add_goodssetting').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'goodssettingedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodssetting_edit_tips'));
		showformheader($this_page.'&subac=goodssettingedit','enctype');
		showtableheader(lang('plugin/cardelm','goodssetting_edit'));
		$goodssettingid ? showhiddenfields(array('goodssettingid'=>$goodssettingid)) : '';
		showsetting(lang('plugin/cardelm','goodssettingname'),'goodssetting_info[goodssettingname]',$goodssetting_info['goodssettingname'],'text','',0,lang('plugin/cardelm','goodssettingname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['goodssetting_info']['goodssettingname']))) {
			cpmsg(lang('plugin/cardelm','goodssettingname_nonull'));
		}
		$datas = $_GET['goodssetting_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_goods_setting')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_goods_setting')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($goodssettingid) {
			DB::update('cardelm_goods_setting',$data,array('goodssettingid'=>$goodssettingid));
		}else{
			DB::insert('cardelm_goods_setting',$data);
		}
		cpmsg(lang('plugin/cardelm', 'goodssetting_edit_succeed'), 'action='.$this_page.'&subac=goodssettinglist', 'succeed');
	}
}

?>