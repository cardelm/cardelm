<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
//这是为了杜绝不小心覆盖文件而专门用于github同步的程序
//实际操作过程中，因为github的pro中的文件夹与本地的wordpress、discuz文件夹名称相同，有几次将文件覆盖错，故以下代码为配合github专用，目的就是修改github中的代码，同时自动更新本地的代码，达到调试的作用
$this_dir = dirname(__FILE__);
//var_dump($this_dir);
if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm'){
	$source_dir = 'C:\GitHub\cardelm';
	check_dz_update();
}elseif($this_dir == 'D:\web\wamp\www\demo\dz3utf8\source\plugin\cardelm'){
	check_homedz_update();
}
//采用递归方式，自动更新discuz文件
function check_dz_update($path=''){
	clearstatcache();
	if($path=='')
		$path = 'C:\GitHub\cardelm';//本地的GitHub的discuz文件夹

	$out_path = 'C:\wamp\www\discuzdemo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);//本地的wamp的discuz文件夹

	if ($handle = opendir($path)) {
		while (false !== ($file = readdir($handle))) {

			if ($file != "." && $file != "..") {
				if (is_dir($path."/".$file)) {
					if (!is_dir($out_path."/".$file)){
						dmkdir($out_path."/".$file);
					}
					check_dz_update($path."/".$file);
				}else{
					if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub文件修改时间大于wamp时
						file_put_contents ($out_path."/".$file,$file =='cardelm.lang.php' ? file_get_contents($path."/".$file) : diconv(file_get_contents($path."/".$file),"UTF-8", "GBK//IGNORE"));
					}
				}
			}
		}
	}
}//func end
//采用递归方式，自动更新discuz文件
function check_homedz_update($path=''){
	clearstatcache();
	if($path=='')
		$path = 'C:\GitHub\cardelm';//本地的GitHub的discuz文件夹

	$out_path = 'D:\web\wamp\www\demo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);//本地的wamp的discuz文件夹

	if ($handle = opendir($path)) {
		while (false !== ($file = readdir($handle))) {

			if ($file != "." && $file != "..") {
				if (is_dir($path."/".$file)) {
					if (!is_dir($out_path."/".$file)){
						dmkdir($out_path."/".$file);
					}
					check_homedz_update($path."/".$file);
				}else{
					if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub文件修改时间大于wamp时
						file_put_contents ($out_path."/".$file,$file =='cardelm.lang.php' ? file_get_contents($path."/".$file) : diconv(file_get_contents($path."/".$file),"UTF-8", "GBK//IGNORE"));
					}
				}
			}
		}
	}
}//func end
/////////以上部分在正式的文件中，必须删除，仅在进行GitHub调试时使用///////////////

require_once DISCUZ_ROOT.'/source/plugin/cardelm/source/function.php';




