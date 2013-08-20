<?php
class widgets extends main{
	public function index(){
		$this->page_title = 'Mejoratuescuela.org widget';	
		$this->include_template('index','widgets');
	}	
	public function reforma(){	
		$this->page_title = 'Mejoratuescuela.org widget';
		$this->include_template('reforma','widgets');
	}
	public function generate(){
		$widget->title = 'Ayuda a transformar tu colegio';
		$widget->text = 'Consulta los resultados de Enlace de las escuelas públicas y privadas del País y aprende cómo puedes ayudar a mejorar la educación de tu centro escolar.';
		$widget->news_title = 'Cabeza de la nota aquí';
		$widget->news_items[0]->title = 'nota';
		$widget->news_items[0]->url = 'http://www.mejoratuescuela.org';
		$code = urlencode(json_encode($widget));
		echo $this->config->http_address.'/widgets/?w='.$code;
	}
}
?>