<?php
class mxnphp_gallery extends component{
	public function init($params){
		if($params){
			$this->photo_table = $params['photo_table'];
		}
	}
	public function save_image($file,$id,$folder,$thumbs=false){
		$ext = explode('.',$file['name']);
		$response->id = $id;
		$filename = $id.".".strtolower($ext[count($ext)-1]);
		$path = $this->config->document_root.$folder;
		$file = $this->save_post_file($file,$path,$filename);
		if($file){			
			$response->full = $folder.$filename;
			if(isset($thumbs) && $thumbs){
				foreach($thumbs as $thumb){
					//echo $thumb->slug;
					$resize_type = isset($thumb->resize_type) ? $thumb->resize_type : "adaptive";
					$this->make_thumb($path.$file,$path."/{$thumb->slug}/".$filename,$thumb->width,$thumb->height,$resize_type);
					$response->{$thumb->slug} =  $folder.$thumb->slug."/".$filename;
				}
			}
			$response->filename = $filename;
			return $response;
		}else{
			return false;
		}
	}
	public function delete_images($filename,$folder,$thumbs=false){
		$this->delete_file($filename,$this->config->document_root.$folder);
		if($thumbs){
			foreach($thumbs as $thumb){
				$this->delete_file($filename,$this->config->document_root.$folder.$thumb->slug."/");
			}
		}
	}
	
}
?>