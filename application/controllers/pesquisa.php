<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
class Pesquisa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'date'));
	}
	
	function index() {
		redirect(base_url());
	}
	
	function find() {
		$url = base_url() . "pesquisa/" . $this->input->post('btnPesquisa') . "/";
		$url = $url . "p1/" . $this->input->post('iPesquisa');
		
		redirect($url, 'location');
	}
	
	function imovel() {
		$pg = 1;
		if (!$this->uri->segment(3)) {
			$pg = substr($this->uri->segment(3), 1);					
		}
		$iPesquisa = $this->uri->segment(4);
		$iContratoTipo = $this->uri->segment(5);
		$iCasaTipo = $this->uri->segment(6);
		$iEstado = $this->uri->segment(7);
		$iCidade = $this->uri->segment(8);
		
		$data = array(
				'tipo' => "imovel",
				'tipo_descricao' => "Imóvel",
				'pg' => $pg,
				'iPeqsuisa' => $iPesquisa,
				'iContratoTipo' => $iContratoTipo,
				'iCasaTipo' => $iCasaTipo,
				'iEstado' => $iEstado,
				'iCidade' => $iCidade
		);
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
	}
	
	function imovel_($pg = 0) {
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		
		$this->load->model ( "anuncio_casa" );
		$this->load->model ( "propriedade_tipo" );
		$this->load->model ( "pesquisa_tipo_casa" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		$pesquisa_resultado = FALSE;
		$pesquisa_destaque = FALSE;
		$estado_id = 0;
		$url = base_url() . "pesquisa/imovel/" . $pg;
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$preco_in = NULL;
			$preco_out = NULL;
			if ($this->input->post('iPreco') != 'null') {
				$precos = explode(",", $this->input->post('iPreco'));
				$preco_in = $precos[0];
				$preco_out = $precos[1];
			}
			if ($this->input->post('iPesquisa') != 'null') {
				$url = $url . "/" . $this->input->post('iPesquisa');
			}
			if ($this->input->post('iContratoTipo') != 'null') {
				$url = $url . "/" . $this->input->post('iContratoTipo');
			}
			if ($this->input->post('iCasaTipo') != 'null') {
				$url = $url . "/" . $this->input->post('iCasaTipo');
			}
			if ($this->input->post('iEstado') != 'null') {
				$url = $url . "/" . $this->input->post('iEstado');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iContratoTipo') == 'null' ? null : $this->input->post('iContratoTipo'),
				$this->input->post('iCasaTipo') == 'null' ? null : $this->input->post('iCasaTipo'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				$preco_in,
				$preco_out,
				$this->input->post('iQuartos') == 'null' ? null : $this->input->post('iQuartos'),
				TRUE
			);
			$pesquisa_destaque = $this->anuncio_casa->AnuncioPesquisa ($params);
			$params[8] = FALSE;
			$pesquisa_resultado = $this->anuncio_casa->AnuncioPesquisa ($params);
		}
		
		$tipo_imovel = $this->propriedade_tipo->ListaTodos ();
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
			'pesquisa_resultado' => $pesquisa_resultado,
			'pesquisa_destaque' => $pesquisa_destaque,
			'url' => $url,
			'pg' => $pg
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
		$pesquisa_destaque = FALSE;
		$estado_id = 0;
		$url = base_url() . "pesquisa/auto/";
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$preco_in = NULL;
			$preco_out = NULL;
			if ($this->input->post('iPreco') != 'null') {
				$precos = explode(",", $this->input->post('iPreco'));
				$preco_in = $precos[0];
				$preco_out = $precos[1];
			}
			$url = $url . urlencode($this->input->post('iPesquisa'));
			if ($this->input->post('iCarroTipo') != 'null') {
				$url = $url . "/" . $this->input->post('iCarroTipo');
			}
			if ($this->input->post('iCarroMarca') != 'null') {
				$url = $url . "/" . $this->input->post('iCarroMarca');
			}
			if ($this->input->post('iCarroModelo') != 'null') {
				$url = $url . "/" . $this->input->post('iCarroModelo');
			}
			if ($this->input->post('iEstado') != 'null') {
				$url = $url . "/" . $this->input->post('iEstado');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iCarroTipo') == 'null' ? null : $this->input->post('iCarroTipo'),
				$this->input->post('iCarroMarca') == 'null' ? null : $this->input->post('iCarroMarca'),
				$this->input->post('iCarroModelo') == 'null' ? null : $this->input->post('iCarroModelo'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				$preco_in,
				$preco_out,
				$this->input->post('iNovo') == 'null' ? null : $this->input->post('iNovo'),
				TRUE	
			);
			$pesquisa_destaque = $this->anuncio_auto->AnuncioPesquisa ($params);
			$params[8] = FALSE;
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
			'pesquisa_resultado' => $pesquisa_resultado,
			'pesquisa_destaque' => $pesquisa_destaque,
			'url' => $url
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
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		
		$this->load->model ( "anuncio_emprego" );
		$this->load->model ( "emprego_contrato" );
		$this->load->model ( "emprego_categoria" );
		$this->load->model ( "emprego_periodo" );
		$this->load->model ( "pais" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		$pesquisa_resultado = FALSE;
		$pesquisa_destaque = FALSE;
		$estado_id = 0;
		$url = base_url() . "pesquisa/emprego/";
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$url = $url . urlencode($this->input->post('iPesquisa'));
			if ($this->input->post('iContrato') != 'null') {
				$url = $url . "/" . $this->input->post('iContrato');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			if ($this->input->post('iCategira') != 'null') {
				$url = $url . "/" . $this->input->post('iCategira');
			}
			if ($this->input->post('iPeriodo') != 'null') {
				$url = $url . "/" . $this->input->post('iPeriodo');
			}
			if ($this->input->post('iPais') != 'null') {
				$url = $url . "/" . $this->input->post('iPais');
			}
			if ($this->input->post('iEstado') != 'null') {
				$url = $url . "/" . $this->input->post('iEstado');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iContrato') == 'null' ? null : $this->input->post('iContrato'),
				$this->input->post('iCategira') == 'null' ? null : $this->input->post('iCategira'),
				$this->input->post('iPeriodo') == 'null' ? null : $this->input->post('iPeriodo'),
				$this->input->post('iPais') == 'null' ? null : $this->input->post('iPais'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				TRUE
			);
			$pesquisa_destaque = $this->anuncio_emprego->AnuncioPesquisa ($params);
			$params[7] = FALSE;
			$pesquisa_resultado = $this->anuncio_emprego->AnuncioPesquisa ($params);
		}
		
		$emprego_contrato = $this->emprego_contrato->ListaTodos ();
		$emprego_categoria = $this->emprego_categoria->ListaTodos ();
		$emprego_periodo = $this->emprego_periodo->ListaTodos ();
		$pais = $this->pais->ListaTodos ();
		$estado = $this->estado->ListaTodos ();
		$cidade = $this->cidade->BuscaPorEstado ($estado_id);
		
		$data = array(
			'tipo' => 3,
			'tipo_descricao' => "Emprego",
			'emprego_contrato' =>	$emprego_contrato,
			'emprego_categoria' =>  $emprego_categoria,
			'emprego_periodo' =>  $emprego_periodo,
			'pais' => $pais,
			'estado' => $estado,
			'cidade' => $cidade,
			'pesquisa_resultado' => $pesquisa_resultado,
			'pesquisa_destaque' => $pesquisa_destaque,
			'url' => $url
		); 
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_emprego_filtro', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_emprego_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function produto() {
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		
		$this->load->model ( "anuncio_produto" );
		$this->load->model ( "produto_categoria" );
		$this->load->model ( "produto_marca" );
		$this->load->model ( "produto_modelo" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );

		$pesquisa_resultado = FALSE;
		$pesquisa_destaque = FALSE;
		$estado_id = 0;
		$url = base_url() . "pesquisa/produto/";
		if ($method == "POST") {
			$estado_id = $this->input->post('iEstado');
			$url = $url . urlencode($this->input->post('iPesquisa'));
			if ($this->input->post('iCategoria') != 'null') {
				$url = $url . "/" . $this->input->post('iCategoria');
			}
			if ($this->input->post('iMarca') != 'null') {
				$url = $url . "/" . $this->input->post('iMarca');
			}
			if ($this->input->post('iModelo') != 'null') {
				$url = $url . "/" . $this->input->post('iModelo');
			}
			if ($this->input->post('iEstado') != 'null') {
				$url = $url . "/" . $this->input->post('iEstado');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iCategoria') == 'null' ? null : $this->input->post('iCategoria'),
				$this->input->post('iMarca') == 'null' ? null : $this->input->post('iMarca'),
				$this->input->post('iModelo') == 'null' ? null : $this->input->post('iModelo'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				TRUE
			);
			$pesquisa_destaque = $this->anuncio_produto->AnuncioPesquisa ($params);
			$params[6] = FALSE;
			$pesquisa_resultado = $this->anuncio_produto->AnuncioPesquisa ($params);
		}
		
		$produto_categoria = $this->produto_categoria->ListaTodos ();
		$produto_marca = $this->produto_marca->ListaTodos ();
		$produto_modelo = $this->produto_modelo->ListaTodos ();
		$estado = $this->estado->ListaTodos ();
		$cidade = $this->cidade->BuscaPorEstado ($estado_id);
		
		$data = array(
			'tipo' => 4,
			'tipo_descricao' => "Produto",
			'produto_categoria' =>	$produto_categoria,
			'produto_marca' =>  $produto_marca,
			'produto_modelo' =>  $produto_modelo,
			'estado' => $estado,
			'cidade' => $cidade,
			'pesquisa_resultado' => $pesquisa_resultado,
			'pesquisa_destaque' => $pesquisa_destaque,
			'url' => $url
		); 
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_produto_filtro', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_produto_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}


	function temporada() {
		$method =  (string)$_SERVER["REQUEST_METHOD"];
		
		$this->load->model ( "anuncio_temporada" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "pais" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );
		
		$pesquisa_resultado = FALSE;
		$pesquisa_destaque = FALSE;
		$pais_id = 1;
		$url = base_url() . "pesquisa/temporada/";
		$estado_id = FALSE;
		if ($method == "POST") {
			$pais_id = $this->input->post('iPais');
			$estado_id = $this->input->post('iEstado');
			$url = $url . urlencode($this->input->post('iPesquisa'));
			if ($this->input->post('iTipoImovel') != 'null') {
				$url = $url . "/" . $this->input->post('iTipoImovel');
			}
			if ($this->input->post('iPais') != 'null') {
				$url = $url . "/" . $this->input->post('iPais');
			}
			if ($this->input->post('iEstado') != 'null') {
				$url = $url . "/" . $this->input->post('iEstado');
			}
			if ($this->input->post('iCidade') != 'null') {
				$url = $url . "/" . $this->input->post('iCidade');
			}
			$params = array(
				$this->input->post('iPesquisa') == 'null' ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iTipoImovel') == 'null' ? null : $this->input->post('iTipoImovel'),
				$this->input->post('iPais') == 'null' ? null : $this->input->post('iPais'),
				$this->input->post('iEstado') == 'null' ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') == 'null' ? null : $this->input->post('iCidade'),
				TRUE
			);
			
			$pesquisa_destaque = $this->anuncio_temporada->AnuncioPesquisa ($params);
			$params[5] = FALSE;
			$pesquisa_resultado = $this->anuncio_temporada->AnuncioPesquisa ($params);
		}
		
		$tipo_imovel = $this->tipo_imovel->ListaTodos ();
		$pais = $this->pais->ListaTodos ();
		$estado = $this->estado->BuscaPorPais ($pais_id);
		if (!$estado_id) { $estado_id = $estado[0]->es_id; }
		$cidade = $this->cidade->BuscaPorEstado ($estado_id);
		
		$data = array(
			'tipo' => 5,
			'tipo_descricao' => "Temporada",
			'tipo_imovel' =>	$tipo_imovel,
			'pais' =>  $pais,
			'estado' => $estado,
			'cidade' => $cidade,
			'pesquisa_resultado' => $pesquisa_resultado,
			'pesquisa_destaque' => $pesquisa_destaque,
			'url' => $url
		); 
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_temporada_filtro', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_temporada_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
} 
