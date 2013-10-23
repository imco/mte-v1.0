<?php
class peticiones extends main{
	/* Controlador: host/peticiones/*
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->read_peticion();
		$this->breadcrumb = array('#'=>'Peticiones');
		$this->header_folder = 'compara';
		$this->title_header = 'Peticiones';
		$this->subtitle_header = 'En esta sección encontrarás peticiones de ciudadanos y de la sociedad civil <br /> para mejorar la educación en México. Entre más personas firmemos, <br /> más fuerza tendrán. ¡Ayúdanos firmando y compartiéndolas con <br />tus familiares y amigos!'; 
		$this->include_theme('index','index');
	}
	private function read_peticion(){
		/* Guarda en el atributo 'petition_url' la información de las peticiones procedentes de http://www.change.org/  */
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
		//escuela cuautitla
		$this->petition_url = 'http://www.change.org/peticiones/autoridades-educativas-del-gobierno-del-estado-de-m%C3%A9xico-exigimos-saber-como-se-gastan-nuestras-cuotas-en-la-escuela-%C3%A1ngel-maria-garibay-kintana';
		$this->petition_info[] = $change->regresa_info_peticion($this->petition_url);

	}
	public function firmar(){
		/* Obtiene los datos del formulario de la petición y realiza la firma de este en http://www.change.org */
		$petition_url = $this->post('petition_url');
		$petition_auth_keys = array();
		$petition_auth_keys[] = 'uno';
		$petition_auth_keys[] = 'dos';
		$petition_auth_keys[] = 'tres';
		$petition_auth_key = $petition_auth_keys[$this->post('number')-1];

		//$petition_auth_key = '3d123d2998aa55899a372ac09aef99f166e74c854df7ec877497533ee996103b';

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
