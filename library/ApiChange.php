<?php
class ApiChange{
	private $api_key;
	private $secret_token;
	private $base_url;


	function __construct( $api_key, $secret_token = '', $base_url = 'https://api.change.org/' ){
		$this->api_key = $api_key;
		$this->secret_token = $secret_token;
		$this->base_url = $base_url;
	}

	private function get_http_response_code($url) {
		$headers = get_headers($url);
		return substr($headers[0], 9, 3);
	}
	
	private function is_url_online($url){
		$onlie = false;
		if (filter_var($url, FILTER_VALIDATE_URL)){
			$online = ($this->get_http_response_code($url) != "404");
		}

		return $online;
	}

	function regresa_razones_peticion( $petition_url ){
		$json_response = false;

		if(preg_match("/ /", $petition_url)){
			$petition_url=urlencode($petition_url);
		}

		$petition_id = $this->regresa_id_peticion( $petition_url );
		$request_url = 'v1/petitions/'.$petition_id.'/reasons';
		$parameters = array(
		    'api_key' => $this->api_key
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";

		if($this->is_url_online($final_request_url)){
			$response = file_get_contents($final_request_url);
			$json_response = json_decode($response, true);
			$reasons = $json_response['reasons'];
		}

		return $json_response;
	}
	function regresa_info_peticion( $petition_url ){
		$petition_id = $this->regresa_id_peticion( $petition_url );
		$request_url = 'v1/petitions/'.$petition_id;
		$parameters = array(
		    'api_key' => $this->api_key
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";

		$response = file_get_contents($final_request_url);

		$json_response = json_decode($response, true);

		return $json_response;
	}
	function regresa_firmas_peticion( $petition_url ){
		$petition_id = $this->regresa_id_peticion( $petition_url );
		$request_url = 'v1/petitions/'.$petition_id.'/signatures';
		$parameters = array(
		    'api_key' => $this->api_key
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";

		$response = file_get_contents($final_request_url);

		$json_response = json_decode($response, true);
		$petition_id = $json_response['signature_count'];

		//echo $final_request_url;exit;
		return $json_response;
	}

	function get_auth_key($petition_url){
		$petition_id = $this->regresa_id_peticion( $petition_url );
		$endpoint = "/v1/petitions/$petition_id/auth_keys";
		$url = $this->base_url . $endpoint;
		$parameters = array(
		    'api_key' => $this->api_key,
		    'petition_id' => $petition_id,
		    'source_description' => 'API en sitio del IMCO',
		    'source' => 'http://comparatuescuela.projects.spaceshiplabs.com/',
		    'requester_email' => 'Contacto@mejoratuescuela.org',
		    'callback_endpoint' => 'http://comparatuescuela.projects.spaceshiplabs.com/peticiones/receive_auth_keys'
		);

		$data = http_build_query($parameters);

		$curl_session = curl_init();
		curl_setopt_array($curl_session, array(
		    CURLOPT_POST => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_POSTFIELDS => $data
		));

		$result = curl_exec($curl_session);
		var_dump($result);
	
	}

	#Esta función sigue en desarrollo
	function pedir_auth_key_peticion( $petition_url ){
		$petition_id = $this->regresa_id_peticion($petition_url);
		$endpoint = "/v1/petitions/$petition_id/auth_keys";
		$url = $this->base_url . $endpoint;
		
		#parametros
		$source_description = 'API en sitio del IMCO';
		$source = 'http://www.mejoratuescuela.org/peticion';
		$requester_email = 'francisco.mekler@imco.org.mx';
		$callback_endpoint = 'http://www.mejoratuescuela.org/receive_auth_keys.php';



		$parameters['source_description'] = $source_description;#	string	 User defined. The type of media around which signatures will be gathered. Example: "YouTube video"
		$parameters['source'] = $source;#	string	 URL or other identifier of the source from which signatures will be gathered. Must be unique to the API consumer submitting the request. Example: http://www.youtube.com/watch?v=bflYjF90t7c
		$parameters['requester_email'] = $requester_email;#	string	 The email address of the individual requesting the petition authorization key.
		$parameters['callback_endpoint'] = $callback_endpoint;#	string	 The URL to which the petition authorization key or other information (outlined below) will be posted.

		$parameters['api_key'] = $this->api_key;
		$parameters['timestamp'] = gmdate("Y-m-d\TH:i:s\Z"); // ISO-8601-formtted timestamp at UTC
		$parameters['endpoint'] = $endpoint;

		$query_string_with_secret_and_auth_key = http_build_query($parameters) . $this->secret_token . $petition_auth_key;

		$parameters['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

		$data = http_build_query($parameters);

		#echo $data;exit;

		$curl_session = curl_init();
		curl_setopt_array($curl_session, array(
		    CURLOPT_POST => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_POSTFIELDS => $data
		));

		$result = curl_exec($curl_session);
		var_dump($result);
		exit('asa');
//		return $result;
//		echo "\n Se ha solicitado la auth_key";
		$json_response = json_decode($response, true);
		$auth_key = $json_response['auth_key'];
		return $auth_key;
		
	}

	function regresa_id_peticion( $petition_url ){
		if(preg_match("/ /", $petition_url)){
			$petition_url=urlencode($petition_url);
		}

		$petition_id = false;
		$request_url = 'v1/petitions/get_id';
		$parameters = array(
		    'api_key' => $this->api_key,
		    'petition_url' => $petition_url
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";

		if($this->is_url_online($final_request_url)){
			$response = file_get_contents($final_request_url);
			$json_response = json_decode($response, true);
			$petition_id = $json_response['petition_id'];
		}

		return $petition_id;
	}

	function suma_firma_peticion( $petition_url, $petition_auth_key, $parameters ){
		$petition_id = $this->regresa_id_peticion($petition_url);
		//var_dump($petition_id);exit;

		$endpoint = "/v1/petitions/$petition_id/signatures";
		$url = $this->base_url . $endpoint;
		//echo $url;exit();

		$parameters['api_key'] = $this->api_key;

		$parameters['timestamp'] = gmdate("Y-m-d\TH:i:s\Z"); // ISO-8601-formtted timestamp at UTC
		
		$parameters['endpoint'] = $endpoint;

		$query_string_with_secret_and_auth_key = http_build_query($parameters) . $this->secret_token . $petition_auth_key;
		#var_dump(http_build_query($parameters) , $this->secret_token , $petition_auth_key);
		$parameters['rsig'] = hash('sha256', $query_string_with_secret_and_auth_key);

		$data = http_build_query($parameters);

		//echo $data;exit;

		$curl_session = curl_init();
		curl_setopt_array($curl_session, array(
		    CURLOPT_POST => 1,
		    CURLOPT_URL => $url,
		    CURLOPT_POSTFIELDS => $data,
		    CURLOPT_RETURNTRANSFER => TRUE
		));

		$result = curl_exec($curl_session);
		return $result;
	}

	function regresa_id_organizacion( $organization_url ){
		if(preg_match("/ /", $organization_url)){
			$organization_url=urlencode($organization_url);
		}

		$organization_id = false;
		$request_url = 'v1/organizations/get_id';
		$parameters = array(
		    'api_key' => $this->api_key,
		    'organization_url' => $organization_url
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";
		if($this->is_url_online($final_request_url)){
			$response = file_get_contents($final_request_url);
			$json_response = json_decode($response, true);
			$organization_id = $json_response['organization_id'];
		}
		return $organization_id;

	}
	
	function regresa_info_peticiones_organizacion($organization_url){
		$organization_id = $this->regresa_id_organizacion($organization_url);
		$request_url = "v1/organizations/$organization_id/petitions";
		$parameters = array(
		    'api_key' => $this->api_key,
		);

		$query_string = http_build_query( $parameters );
		$final_request_url = "{$this->base_url}$request_url?$query_string";
		$petitions = array();
		if($this->is_url_online($final_request_url)){
			$response = file_get_contents($final_request_url);
			$json_response = json_decode($response, true);

			foreach($json_response['petitions'] as $petition){
				$petition['url'] = str_replace('https://api.change.org/petitions/','http://www.change.org/peticiones/',$petition['url']);
				$petitions[] = $petition;
			}
		}
		return $petitions;
	}

}
?>