$submod = getgpc('submod');
$submod = $submod ? $submod : 'base_index';
$current_group = 'base';
$admin_menu = array();
$admin_menu[] = array(array('menu'=>in_array($submod,array('base_index','base_setting','base_mokuai')) ? lang('plugin/cardelm',$submod):lang('plugin/cardelm','admin_base'),'submenu'=>array(array(lang('plugin/cardelm','base_index'),'plugins&identifier=cardelm&pmod=admincp&submod=base_index',$submod=='base_index'),array(lang('plugin/cardelm','base_setting'),'plugins&identifier=cardelm&pmod=admincp&submod=base_setting',$submod=='base_setting'),array(lang('plugin/cardelm','base_mokuai'),'plugins&identifier=cardelm&pmod=admincp&submod=base_mokuai',$submod=='base_mokuai'))),in_array($submod,array('base_index','base_setting','base_mokuai')));
//设计时使用，在插件设计中，设计好模块信息之后，执行此语句
$query = DB::query("SELECT * FROM ".DB::table('common_plugin')." WHERE identifier like 'yiqixueba_%' order by pluginid asc");
while($row = DB::fetch($query)) {
	$row['identifier'] = str_replace("yiqixueba_","",$row['identifier']);
	$row['available'] = 1;
	unset($row['pluginid']);
	if(DB::result_first("SELECT count(*) FROM ".DB::table('cardelm_mokuai')." WHERE identifier='".$row['identifier']."'")==0){
		DB::insert('cardelm_mokuai', $temp_info);
	}else{
		DB::update('cardelm_mokuai', $temp_info,array('identifier'=>$row['identifier']));
	}
}
$mokuai_info = DB::fetch_first("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE identifier='brand'");
$mokuai_info['identifier'] = 'yiqixueba_'.$mokuai_info['identifier'];
$mokuai_info['available'] = 0;
unset($mokuai_info['mokuaiid']);
if(DB::result_first("SELECT count(*) FROM ".DB::table('common_plugin')." WHERE identifier='".$mokuai_info['identifier']."'")==0){
	DB::insert('common_plugin', $mokuai_info);
}
////////////////////////////////////////////
$query = DB::query("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE available = 1 order by mokuaiid asc");
while($row = DB::fetch($query)) {
	$modules = dunserialize($row['modules']);
	$current_menu = '';
	$submenu = array();
	foreach( $modules as $k=>$v ){
		if($v['type'] == 3){
			$submenu[] = array($v['menu'],'plugins&identifier=cardelm&pmod=admincp&submod='.$row['identifier'].'_'.$v['name'],$submod==$row['identifier'].'_'.$v['name']);
			if($submod==$row['identifier'].'_'.$v['name']){
				$current_menu =  $v['menu'];
			}
		}
	}
	$admin_menu[] = array(array('menu'=>$current_menu ? $current_menu : $row['name'],'submenu'=>$submenu),$current_menu );
}
echo '<style>.floattopempty { height: 15px !important; height: auto; } </style>';
showsubmenu($plugin['name'].' '.$plugin['version'],$admin_menu);


