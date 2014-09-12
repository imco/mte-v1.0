<?php

/**
* Clase mejora Extiende main.
* Controlador: host/mejora
*/
class mejora extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->common_mejora();
		$this->include_theme('index','index');
	}

	private function common_mejora(){
		$this->title_header = 'Mejora tu escuela';
		$this->subtitle_header = 'Aquí encontrarás herramientas para que actúes como agente <br />de cambio positivo en tu comunidad educativa. <br />¡Participa e involúcrate!';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Mejora');
		$this->meta_description = "Tú puedes ayudar a tus hijos y su escuela tomando un rol más activo en su educación. En Mejora tu escuela tenemos tips y herramientas para papás y niños que les ayudarán a mejorar su aprendizaje y las condiciones de su escuela. Encontrarás temas como: lectura, bullying y programas de apoyo para las escuelas.";
	}

	public function enviar(){
		$captcha = new Recaptcha($this->config->recaptcha_public_key,$this->config->recaptcha_private_key);
		$this->contact_status = false;
		if($captcha->check_answer($this->config->http_address,
			$this->post('recaptcha_challenge_field'),
			$this->post('recaptcha_response_field'))){
				$this->contact_status = $this->send_email(
					$this->config->contact_email,
					'Correo electronico desde Mejora tu escuela desde sección "mejora": '.$this->post('email'),
					$this->post('mensaje'),
					'system@mejoratuescuela.org',
					'sección mejora' 
				);
			}
		$this->index();
	}

	public function programas(){
		$this->common_mejora();
		$nivel = array('primaria'=>'PR','secundaria'=> 'ES','bachillerato'=> 'BH','Preescolar'=>'JN');
		$filtroF = array();
		$filtro = array();
		$estado = $this->get('estado');
		$niv = $this->get('nivel');
		if($estado || $niv){
			if(is_numeric($estado) || array_key_exists($niv,$nivel)){
			        if ($estado < 10) $estado = '0'.$estado;
			    	for($i=2;$i<16;$i++){
					$p = new programa($i);
					$p->read('id,nombre,m_collection,tema_especifico,federal');
					$regex1 = array('$regex'=> "^$estado");
					$regex2 = array('$regex'=> "^[a-zA-Z0-9]{3}{$nivel[$niv]}");
					$add = true;
					if($niv && !$this->exist_cct_in($p->m_collection,$regex2)){
						$add = false;
					}

				    	if($add && $estado && !$this->exist_cct_in($p->m_collection,$regex1)){
						$add = false;
					}
					if($add){
						if($p->federal){
							$filtroF[] = $p;
						}else{
							$filtro[] = $p;
						}					
					}
				}
			}

		}
		$this->programas_federales = $filtroF;
		$this->programas_osc = $filtro;
		if(!($this->get('nivel') || $this->get('estado') )){
			$this->load_programas();
		}
		$this->include_theme('index','programas');
	}

	private function exist_cct_in($m_collection,$regex){
		try {
			$m = $this->mongo_connect();
			$db = $m->selectDB("mte_programas");
			$c = $db->selectCollection($m_collection);
			$max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);
			$aux = $max_aux->getNext();
			$max_anio = isset($aux['anio']) ? $aux['anio'] : false;
			//$regex = array('$regex'=> "^[a-zA-Z0-9]{3}{$code}");

			if ($max_anio) {
				$find = array( "anio" => $max_anio , "cct" => $regex);
			}else{
				$find = array( "cct" => $regex);
			}
			$escuelasaux = $c->find($find)->limit(1);
			return $escuelasaux->hasNext();
 
		}catch(Exception $ex) {
			if ($this->debug) {
				var_dump($ex);
		                throw $ex;
			}
		    return false;
        	}

	
	}
}
?>
