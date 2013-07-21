<?php
//这是为了杜绝不小心覆盖文件而专门用于github同步的程序
//实际操作过程中，因为github的pro中的文件夹与本地的discuz文件夹名称相同，有几次将文件覆盖错，故以下代码为配合github专用，目的就是修改github中的代码，同时自动更新本地的代码，达到调试的作用
define('CARDELM_ROOT', 'C:\GitHub\cardelm/source/plugin/cardelm/');
//define('CARDELM_ROOT', DISCUZ_ROOT.'source/plugin/cardelm/');
$this_dir = dirname(__FILE__);
//var_dump($this_dir);
if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm\source'){
	$source_dir = 'C:\GitHub\cardelm';
	check_dz_update();
}elseif($this_dir == 'D:\web\wamp\www\demo\dz3utf8\source\plugin\cardelm\source'){
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

//api_api_indata
function api_indata($apiaction,$indata=array()){
	global $_G,$indata,$sitekey;
	//$server_url = 'www.cardelm.com';
	$server_url = 'localhost/demo/dz3utf8';
	//if(fsockopen($server_url, 80)){
		$indata['sitekey'] = $sitekey;
		$indata['siteurl'] = $_G['siteurl'];
		if($_G['charset']=='gbk') {
			foreach ( $indata as $k=>$v) {
				//$indata[$k] = diconv($v,$_G['charset'],'utf8');
			}
		}
		$indata = serialize($indata);
		$indata = base64_encode($indata);
		$api_url = 'http://'.$server_url.'/plugin.php?id=cardelmserver:api&apiaction='.$apiaction.'&indata='.$indata.'&sign='.md5(md5($indata));
		$xml = @file_get_contents($api_url);
		require_once libfile('class/xml');
		$outdata = is_array(xml2array($xml)) ? xml2array($xml) : $xml;
		return $outdata;
		//return $api_url;
	//}else{
		//return false;
	//}
}//end func

//站长安装，此函数必须要修改
function site_install(){
	global $_G;
	require_once DISCUZ_ROOT.'/source/discuz_version.php';
	$installdata['siteurl'] = $_G['siteurl'];
	$installdata['sitegroupid'] = 1;
	$installdata['charset'] = $_G['charset'];
	$installdata['clientip'] = $_G['clientip'];
	$installdata['version'] = DISCUZ_VERSION.'-'.DISCUZ_RELEASE.'-'.DISCUZ_FIXBUG;
	if(DB::result_first("SELECT count(*) FROM ".DB::table('cardelm_server_site')." WHERE siteurl='".$_G['siteurl']."'")==0){
		$installdata['salt'] = random(6);
		$installdata['sitekey'] = md5(md5($_G['siteurl']).$installdata['salt']);
		$installdata['installtime'] = time();
		DB::insert('cardelm_server_site', $installdata);
	}else{
		$installdata['updatetime'] = time();
		DB::update('cardelm_server_site', $installdata,array('siteurl'=>$_G['siteurl']));
	}

}//end func

//生成pageid数据
function make_pageid($mokuai,$pagetype,$submod){
	$sitekey = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='sitekey'");
	if(DB::result_first("SELECT count(*) FROM ".DB::table('cardelm_page')." WHERE mokuai='".$mokuai."' AND pagetype = '".$pagetype."' AND submod = '".$submod."'")==0){
		$indata['mokuai'] = $mokuai;
		$indata['pagetype'] = $pagetype;
		$indata['submod'] = $submod;
		$indata['pageid'] = md5($mokuai.$pagetype.$submod.$sitekey);
		DB::insert('cardelm_page', $indata);
	}
	return DB::result_first("SELECT pageid FROM ".DB::table('cardelm_page')." WHERE mokuai='".$mokuai."' AND pagetype = '".$pagetype."' AND submod = '".$submod."'");
}
//生成页面类型pageid数据
function make_pagetype_pageid($pagetype){
	$sitekey = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='sitekey'");
	if(DB::result_first("SELECT count(*) FROM ".DB::table('common_setting')." WHERE skey='pagetype_".$pagetype."'")==0){
		DB::insert('common_setting', array('skey'=>'pagetype_'.$pagetype,'svalue'=>random(1).md5($pagetype.$sitekey)));
	}
	$pageid = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='pagetype_".$pagetype."'");
	$pagetype_file = CARDELM_ROOT.$pageid.'.inc.php';
	if(!file_exists($pagetype_file)){
		file_put_contents($pagetype_file,"<?php\n\n?>");
	}
	return $pagetype_file;
}
//创建后台管理的页面
function make_admincp_page(){
	$admincp_page = CARDELM_ROOT.DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='pagetype_admincp'").'.inc.php';
	$function_name = DB::result_first("SELECT svalue FROM ".DB::table('common_setting')." WHERE skey='pagetype_function'");
	$admincp_file_text = file_get_contents(CARDELM_ROOT.'admincp.inc.php');
	$admincp_file_text = str_replace("/source/plugin/cardelm/source/function.php","/source/plugin/cardelm/".$function_name.".inc.php",$admincp_file_text);
	file_put_contents($admincp_page,$admincp_file_text);
	//return $function_name;
}


//
function cardelm_page($mokuai,$pagetype,$submod){
	$cardelm_page = DB::result_first("SELECT pageid FROM ".DB::table('cardelm_page')." WHERE mokuai='".$mokuai."' AND pagetype = '".$pagetype."' AND submod = '".$submod."'");
	if(DB::result_first("SELECT count(*) FROM ".DB::table('cardelm_page')." WHERE mokuai='".$mokuai."' AND pagetype = '".$pagetype."' AND submod = '".$submod."'")==0){

	}
	if($pagetype == 'admincp'){
		$cardelm_page = 'plugins&identifier=cardelm&pmod=admincp&submod='.$mokuai.'_'.$submod;
	}elseif ($pagetype == 'cardelm'){
		$cardelm_page = 'plugins&identifier=cardelm&pmod=admincp&submod='.$submod;
	}elseif ($pagetype == 'member'){
		$cardelm_page = 'plugins&identifier=cardelm&pmod=admincp&submod='.$submod;
	}
	return $cardelm_page;
}//end func

//更新前台导航菜单
function cardelm_upnav(){
	$query = DB::query("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE available = 1 order by mokuaiid asc");
	while($row = DB::fetch($query)) {
		$modules = dunserialize($row['modules']);
		foreach( $modules as $k=>$v ){
			if($v['type'] == 1){
				$navdata['parentid'] = 0;
				$navdata['name'] = $v['menu'];
				$navdata['url'] = 'plugin.php?id=cardelm&mokuai='.$row['identifier'].'&submod='.$v['name'];
				$navdata['identifier'] = $v['name'];
				$navdata['target'] = 0;
				$navdata['type'] = 0;
				$navdata['available'] = 1;
				$navdata['displayorder'] = $v['displayorder'];
				$navdata['navtype'] = 0;
				$submod_file = CARDELM_ROOT.'mokuai/'.$row['identifier'].'/cardelm/'.$v['name'].'.inc.php';
				if(DB::result_first("SELECT count(*) FROM ".DB::table('common_nav')." WHERE identifier='".$v['name']."'")==0){
					DB::insert('common_nav', $navdata);
				}else{
					DB::update('common_nav', $navdata,array('identifier'=>$v['name']));
				}
			}
		}
	}
}

//
function mokuai_install($plugin_info){
	$mokuai_dir = CARDELM_ROOT.'mokuai/'.$plugin_info['identifier'];
	$plugin_dir = substr(CARDELM_ROOT,0,strlen(CARDELM_ROOT)-8).'yiqixueba_'.$plugin_info['identifier'];
	if(!is_dir($mokuai_dir)){
		dmkdir($mokuai_dir);
	}
	$mokuai_dir_array = array('admincp','cardelm','member','api','ajax','template');
	foreach ( $mokuai_dir_array as $k => $v ){
		if(!is_dir($mokuai_dir.'/'.$v)){
			dmkdir($mokuai_dir.'/'.$v);
		}
	}
	if(!is_dir($plugin_dir)){
		dmkdir($plugin_dir);
	}
	$modules = dunserialize($plugin_info['modules']);
	foreach( $modules as $k=>$v ){
		if($v['type'] == 3 || $v['type'] == 1 ){
			$plugin_file = $plugin_dir.'/'.$v['name'].'.inc.php';
			if(!file_exists($plugin_file)){
				file_put_contents($plugin_file,"");
			}
		}
	}
	return $mokuai_dir;
}//end func

//
function plugin_trans($pluginid){
	$plugin_info = DB::fetch_first("SELECT * FROM ".DB::table('common_plugin')." WHERE pluginid=".$pluginid);
	$plugin_info['identifier'] = str_replace("yiqixueba_","",$plugin_info['identifier']);
	$plugin_info['available'] = 1;
	$mokuai_setting = array();
	$query = DB::query("SELECT * FROM ".DB::table('common_pluginvar')." WHERE pluginid = ".$plugin_info['pluginid']." order by pluginvarid asc");
	while($row = DB::fetch($query)) {
		$mokuai_setting[] = $row;
	}
	$plugin_info['setting'] = serialize($mokuai_setting);
	unset($plugin_info['pluginid']);
	if($plugin_info['identifier']){
		if(DB::result_first("SELECT count(*) FROM ".DB::table('cardelm_mokuai')." WHERE identifier='".$plugin_info['identifier']."'")==0){
			DB::insert('cardelm_mokuai', $plugin_info);
		}else{
			DB::update('cardelm_mokuai', $plugin_info,array('identifier'=>$plugin_info['identifier']));
		}
		mokuai_install($plugin_info);
		DB::update('common_plugin', array('available'=>0),array('pluginid'=>$pluginid));
	}
}//end func

//生成常规的后台页面
function make_admincp_file($submod_file){
	global $submod,$current_group;
	$pluginname = 'cardelm';
	if (!file_exists($submod_file)){
		$mysubmod = str_replace($current_group."_","",$submod);
		file_put_contents($submod_file, "<?php\n\n/**\n*\t卡益联盟程序\n*\t文件名：".$submod.".inc.php  创建时间：".dgmdate(time(),'dt')."  杨文\n*\n*/\n\nif(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {\n\texit('Access Denied');\n}\n\$this_page = 'plugins&identifier=".$pluginname."&pmod=admincp&submod=".$submod."';\n\n".
		"\$subac = getgpc('subac');\n".
		"\$subacs = array('".$mysubmod."list','".$mysubmod."edit');\n".
		"\$subac = in_array(\$subac,\$subacs) ? \$subac : \$subacs[0];\n\n".
		"\$".$mysubmod."id = getgpc('".$mysubmod."id');\n".
		"\$".$mysubmod."_info = \$".$mysubmod."id ? DB::fetch_first(\"SELECT * FROM \".DB::table('".$pluginname."_".$submod."').\" WHERE ".$mysubmod."id=\".\$".$mysubmod."id) : array();\n\n".
		"if(\$subac == '".$mysubmod."list') {\n".
		"\tif(!submitcheck('submit')) {\n".
		"\t\tshowtips(lang('plugin/".$pluginname."','".$mysubmod."_list_tips'));\n".
		"\t\tshowformheader(\$this_page.'&subac=".$mysubmod."list');\n".
		"\t\tshowtableheader(lang('plugin/".$pluginname."','".$mysubmod."_list'));\n".
		"\t\tshowsubtitle(array('', lang('plugin/".$pluginname."','".$mysubmod."name'),lang('plugin/".$pluginname."','shopnum'), lang('plugin/".$pluginname."','".$mysubmod."quanxian'), lang('plugin/".$pluginname."','status'), ''));\n".
		"\t\t//\$query = DB::query(\"SELECT * FROM \".DB::table('".$pluginname."_".$submod."').\" order by ".$mysubmod."id asc\");\n".
		"\t\t//while(\$row = DB::fetch(\$query)) {\n".
		"\t\t\tshowtablerow('', array('class=\"td25\"','class=\"td23\"', 'class=\"td23\"', 'class=\"td23\"','class=\"td25\"',''), array(\n".
		"\t\t\t\t\"<input class=\\\"checkbox\\\" type=\\\"checkbox\\\" name=\\\"delete[]\\\" value=\\\"\$row[".$mysubmod."id]\\\">\",\n".
		"\t\t\t\$row['".$mysubmod."name'],\n".
		"\t\t\t\$row['".$mysubmod."name'],\n".
		"\t\t\t\$row['".$mysubmod."name'],\n".
		"\t\t\t\"<input class=\\\"checkbox\\\" type=\\\"checkbox\\\" name=\\\"statusnew[\".\$row['".$mysubmod."id'].\"]\\\" value=\\\"1\\\" \".(\$row['status'] > 0 ? 'checked' : '').\">\",\n".
		"\t\t\t\t\"<a href=\\\"\".ADMINSCRIPT.\"?action=\".\$this_page.\"&subac=".$mysubmod."edit&".$mysubmod."id=\$row[".$mysubmod."id]\\\" class=\\\"act\\\">\".lang('plugin/".$pluginname."','edit').\"</a>\",\n".
		"\t\t\t));\n".
		"\t\t//}\n".
		"\t\techo '<tr><td></td><td colspan=\"6\"><div><a href=\"'.ADMINSCRIPT.'?action='.\$this_page.'&subac=".$mysubmod."edit\" class=\"addtr\">'.lang('plugin/".$pluginname."','add_".$mysubmod."').'</a></div></td></tr>';\n".
		"\t\tshowsubmit('submit','submit','del');\n".
		"\t\tshowtablefooter();\n".
		"\t\tshowformfooter();\n".
		"\t}else{\n".
		"\t}\n".
		"}elseif(\$subac == '".$mysubmod."edit') {\n".
		"\tif(!submitcheck('submit')) {\n".
		"\t\tshowtips(lang('plugin/".$pluginname."','".$mysubmod."_edit_tips'));\n".
		"\t\tshowformheader(\$this_page.'&subac=".$mysubmod."edit','enctype');\n".
		"\t\tshowtableheader(lang('plugin/".$pluginname."','".$mysubmod."_edit'));\n".
		"\t\t\$".$mysubmod."id ? showhiddenfields(array('".$mysubmod."id'=>\$".$mysubmod."id)) : '';\n".
		"\t\tshowsetting(lang('plugin/".$pluginname."','".$mysubmod."name'),'".$mysubmod."_info[".$mysubmod."name]',\$".$mysubmod."_info['".$mysubmod."name'],'text','',0,lang('plugin/".$pluginname."','".$mysubmod."name_comment'),'','',true);\n".
		"\t\tshowsubmit('submit');\n".
		"\t\tshowtablefooter();\n".
		"\t\tshowformfooter();\n".
		"\t}else{\n".
		"\t\tif(!htmlspecialchars(trim(\$_GET['".$mysubmod."_info']['".$mysubmod."name']))) {\n".
		"\t\t\tcpmsg(lang('plugin/".$pluginname."','".$mysubmod."name_nonull'));\n".
		"\t\t}\n".
		"\t\t\$datas = \$_GET['".$mysubmod."_info'];\n".
		"\t\tforeach ( \$datas as \$k=>\$v) {\n".
		"\t\t\t\$data[\$k] = htmlspecialchars(trim(\$v));\n".
		"\t\t\tif(!DB::result_first(\"describe \".DB::table('".$pluginname."_".$submod."').\" \".\$k)) {\n".
		"\t\t\t\t\$sql = \"alter table \".DB::table('".$pluginname."_".$submod."').\" add `\".\$k.\"` varchar(255) not Null;\";\n".
		"\t\t\t\trunquery(\$sql);\n".
		"\t\t\t}\n".
		"\t\t}\n".
		"\t\tif(\$".$mysubmod."id) {\n".
		"\t\t\tDB::update('".$pluginname."_".$submod."',\$data,array('".$mysubmod."id'=>\$".$mysubmod."id));\n".
		"\t\t}else{\n".
		"\t\t\tDB::insert('".$pluginname."_".$submod."',\$data);\n".
		"\t\t}\n".
		"\t\tcpmsg(lang('plugin/".$pluginname."', '".$mysubmod."_edit_succeed'), 'action='.\$this_page.'&subac=".$mysubmod."list', 'succeed');\n".
		"\t}\n".
		"}\n".
		"\n".
		"?>");
	}
}//end func

//复制插件文件
function copy_plugin_file($submod_file){
	global $submod,$current_group;
	$plugin_file = substr(CARDELM_ROOT,0,strlen(CARDELM_ROOT)-8).'yiqixueba_'.$current_group.'/'.str_replace($current_group."_","",$submod).'.inc.php';
	//dump($plugin_file);
	if(file_exists($plugin_file)){
		file_put_contents($submod_file,file_get_contents($plugin_file));
	}else{
		make_admincp_file($submod_file);
	}
}//end func
// 浏览器友好的变量输出
function dump($var, $echo=true,$label=null, $strict=true){
    $label = ($label===null) ? '' : rtrim($label) . ' ';
    if(!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>".$label.htmlspecialchars($output,ENT_QUOTES)."</pre>";
        } else {
            $output = $label . " : " . print_r($var, true);
        }
    }else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if(!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>'. $label. htmlspecialchars($output, ENT_QUOTES). '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}
?>