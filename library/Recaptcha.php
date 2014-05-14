<?php

class Recaptcha {
	
	private $public_key; //= WEBSITE_RECAPTCHA_PUBLIC_KEY;
	private $private_key; //= WEBSITE_RECAPTCHA_PRIVATE_KEY;	
	var $api_create = 'https://www.google.com/recaptcha/admin/create';
	var $api_server = 'http://www.google.com/recaptcha/api';
	var $api_secure_server = 'https://www.google.com/recaptcha/api';
	var $verify_server = 'www.google.com';
	var $is_valid;
	var $error_message;

	function __construct($public_key,$private_key){
		$this->public_key = $public_key;
		$this->private_key = $private_key;
	}
	
	private function encode_query($data){
		
		$request = '';
		
		foreach($data as $key => $value) $request .= $key.'='.urlencode(stripslashes($value)).'&';
		
		// cut the last '&'
		$request = substr($request, 0, strlen($request) - 1);
		
		return $request;
		
	}
	
	private function post($host, $path, $data, $port = 80){

		$request = $this->encode_query($data);
		
		$http_request  = "POST $path HTTP/1.0\r\n";
		$http_request .= "Host: $host\r\n";
		$http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
		$http_request .= "Content-Length: ".strlen($request)."\r\n";
		$http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
		$http_request .= "\r\n";
		$http_request .= $request;
		
		$response = '';
		
		if(false == ($fs = fsockopen($host, $port, $errno, $errstr, 10))) exit('reCaptcha: Could not open socket');
		
		fwrite($fs, $http_request);
		
		while(!feof($fs)) $response .= fgets($fs, 1160); // One TCP-IP packet
		
		fclose($fs);
		
		$response = explode("\r\n\r\n", $response, 2);
		
		return $response;
		
	}
	
	public function form($error = false, $use_ssl = false){
		
		if(is_null($this->public_key) || empty($this->public_key)) exit('To use reCAPTCHA you must get an API key from <a href="'.$this->api_create.'">'.$this->api_create.'</a>');
		
		$server = ($use_ssl ? $this->$api_secure_server : $this->api_server);
	
		$errorpart = '';
		
		if($error) $errorpart = '&amp;error='.$error;
		
		echo '
		 <script type="text/javascript">var RecaptchaOptions = {theme : "blackglass"};</script>
		<script type="text/javascript" src="'.$server.'/challenge?k='.$this->public_key.$errorpart.'"></script>
		<noscript>
			<iframe src="'.$server. '/noscript?k='.$this->public_key.$errorpart.'" height="300" width="500" frameborder="0"></iframe><br/>
			<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
			<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
		</noscript>';
		
	}
	
	public function check_answer($remote_ip, $challenge, $response, $extra_params = array()){
		
		if(is_null($this->private_key) || empty($this->private_key)) exit('To use reCAPTCHA you must get an API key from <a href="'.$this->api_create.'">'.$this->api_create.'</a>');
		
		if(is_null($remote_ip) || empty($remote_ip)) exit('For security reasons, you must pass the remote IP to reCAPTCHA');
		
		// discard spam submissions
		if(is_null($challenge) || strlen($challenge) == 0 || is_null($response) || strlen($response) == 0){		
			$this->is_valid = false;
			$this->error_message = 'incorrect-captcha-sol';
			return;
		}
		
		$response = $this->post(
			$this->verify_server, 
			'/recaptcha/api/verify',
			array(
				'privatekey' => $this->private_key,
				'remoteip' => $remote_ip,
				'challenge' => $challenge,
				'response' => $response
			) + $extra_params
		);
		
		$answers = explode ("\n", $response[1]);
		
		if(trim($answers[0]) == 'true'){
		
			$this->is_valid = true;
		
		}else{
		
			$this->is_valid = false;
			$this->error_message = $answers [1];
		
		}
		
		return ($this->is_valid ? $this->is_valid : false);
		
	}	
	
	public function get_signup_url($domain = false, $appname = false){
		
		return $this->api_create.'?'.$this->encode_query(array('domains' => $domain, 'app' => $appname));
		
	}
	
}

class MailHide {
	
	private $public_key = WEBSITE_MAILHIDE_PUBLIC_KEY;
	private $private_key = WEBSITE_MAILHIDE_PRIVATE_KEY;

	private function aes_pad($val){
		
		$block_size = 16;
		
		$numpad = $block_size - (strlen($val) % $block_size);
		
		return str_pad($val, strlen($val) + $numpad, chr($numpad));
		
	}

	private function aes_encrypt($val, $ky){
		
		if(!function_exists('mcrypt_encrypt')) exit('To use reCAPTCHA Mailhide, you need to have the mcrypt php module installed.');
		
		$mode = MCRYPT_MODE_CBC;  		
		$enc = MCRYPT_RIJNDAEL_128;
		$val = $this->aes_pad($val);
		
		return mcrypt_encrypt($enc, $ky, $val, $mode, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
		
	}


	private function get_mailhide_urlbase64($x){
		
		return strtr(base64_encode($x), '+/', '-_');
		
	}
	
	private function get_mailhide_url($email){
		
		if(is_null($this->public_key) || empty($this->public_key) || is_null($this->private_key) || empty($this->private_key)) 
			exit('To use reCAPTCHA Mailhide, you have to sign up for a public and private key, you can do so at <a href="http://www.google.com/recaptcha/mailhide/apikey">http://www.google.com/recaptcha/mailhide/apikey</a>');

		$ky = pack('H*', $this->private_key);
		$crypt_mail = $this->aes_encrypt($email, $ky);
		
		return 'http://www.google.com/recaptcha/mailhide/d?k='.$pubkey.'&c='.$this->get_mailhide_urlbase64($crypt_mail);
		
	}
	
	private function get_mailhide_email_parts($email){
		
		$arr = preg_split("/@/", $email);
	
		if(strlen($arr[0]) <= 4){
			$arr[0] = substr($arr[0], 0, 1);
		}elseif(strlen($arr[0]) <= 6){
			$arr[0] = substr($arr[0], 0, 3);
		}else{
			$arr[0] = substr($arr[0], 0, 4);
		}
		
		return $arr;
		
	}
	
	public function email($email){
		
		$email_parts = $this->get_mailhide_email_parts($email);
		
		$url = $this->get_mailhide_url($email);
		
		echo htmlentities($email_parts[0]).'<a href="'.htmlentities($url).'" onclick="window.open(\''.htmlentities($url).'\', \'\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300\'); return false;" title="Reveal this e-mail address">...</a>@'.htmlentities($email_parts[1]);
	
	}	
	
}

?>
