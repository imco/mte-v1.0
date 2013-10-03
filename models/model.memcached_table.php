<?php
class memcached_table extends table{
	function read($fields){
		if(class_exists('Memcache')){
			$memcache = new Memcache;	
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
				var_dump($result);
				$memcache->set($query_hash,$result,false,0);
				return $result;
			}
		}else{
			echo "no memcache";
			return parent::read($fields);
		}		
	}
}
?>