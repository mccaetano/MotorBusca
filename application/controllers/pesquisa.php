<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
class Pesquisa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index() {
		$data = array();
		$this->load->view('templates/header');
		$this->load->view('pesquisa');
		$this->load->view('templates/footer');
	}
	
} 