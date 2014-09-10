<?php
require APPPATH.'/libraries/threadURL.php';


class Agenda extends CI_Controller {
	
	function feeds() {
		$this->load->helper('url');
		
		$th = new ThreadURL(base_url() . 'admin/feeds/carregaanuncios',3600, TRUE);
		$th::start();
		
	}
	
	
}