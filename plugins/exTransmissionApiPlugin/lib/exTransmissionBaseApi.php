<?php
class exTransmissionBaseApi{

	const RPC_URL='http://%s:%s/transmission/rpc';

	private $host, $port, $username, $password, $url;

	public function __construct($host='',$port='9091',$username='',$password=''){


		$this->host = $host;
		$this->port =  $port;
		$this->username = $username;
		$this->password= $password;

		$this->url = sprintf(self::RPC_URL,$host,$port);

	}
	
	
	public function callTransmission($method='', $arguments=array()){
		
		$session_id = $this->getTransmissionSessionId();
		
		$data = array(
			'method'=>$method,
			'arguments'=>$arguments,
			'tag'=>'symfony-rpc'
		);
		
		
		$r = $this->doRpcPost($data,$session_id);
		return json_decode($r);
		
	}

	
	private function doRpcPost($data=array(),$session_id=''){
		
		//maybe this should be extracted
		$curl = curl_init();

		//set the options
		curl_setopt($curl, CURLOPT_URL,$this->url);
		curl_setopt($curl, CURLOPT_ENCODING,'utf-8');
		curl_setopt($curl, CURLOPT_POST,1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl, CURLOPT_HEADER, 0); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, array ('X-Transmission-Session-Id: '.$session_id)) ;
		
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
		
				//	  //make the request
		$r = curl_exec($curl);
		
		curl_close($curl);
		
		return $r;
	
	}
	
	public function getTransmissionSessionId(){

		
		$rpcResult = $this->doRpcPost();

		$result=array();
		$ret = preg_match  ( "/<code>.*X-Transmission-Session-Id: (.*?)<\\/code>/", $rpcResult, $result) ;
		
		if(!$ret){
			return null;
		}
		return $result[1];
	
	}
	

}
