<?php
class memcached_table extends table{
	function read($fields){
		//$time_start = microtime(true);
		if(class_exists('Memcache') && false){
			$memcache = new Memcache;	
			$memcache->connect('10.208.99.46', 11211) or die ("Could not connect memcache");
			$this->execute = false;
			parent::read($fields);
			$this->execute = true;
			$query_hash = sha1($this->sql);
			if($result = $memcache->get($query_hash)){				
				//$time_end = microtime(true);
				//$time = $time_end - $time_start;
				//echo 'Memcached: '.$time.'<br/>';
				return $result;
			}else{
				$result = parent::read($fields);				
				//$time_end = microtime(true);
				$memcache->set($query_hash,$result,false,0);
				//$time = $time_end - $time_start;
				//echo "Query from DB:".$time."<br/>";

				return $result;
			}
		}else{
			return parent::read($fields);
		}		
	}
}
?>
