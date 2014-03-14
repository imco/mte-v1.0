<?php

/**
* Clase programas Extiende main.
* Controlador: host/programas
*/
class programas extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->programa_info();
        $this->load_programas();
		$this->title_header = 'Programas';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Programas');
		$this->subtitle_header = '
			MejoraTuEscuela.org es una plataforma que busca <br />
			promover la participación ciudadana para transformar <br />
			la educación en México.';
		$this->include_theme('index','index');
	}

	private function programa_info(){
		$this->programa = new programa($this->get('id'));
		$this->programa->read("id,nombre,tema,descripcion,zonas,requisitos,direccion,telefono,mail,telefono_contacto,sitio_web,m_collection,tema_especifico");
	        $this->programa->entidad_escuelas_count = $this->get_estado_escuelas_count($this->programa->m_collection);
	}

    public function estado_escuelas(){
        $programa = $this->request('id');
        $estado = $this->request('es');
	   $skip = $this->request('skip')?$this->request('skip'):0;
        if ($estado < 10) $estado = '0'.$estado;
        $ccts = $this->get_estado_escuelascct($programa,$estado,$skip);
        $params = new stdClass();
	if($skip!=0 && !$ccts){
		exit;
	}
        $params->ccts = $ccts;
        $params->limit = 20;
        #$params->order_by = "ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC";
        $params->order_by = "ISNULL(escuelas.rank_entidad), escuelas.nombre ASC";
        $this->get_escuelas($params);
    	$skip +=20;
    	$this->url_more_cct = "id={$programa}&es={$estado}&skip={$skip}";
        $this->include_template("estado_escuelas","programas/partial");
    }

}

?>
