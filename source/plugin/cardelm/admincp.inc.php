<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'/source/plugin/cardelm/function.php';




$submod = getgpc('submod');
$submod = $submod ? $submod : 'base_index';
$current_group = 'base';
$admin_menu = array();
$admin_menu[] = array(array('menu'=>in_array($submod,array('base_index','base_setting','base_mokuai')) ? lang('plugin/cardelm',$submod):lang('plugin/cardelm','admin_base'),'submenu'=>array(array(lang('plugin/cardelm','base_index'),'plugins&identifier=cardelm&pmod=admincp&submod=base_index',$submod=='base_index'),array(lang('plugin/cardelm','base_setting'),'plugins&identifier=cardelm&pmod=admincp&submod=base_setting',$submod=='base_setting'),array(lang('plugin/cardelm','base_mokuai'),'plugins&identifier=cardelm&pmod=admincp&submod=base_mokuai',$submod=='base_mokuai'))),in_array($submod,array('base_index','base_setting','base_mokuai')));







echo '<style>.floattopempty { height: 15px !important; height: auto; } </style>';
showsubmenu($plugin['name'].' '.$plugin['version'],$admin_menu);


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