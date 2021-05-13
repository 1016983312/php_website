<?php
header("Content-type:text/html;charset=utf-8");
$url='http://staging-oms.pernod-ricard-china.com/index.php/omsapi/service';

$data['location'] = array(
    'VIP D2C',
    'EAST',
    'SOUTH1');
$data['sku'] = array(
    '011007',
    '015877'
);

$post['app_key'] = 'ATEST';
$post['method'] = 'lecercle_d.stock.query';
$post['timestamp'] = time();
$post['version'] = '1.0';
$post['random'] = rand(1,99999);
$post['format'] = 'json';
$post['params'] = json_encode($data);
$post['sign']=getSign($post);
			$ch = curl_init();//初始化一个cURL会话
          
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
            // 在POST数据哦！
            curl_setopt($ch, CURLOPT_POST, 1);
            // 把post的变量加上
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            echo   $post['app_key'];
            echo    $post['timestamp'] ;
            echo  $post['format'];
            echo  $post['random'] ;
            echo   $post['params'];
            echo  $post['sign'];           
            //抓取URL并把它传递给浏览器
            $output = curl_exec($ch);//kernel::log($output);
		     $result=json_decode($output,true); echo "<pre>";print_r($output);print_r($result);exit();
			 if($result['rsp']=="succ"){
			 }

function getSign($params){
	
    $secretKey = 'lecercle123';
	$stringA='';
    ksort($params);
    
	foreach($params as $k=>$v){
		if(!is_array($v)){
			$stringA.=$k.'='.$v.'&';
		}
    }	
	
	$stringA = trim($stringA,"&");

    return strtoupper(md5($stringA . $secretKey));
	
}