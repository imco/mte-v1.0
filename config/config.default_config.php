<?php
class default_config{
        public function __construct(){
                //system configuration
                $this->site_name =  'comparatuescuela.org';
                $this->theme = 'mtev1';
                $this->default_controler = 'home';
                $this->default_action = 'index';
                $this->blog_address = 'http://blog.mejoratuescuela.org/';
                //Security
                $this->secured = false;

                //Sofware
                $this->document_root = $_SERVER['DOCUMENT_ROOT']."/";
                $this->lang = "en";
                $this->dev_mode = true;
                $this->search_location = false;
                $this->memcache_host = '***REMOVED***';                
                $this->contact_email = 'contacto@mejoratuescuela.org';
                $this->image_email = 'sonny@spaceshiplabs.com';
                $this->image_email = 'ariadna.camargo@imco.org.mx';
                $this->tynt = false;

                //Image Sizes
                $this->icon_sizes = json_decode('[
                        {"width":"50","height":"50","slug":"tiny"},
                        {"width":"156","height":"112","slug":"signs" ,"resize_type":"best fit"}
                ]');
               //MTE
                $this->semaforos = array('Reprobado','De panzazo','Bien','Excelente','No tomá la <br /> prueba <br />ENLACE','Poco confiable','Esta escuela no tomá la prueba ENLACE para todos los años','La prueba ENLACE no esta disponible para este nivel escolar');

                
        }

                
               
}
?>