cardelm_upnav();//更新前台的导航菜单，在模块安装使用，先暂时放在这里
$submod_file = 'C:\GitHub\cardelm/source/plugin/cardelm/source/admincp/'.$submod.'.inc.php';
if (!file_exists($submod_file)){
	$mysubmod = str_replace($current_group."_","",$submod);
	file_put_contents($submod_file, "<?php\n\n/**\n*\t卡益联盟程序\n*\t文件名：".$submod.".inc.php  创建时间：".dgmdate(time(),'dt')."  杨文\n*\n*/\n\nif(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {\n\texit('Access Denied');\n}\n\$this_page = 'plugins&identifier=cardelm&pmod=admincp&submod=".$submod."';\n\n".
	"\$subac = getgpc('subac');\n".
	"\$subacs = array('".$mysubmod."list','".$mysubmod."edit');\n".
	"\$subac = in_array(\$subac,\$subacs) ? \$subac : \$subacs[0];\n\n".
	"\$".$mysubmod."id = getgpc('".$mysubmod."id');\n".
	"\$".$mysubmod."_info = \$".$mysubmod."id ? DB::fetch_first(\"SELECT * FROM \".DB::table('cardelm_".$submod."').\" WHERE ".$mysubmod."id=\".\$".$mysubmod."id) : array();\n\n".
	"if(\$subac == '".$mysubmod."list') {\n".
	"\tif(!submitcheck('submit')) {\n".
	"\t\tshowtips(lang('plugin/cardelm','".$mysubmod."_list_tips'));\n".
	"\t\tshowformheader(\$this_page.'&subac=".$mysubmod."list');\n".
	"\t\tshowtableheader(lang('plugin/cardelm','".$mysubmod."_list'));\n".
	"\t\tshowsubtitle(array('', lang('plugin/cardelm','".$mysubmod."name'),lang('plugin/cardelm','shopnum'), lang('plugin/cardelm','".$mysubmod."quanxian'), lang('plugin/cardelm','status'), ''));\n".
	"\t\t//\$query = DB::query(\"SELECT * FROM \".DB::table('cardelm_".$submod."').\" order by ".$mysubmod."id asc\");\n".
	"\t\t//while(\$row = DB::fetch(\$query)) {\n".
	"\t\t\tshowtablerow('', array('class=\"td25\"','class=\"td23\"', 'class=\"td23\"', 'class=\"td23\"','class=\"td25\"',''), array(\n".
	"\t\t\t\t\"<input class=\\\"checkbox\\\" type=\\\"checkbox\\\" name=\\\"delete[]\\\" value=\\\"\$row[".$mysubmod."id]\\\">\",\n".
	"\t\t\t\$row['".$mysubmod."name'],\n".
	"\t\t\t\$row['".$mysubmod."name'],\n".
	"\t\t\t\$row['".$mysubmod."name'],\n".
	"\t\t\t\"<input class=\\\"checkbox\\\" type=\\\"checkbox\\\" name=\\\"statusnew[\".\$row['".$mysubmod."id'].\"]\\\" value=\\\"1\\\" \".(\$row['status'] > 0 ? 'checked' : '').\">\",\n".
	"\t\t\t\t\"<a href=\\\"\".ADMINSCRIPT.\"?action=\".\$this_page.\"&subac=".$mysubmod."edit&".$mysubmod."id=\$row[".$mysubmod."id]\\\" class=\\\"act\\\">\".lang('plugin/cardelm','edit').\"</a>\",\n".
	"\t\t\t));\n".
	"\t\t//}\n".
	"\t\techo '<tr><td></td><td colspan=\"6\"><div><a href=\"'.ADMINSCRIPT.'?action='.\$this_page.'&subac=".$mysubmod."edit\" class=\"addtr\">'.lang('plugin/cardelm','add_".$mysubmod."').'</a></div></td></tr>';\n".
	"\t\tshowsubmit('submit','submit','del');\n".
	"\t\tshowtablefooter();\n".
	"\t\tshowformfooter();\n".
	"\t}else{\n".
	"\t}\n".
	"}elseif(\$subac == '".$mysubmod."edit') {\n".
	"\tif(!submitcheck('submit')) {\n".
	"\t\tshowtips(lang('plugin/cardelm','".$mysubmod."_edit_tips'));\n".
	"\t\tshowformheader(\$this_page.'&subac=".$mysubmod."edit','enctype');\n".
	"\t\tshowtableheader(lang('plugin/cardelm','".$mysubmod."_edit'));\n".
	"\t\t\$".$mysubmod."id ? showhiddenfields(array('".$mysubmod."id'=>\$".$mysubmod."id)) : '';\n".
	"\t\tshowsetting(lang('plugin/cardelm','".$mysubmod."name'),'".$mysubmod."_info[".$mysubmod."name]',\$".$mysubmod."_info['".$mysubmod."name'],'text','',0,lang('plugin/cardelm','".$mysubmod."name_comment'),'','',true);\n".
	"\t\tshowsubmit('submit');\n".
	"\t\tshowtablefooter();\n".
	"\t\tshowformfooter();\n".
	"\t}else{\n".
	"\t\tif(!htmlspecialchars(trim(\$_GET['".$mysubmod."_info']['".$mysubmod."name']))) {\n".
	"\t\t\tcpmsg(lang('plugin/cardelm','".$mysubmod."name_nonull'));\n".
	"\t\t}\n".
	"\t\t\$datas = \$_GET['".$mysubmod."_info'];\n".
	"\t\tforeach ( \$datas as \$k=>\$v) {\n".
	"\t\t\t\$data[\$k] = htmlspecialchars(trim(\$v));\n".
	"\t\t\tif(!DB::result_first(\"describe \".DB::table('cardelm_".$submod."').\" \".\$k)) {\n".
	"\t\t\t\t\$sql = \"alter table \".DB::table('cardelm_".$submod."').\" add `\".\$k.\"` varchar(255) not Null;\";\n".
	"\t\t\t\trunquery(\$sql);\n".
	"\t\t\t}\n".
	"\t\t}\n".
	"\t\tif(\$".$mysubmod."id) {\n".
	"\t\t\tDB::update('cardelm_".$submod."',\$data,array('".$mysubmod."id'=>\$".$mysubmod."id));\n".
	"\t\t}else{\n".
	"\t\t\tDB::insert('cardelm_".$submod."',\$data);\n".
	"\t\t}\n".
	"\t\tcpmsg(lang('plugin/cardelm', '".$mysubmod."_edit_succeed'), 'action='.\$this_page.'&subac=".$mysubmod."list', 'succeed');\n".
	"\t}\n".
	"}\n".
	"\n".
	"?>");
}

require_once DISCUZ_ROOT.'source/plugin/cardelm/source/admincp/'.$submod.'.inc.php';



?>