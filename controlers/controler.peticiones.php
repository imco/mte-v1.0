<?php
class peticiones extends main{
	public function index(){		
		$this->header_folder ='escuelas';
		$this->read_peticion();
		$this->include_theme('index','index');
	}
	private function read_peticion(){
		date_default_timezone_set('America/Mexico_City');
		$this->petition_url = 'http://www.change.org/peticiones/autoridades-educativas-del-gobierno-del-estado-de-m%C3%A9xico-exigimos-saber-como-se-gastan-nuestras-cuotas-en-la-escuela-%C3%A1ngel-maria-garibay-kintana';
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->peticion = $change->regresa_info_peticion($this->petition_url);
	}
	public function firmar(){
		$petition_url = $this->post('petition_url');
		$petition_auth_key = '3d123d2998aa55899a372ac09aef99f166e74c854df7ec877497533ee996103b';

		$names = explode(' ',$this->post('nombre'));
		$name = $names[0];
		unset($names[0]);
		$hidden = $this->post('public') ? 'false' : 'true';
		$last_name = isset($names[1]) ? implode(' ',$names) : '';

		$parameters['source'] = 'www.mejoratuescuela.org/peticiones';
		$parameters['email'] = $this->post('email');
		$parameters['first_name'] = $name;
		$parameters['last_name'] = $last_name;
		$parameters['city'] = $this->post('ciudad');
		$parameters['postal_code'] = $this->post('cp');
		$parameters['country_code'] = $this->post('pais');
		$parameters['hidden'] = $hidden;
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->sign_result = $change->suma_firma_peticion($petition_url,$petition_auth_key,$parameters);
		

		$this->header_folder = 'escuelas';
		$this->read_peticion();
		$this->include_theme('index','index');

	}
}
?>