<?php
class api extends main{
	public function escuelas(){
		$params->limit = "0 ,100";
		$this->get_escuelas($params);
		$this->process_escuelas();
		echo json_encode($this->escuelas_digest->escuelas);
	}

}
?>