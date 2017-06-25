<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Probando_helper_url extends CI_Controller {
   
   ///////////////////////////////////////////////////////////////////////////
   //Constructor
	public function __construct() {
		
		parent::__construct();
    $this->load->helper('url');

		
	}
 
///////////////////////////////////////////////////////////////////////////
//método index, función por defecto del controlador
function index(){
 
   $this->load->view('lol');
 
}

   ///////////////////////////////////////////////////////////////////////////
   //funcion muestra_base_url, para mostrar la URL principal de esta aplicación web
   function muestra_base_url(){
 
	$prefs =  array (
               'show_next_prev'  => TRUE,
               'next_prev_url'   => base_url() .'probando_helper_url/muestra_base_url'
             );
	
	echo base_url();
	echo  site_url('probando_helper_url/muestra_base_url');
	
	$this->load->library('calendar', $prefs);

	echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));	
    
	$this->load->view('lol2'); 
   }
   
   ///////////////////////////////////////////////////////////////////////////
   //funcion muestra_url_actual, para mostrar la URL actual de esta página
   function muestra_url_actual(){
      //escribo desde el controlador, aunque debería hacerlo desde la vista
      echo current_url();
      
      //un enlace para volver
      echo '<p><a href="' . site_url('probando_helper_url') . '">Volver</a></p>';
   }
}