<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


class plugin_cardelm {

	function global_footer(){
		$this_dir = dirname(__FILE__);
		//var_dump($this_dir);
		if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm'){
			$source_dir = 'C:\GitHub\cardelm';
			$this -> check_dz_update();
		}elseif($this_dir == 'D:\web\wamp\www\demo\dz3utf8\source\plugin\cardelm'){
			$this -> check_homedz_update();
		}

	}

	function check_dz_update($path=''){
		clearstatcache();
		if($path=='')
			$path = 'C:\GitHub\cardelm';

		$out_path = 'C:\wamp\www\discuzdemo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);

		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {

				if ($file != "." && $file != "..") {
					if (is_dir($path."/".$file)) {
						if (!is_dir($out_path."/".$file)){
							dmkdir($out_path."/".$file);
						}
						$this -> check_dz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){
							file_put_contents ($out_path."/".$file,$file =='cardelm.lang.php' ? file_get_contents($path."/".$file) : diconv(file_get_contents($path."/".$file),"UTF-8", "GBK//IGNORE"));
						}
					}
				}
			}
		}
	}//func end
	function check_homedz_update($path=''){
		clearstatcache();
		if($path=='')
			$path = 'C:\GitHub\cardelm';

		$out_path = 'D:\web\wamp\www\demo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);

		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {

				if ($file != "." && $file != "..") {
					if (is_dir($path."/".$file)) {
						if (!is_dir($out_path."/".$file)){
							dmkdir($out_path."/".$file);
						}
						$this -> check_homedz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){
							file_put_contents ($out_path."/".$file,$file =='cardelm.lang.php' ? file_get_contents($path."/".$file) : diconv(file_get_contents($path."/".$file),"UTF-8", "GBK//IGNORE"));
						}
					}
				}
			}
		}
	}//func end
	////////////////////////

	function global_usernav_extra1(){
		global $_G;
		$return = '<span class="pipe">|</span><a href="plugin.php?id=cardelm:member">'.lang('plugin/cardelm','member_center').'</a> ';
		return $return;
	}

}

class plugin_cardelm_forum extends plugin_cardelm{
}
?>