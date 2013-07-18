<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/cardelm/source/function.php';

$submod = getgpc('submod');
$mokuai = getgpc('mokuai');

$submod_file = CARDELM_ROOT.'mokuai/'.$mokuai.'/cardelm/'.$submod.'.inc.php';

dump(file_exists($submod_file));

if (file_exists($submod_file)){
	require_once $submod_file;
}


?>