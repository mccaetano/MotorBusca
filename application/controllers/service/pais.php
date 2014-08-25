<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Pais extends REST_Controller {

	function __construct() {
		parent::__construct();
	}

	function index_get() {
		$this->load->model('pais');
		$pais = $this->pais->ListaTodos();
		
		$this->response($pais, '200');		
	}
}