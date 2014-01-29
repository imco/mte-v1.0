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
            $m = new MongoClient("mongodb://***REMOVED***:***REMOVED***@***REMOVED***:27017/mte_produccion");
            $db = $m->selectDB("mte_programas");
            $c = $db->selectCollection($m_collection);//pec,jornada_amplia,siat,censo_2013

            $max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);
            $aux = $max_aux->getNext();
            $max_anio = $aux['anio'];

            for($i=1;$i<=32;$i++) {
                $aux = $i;
                if ($i < 10) {
                    $aux = '0'.$i;
                }
                $estado_escuelas[$i] = $c->count(array( "anio" => $max_anio , "cct" => array('$regex' => '\A'.$aux.'.*') ));
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

    private function get_estado_escuelascct($programa,$estado_id){
        $escuelas = array();
        $this->programa = new programa($programa);
        $this->programa->read("id,m_collection");

        if (!$this->programa->m_collection) return $estado_escuelas;
        try {
            $m = new MongoClient("mongodb://***REMOVED***:***REMOVED***@***REMOVED***:27017/mte_produccion");
            $db = $m->selectDB("mte_programas");
            $c = $db->selectCollection($this->programa->m_collection);//pec,jornada_amplia,siat,censo_2013

            $max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);
            $aux = $max_aux->getNext();
            $max_anio = $aux['anio'];

            $escuelasaux = $c->find(array( "anio" => $max_anio , "cct" => array('$regex' => '\A'.$estado_id.'.*') ))->limit(20);

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
        $programa = $this->get('id');
        $estado = $this->get('es');
        $ccts = $this->get_estado_escuelascct($programa,$estado);
        $params = new stdClass();
        $params->ccts = $ccts;
        $params->limit = 20;
        $this->get_escuelas($params);
        $this->include_template("estado_escuelas","programas/partial");
    }

}

?>
