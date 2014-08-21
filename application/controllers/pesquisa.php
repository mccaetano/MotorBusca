<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
class Pesquisa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index() {
		redirect(base_url());
	}
	
	function imovel() {
		$data = array(
			'tipo' => 1
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function auto() {
		$data = array(
			'tipo' => 2
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function emprego() {
		$data = array(
			'tipo' => 3
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function produto() {
		$data = array(
			'tipo' => 4
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}


	function temporada() {
		$data = array(
			'tipo' => 5
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
} 