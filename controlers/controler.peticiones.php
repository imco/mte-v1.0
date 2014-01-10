<?php

/**
* Clase peticiones Extiende main.
* Controlador: host/peticiones
*/
class peticiones extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		$this->read_peticion();
		$this->breadcrumb = array('#'=>'Peticiones');
		$this->header_folder = 'compara';
		$this->title_header = 'Peticiones';
		$this->subtitle_header = 'En esta sección encontrarás peticiones de ciudadanos y de la sociedad civil <br /> para mejorar la educación en México. Entre más personas firmemos, <br /> más fuerza tendrán. ¡Ayúdanos firmando y compartiéndolas con <br />tus familiares y amigos!'; 
		$this->include_theme('index','index');
	}

	/**
	* Funcion Privada read_peticion.
	* Guarda en el atributo 'petition_url' la información de las peticiones procedentes de http://www.change.org/
	*/
	private function read_peticion(){
		/* Guarda en el atributo 'petition_url' la información de las peticiones procedentes de http://www.change.org/  */
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
		//escuela cuautitla
		$this->petition_url = 'http://www.change.org/peticiones/autoridades-educativas-del-gobierno-del-estado-de-m%C3%A9xico-exigimos-saber-como-se-gastan-nuestras-cuotas-en-la-escuela-%C3%A1ngel-maria-garibay-kintana';
		$this->petition_info[] = $change->regresa_info_peticion($this->petition_url);
		$this->petition_url = 'https://www.change.org/es-LA/peticiones/autoridades-educativas-del-gobierno-del-estado-de-campeche-no-nos-abandonen-los-necesitamos';
		$this->petition_info[] = $change->regresa_info_peticion($this->petition_url);

	}

	/**
	* Funcion Publica firmar.
	* Obtiene los datos del formulario de la petición y realiza la firma de este en http://www.change.org
	*/
	public function firmar(){
		/* Obtiene los datos del formulario de la petición y realiza la firma de este en http://www.change.org */
		$petition_url = $this->post('petition_url');
		//$petition_auth_key = '3d123d2998aa55899a372ac09aef99f166e74c854df7ec877497533ee996103b';

		$names = explode(' ',$this->post('nombre'));
		$name = $names[0];
		unset($names[0]);
		$hidden = $this->post('public') ? 'false' : 'true';
		$last_name = isset($names[1]) ? implode(' ',$names) : $name;

		$parameters['source'] = $petition_url;
		$parameters['email'] = $this->post('email');
		$parameters['first_name'] = $name;
		$parameters['last_name'] = $last_name;
		$parameters['city'] = $this->post('ciudad');
		$parameters['postal_code'] = $this->post('cp');
		$parameters['country_code'] = $this->post('pais');
		$parameters['hidden'] = $hidden;
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$petition_auth_key = $change->get_auth_key($petition_url,$petition_url);
		//$petition_auth_key = '91df846373856cf420575fd332dd6b0420a54dbdfad44dd9ac879d67e677cc84';
		$this->sign_result['status'] = $change->suma_firma_peticion($petition_url,$petition_auth_key,$parameters);
		$this->sign_result_number = $this->post('number');
		$this->header_folder = 'escuelas';
		$this->read_peticion();
		$this->include_theme('index','index');

	}

	public function sienlace(){
		$firma = new firma();
		$this->firmas = number_format($firma->count());
		$this->photos = $this->searchPhotos();
		if( $this->get('img') ){
			$this->thephoto = new firma_img($this->get('img'));
			$this->thephoto->read('id,filename');
		}else{
			$this->thephoto = false;
		}
		$this->include_template('sienlace','peticiones');
	}
	public function sign(){
		$firma = new firma();
		$firma->create('nombre,apellido,email,cp,comentario');
		$count = $firma->count();
		echo number_format($count);
	}
	private function searchPhotos(){
		$result = new firma_img();
		$result->search_clause = " activo = '1' ";
		$result->order_by = " rand() ";
		$result = $result->read('id,filename,email,activo');
		return $result;
	}
	public function uphoto(){
		$firma = new firma_img();
		$this->add_component("mxnphp_gallery");
		//var_dump($_POST);
		//var_dump($_FILES);
		$nid = $firma->next_id();
		$image = $this->components['mxnphp_gallery']->save_image( $_FILES['profile_input'] , $nid , "/signs/" , $this->config->icon_sizes );
		$firma->debug = true;
		//var_dump($image);
		if( $image ){
			$firma->create( 'email,filename,activo' , array( $_POST['email'] , $image->filename , '0' ) );
			//echo "<img alt='' src='" . $this->config->document_root . '/signs/signs/'. $image->signs . "' />";
			$extra = "?img=" . $nid;
			if($this->post('email')){
				$subject = 'Nueva Foto SiENLACE';
				$from = 'system@mejoratuescuela.org';
				$from_name = 'Sistema Mejoratuescuela'
				$message = <<<EOD
Alguien ha subido una nueva foto en la petición SiENLACE:
http://www.mejoratuescuela.org/signs/{$image->filename}
Haz clic en el siguiente vinculo para aprobar:
http://www.mejoratuescuela.org/peticiones/aprobar_imagen/{$nid}
Para denegar no es necesario tomar acción.
EOD;
				$this->send_email($this->config->image_email,$subject,$message,$from,$from_name);
				echo $message;
			}
		}else{
			echo false;
			$extra = "";
		}
		
		//header( "location: /peticiones/sienlace" . $extra );
	}

	public function receive_auth_keys(){

	}
}
?>
