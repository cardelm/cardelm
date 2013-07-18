<?php

/**
*	卡益联盟程序
*	文件名：dianping_dianpinglist.inc.php  创建时间：2013-7-18 23:46  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=dianping_dianpinglist';

$subac = getgpc('subac');
$subacs = array('dianpinglistlist','dianpinglistedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$dianpinglistid = getgpc('dianpinglistid');
$dianpinglist_info = $dianpinglistid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_dianping_dianpinglist')." WHERE dianpinglistid=".$dianpinglistid) : array();

if($subac == 'dianpinglistlist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','dianpinglist_list_tips'));
		showformheader($this_page.'&subac=dianpinglistlist');
		showtableheader(lang('plugin/cardelm','dianpinglist_list'));
		showsubtitle(array('', lang('plugin/cardelm','dianpinglistname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','dianpinglistquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_dianping_dianpinglist')." order by dianpinglistid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[dianpinglistid]\">",
			$row['dianpinglistname'],
			$row['dianpinglistname'],
			$row['dianpinglistname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['dianpinglistid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=dianpinglistedit&dianpinglistid=$row[dianpinglistid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=dianpinglistedit" class="addtr">'.lang('plugin/cardelm','add_dianpinglist').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'dianpinglistedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','dianpinglist_edit_tips'));
		showformheader($this_page.'&subac=dianpinglistedit','enctype');
		showtableheader(lang('plugin/cardelm','dianpinglist_edit'));
		$dianpinglistid ? showhiddenfields(array('dianpinglistid'=>$dianpinglistid)) : '';
		showsetting(lang('plugin/cardelm','dianpinglistname'),'dianpinglist_info[dianpinglistname]',$dianpinglist_info['dianpinglistname'],'text','',0,lang('plugin/cardelm','dianpinglistname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['dianpinglist_info']['dianpinglistname']))) {
			cpmsg(lang('plugin/cardelm','dianpinglistname_nonull'));
		}
		$datas = $_GET['dianpinglist_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_dianping_dianpinglist')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_dianping_dianpinglist')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($dianpinglistid) {
			DB::update('cardelm_dianping_dianpinglist',$data,array('dianpinglistid'=>$dianpinglistid));
		}else{
			DB::insert('cardelm_dianping_dianpinglist',$data);
		}
		cpmsg(lang('plugin/cardelm', 'dianpinglist_edit_succeed'), 'action='.$this_page.'&subac=dianpinglistlist', 'succeed');
	}
}

?>