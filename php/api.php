<?php

class Burningsoul_API{
	
	function __construct(){
		$this->config();
	}
	
	function config($ssl=FALSE,$returnArray=FALSE){
		$this->config['ssl']=$ssl;
		$this->config['returnArray']=$returnArray;
		$this->result="";
	}
	
//geoip
public function geoip($ip=null){ //$ip Required
$this->config['apiname']="geoip";
if($ip==null || !filter_var($ip, FILTER_VALIDATE_IP)){ //check input
	$this->e("Invalid IP");
}
	return $this->httpIO(array("ip"=>$ip), "GET");
}

//QR-Code
public function qr($data,$size=null,$ecc=null){ //$data Required
	$this->config['apiname']="qr";
	return $this->httpIO(array("data"=>$data,'size'=>$size,'ecc'=>$ecc),"POST");
}

//Whois
public function whois($domain){ //$domain Required
$this->config['apiname']="whois";
$domain=str_replace(array('http://','https://','http://www','https://www'), "", $domain); //Remove unvanted prefix
return $this->httpIO(array("domain"=>$domain), "GET");
}

//Location
public function location($name,$location){ //$name=name of the country/state | $location = cities/states 
$this->config['apiname']="location";
return $this->httpIO(array('name'=>$name,'location'=>$location),"GET");
}

//Moon
public function moon($time=null){
	$this->config['apiname']="moon";
	return $this->httpIO(array('time'=>$time), "GET");
}




function httpIO($fields,$method){ //making curl calls
//SSL
$http=($this->config['ssl'] ? 'https://' : 'http://');
$url=$http.'api.burningsoul.in/'.$this->config['apiname'];
if($method=='GET'){
	
	foreach($fields as $key=>$value){$url .='/'.$value;}
	$this->result=file_get_contents($url);
	
}else{

    $fields_string="";
    foreach($fields as $key=>$value) {
    	 $fields_string .= $key.'='.$value.'&';
		 }
    $fields_string=rtrim($fields_string, '&');
    //open connection
    $ch = curl_init();
    //set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//execute post
	$this->result=curl_exec($ch);
	//close connection
	curl_close($ch);

}

 return json_decode($this->result,$this->config['returnArray']);

}

//error trigger
function e($message=null){
	trigger_error("<font color='red'>".$message."</font>", E_USER_ERROR);
	
}
	
}
