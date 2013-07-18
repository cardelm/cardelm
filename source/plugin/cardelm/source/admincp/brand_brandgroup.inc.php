<?php

/**
*	卡益联盟程序
*	文件名：brand_brandgroup.inc.php  创建时间：2013-7-18 22:39  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=brand_brandgroup';

$subac = getgpc('subac');
$subacs = array('brandgrouplist','brandgroupedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$brandgroupid = getgpc('brandgroupid');
$brandgroup_info = $brandgroupid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_brand_brandgroup')." WHERE brandgroupid=".$brandgroupid) : array();

if($subac == 'brandgrouplist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','brandgroup_list_tips'));
		showformheader($this_page.'&subac=brandgrouplist');
		showtableheader(lang('plugin/cardelm','brandgroup_list'));
		showsubtitle(array('', lang('plugin/cardelm','brandgroupname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','brandgroupquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_brand_brandgroup')." order by brandgroupid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[brandgroupid]\">",
			$row['brandgroupname'],
			$row['brandgroupname'],
			$row['brandgroupname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['brandgroupid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=brandgroupedit&brandgroupid=$row[brandgroupid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=brandgroupedit" class="addtr">'.lang('plugin/cardelm','add_brandgroup').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'brandgroupedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','brandgroup_edit_tips'));
		showformheader($this_page.'&subac=brandgroupedit','enctype');
		showtableheader(lang('plugin/cardelm','brandgroup_edit'));
		$brandgroupid ? showhiddenfields(array('brandgroupid'=>$brandgroupid)) : '';
		showsetting(lang('plugin/cardelm','brandgroupname'),'brandgroup_info[brandgroupname]',$brandgroup_info['brandgroupname'],'text','',0,lang('plugin/cardelm','brandgroupname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['brandgroup_info']['brandgroupname']))) {
			cpmsg(lang('plugin/cardelm','brandgroupname_nonull'));
		}
		$datas = $_GET['brandgroup_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_brand_brandgroup')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_brand_brandgroup')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($brandgroupid) {
			DB::update('cardelm_brand_brandgroup',$data,array('brandgroupid'=>$brandgroupid));
		}else{
			DB::insert('cardelm_brand_brandgroup',$data);
		}
		cpmsg(lang('plugin/cardelm', 'brandgroup_edit_succeed'), 'action='.$this_page.'&subac=brandgrouplist', 'succeed');
	}
}

?>