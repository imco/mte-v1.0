<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_escuelas();
		$this->include_theme('index','index');
	}
	public function load_escuelas(){
		$niveles = array(12,13,22);
		$this->get_location();
		//$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC';
		$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC';
		$this->nivel_5 = $params->nivel = $niveles[rand(0,2)];
		$params->entidad = $this->user_location->id;
		$params->limit = '0,5';
		$this->get_escuelas($params);
		$this->process_escuelas();
	}

	public function twitter(){
		$params = array('oauth_access_token'=>$this->config->twitter_access_token,
			'oauth_access_token_secret'=>$this->config->twitter_access_token_secret,
			'consumer_key'=>$this->config->twitter_consumer_key,
			'consumer_secret'=>$this->config->twitter_consumer_secret,
			'use_whitelist' => false,
			'base_url' => 'http://api.twitter.com/1.1/'
		);
		$this->add_component("twitter_component",$params);
	        $this->components['twitter_component']->twitterToken('mejoratuescuela',3);
	    }

	protected function get_abreviatura_estado($estado){
    		$estado = strtolower($estado);
		$estados["aguascalientes"] = "Ags";
		$estados["baja california"] = "BC";
		$estados["baja california sur"] = "BCS";
		$estados["campeche"] = "Camp";
		$estados["chiapas"] = "Chis";
		$estados["chihuahua"] = "Chih";
		$estados["coahuila"] = "Coah";
		$estados["colima"] = "Col";
		$estados["distrito federal"] = "DF";
		$estados["durango"] = "Dgo";
		$estados["guanajuato"] = "Gto";
		$estados["guerrero"] = "Gro";
		$estados["hidalgo"] = "Hgo";
		$estados["jalisco"] = "Jal";
		$estados["méxico"] = "Méx";
		$estados["michoacán"] = "Mich";
		$estados["morelos"] = "Mor";
		$estados["nayarit"] = "Nay";
		$estados["nuevo león"] = "NL";
		$estados["oaxaca"] = "Oax";
		$estados["puebla"] = "Pue";
		$estados["querétaro"] = "Qro";
		$estados["quintana roo"] = "QR";
		$estados["san luis potosí"] = "SLP";
		$estados["sinaloa"] = "Sin";
		$estados["sonora"] = "Son";
		$estados["tabasco"] = "Tab";
		$estados["tamaulipas"] = "Tamps";
		$estados["tlaxcala"] = "Tlax";
		$estados["veracruz"] = "Ver";
		$estados["yucatán"] = "Yuc";
		$estados["zacatecas"] = "Zac";
		if(isset($estados[$estado]))
			return $estados[$estado];
		else
			return $estado;
    	
	}

	public function newsletter(){
		$location = "/home/";
		if($this->post('aviso')){
			$correo = $this->post('correo');
			$news = new newsletters();
			$news->create('email_input',array($correo));
			$location = $news->id ? "/home/index?news=true" : "/home/index?news=false";
		}
		$this->send_email(
			$correo,
			'Mejora tu escuela',
			'Registrado correctamente.',
			'contacto@mejoratuescuela.org',
			''
		);	
		header("location: $location");
	}
}
?>
