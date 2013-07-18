<?php

/**
*	卡益联盟程序
*	文件名：goods_goodscats.inc.php  创建时间：2013-7-18 22:58  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=goods_goodscats';

$subac = getgpc('subac');
$subacs = array('goodsgoodscatslist','goodsgoodscatsedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$goodsgoodscatsid = getgpc('goodsgoodscatsid');
$goodsgoodscats_info = $goodsgoodscatsid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_goods_goodscats')." WHERE goodsgoodscatsid=".$goodsgoodscatsid) : array();

if($subac == 'goodsgoodscatslist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodsgoodscats_list_tips'));
		showformheader($this_page.'&subac=goodsgoodscatslist');
		showtableheader(lang('plugin/cardelm','goodsgoodscats_list'));
		showsubtitle(array('', lang('plugin/cardelm','goodsgoodscatsname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','goodsgoodscatsquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_goods_goodscats')." order by goodsgoodscatsid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[goodsgoodscatsid]\">",
			$row['goodsgoodscatsname'],
			$row['goodsgoodscatsname'],
			$row['goodsgoodscatsname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['goodsgoodscatsid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=goodsgoodscatsedit&goodsgoodscatsid=$row[goodsgoodscatsid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=goodsgoodscatsedit" class="addtr">'.lang('plugin/cardelm','add_goodsgoodscats').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'goodsgoodscatsedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodsgoodscats_edit_tips'));
		showformheader($this_page.'&subac=goodsgoodscatsedit','enctype');
		showtableheader(lang('plugin/cardelm','goodsgoodscats_edit'));
		$goodsgoodscatsid ? showhiddenfields(array('goodsgoodscatsid'=>$goodsgoodscatsid)) : '';
		showsetting(lang('plugin/cardelm','goodsgoodscatsname'),'goodsgoodscats_info[goodsgoodscatsname]',$goodsgoodscats_info['goodsgoodscatsname'],'text','',0,lang('plugin/cardelm','goodsgoodscatsname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['goodsgoodscats_info']['goodsgoodscatsname']))) {
			cpmsg(lang('plugin/cardelm','goodsgoodscatsname_nonull'));
		}
		$datas = $_GET['goodsgoodscats_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_goods_goodscats')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_goods_goodscats')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($goodsgoodscatsid) {
			DB::update('cardelm_goods_goodscats',$data,array('goodsgoodscatsid'=>$goodsgoodscatsid));
		}else{
			DB::insert('cardelm_goods_goodscats',$data);
		}
		cpmsg(lang('plugin/cardelm', 'goodsgoodscats_edit_succeed'), 'action='.$this_page.'&subac=goodsgoodscatslist', 'succeed');
	}
}

?>