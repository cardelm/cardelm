<?php

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

//更新前台导航菜单
function cardelm_upnav(){
	$query = DB::query("SELECT * FROM ".DB::table('cardelm_mokuai')." WHERE available = 1 order by mokuaiid asc");
	while($row = DB::fetch($query)) {
		$modules = dunserialize($row['modules']);
		foreach( $modules as $k=>$v ){
			if($v['type'] == 1){
				$navdata['parentid'] = 0;
				$navdata['name'] = $v['menu'];
				$navdata['url'] = 'plugin.php?id=cardelm&submod='.$row['identifier'];
				$navdata['identifier'] = $v['name'];
				$navdata['target'] = 0;
				$navdata['type'] = 0;
				$navdata['available'] = 1;
				$navdata['displayorder'] = $v['displayorder'];
				$navdata['navtype'] = 0;
				if(DB::result_first("SELECT count(*) FROM ".DB::table('common_nav')." WHERE identifier='".$v['name']."'")==0){
					DB::insert('common_nav', $navdata);
				}else{
					DB::update('common_nav', $navdata,array('identifier'=>$v['name']));
				}
			}
		}
	}
}



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