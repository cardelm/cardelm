<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'source/plugin/cardelm/lang.php';

class plugin_cardelm {

	function global_footer(){
		//����Ϊ�˶ž���С�ĸ����ļ���ר������githubͬ���ĳ���
		//ʵ�ʲ��������У���Ϊgithub��pro�е��ļ����뱾�ص�wordpress��discuz�ļ���������ͬ���м��ν��ļ����Ǵ������´���Ϊ���githubר�ã�Ŀ�ľ����޸�github�еĴ��룬ͬʱ�Զ����±��صĴ��룬�ﵽ���Ե�����
		$this_dir = dirname(__FILE__);
		//var_dump($this_dir);
		if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm'){
			$source_dir = 'C:\GitHub\cardelm';
			$this -> check_dz_update();
		}elseif($this_dir == 'D:\web\wamp\www\demo\dz3utf8\source\plugin\cardelm'){
			$this -> check_homedz_update();
		}

	}

	//���õݹ鷽ʽ���Զ�����discuz�ļ�
	function check_dz_update($path=''){
		clearstatcache();
		if($path=='')
			$path = 'C:\GitHub\cardelm';//���ص�GitHub��discuz�ļ���

		$out_path = 'C:\wamp\www\discuzdemo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);//���ص�wamp��discuz�ļ���

		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {

				if ($file != "." && $file != "..") {
					if (is_dir($path."/".$file)) {
						if (!is_dir($out_path."/".$file)){
							dmkdir($out_path."/".$file);
						}
						$this -> check_dz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub�ļ��޸�ʱ�����wampʱ
							file_put_contents ($out_path."/".$file,file_get_contents($path."/".$file));
						}
					}
				}
			}
		}
	}//func end
	function check_homedz_update($path=''){
		clearstatcache();
		if($path=='')
			$path = 'C:\GitHub\cardelm';//���ص�GitHub��discuz�ļ���

		$out_path = 'D:\web\wamp\www\demo\dz3utf8'.str_replace("C:\GitHub\cardelm","",$path);//���ص�wamp��discuz�ļ���

		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {

				if ($file != "." && $file != "..") {
					if (is_dir($path."/".$file)) {
						if (!is_dir($out_path."/".$file)){
							dmkdir($out_path."/".$file);
						}
						$this -> check_homedz_update($path."/".$file);
					}else{
						if (filemtime($path."/".$file)  > filemtime($out_path."/".$file)){//GitHub�ļ��޸�ʱ�����wampʱ
							file_put_contents ($out_path."/".$file,file_get_contents($path."/".$file));
						}
					}
				}
			}
		}
	}//func end
	/////////���ϲ�������ʽ���ļ��У�����ɾ�������ڽ���GitHub����ʱʹ��///////////////

	function global_usernav_extra1(){
		global $_G,$cardelmlang;
		$return = '<span class="pipe">|</span><a href="plugin.php?id=cardelm:member">'.$cardelmlang['membercenter'].'</a> ';
		return $return;
	}

}

class plugin_cardelm_forum extends plugin_cardelm{
}
?>