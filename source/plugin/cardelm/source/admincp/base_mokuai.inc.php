<?php

/**
*	卡益联盟程序
*	文件名：base_mokuai.inc.php  创建时间：2013-7-12 14:27  杨文
*
*/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=base_mokuai';

$subac = getgpc('subac');
$subacs = array('mokuailist','mokuaiedit');
$subac = in_array($subac,$subacs) ? $subac : $subacs[0];

$mokuaiid = getgpc('mokuaiid');
$mokuai_info = $mokuaiid ? DB::fetch_first("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE mokuaiid=".$mokuaiid) : array();

//服务器端的模块数据
$indata = array();
$server_mokuais = api_indata('getmokuailist',$indata);

dump($server_mokuais);


if($subac == 'mokuailist') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','mokuai_list_tips'));
		showformheader($this_page.'&subac=mokuailist');
		showtableheader(lang('plugin/cardelm','mokuai_list'));
		$query = DB::query("SELECT * FROM ".DB::table('cardelm_mokuai')." order by mokuaiid asc");
		while($row = DB::fetch($query)) {
			showtablerow('', array('style="width:45px"', 'valign="top" style="width:260px"', 'valign="top"', 'align="right" valign="bottom" style="width:160px"'), array(
				'<img src="'.cloudaddons_pluginlogo_url($entry).'" onerror="this.src=\'static/image/admincp/plugin_logo.png\';this.onerror=null" width="40" height="40" align="left" style="margin-right:5px" />',
				'<span class="bold">'.$row['mokuaititle'].$row['mokuaiver'].($filemtime > TIMESTAMP - 86400 ? ' <font color="red">New!</font>' : '').'</span>  <span class="sml">('.$row['mokuainame'].')</span>',
				$row['description'],
				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=mokuaiedit&mokuaiid=$row[mokuaiid]\" class=\"bold\" >".$lang['plugins_config_install']."</a>&nbsp;&nbsp;<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=mokuaiedit&mokuaiid=$row[mokuaiid]\" >".$lang['plugins_config_uninstall']."</a>&nbsp;&nbsp;",
			));
//			showtablerow('class="hover"', array('style="width:45px"', 'valign="top"', 'align="right" valign="bottom" style="width:160px"'), array(
//				'<img src="'.cloudaddons_pluginlogo_url($entry).'" onerror="this.src=\'static/image/admincp/plugin_logo.png\';this.onerror=null" width="40" height="40" align="left" style="margin-right:5px" />',
//				'<span class="bold light">'.$row['mokuaititle'].'('.$row['mokuainame'].')'.$row['mokuaiver'].($filemtime > TIMESTAMP - 86400 ? ' <font color="red">New!</font>' : '').'</span>',
//				"<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=mokuaiedit&mokuaiid=$row[mokuaiid]\" class=\"bold\" >".$lang['plugins_config_install']."</a>&nbsp;&nbsp;<a href=\"".ADMINSCRIPT."?action=".$this_page."&subac=mokuaiedit&mokuaiid=$row[mokuaiid]\" >".$lang['plugins_config_uninstall']."</a>&nbsp;&nbsp;",
//			));
		}
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
	}
}elseif($subac == 'mokuaiedit') {
	if(!submitcheck('submit')) {
		showtips(lang('plugin/cardelm','mokuai_edit_tips'));
		showformheader($this_page.'&subac=mokuaiedit','enctype');
		showtableheader(lang('plugin/cardelm','mokuai_edit'));
		$mokuaiid ? showhiddenfields(array('mokuaiid'=>$mokuaiid)) : '';
		showsetting(lang('plugin/cardelm','mokuainame'),'mokuai_info[mokuainame]',$mokuai_info['mokuainame'],'text','',0,lang('plugin/cardelm','mokuainame_comment'),'','',true);
		showsubmit('submit');
		showtablefooter();
		showformfooter();
	}else{
		if(!htmlspecialchars(trim($_GET['mokuai_info']['mokuainame']))) {
			cpmsg(lang('plugin/cardelm','mokuainame_nonull'));
		}
		$datas = $_GET['mokuai_info'];
		foreach ( $datas as $k=>$v) {
			$data[$k] = htmlspecialchars(trim($v));
			if(!DB::result_first("describe ".DB::table('cardelm_base_mokuai')." ".$k)) {
				$sql = "alter table ".DB::table('cardelm_base_mokuai')." add `".$k."` varchar(255) not Null;";
				runquery($sql);
			}
		}
		if($mokuaiid) {
			DB::update('cardelm_base_mokuai',$data,array('mokuaiid'=>$mokuaiid));
		}else{
			DB::insert('cardelm_base_mokuai',$data);
		}
		cpmsg(lang('plugin/cardelm', 'mokuai_edit_succeed'), 'action='.$this_page.'&subac=mokuailist', 'succeed');
	}
}

?>