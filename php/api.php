<?php

class Burningsoul_API{
	
	function config($APIname,$ssl=FALSE,$returnArray=FALSE){
		
		$this->config['apiname']=$APIname;
		$this->config['ssl']=$ssl;
		$this->config['returnArray']=$returnArray;
	}
	

function httpIO($fields){ //making curl calls
//SSL
$http=($this->config['ssl'] ? 'https://' : 'http://');
$url=$http.'api.burningsoul.in/'.$this->config['apiname'];
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
$fields_string=rtrim($fields_string, '&');
//open connection

$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//execute post
$result=curl_exec($ch);
//close connection
curl_close($ch);
	return $result;
}	
}
