<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
class Pesquisa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'date'));
	}
	
	function index() {
		redirect(base_url());
	}
	
	function imovel() {
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "pesquisa_tipo_casa" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		
		$tipo_imovel = $this->tipo_imovel->ListaTodos ();
		$pesquisa_tipo_casa = $this->pesquisa_tipo_casa->ListaTodos ();
		$estado = $this->estado->ListaTodos ();
		$cidade = $this->cidade->ListaTodos ();
		
		$data = array(
			'tipo' => 1,
			'tipo_descricao' => "Imóvel",
			'tipo_imovel' =>	$tipo_imovel,
			'pesquisa_tipo_casa' =>  $pesquisa_tipo_casa,
			'estado' => $estado,
			'cidade' => $cidade
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_imovel', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function auto() {
		$data = array(
			'tipo' => 2,
			'tipo_descricao' => "Auto"
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function emprego() {
		$data = array(
			'tipo' => 3,
			'tipo_descricao' => "Emprego"
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function produto() {
		$data = array(
			'tipo' => 4,
			'tipo_descricao' => "Produto"
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}


	function temporada() {
		$data = array(
			'tipo' => 5,
			'tipo_descricao' => "Temporada"
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa', $data);
		$this->load->view('templates/footer', $data);
	}
	
} 