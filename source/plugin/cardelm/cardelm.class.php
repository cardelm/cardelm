<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'source/plugin/cardelm/lang.php';

class plugin_cardelm {

	function global_footer(){
		//这是为了杜绝不小心覆盖文件而专门用于github同步的程序
		//实际操作过程中，因为github的pro中的文件夹与本地的wordpress、discuz文件夹名称相同，有几次将文件覆盖错，故以下代码为配合github专用，目的就是修改github中的代码，同时自动更新本地的代码，达到调试的作用
		$this_dir = dirname(__FILE__);
		//var_dump($this_dir);
		if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm'){
			$source_dir = 'C:\GitHub\cardelm';
			$this -> check_dz_update();
		}elseif($this_dir == 'D:\web\wamp\www\demo\dz3utf8\source\plugin\cardelm'){
			$this -> check_homedz_update();
		}

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
						$this -> check_dz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub文件修改时间大于wamp时
							file_put_contents ($out_path."/".$file,$file =='lang.php' ? file_get_contents($path."/".$file) : iconv("UTF-8", "ASCII",file_get_contents($path."/".$file)));
						}
					}
				}
			}
		}
	}//func end
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
						$this -> check_homedz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub文件修改时间大于wamp时
							file_put_contents ($out_path."/".$file,$file =='lang.php' ? file_get_contents($path."/".$file) : iconv("UTF-8", "ASCII",file_get_contents($path."/".$file)));
						}
					}
				}
			}
		}
	}//func end
	/////////以上部分在正式的文件中，必须删除，仅在进行GitHub调试时使用///////////////

	function global_usernav_extra1(){
		global $_G,$cardelmlang;
		$return = '<span class="pipe">|</span><a href="plugin.php?id=cardelm:member">'.$cardelmlang['membercenter'].'</a> ';
		return $return;
	}

}

class plugin_cardelm_forum extends plugin_cardelm{
}
?>