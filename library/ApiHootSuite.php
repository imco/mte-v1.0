<?php
class ApiHootSuite{
	private $apiKey;
	
	function __construct($apiKey,$base_url="http://ow.ly/api/1.1/url/"){
		$this->apiKey = $apiKey;
		$this->base_url = $base_url;
	}

	public function shorten($url){
		$request_url = "shorten";
		$parameters = array(
		    'apiKey' => $this->apiKey,
		    'longUrl' => $url
		);
		$query_string = http_build_query( $parameters );
		$response = file_get_contents("{$this->base_url}$request_url?$query_string");
		$json_response = json_decode($response, true);
		return $json_response;
	}
}
?>
