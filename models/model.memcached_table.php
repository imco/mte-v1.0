<?php
class memcached_table extends table{
	function read($fields){
		if(extension_loaded('memcached')){
			$memcache = new memcached;	
			$memcache->connect('***REMOVED***', 11211) or die ("Could not connect memcache");
			$this->execute = false;
			parent::read($fields);
			$this->execute = true;
			$query_hash = md5($this->sql);
			if($result = $memcache->get($query_hash)){
				echo 'memcached';
				return $result;
			}else{
				print("<br/>Query from DB<br/>");
				$result = parent::read();				
				$memcache->set($query_hash,$result,false,0);
			}
		}else{
			echo "no memcache";
			return parent::read($fields);
		}		
	}
}
?>