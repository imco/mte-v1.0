<?php
class home extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_escuelas();
		$this->get_metadata();
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
	    $this->components['twitter_component']->twitterToken('mejoratuescuela',10,'mejoratuescuela');
	   }

	protected function get_abreviatura_estado($estado){
    		$estado = strtolower($estado);
		$estados["aguascalientes"] = "Ags.";
		$estados["baja california"] = "B.C.";
		$estados["baja california sur"] = "B.C.S.";
		$estados["campeche"] = "Camp.";
		$estados["chiapas"] = "Chis.";
		$estados["chihuahua"] = "Chih.";
		$estados["coahuila"] =  "Coah.";
		$estados["colima"] = "Col.";
		$estados["distrito federal"] = 	"D.F.";
		$estados["durango"] = "Dgo.";
		$estados["guanajuato"] = "Gto.";
		$estados["guerrero"] = "Gro.";
		$estados["hidalgo"] = "Hgo.";
		$estados["jalisco"] = "Jal.";
		$estados["méxico"] = "Méx.";
		$estados["michoacán"] = "Mich.";
		$estados["morelos"] = "Mor.";
		$estados["nayarit"] = "Nay.";
		$estados["nuevo león"] ="N.L.";
		$estados["oaxaca"] = "Oax.";
		$estados["puebla"] = "Pue.";
		$estados["querétaro"] = "Qro.";
		$estados["quintana roo"] = "Q. Roo.";
		$estados["san luis potosí"] = 	"S.L.P";
		$estados["sinaloa"] = "Sin.";
		$estados["sonora"] = "Son.";
		$estados["tabasco"] = "Tab.";
		$estados["tamaulipas"] = "Tamps.";
		$estados["tlaxcala"] = "Tlax.";
		$estados["veracruz"] = "Ver.";
		$estados["yucatán"] = "Yuc.";
		$estados["zacatecas"] = "Zac.";
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
			'Ha sido registrado correctamente en http://www.mejoratuescuela.org',
			'contacto@mejoratuescuela.org',
			'www.mejoratuescuela.org'
		);
		
		//include_once $_SERVER['DOCUMENT_ROOT'].'/library/SendGrid_loader.php';

		//$sendgrid = new SendGrid('***REMOVED***', '***REMOVED***');
		//var_dump($_SERVER['DOCUMENT_ROOT'].'/library/SendGrid_loader.php', $sendgrid);exit;
		//exit;
		header("location: $location");
	}

	public function get_metadata(){
		$this->meta_description = "Encuentra las mejores primarias, secundarias y bachilleratos públicos y privados en tu zona, según la prueba ENLACE 2013. Consulta la calificación de tu escuela en la prueba ENLACE de español y matemáticas.";
	}
}
?>
