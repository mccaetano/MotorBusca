<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}
class Pesquisa extends CI_Controller {
	private $preco_imovel = array(
		array('prc_id' => '10000,80000', 'prc_descricao' => '10.000 - 80.000'),
		array('prc_id' => '80000,100000', 'prc_descricao' => '80.000 - 100.000'),
		array('prc_id' => '100000,200000', 'prc_descricao' => '100.000 - 200.000'),
		array('prc_id' => '200000,300000', 'prc_descricao' => '200.000 - 300.000'),
		array('prc_id' => '300000,400000', 'prc_descricao' => '300.000 - 400.000'),
		array('prc_id' => '400000,500000', 'prc_descricao' => '400.000 - 500.000'),
		array('prc_id' => '500000,600000', 'prc_descricao' => '500.000 - 600.000'),
		array('prc_id' => '600000,800000', 'prc_descricao' => '600.000 - 800.000'),
		array('prc_id' => '800000,1000000', 'prc_descricao' => '800.000 - 1.000.000'),
		array('prc_id' => '1000000,10000000', 'prc_descricao' => '1.000.000 - 10.000.000')
	);
	
	private $quarto_imovel = array(
			array('qrt_id' => '1', 'qrt_descricao' => '1 Quarto'),
			array('qrt_id' => '2', 'qrt_descricao' => '2 Quartos'),
			array('qrt_id' => '3', 'qrt_descricao' => '3 Quartos'),
			array('qrt_id' => '4', 'qrt_descricao' => '4 Quartos'),
			array('qrt_id' => '5', 'qrt_descricao' => '5 Quartos')
	);
	
	private $preco_auto = array(
		array('prc_id' => '1000,5000', 'prc_descricao' => '1.000 - 5.000'),
		array('prc_id' => '5000,10000', 'prc_descricao' => '5.000 - 10.000'),
		array('prc_id' => '10000,20000', 'prc_descricao' => '10.000 - 20.000'),
		array('prc_id' => '20000,40000', 'prc_descricao' => '20.000 - 40.000'),
		array('prc_id' => '40000,60000', 'prc_descricao' => '40.000 - 60.000'),
		array('prc_id' => '60000,80000', 'prc_descricao' => '60.000 - 80.000'),
		array('prc_id' => '80000,100000', 'prc_descricao' => '80.000 - 100.000'),
		array('prc_id' => '100000,200000', 'prc_descricao' => '100.000 - 200.000'),
		array('prc_id' => '200000,500000', 'prc_descricao' => '200.000 - 5000.000')
	);
	
