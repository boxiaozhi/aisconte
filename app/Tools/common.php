<?php
namespace App\Tools;

/**
* 
*/
class Common
{
	
	public static function cUrl($url,$header=null, $data = null){
	    //初始化curl
	    $curl = curl_init();
	    //设置cURL传输选项
	    
	    if(is_array($header)){

	        curl_setopt($curl, CURLOPT_HTTPHEADER  , $header);
	    }
	    
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    

	    if (!empty($data)){//post方式
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    
	    //获取采集结果
	    $output = curl_exec($curl);

	    //关闭cURL链接
	    curl_close($curl);
	  
	    //解析json
	    $json=json_decode($output,true);
	    //判断json还是xml
	    if ($json) {
	        return $json;
	    }else{
	        #验证xml
	        libxml_disable_entity_loader(true);
	        #解析xml
	        $xml = simplexml_load_string($output, 'SimpleXMLElement', LIBXML_NOCDATA);
	        return $xml;
	    }
	}
}