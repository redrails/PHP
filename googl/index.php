<?php

class Googl
{
	
	function Googl($apiKey, $ENDPOINT = 'https://www.googleapis.com/urlshortener/v1/url'){
	
		$this->apiURL = $ENDPOINT.'?key='.$apiKey;
		
	}
	
	function ShortURL($url){
	
		$receive = $this->exec($url);
		
		return isset($receive['id']) ? $receive['id'] : false;
		
	}
	
	function ExpandURL($url){
	
		$receive = $this->exec($url,false);
		
		return isset($receive['longUrl']) ? $receive['longUrl'] : false;
		
	}
	
	function exec($url, $ShortURL = true){
	
		$ch = curl_init();
		
		if($ShortURL){
		
			curl_setopt($ch,CURLOPT_URL,$this->apiURL);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$url)));
			curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
			
		}
		
		else{
		
			curl_setopt($ch,CURLOPT_URL,$this->apiURL.'&shortUrl='.$url);
			
		}
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		
		$result = curl_exec($ch);
		
		curl_close($ch);
		
		return json_decode($result,true);
		
	}	
	
}

// CREATE INSTANCE WITH YOUR GOOGLE DEV KEY HERE:

$key = ''; //YOUR GOOGLE API KEY HERE

$class = new Googl($key);

// Shortening the URL

$minimize = $class->ShortURL("blog.ihtasham.com");
echo $minimize; 

// Expanding the URL from a goo.gl input

$expand = $class->ExpandURL($minimize);
echo $expand; 

?>