	private $novo_auto = array(
		array('nv_id' => '1', 'nvc_descricao' => 'Novo'),
		array('nv_id' => '2', 'nvc_descricao' => 'Usuado'),
	);
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		redirect(base_url());
	}
	
	function sch1() {	
		$this->load->helper(array('form', 'url'));
		
		$url = base_url() . "pesquisa/imovel";
		if ($this->input->post("pag")) {
			$url = $url . "/" . $this->input->post("pag");
		} else {
			$url = $url . "/p1";
		}
		if ($this->input->post("iPesquisa")) {
			$url = $url . "/" . $this->input->post("iPesquisa");
		}
		if ($this->input->post("iContratoTipo")) {
			$this->load->model('pesquisa_tipo_casa');
			$url = $url . "/" . str_replace(" ", "_", $this->pesquisa_tipo_casa->BuscaPorId($this->input->post("iContratoTipo"))[0]->pct_descricao);
		}
		if ($this->input->post("iCasaTipo")) {
			$this->load->model ( "propriedade_tipo" );
			$url = $url . "/" . str_replace(" ", "_", $this->propriedade_tipo->BuscaPorId($this->input->post("iCasaTipo"))[0]->pt_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$url = $url . "/" . str_replace(" ", "_", $this->estado->BuscaPorId($this->input->post("iEstado"))[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$url = $url . "/" . str_replace(" ", "_", $this->cidade->BuscaPorId($this->input->post("iCidade"))[0]->cd_descricao);
		}
		if ($this->input->post("iPreco")) {
			$url = $url . "/" . str_replace(",", "_", $this->input->post("iPreco"));
		}
		if ($this->input->post("iQuarto")) {
			$url = $url . "/" . $this->input->post("iQuarto") . "_Quartos";
		}
		
		$this->session->set_userdata('post_data', $_POST);
		
		redirect($url, 'location');
	}
	
	function sch2() {
		$this->load->helper(array('form', 'url'));
	
		$url = base_url() . "pesquisa/auto";
		if ($this->input->post("pag")) {
			$url = $url . "/" . $this->input->post("pag");
		} else {
			$url = $url . "/p1";
		}
		if ($this->input->post("iPesquisa")) {
			$url = $url . "/" . $this->input->post("iPesquisa");
		}
		if ($this->input->post("iCarroTipo")) {
			$this->load->model('carro_tipo');
			$url = $url . "/" . str_replace(" ", "_", $this->carro_tipo->BuscaPorId($this->input->post("iCarroTipo"))[0]->tpc_descricao);
		}
		if ($this->input->post("iCarroMarca")) {
			$this->load->model ( "carro_marca" );
			$url = $url . "/" . str_replace(" ", "_", $this->carro_marca->BuscaPorId($this->input->post("iCarroMarca"))[0]->cmr_descricao);
		}
		if ($this->input->post("iCarroModelo")) {
			$this->load->model ( "carro_modelo" );
			$url = $url . "/" . str_replace(" ", "_", $this->carro_modelo->BuscaPorId($this->input->post("iCarroModelo"))[0]->cmd_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$url = $url . "/" . str_replace(" ", "_", $this->estado->BuscaPorId($this->input->post("iEstado"))[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$url = $url . "/" . str_replace(" ", "_", $this->cidade->BuscaPorId($this->input->post("iCidade"))[0]->cd_descricao);
		}
		if ($this->input->post("iPreco")) {
			$url = $url . "/" . str_replace(",", "_", $this->input->post("iPreco"));
		}
		if ($this->input->post("iNovo")) {
			$url = $url . "/" . $this->input->post("iNovo");
		}
	
		$this->session->set_userdata('post_data', $_POST);
	
		redirect($url, 'location');
	}
	
	function imovel() {	

		$this->load->helper(array('form', 'url', 'date'));
		
		$_POST = $this->session->userdata('post_data');
		$this->session->unset_userdata('post_data');		
		
		$pg = "p1";
		if ($this->input->post("pag")) {
			$pg = $this->input->post("pag");
		}
		
		$lista_contrato = FALSE;
		$iContratoTipo_descricao = FALSE;
		$this->load->model ( "pesquisa_tipo_casa" );
		if (!$this->input->post("iContratoTipo")) {			
			$lista_contrato = $this->pesquisa_tipo_casa->ListaTodos();
		} else {			
			$iContratoTipo_descricao = $this->pesquisa_tipo_casa->BuscaPorId($this->input->post("iContratoTipo"))[0]->pct_descricao;
		}
		$lista_tipoimovel = FALSE;
		$iCasaTipo_descricao = FALSE;
		$this->load->model ( "propriedade_tipo" );
		if (!$this->input->post("iCasaTipo")) {
			$lista_tipoimovel = $this->propriedade_tipo->ListaTodos();
		} else {
			$iCasaTipo_descricao = $this->propriedade_tipo->BuscaPorId($this->input->post("iCasaTipo"))[0]->pt_descricao;
		}
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->ListaTodos();
		} else {
			$iEstado_descricao = $this->estado->BuscaPorId($this->input->post("iEstado"))[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$iCidade_descricao = $this->cidade->BuscaPorId($this->input->post("iCidade"))[0]->cd_descricao;
		}
		
		$preco_in = FALSE;
		$preco_out = FALSE;			
		$lista_preco = FALSE;
		$iPreco_descricao = FALSE;
		if (!$this->input->post("iPreco")) {
			$lista_preco = $this->preco_imovel;
		} else {
			$precos = explode(",", $this->input->post('iPreco'));
			$preco_in = $precos[0];
			$preco_out = $precos[1];
			for ($i=0; $i<count($this->preco_imovel);$i++) {
				if ($this->input->post("iPreco") == $this->preco_imovel[$i]['prc_id']) {
					$iPreco_descricao = $this->preco_imovel[$i]['prc_descricao'];
					break;
				}
			}
		}
		
		$lista_quarto = FALSE;
		$iQuarto_descricao = FALSE;
		if (!$this->input->post("iQuarto")) {
			$lista_quarto = $this->quarto_imovel;
		} else {
			for ($i=0; $i<count($this->quarto_imovel);$i++) {
				if ($this->input->post("iQuarto") == $this->quarto_imovel[$i]['qrt_id']) {
					$iQuarto_descricao = $this->quarto_imovel[$i]['qrt_descricao'];
					break;
				}
			}
		}
		$iPesquisa = $this->input->post('iPesquisa');
		if ($iPesquisa == '') { $iPesquisa = FALSE; }		
		$this->load->model ( "anuncio_casa" );
		$params = array(
				$iPesquisa === FALSE ? null : "%" . $iPesquisa . "%",
				$this->input->post('iContratoTipo') === FALSE ? null : $this->input->post('iContratoTipo'),
				$this->input->post('iCasaTipo') === FALSE ? null : $this->input->post('iCasaTipo'),
				$this->input->post('iEstado') === FALSE ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') === FALSE ? null : $this->input->post('iCidade'),
				$preco_in === FALSE ? null : $preco_in,
				$preco_out === FALSE ? null : $preco_out,
				$this->input->post('iQuartos') === FALSE ? null : $this->input->post('iQuartos')
		); 
		$pesquisa_resultado = $this->anuncio_casa->AnuncioPesquisa ($params);
		
		$data = array(
				'find' => "sch1",
				'tipo' => "imovel",
				'tipo_descricao' => "Imóvel",
				'pg' => $pg,
				'iPesquisa' => $this->input->post("iPesquisa") == 'null' ? FALSE : $this->input->post("iPesquisa"),
				'iContratoTipo' => $this->input->post("iContratoTipo") == 'null' ? FALSE : $this->input->post("iContratoTipo"),
				'iContratoTipo_descricao' => $iContratoTipo_descricao,
				'iCasaTipo' => $this->input->post("iCasaTipo") == 'null' ? FALSE : $this->input->post("iCasaTipo"),
				'iCasaTipo_descricao' => $iCasaTipo_descricao,
				'iEstado' => $this->input->post("iEstado") == 'null' ? FALSE : $this->input->post("iEstado"),
				'iEstado_descricao' => $iEstado_descricao,
				'iCidade' => $this->input->post("iCidade") == 'null' ? FALSE : $this->input->post("iCidade"),
				'iCidade_descricao' => $iCidade_descricao,
				'iPreco' => $this->input->post("iPreco") == 'null' ? FALSE : $this->input->post("iPreco"),
				'iPreco_descricao' => $iPreco_descricao,
				'iQuarto' => $this->input->post("iQuarto") == 'null' ? FALSE : $this->input->post("iQuarto"),
				'iQuarto_descricao' => $iQuarto_descricao,
				'lista_contrato' => $lista_contrato,
				'lista_tipoimovel' => $lista_tipoimovel,
				'lista_estado' => $lista_estado,
				'lista_cidade' => $lista_cidade,
				'lista_preco' => $lista_preco,
				'lista_quarto' => $lista_quarto,
				'pesquisa_resultado' => $pesquisa_resultado
		);
		
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_imovel_filtro', $data);
		$this->load->view('pesquisa_imovel_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function auto() {
		$this->load->helper(array('form', 'url', 'date'));
		
		$_POST = $this->session->userdata('post_data');
		$this->session->unset_userdata('post_data');
		
		$pg = "p1";
		if ($this->input->post("pag")) {
			$pg = $this->input->post("pag");
		}
		
		$lista_tipocarro = FALSE;
		$iCarroTipo_descricao = FALSE;
		$this->load->model ( "carro_tipo" );
		if (!$this->input->post("iCarroTipo")) {
			$lista_tipocarro = $this->carro_tipo->ListaTodos();
		} else {
			$iContratoTipo_descricao = $this->carro_tipo->BuscaPorId($this->input->post("iCarroTipo"))[0]->pct_descricao;
		}
		
		$lista_marca = FALSE;
		$iCarroMarca_descricao = FALSE;
		$this->load->model ( "carro_marca" );
		if (!$this->input->post("iCarroMarca")) {
			$lista_marca = $this->carro_marca->ListaTodos();
		} else {
			$iContratoTipo_descricao = $this->carro_marca->BuscaPorId($this->input->post("iCarroMarca"))[0]->cmr_descricao;
		}
		
		$lista_modelo = FALSE;
		$iCarroModelo_descricao = FALSE;
		$this->load->model ( "carro_modelo" );
		if (!$this->input->post("iCarroModelo")) {
			$lista_modelo = $this->carro_modelo->ListaTodos();
		} else {
			$iContratoTipo_descricao = $this->carro_modelo->BuscaPorId($this->input->post("iCarroModelo"))[0]->cmd_descricao;
		}
		
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->ListaTodos();
		} else {
			$iEstado_descricao = $this->estado->BuscaPorId($this->input->post("iEstado"))[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$iCidade_descricao = $this->cidade->BuscaPorId($this->input->post("iCidade"))[0]->cd_descricao;
		}
		
		$preco_in = FALSE;
		$preco_out = FALSE;
		$lista_preco = FALSE;
		$iPreco_descricao = FALSE;
		if (!$this->input->post("iPreco")) {
			$lista_preco = $this->preco_auto;
		} else {
			$precos = explode(",", $this->input->post('iPreco'));
			$preco_in = $precos[0];
			$preco_out = $precos[1];
			for ($i=0; $i<count($this->preco_imovel);$i++) {
				if ($this->input->post("iPreco") == $this->preco_imovel[$i]['prc_id']) {
					$iPreco_descricao = $this->preco_imovel[$i]['prc_descricao'];
					break;
				}
			}
		}
		
		$lista_novo = FALSE;
		$iNovo_descricao = FALSE;
		if (!$this->input->post("iNovo")) {
			$lista_novo = $this->novo_auto;
		} else {
			for ($i=0; $i<count($this->novo_auto);$i++) {
				if ($this->input->post("iNovo") == $this->novo_auto[$i]['nv_id']) {
					$iNovo_descricao = $this->novo_auto[$i]['nv_descricao'];
					break;
				}
			}
		}
		
		$iPesquisa = $this->input->post('iPesquisa');
		if ($iPesquisa == '') { $iPesquisa = FALSE; }
		$params = array(
				$this->input->post('iPesquisa') === FALSE ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iCarroTipo') === FALSE ? null : $this->input->post('iCarroTipo'),
				$this->input->post('iCarroMarca') === FALSE ? null : $this->input->post('iCarroMarca'),
				$this->input->post('iCarroModelo') === FALSE ? null : $this->input->post('iCarroModelo'),
				$this->input->post('iEstado') === FALSE ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') === FALSE ? null : $this->input->post('iCidade'),
				$preco_in,
				$preco_out,
				$this->input->post('iNovo') === FALSE ? null : $this->input->post('iNovo')
		);
		$this->load->model ( "anuncio_auto" );
		$pesquisa_resultado = $this->anuncio_auto->AnuncioPesquisa ($params);
		
		$data = array(
				'find' => "sch2",
				'tipo' => "auto",
				'tipo_descricao' => "Carro",
				'pg' => $pg,
				'iPesquisa' => $this->input->post('iPesquisa'),
				'pesquisa_resultado' => $pesquisa_resultado,
				'lista_tipocarro' => $lista_tipocarro,
				'iCarroTipo_descricao' => $iCarroTipo_descricao,
				'iCarroTipo' => $this->input->post('iCarroTipo'),
				'lista_marca' => $lista_marca,
				'iCarroMarca_descricao' => $iCarroMarca_descricao,
				'iCarroMarca' => $this->input->post('iCarroMarca'),
				'lista_modelo' => $lista_modelo,
				'iCarroModelo_descricao' => $iCarroModelo_descricao,
				'iCarroModelo' => $this->input->post('iCarroModelo'),
				'lista_estado' => $lista_estado,
				'iEstado_descricao' => $iEstado_descricao,
				'iEstado' => $this->input->post('iEstado'),
				'lista_cidade' => $lista_cidade,
				'iCidade_descricao' => $iCidade_descricao,
				'iCidade' => $this->input->post('iCidade'),
				'lista_preco' => $lista_preco,
				'iPreco_descricao' => $iPreco_descricao,
				'lista_novo' => $lista_novo,
				'iNovo_descricao' => $iNovo_descricao,
				'iNovo' => $this->input->post('iNovo')
		);
		
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_auto_filtro', $data);
		$this->load->view('pesquisa_auto_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function auto_() {
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
