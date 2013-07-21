<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'/source/plugin/cardelm/u683de815ef99e525668426dae2d67853.inc.php';




$submod = getgpc('submod');
$submod = $submod ? $submod : 'base_index';
$current_group = 'base';
$admin_menu = array();
$admin_menu[] = array(array('menu'=>in_array($submod,array('base_index','base_setting','base_mokuai')) ? lang('plugin/cardelm',$submod):lang('plugin/cardelm','admin_base'),'submenu'=>array(array(lang('plugin/cardelm','base_index'),'plugins&identifier=cardelm&pmod=admincp&submod=base_index',$submod=='base_index'),array(lang('plugin/cardelm','base_setting'),'plugins&identifier=cardelm&pmod=admincp&submod=base_setting',$submod=='base_setting'),array(lang('plugin/cardelm','base_mokuai'),'plugins&identifier=cardelm&pmod=admincp&submod=base_mokuai',$submod=='base_mokuai'))),in_array($submod,array('base_index','base_setting','base_mokuai')));

//设计时使用，在插件设计中，设计好模块信息之后，执行此语句
$query = DB::query("SELECT * FROM ".DB::table('common_plugin')." WHERE identifier like 'yiqixueba_%' order by pluginid asc");
while($row = DB::fetch($query)) {
	plugin_trans($row['pluginid']);
}
////////////////////////////////////////////



if(DB::result_first("SELECT count(*) FROM ".DB::table('common_setting')." WHERE skey = 'sitekey'")==0){
	DB::insert('common_setting', array('skey'=>'sitekey','svalue'=>DB::result_first("SELECT sitekey FROM ".DB::table('cardelm_server_site')." WHERE siteurl='".$_G['siteurl']."'")));
}




$query = DB::query("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE available = 1 order by mokuaiid asc");
while($row = DB::fetch($query)) {
	$modules = dunserialize($row['modules']);
	$current_menu = '';
	$submenu = array();
	$setting = dunserialize($row['setting']);
	if($setting){
		$submenu[] = array(lang('plugin/cardelm','setting'),'plugins&identifier=cardelm&pmod=admincp&submod='.$row['identifier'].'_setting',$submod==$row['identifier'].'_setting');
	}
	foreach( $modules as $k=>$v ){
		if($v['type'] == 3){
			$submenu[] = array($v['menu'],'plugins&identifier=cardelm&pmod=admincp&submod='.$row['identifier'].'_'.$v['name'],$submod==$row['identifier'].'_'.$v['name']);
			if($submod==$row['identifier'].'_'.$v['name']){
				$current_menu =  $v['menu'];
				$current_group =  $row['identifier'];
			}
		}
	}
	$admin_menu[] = array(array('menu'=>$current_menu ? $current_menu : $row['name'],'submenu'=>$submenu),$current_menu);
}

$pageid = make_pageid($current_group,'admincp',str_replace($current_group."_","",$submod));
make_pagetype_pageid('admin');

echo '<style>.floattopempty { height: 15px !important; height: auto; } </style>';
showsubmenu($plugin['name'].' '.$plugin['version'],$admin_menu,'<a href="'.ADMINSCRIPT.'?action=plugins&operation=upgradecheck" class="bold" style="float:right;padding-right:40px;">'.$lang['plugins_validator'].'</a>');


//$this_page = substr($_SERVER['QUERY_STRING'],7,strlen($_SERVER['QUERY_STRING'])-7);
//stripos($this_page,'subac=') ? $this_page = substr($this_page,0,stripos($this_page,'subac=')-1) : $this_page;








$query = DB::query("SELECT * FROM ".DB::table('common_setting')." WHERE skey like 'pagetype_%'");
while($row = DB::fetch($query)) {
	//echo $row['skey'].'='.$row['svalue'].'<br />';
}

make_admincp_page();

cardelm_upnav();//更新前台的导航菜单，在模块安装使用，先暂时放在这里


if($current_group == 'base'){
	$submod_file = CARDELM_ROOT.'source/admincp/'.$submod.'.inc.php';
	make_admincp_file($submod_file);
}else{
	$submod_file = CARDELM_ROOT.'mokuai/'.$current_group.'/admincp/'.str_replace($current_group."_","",$submod).'.inc.php';
	copy_plugin_file($submod_file);
}

if (file_exists($submod_file)){
	require_once $submod_file;
}



?>