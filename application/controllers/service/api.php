<?php
require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {

	function pais_get() {
		$this->load->model('pais');
		$pais = $this->pais->ListaTodos();
		
		$this->response($pais, '200');		
	}
}