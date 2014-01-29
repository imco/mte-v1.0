<?php
class twitter_component extends component{

	public function init($params){
		// The tokens, keys and secrets from the app you created at https://dev.twitter.com/apps
		$this->config_tweet = $params;
		$this->whitelist = array('statuses/user_timeline.json?screen_name=MikeRogers0&count=10&include_rts=false&exclude_replies=true'=>true);
	}

	public function twitterToken($user='spaceshiplabs',$count=10,$search=false){
		/*if(!isset($url)){
			die('No URL set');
		}
		if($this->config_tweet['use_whitelist'] && !isset($this->whitelist[$url])){
			die('URL is not authorised');
		}
		*/
		$url = 'statuses/user_timeline.json?screen_name='.$user.'&count='.$count;
		$url = $search ? "search/tweets.json?q=$search&count=$count" : $url;
		$url_parts = parse_url($url);
		parse_str($url_parts['query'], $url_arguments);
		$full_url = $this->config_tweet['base_url'].$url; // Url with the query on it.
		$base_url = $this->config_tweet['base_url'].$url_parts['path']; // Url without the query.
		// Set up the oauth Authorization array
		$oauth = array(
			'oauth_consumer_key' => $this->config_tweet['consumer_key'],
			'oauth_nonce' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_token' => $this->config_tweet['oauth_access_token'],
			'oauth_timestamp' => time(),
			'oauth_version' => '1.0'
		);

		$base_info = $this->buildBaseString($base_url, 'GET', array_merge($oauth, $url_arguments));
		$composite_key = rawurlencode($this->config_tweet['consumer_secret']) . '&' . rawurlencode($this->config_tweet['oauth_access_token_secret']);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;

// Make Requests
		$header = array(
			$this->buildAuthorizationHeader($oauth), 
			'Expect:'
		);
		$options = array(
			CURLOPT_HTTPHEADER => $header,
			//CURLOPT_POSTFIELDS => $postfields,
			CURLOPT_HEADER => false,
			CURLOPT_URL => $full_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
		);

		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$result = curl_exec($feed);
		$info = curl_getinfo($feed);
		curl_close($feed);

		// Send suitable headers to the end user.
		if(isset($info['content_type']) && isset($info['size_download'])){
			header('Content-Type: '.$info['content_type']);
			header('Content-Length: '.$info['size_download']);
		}

		$vartemp = json_decode($result);
		$vartemp = $vartemp->statuses;
		$responce = array();
		foreach($vartemp as $tweet){
			$tweetData = new stdClass();
			$tweetData->screen_name = $tweet->user->screen_name;
			$tweetData->text  = $tweet->text;
;			$tweetData->user = new stdClass();
			$tweetData->user->screen_name  =$tweet->user->screen_name;
			$tweetData->user->profile_image_url = $tweet->user->profile_image_url;
			$tweetData->id_str = $tweet->id_str;
			$responce[] = $tweetData;
		}
		echo json_encode($responce);
	}

	function buildBaseString($baseURI, $method, $params) {
		$r = array();
		ksort($params);
		foreach($params as $key=>$value){
		$r[] = "$key=" . rawurlencode($value);
		}
		return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}

	function buildAuthorizationHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
		$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}
}
?>
