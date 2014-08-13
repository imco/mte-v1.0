<?php

/**
* Clase widgets Extiende main.
* Controlador: host/widget
* Se encarga de mostrar elementos que pueden ser embebidos en otras paginas
*/
class widgets extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->page_title = 'Mejoratuescuela.org widget';	
		$this->include_template('index','widgets');
	}	

	/**
	* Funcion Publica reforma.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas
	*/
	public function reforma(){
		$this->page_title = 'Mejoratuescuela.org widget';
		$this->include_template('reforma','widgets');
	}

	/**
	* Funcion Publica generate.
	* Genera y imprime la url para acceder al widget que se encuentra en el 'index'
	*/
	/*
	public function generate(){
		$widget->title = 'Ayuda a transformar tu colegio';
		$widget->text = 'Consulta los resultados de Enlace de las escuelas públicas y privadas del País y aprende cómo puedes ayudar a mejorar la educación de tu centro escolar.';
		$widget->news_title = 'Cabeza de la nota aquí';
		$widget->news_items[0]->title = 'nota';
		$widget->news_items[0]->url = 'http://www.mejoratuescuela.org';
		$code = urlencode(json_encode($widget));
		echo $this->config->http_address.'/widgets/?w='.$code;
	}*/

	public function escuelas(){
		$this->page_title = 'Mejoratuescuela.org widget';
		$this->escuela = new escuela($this->get('id'));
		#$this->escuela->debug = true;
		$names = array(12=>'numero_escuelas_primaria',13=>'numero_escuelas_secundaria',22=>'numero_escuelas_bachillerato');
		$this->escuela->key = 'cct';
		$this->escuela->fields['cct'] = $this->get('id');
		$this->escuela->read("cct,nombre,localidad=>nombre,nivel=>nombre,nivel=>id,sostenimiento=>nombre,rank_entidad,id,entidad=>nombre,control=>nombre,entidad=>numero_escuelas_primaria,entidad=>numero_escuelas_secundaria,entidad=>numero_escuelas_bachillerato");
		$this->escuela->entidad_total = $this->escuela->entidad->$names[$this->escuela->nivel->id];

		$this->layout = 'normal';
		$this->include_template('escuelas','widgets');
	}

	public function escuelas_small(){
		$this->page_title = 'Mejoratuescuela.org widget';
		$this->escuela = new escuela($this->get('id'));
		#$this->escuela->debug = true;
		$names = array(12=>'numero_escuelas_primaria',13=>'numero_escuelas_secundaria',22=>'numero_escuelas_bachillerato');
		$this->escuela->key = 'cct';
		$this->escuela->fields['cct'] = $this->get('id');
		$this->escuela->read("cct,nombre,localidad=>nombre,nivel=>nombre,nivel=>id,sostenimiento=>nombre,rank_entidad,id,entidad=>nombre,control=>nombre,entidad=>numero_escuelas_primaria,entidad=>numero_escuelas_secundaria,entidad=>numero_escuelas_bachillerato");
		$this->escuela->entidad_total = $this->escuela->entidad->$names[$this->escuela->nivel->id];

		$this->layout = 'small';
		$this->include_template('escuelas','widgets');
	}

	public function cinepolis(){
		$this->include_template('cinepolis','widgets');
	}
}
?>	
