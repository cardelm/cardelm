<?php


if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
//����Ϊ�˶ž���С�ĸ����ļ���ר������githubͬ���ĳ���
//ʵ�ʲ��������У���Ϊgithub��pro�е��ļ����뱾�ص�wordpress��discuz�ļ���������ͬ���м��ν��ļ����Ǵ������´���Ϊ���githubר�ã�Ŀ�ľ����޸�github�еĴ��룬ͬʱ�Զ����±��صĴ��룬�ﵽ���Ե�����
$this_dir = dirname(__FILE__);
//var_dump($this_dir);
if ($this_dir == 'C:\wamp\www\discuzdemo\dz3utf8\source\plugin\cardelm'){
	$source_dir = 'C:\GitHub\cardelm';
	check_dz_update();
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
					check_dz_update($path."/".$file);
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









// ������Ѻõı������
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