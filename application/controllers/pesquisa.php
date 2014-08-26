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
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		var_dump($method);
		$this->load->model ( "anuncio_casa" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "pesquisa_tipo_casa" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		$pesquisa_resultado = FALSE;
		$estado_id = 0;
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$preco_in = NULL;
			$preco_out = NULL;
			if ($this->input->post('iPreco') != 'null') {
				$precos = explode(",", $this->input->post('iPreco'));
				$preco_in = $precos[0];
				$preco_out = $precos[1];
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : $this->input->post('iPesquisa'),
				$this->input->post('iContratoTipo') == 'null' ? null : $this->input->post('iContratoTipo'),
				$this->input->post('iCasaTipo') == 'null' ? null : $this->input->post('iCasaTipo'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				$preco_in,
				$preco_out,
				$this->input->post('iQuartos') == 'null' ? null : $this->input->post('iQuartos')
			);
			
			$pesquisa_resultado = $this->anuncio_casa->AnuncioPesquisa ($params);
		}
		
		$tipo_imovel = $this->tipo_imovel->ListaTodos ();
		$pesquisa_tipo_casa = $this->pesquisa_tipo_casa->ListaTodos ();
		$estado = $this->estado->ListaTodos ();
		$cidade = $this->cidade->BuscaPorEstado ($estado_id);
		
		$data = array(
			'tipo' => 1,
			'tipo_descricao' => "Imóvel",
			'tipo_imovel' =>	$tipo_imovel,
			'pesquisa_tipo_casa' =>  $pesquisa_tipo_casa,
			'estado' => $estado,
			'cidade' => $cidade,
			'pesquisa_resultado' => $pesquisa_resultado
		); 
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_imovel_filtro', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_imovel_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function auto() {
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		
		$this->load->model ( "anuncio_auto" );
		$this->load->model ( "carro_tipo" );
		$this->load->model ( "carro_marca" );
		$this->load->model ( "carro_modelo" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		$pesquisa_resultado = FALSE;
		$estado_id = 0;
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$preco_in = NULL;
			$preco_out = NULL;
			if ($this->input->post('iPreco') != 'null') {
				$preco_in = explode(",", $this->input->post('iPreco'))[0];
				$preco_out = explode(",", $this->input->post('iPreco'))[1];
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : $this->input->post('iPesquisa'),
				$this->input->post('iCarroTipo') == 'null' ? null : $this->input->post('iCarroTipo'),
				$this->input->post('iCarroMarca') == 'null' ? null : $this->input->post('iCarroMarca'),
				$this->input->post('iCarroModelo') == 'null' ? null : $this->input->post('iCarroModelo'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				$preco_in,
				$preco_out,
				$this->input->post('iNovo') == 'null' ? null : $this->input->post('iNovo')
			);
			
			$pesquisa_resultado = $this->anuncio_auto->AnuncioPesquisa ($params);
		}
		
		$carro_tipo = $this->carro_tipo->ListaTodos ();
		$carro_marca = $this->carro_marca->ListaTodos ();
		$carro_modelo = $this->carro_modelo->ListaTodos ();
		$estado = $this->estado->ListaTodos ();
		$cidade = $this->cidade->BuscaPorEstado ($estado_id);
		
		$data = array(
			'tipo' => 2,
			'tipo_descricao' => "Auto",
			'carro_tipo' =>	$carro_tipo,
			'carro_marca' =>  $carro_marca,
			'carro_modelo' =>  $carro_modelo,
			'estado' => $estado,
			'cidade' => $cidade,
			'pesquisa_resultado' => $pesquisa_resultado
		); 
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_auto_filtro', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_auto_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
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
