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
		$this->programa->read("id,nombre,tema,descripcion,zonas,requisitos,direccion,telefono,mail,telefono_contacto,sitio_web,m_collection");
        $this->programa->entidad_escuelas_count = $this->get_estado_escuelas_count($this->programa->m_collection);
	}

    /**
     * requiere m_collection seteado
     * setead escuelas y estado_escuelas
     * */
    private function get_estado_escuelas_count($m_collection = false){
        $estado_escuelas = array();

        if (!$m_collection) return $estado_escuelas;
        try {
            $m = $this->mongo_connect();
            $db = $m->selectDB("mte_programas");
            $c = $db->selectCollection($m_collection);//pec,jornada_amplia,siat,censo_2013

            $max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);
            $aux = $max_aux->getNext();
            $max_anio = isset($aux['anio']) ? $aux['anio'] : false ;

            for($i=1;$i<=32;$i++) {
                $aux = $i;
                if ($i < 10) {
                    $aux = '0'.$i;
                }
                if ($max_anio) {
                    $estado_escuelas[$i] = $c->count(array( "anio" => $max_anio , "cct" => array('$regex' => '\A'.$aux.'.*') ));
                } else {
                    $estado_escuelas[$i] = $c->count(array( "cct" => array('$regex' => '\A'.$aux.'.*') ));
                }
            }

            $m->close();
        } catch(Exception $ex) {
            if ($this->debug) {
                var_dump($ex);
                throw $ex;
            }
            return $estado_escuelas;
        }

        return $estado_escuelas;
    }

    private function get_estado_escuelascct($programa,$estado_id,$skip=0){
        $escuelas = array();
        $this->programa = new programa($programa);
        $this->programa->read("id,m_collection");

        if (!$this->programa->m_collection) return $estado_escuelas;
        try {
            $m = $this->mongo_connect();
            $db = $m->selectDB("mte_programas");
            $c = $db->selectCollection($this->programa->m_collection);//pec,jornada_amplia,siat,censo_2013

            $max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);
            $aux = $max_aux->getNext();
            $max_anio = isset($aux['anio']) ? $aux['anio'] : false ;
            if ($max_anio) {
                $escuelasaux = $c->find(array( "anio" => $max_anio , "cct" => array('$regex' => '\A'.$estado_id.'.*') ))->limit(20)->skip($skip);
            } else {
                $escuelasaux = $c->find(array( "cct" => array('$regex' => '\A'.$estado_id.'.*') ))->limit(20)->skip($skip);
            }

            $i = 0;
            while($escuelasaux->hasNext()) {
                $aux = $escuelasaux->getNext();
                $escuelas[$i++] = $aux['cct'];
            }

            $m->close();
        } catch(Exception $ex) {
            if ($this->debug) {
                var_dump($ex);
                throw $ex;
            }
            return $escuelas;
        }
        return $escuelas;
    }

    public function estado_escuelas(){
        $programa = $this->request('id');
        $estado = $this->request('es');
	   $skip = $this->request('skip')?$this->request('skip'):0;
        if ($estado < 10) $estado = '0'.$estado;
        $ccts = $this->get_estado_escuelascct($programa,$estado,$skip);
        $params = new stdClass();
        $params->ccts = $ccts;
        $params->limit = 20;
        $params->order_by = "ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC";
        $this->get_escuelas($params);
    	$skip +=20;
    	$this->url_more_cct = "id={$programa}&es={$estado}&skip={$skip}";
        $this->include_template("estado_escuelas","programas/partial");
    }

}

?>
