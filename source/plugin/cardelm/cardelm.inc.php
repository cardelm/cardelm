<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$_G['disabledwidthauto'] = 0;

$submod = getgpc('submod');
$submods = array('index','openweixin');
$submod = in_array($submod,$submods) ? $submod : $submods[0];

$thistemplate = 'default';
//$thistemplate = 'modoer';
$thismokuai = 'shop';

$currentnav = '<a href="plugin.php?id=cardelm">'.lang('plugin/cardelm','plugintitle').'</a>';


$template_file = $thistemplate.'/'.$thismokuai.'/'.$submod ;
//$templatefile = DISCUZ_ROOT.'source/plugin/cardelm/template/'.$template_file.'.htm';
$templatefile = 'C:\GitHub\cardelm\source/plugin/cardelm/template/'.$template_file.'.htm';
if (!file_exists($templatefile)){
	file_put_contents($templatefile,"<!--{template common/header}-->\n<div id=\"wp\" class=\"wp\">\n\t<div id=\"pt\" class=\"bm cl\">\n\t\t<div class=\"z\"><a href=\"./\" class=\"nvhm\" title=\"{lang home}\">\$_G[setting][bbname]</a><em>&raquo;</em>{\$currentnav}</div>\n\t</div>\n</div>\n<div class=\"wp\">\n\n</div>\n<!--{subtemplate common/footer}-->");
}

//$mod_file = DISCUZ_ROOT.'source/plugin/cardelm/source/'.$thismokuai.'/main/'.$submod.'.inc.php';
$mod_file = 'C:\GitHub\cardelm\source/plugin/cardelm/source/'.$thismokuai.'/main/'.$submod.'.inc.php';
if (!file_exists($mod_file)){
	file_put_contents($mod_file, "<?php\n\n/**\n*\t卡益联盟程序\n*\t文件名：".$submod.".inc.php  创建时间：".dgmdate(time(),'dt')."  杨文\n*\n*/\n\nif(!defined('IN_DISCUZ')) {\n\texit('Access Denied');\n}\ninclude template('cardelm:'.\$template_file);\n?>");
}



require_once $mod_file;



?>