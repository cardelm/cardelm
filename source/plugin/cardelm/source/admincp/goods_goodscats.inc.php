<?php

/**
*	卡益联盟程序
*	文件名：goods_goodscats.inc.php  创建时间：2013-7-18 22:40  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=goods_goodscats';

$subac = getgpc('subac');
$subacs = array('goodscatslist','goodscatsedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$goodscatsid = getgpc('goodscatsid');
$goodscats_info = $goodscatsid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_goods_goodscats')." WHERE goodscatsid=".$goodscatsid) : array();

if($subac == 'goodscatslist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodscats_list_tips'));
		showformheader($this_page.'&subac=goodscatslist');
		showtableheader(lang('plugin/cardelm','goodscats_list'));
		showsubtitle(array('', lang('plugin/cardelm','goodscatsname'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','goodscatsquanxian'), lang('plugin/cardelm','status'), ''));
		//$query = DB::query("SELECT * FROM ".DB::table('cardelm_goods_goodscats')." order by goodscatsid asc");
		//while($row = DB::fetch($query)) {
			showtablerow('', array('class="td25"','class="td23"', 'class="td23"', 'class="td23"','class="td25"',''), array(
				"<input class=\"checkbox\" type=\"checkbox\" name=\"delete[]\" value=\"$row[goodscatsid]\">",
			$row['goodscatsname'],
			$row['goodscatsname'],
			$row['goodscatsname'],
			"<input class=\"checkbox\" type=\"checkbox\" name=\"statusnew[".$row['goodscatsid']."]\" value=\"1\" ".($row['status'] > 0 ? 'checked' : '').">",
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=goodscatsedit&goodscatsid=$row[goodscatsid]\" class=\"act\">".lang('plugin/cardelm','edit')."</a>",
			));
		//}
		echo '<tr><td></td><td colspan="6"><div><a href="'.ADMINSCRIPT.'?action='.$this_page.'&subac=goodscatsedit" class="addtr">'.lang('plugin/cardelm','add_goodscats').'</a></div></td></tr>';
		showsubmit('submit','submit','del');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'goodscatsedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','goodscats_edit_tips'));
		showformheader($this_page.'&subac=goodscatsedit','enctype');
		showtableheader(lang('plugin/cardelm','goodscats_edit'));
		$goodscatsid ? showhiddenfields(array('goodscatsid'=>$goodscatsid)) : '';
		showsetting(lang('plugin/cardelm','goodscatsname'),'goodscats_info[goodscatsname]',$goodscats_info['goodscatsname'],'text','',0,lang('plugin/cardelm','goodscatsname_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['goodscats_info']['goodscatsname']))) {
			cpmsg(lang('plugin/cardelm','goodscatsname_nonull'));
		}
		$datas = $_GET['goodscats_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_goods_goodscats')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_goods_goodscats')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($goodscatsid) {
			DB::update('cardelm_goods_goodscats',$data,array('goodscatsid'=>$goodscatsid));
		}else{
			DB::insert('cardelm_goods_goodscats',$data);
		}
		cpmsg(lang('plugin/cardelm', 'goodscats_edit_succeed'), 'action='.$this_page.'&subac=goodscatslist', 'succeed');
	}
}

?>