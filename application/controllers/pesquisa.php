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
		array('nv_id' => '1', 'nv_descricao' => 'Novo'),
		array('nv_id' => '2', 'nv_descricao' => 'Usuado'),
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
			$url = $url . "/" . str_replace(" ", "_", $this->input->post("iPesquisa"));
		}
		if ($this->input->post("iContratoTipo")) {
			$this->load->model('pesquisa_tipo_casa');
			$tipoimovel =  $this->pesquisa_tipo_casa->BuscaPorId($this->input->post("iContratoTipo"));
			$url = $url . "/" . str_replace(" ", "_", $tipoimovel[0]->pct_descricao);
		}
		if ($this->input->post("iCasaTipo")) {
			$this->load->model ( "propriedade_tipo" );
			$proptipo = $this->propriedade_tipo->BuscaPorId($this->input->post("iCasaTipo"));
			$url = $url . "/" . str_replace(" ", "_", $proptipo[0]->pt_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$url = $url . "/" . str_replace(" ", "_", $estado[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$cidade = $this->estado->BuscaPorId($this->input->post("iCidade"));
			$url = $url . "/" . str_replace(" ", "_", $cidade[0]->cd_descricao);
		}
		if ($this->input->post("iPreco")) {
			for ($i=0; $i<count($this->preco_imovel);$i++) {
				if ($this->input->post("iPreco") == $this->preco_imovel[$i]['prc_id']) {
					$iQuarto_descricao = $this->preco_imovel[$i]['prc_descricao'];
					break;
				}
			}
			$url = $url . "/" . str_replace(",", "_", $this->input->post("iPreco"));
		}
		if ($this->input->post("iQuarto")) {
			for ($i=0; $i<count($this->quarto_imovel);$i++) {
				if ($this->input->post("iQuarto") == $this->quarto_imovel[$i]['qrt_id']) {
					$iQuarto_descricao = $this->quarto_imovel[$i]['qrt_descricao'];
					break;
				}
			}
			$url = $url . "/" . str_replace(" ", "_", $iQuarto_descricao);
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
			$url = $url . "/" . str_replace(" ", "_", $this->input->post("iPesquisa"));
		}
		if ($this->input->post("iCarroTipo")) {
			$this->load->model('carro_tipo');
			$carrotipo = $this->carro_tipo->BuscaPorId($this->input->post("iCarroTipo"));
			$url = $url . "/" . str_replace(" ", "_", $carrotipo[0]->tpc_descricao);
		}
		if ($this->input->post("iCarroMarca")) {
			$this->load->model ( "carro_marca" );
			$carromarca = $this->carro_marca->BuscaPorId($this->input->post("iCarroMarca"));
			$url = $url . "/" . str_replace(" ", "_", $carromarca[0]->cmr_descricao);
		}
		if ($this->input->post("iCarroModelo")) {
			$this->load->model ( "carro_modelo" );
			$carromodelo = $this->carro_modelo->BuscaPorId($this->input->post("iCarroModelo"));
			$url = $url . "/" . str_replace(" ", "_", $carromodelo[0]->cmd_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$url = $url . "/" . str_replace(" ", "_", $estado[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$url = $url . "/" . str_replace(" ", "_", $cidade[0]->cd_descricao);
		}
		if ($this->input->post("iPreco")) {
			for ($i=0; $i<count($this->preco_auto);$i++) {
				if ($this->input->post("iPreco") == $this->preco_auto[$i]['prc_id']) {
					$iPreco_descricao = $this->preco_auto[$i]['prc_descricao'];
					break;
				}
			}
			$url = $url . "/" . str_replace(" ", "_", $iPreco_descricao);
		}
		if ($this->input->post("iNovo")) {
			for ($i=0; $i<count($this->novo_auto);$i++) {
				if ($this->input->post("iNovo") == $this->novo_auto[$i]['nv_id']) {
					$iNovo_descricao = str_replace(" ", "_", $this->novo_auto[$i]['nv_descricao']);
					break;
				}
			}
			$url = $url . "/" . $iNovo_descricao;
		}
	
		$this->session->set_userdata('post_data', $_POST);
	
		redirect($url, 'location');
	}
	
	function sch3() {
		$this->load->helper(array('form', 'url'));
	
		$url = base_url() . "pesquisa/emprego";
		if ($this->input->post("pag")) {
			$url = $url . "/" . $this->input->post("pag");
		} else {
			$url = $url . "/p1";
		}
		if ($this->input->post("iPesquisa")) {
			$url = $url . "/" . str_replace(" ", "_", $this->input->post("iPesquisa"));
		}
		if ($this->input->post("iContrato")) {
			$this->load->model('emprego_contrato');
			$empregocontrato = $this->emprego_contrato->BuscaPorId($this->input->post("iContrato"));
			$url = $url . "/" . str_replace(" ", "_", $empregocontrato[0]->emc_descricao);
		}
		if ($this->input->post("iCategoria")) {
			$this->load->model ( "emprego_categoria" );
			$categoria = $this->emprego_categoria->BuscaPorId($this->input->post("iCategoria"));
			$url = $url . "/" . str_replace(" ", "_", $categoria[0]->ect_descricao);
		}
		if ($this->input->post("iPeriodo")) {
			$this->load->model ( "emprego_periodo" );
			$periodo = $this->emprego_periodo->BuscaPorId($this->input->post("iPeriodo"));
			$url = $url . "/" . str_replace(" ", "_", $periodo[0]->emp_descricao);
		}
		if ($this->input->post("iPais")) {
			$this->load->model('pais');
			$pais = $this->pais->BuscaPorId($this->input->post("iPais"));
			$url = $url . "/" . str_replace(" ", "_", $pais[0]->ps_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$url = $url . "/" . str_replace(" ", "_", $estado[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$cidade =  $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$url = $url . "/" . str_replace(" ", "_", $cidade[0]->cd_descricao);
		}
	
		$this->session->set_userdata('post_data', $_POST);
	
		redirect($url, 'location');
	}
	


	function sch4() {
		$this->load->helper(array('form', 'url'));
	
		$url = base_url() . "pesquisa/produto";
		if ($this->input->post("pag")) {
			$url = $url . "/" . $this->input->post("pag");
		} else {
			$url = $url . "/p1";
		}
		if ($this->input->post("iPesquisa")) {
			$url = $url . "/" . str_replace(" ", "_", $this->input->post("iPesquisa"));
		}
		if ($this->input->post("iCategoria")) {
			$this->load->model ( "produto_categoria" );
			$categoria = $this->produto_categoria->BuscaPorId($this->input->post("iCategoria"));
			$url = $url . "/" . str_replace(" ", "_", $categoria[0]->prc_descricao);
		}
		if ($this->input->post("iMarca")) {
			$this->load->model ( "produto_marca" );
			$produtomarca = $this->produto_marca->BuscaPorId($this->input->post("iMarca"));
			$url = $url . "/" . str_replace(" ", "_", $produtomarca[0]->pmr_descricao);
		}
		if ($this->input->post("iModelo")) {
			$this->load->model ( "produto_modelo" );
			$produtomodelo = $this->produto_modelo->BuscaPorId($this->input->post("iModelo"));
			$url = $url . "/" . str_replace(" ", "_", $produtomodelo[0]->pmd_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$url = $url . "/" . str_replace(" ", "_", $estado[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$url = $url . "/" . str_replace(" ", "_", $cidade[0]->cd_descricao);
		}
	
		$this->session->set_userdata('post_data', $_POST);
	
		redirect($url, 'location');
	}
	
	function sch5() {
		$this->load->helper(array('form', 'url'));
	
		$url = base_url() . "pesquisa/temporada";
		if ($this->input->post("pag")) {
			$url = $url . "/" . $this->input->post("pag");
		} else {
			$url = $url . "/p1";
		}
		if ($this->input->post("iPesquisa")) {
			$url = $url . "/" . str_replace(" ", "_", $this->input->post("iPesquisa"));
		}
		if ($this->input->post("iTipoImovel")) {
			$this->load->model ( "tipo_imovel" );
			$tipoimovel = $this->tipo_imovel->BuscaPorId($this->input->post("iTipoImovel"));
			$url = $url . "/" . str_replace(" ", "_", $tipoimovel[0]->tpi_descricao);
		}
		if ($this->input->post("iPais")) {
			$this->load->model('pais');
			$pais = $this->pais->BuscaPorId($this->input->post("iPais"));
			$url = $url . "/" . str_replace(" ", "_", $pais[0]->ps_descricao);
		}
		if ($this->input->post("iEstado")) {
			$this->load->model('estado');
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$url = $url . "/" . str_replace(" ", "_", $estado[0]->es_descricao);
		}
		if ($this->input->post("iCidade")) {
			$this->load->model('cidade');
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$url = $url . "/" . str_replace(" ", "_", $cidade[0]->cd_descricao);
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
			$cotratotipo = $this->pesquisa_tipo_casa->BuscaPorId($this->input->post("iContratoTipo"));
			$iContratoTipo_descricao = $cotratotipo[0]->pct_descricao;
		}
		$lista_tipoimovel = FALSE;
		$iCasaTipo_descricao = FALSE;
		$this->load->model ( "propriedade_tipo" );
		if (!$this->input->post("iCasaTipo")) {
			$lista_tipoimovel = $this->propriedade_tipo->ListaTodos();
		} else {
			$propriedadetipo = $this->propriedade_tipo->BuscaPorId($this->input->post("iCasaTipo"));
			$iCasaTipo_descricao = $propriedadetipo[0]->pt_descricao;
		}
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->ListaTodos();
		} else {
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$iEstado_descricao = $estado[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$iCidade_descricao = $cidade[0]->cd_descricao;
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
			$carrotipo = $this->carro_tipo->BuscaPorId($this->input->post("iCarroTipo"));
			$iCarroTipo_descricao = $carrotipo[0]->crt_descricao;
		}
		
		$lista_marca = FALSE;
		$iCarroMarca_descricao = FALSE;
		$this->load->model ( "carro_marca" );
		if (!$this->input->post("iCarroMarca")) {
			$lista_marca = $this->carro_marca->ListaTodos();
		} else {
			$carromarca = $this->carro_marca->BuscaPorId($this->input->post("iCarroMarca"));
			$iCarroMarca_descricao = $carromarca[0]->cmr_descricao;
		}
		
		$lista_modelo = FALSE;
		$iCarroModelo_descricao = FALSE;
		$this->load->model ( "carro_modelo" );
		if (!$this->input->post("iCarroModelo")) {
			$lista_modelo = $this->carro_modelo->BuscaPorMarcaId($this->input->post("iCarroMarca"));
		} else {
			$carromodelo = $this->carro_modelo->BuscaPorId($this->input->post("iCarroModelo"));
			$iCarroModelo_descricao = $carromodelo[0]->cmd_descricao;
		}
		
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->ListaTodos();
		} else {
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$iEstado_descricao = $estado[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$iCidade_descricao = $cidade[0]->cd_descricao;
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
			for ($i=0; $i<count($this->preco_auto);$i++) {
				if ($this->input->post("iPreco") == $this->preco_auto[$i]['prc_id']) {
					$iPreco_descricao = $this->preco_auto[$i]['prc_descricao'];
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
				$preco_in === FALSE ? null : $preco_in,
				$preco_out === FALSE ? null : $preco_out,
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
				'iPreco' => $this->input->post('iPreco'),
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
	
	function emprego() {
		$this->load->helper(array('form', 'url', 'date'));
		
		$_POST = $this->session->userdata('post_data');
		$this->session->unset_userdata('post_data');
		
		$pg = "p1";
		if ($this->input->post("pag")) {
			$pg = $this->input->post("pag");
		}
		
		$lista_contrato = FALSE;
		$iContrato_descricao = FALSE;
		$this->load->model ( "emprego_contrato" );
		if (!$this->input->post("iContrato")) {
			$lista_contrato = $this->emprego_contrato->ListaTodos();
		} else {
			$contratotipo = $this->emprego_contrato->BuscaPorId($this->input->post("iContrato"));
			$iContrato_descricao = $contratotipo[0]->emc_descricao;
		}
		
		$lista_categoria = FALSE;
		$iCategoria_descricao = FALSE;
		$this->load->model ( "emprego_categoria" );
		if (!$this->input->post("iCategoria")) {
			$lista_categoria = $this->emprego_categoria->ListaTodos();
		} else {
			$categoria = $this->emprego_categoria->BuscaPorId($this->input->post("iCategoria"));
			$iCategoria_descricao = $categoria[0]->ect_descricao;
		}
		
		$lista_periodo = FALSE;
		$iPeriodo_descricao = FALSE;
		$this->load->model ( "emprego_periodo" );
		if (!$this->input->post("iPeriodo")) {
			$lista_catgoria = $this->emprego_periodo->ListaTodos();
		} else {
			$periodo = $this->emprego_periodo->BuscaPorId($this->input->post("iPeriodo"));
			$lista_periodo = $periodo[0]->emp_descricao;
		}
		
		$lista_pais = FALSE;
		$iPais_descricao = FALSE;
		$this->load->model ( "pais" );
		if (!$this->input->post("iPais")) {
			$lista_pais = $this->pais->ListaTodos();
		} else {
			$pais = $this->pais->BuscaPorId($this->input->post("iPais"));
			$iPais_descricao = $pais[0]->ps_descricao;
		}
		
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->BuscaPorPais($this->input->post("iPais"));
		} else {
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$iEstado_descricao = $estado[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$iCidade_descricao = $cidade[0]->cd_descricao;
		}
		
		$iPesquisa = $this->input->post('iPesquisa');
		if ($iPesquisa == '') { $iPesquisa = FALSE; }
		$params = array(
				$this->input->post('iPesquisa') === FALSE ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iContrato') === FALSE ? null : $this->input->post('iContrato'),
				$this->input->post('iCategoria') === FALSE ? null : $this->input->post('iCategoria'),
				$this->input->post('iPeriodo') === FALSE ? null : $this->input->post('iPeriodo'),
				$this->input->post('iPais') === FALSE ? null : $this->input->post('iPais'),
				$this->input->post('iEstado') === FALSE ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') === FALSE ? null : $this->input->post('iCidade')
		);
		$this->load->model ( "anuncio_emprego" );
		$pesquisa_resultado = $this->anuncio_emprego->AnuncioPesquisa ($params);
		
		$data = array(
				'find' => "sch3",
				'tipo' => "emprego",
				'tipo_descricao' => "Emprego",
				'pg' => $pg,
				'iPesquisa' => $this->input->post('iPesquisa'),
				'pesquisa_resultado' => $pesquisa_resultado,				
				'lista_contrato' => $lista_contrato,
				'iContrato_descricao' => $iContrato_descricao,
				'iContrato' => $this->input->post('iContrato'),				
				'lista_categoria' => $lista_categoria,
				'iCategoria_descricao' => $iCategoria_descricao,
				'iCategoria' => $this->input->post('iCategoria'),
				'lista_periodo' => $lista_periodo,
				'iPeriodo_descricao' => $iPeriodo_descricao,
				'iPeriodo' => $this->input->post('iPeriodo'),
				'lista_pais' => $lista_pais,
				'iPais_descricao' => $iPais_descricao,
				'iPais' => $this->input->post('iPais'),
				'lista_estado' => $lista_estado,
				'iEstado_descricao' => $iEstado_descricao,
				'iEstado' => $this->input->post('iEstado'),
				'lista_cidade' => $lista_cidade,
				'iCidade_descricao' => $iCidade_descricao,
				'iCidade' => $this->input->post('iCidade')
		);
		
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_emprego_filtro', $data);
		$this->load->view('pesquisa_emprego_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}

	function produto() {
		$this->load->helper(array('form', 'url', 'date'));
	
		$_POST = $this->session->userdata('post_data');
		$this->session->unset_userdata('post_data');
	
		$pg = "p1";
		if ($this->input->post("pag")) {
			$pg = $this->input->post("pag");
		}
	
		$lista_categoria = FALSE;
		$iCategoria_descricao = FALSE;
		$this->load->model ( "produto_categoria" );
		if (!$this->input->post("iCategoria")) {
			$lista_categoria = $this->produto_categoria->ListaTodos();
		} else {
			$categoria = $this->produto_categoria->BuscaPorId($this->input->post("iCategoria"));
			$iCategoria_descricao = $categoria[0]->prc_descricao;
		}
		
		$lista_marca = FALSE;
		$iMarca_descricao = FALSE;
		$this->load->model ( "produto_marca" );
		if (!$this->input->post("iMarca")) {
			$lista_marca = $this->produto_marca->ListaTodos();
		} else {
			$marca = $this->produto_marca->BuscaPorId($this->input->post("iMarca"));
			$iMarca_descricao = $marca[0]->pmr_descricao;
		}
		
		$lista_modelo = FALSE;
		$iModelo_descricao = FALSE;
		$this->load->model ( "produto_modelo" );
		if (!$this->input->post("iModelo")) {			 
			$lista_modelo = $this->produto_modelo->BuscaPorMarcaId($this->input->post("iMarca"));
		} else {
			$modelo = $this->produto_modelo->BuscaPorId($this->input->post("iModelo")); 
			$iModelo_descricao = $modelo[0]->pmd_descricao;
		}
	
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->ListaTodos();
		} else {
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$iEstado_descricao = $estado[0]->es_descricao;
		}
	
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$iCidade_descricao = $cidade[0]->cd_descricao;
		}
	
		$iPesquisa = $this->input->post('iPesquisa');
		if ($iPesquisa == '') { $iPesquisa = FALSE; }
		$params = array(
				$this->input->post('iPesquisa') === FALSE ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iCategoria') === FALSE ? null : $this->input->post('iCategoria'),
				$this->input->post('iMarca') === FALSE ? null : $this->input->post('iMarca'),
				$this->input->post('iModelo') === FALSE ? null : $this->input->post('iModelo'),
				$this->input->post('iEstado') === FALSE ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') === FALSE ? null : $this->input->post('iCidade')
		);
		$this->load->model ( "anuncio_produto" );
		$pesquisa_resultado = $this->anuncio_produto->AnuncioPesquisa ($params);
	
		$data = array(
				'find' => "sch4",
				'tipo' => "produto",
				'tipo_descricao' => "Produto",
				'pg' => $pg,
				'iPesquisa' => $this->input->post('iPesquisa'),
				'pesquisa_resultado' => $pesquisa_resultado,
				'lista_categoria' => $lista_categoria,
				'iCategoria_descricao' => $iCategoria_descricao,
				'iCategoria' => $this->input->post('iCategoria'),
				'lista_marca' => $lista_marca,
				'iMarca_descricao' => $iMarca_descricao,
				'iMarca' => $this->input->post('iMarca'),
				'lista_modelo' => $lista_modelo,
				'iModelo_descricao' => $iModelo_descricao,
				'iModelo' => $this->input->post('iModelo'),
				'lista_estado' => $lista_estado,
				'iEstado_descricao' => $iEstado_descricao,
				'iEstado' => $this->input->post('iEstado'),
				'lista_cidade' => $lista_cidade,
				'iCidade_descricao' => $iCidade_descricao,
				'iCidade' => $this->input->post('iCidade')
		);
	
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_produto_filtro', $data);
		$this->load->view('pesquisa_produto_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function temporada() {
		$this->load->helper(array('form', 'url', 'date'));
		
		$_POST = $this->session->userdata('post_data');
		$this->session->unset_userdata('post_data');
		
		$pg = "p1";
		if ($this->input->post("pag")) {
			$pg = $this->input->post("pag");
		}
		
		$lista_tipoimovel = FALSE;
		$iTipoImovel_descricao = FALSE;
		$this->load->model ( "tipo_Imovel" );
		if (!$this->input->post("iTipoImovel")) {
			$lista_tipoimovel = $this->tipo_Imovel->ListaTodos();
		} else {
			$tipoimovel = $this->tipo_Imovel->BuscaPorId($this->input->post("iTipoImovel"));
			$iTipoImovel_descricao = $tipoimovel[0]->tpi_descricao;
		}
		
		$lista_pais = FALSE;
		$iPais_descricao = FALSE;
		$this->load->model ( "pais" );
		if (!$this->input->post("iPais")) {
			$lista_pais = $this->pais->ListaTodos();
		} else {
			$pais = $this->pais->BuscaPorId($this->input->post("iPais"));
			$iPais_descricao = $pais[0]->ps_descricao;
		}
		
		$lista_estado = FALSE;
		$iEstado_descricao = FALSE;
		$this->load->model ( "estado" );
		if (!$this->input->post("iEstado")) {
			$lista_estado = $this->estado->BuscaPorPais($this->input->post("iPais"));
		} else {
			$estado = $this->estado->BuscaPorId($this->input->post("iEstado"));
			$iEstado_descricao = $estado[0]->es_descricao;
		}
		
		$lista_cidade = FALSE;
		$iCidade_descricao = FALSE;
		$this->load->model ( "cidade" );
		if (!$this->input->post("iCidade")) {
			$lista_cidade = $this->cidade->BuscaPorEstado($this->input->post("iEstado"));
		} else {
			$cidade = $this->cidade->BuscaPorId($this->input->post("iCidade"));
			$iCidade_descricao = $cidade[0]->cd_descricao;
		}
		
		$iPesquisa = $this->input->post('iPesquisa');
		if ($iPesquisa == '') { $iPesquisa = FALSE; }
		$params = array(
				$this->input->post('iPesquisa') === FALSE ? null : "%" . $this->input->post('iPesquisa') . "%",
				$this->input->post('iTipoImovel') === FALSE ? null : $this->input->post('iTipoImovel'),
				$this->input->post('iPais') === FALSE ? null : $this->input->post('iPais'),
				$this->input->post('iEstado') === FALSE ? null : $this->input->post('iEstado'),
				$this->input->post('iCidade') === FALSE ? null : $this->input->post('iCidade')
		);
		$this->load->model ( "anuncio_temporada" );
		$pesquisa_resultado = $this->anuncio_temporada->AnuncioPesquisa ($params);
		
		$data = array(
				'find' => "sch3",
				'tipo' => "emprego",
				'tipo_descricao' => "Emprego",
				'pg' => $pg,
				'iPesquisa' => $this->input->post('iPesquisa'),
				'pesquisa_resultado' => $pesquisa_resultado,
				'lista_tipoimovel' => $lista_tipoimovel,
				'iTipoImovel_descricao' => $iTipoImovel_descricao,
				'iTipoImovel' => $this->input->post('iTipoImovel'),
				'iPais_descricao' => $iPais_descricao,
				'iPais' => $this->input->post('iPais'),
				'lista_pais' => $lista_pais,
				'lista_estado' => $lista_estado,
				'iEstado_descricao' => $iEstado_descricao,
				'iEstado' => $this->input->post('iEstado'),
				'lista_cidade' => $lista_cidade,
				'iCidade_descricao' => $iCidade_descricao,
				'iCidade' => $this->input->post('iCidade')
		);
		
		$this->load->view('templates/header', $data);
		$this->load->view('pesquisa_header', $data);
		$this->load->view('pesquisa_search', $data);
		$this->load->view('pesquisa_temporada_filtro', $data);
		$this->load->view('pesquisa_temporada_resultado', $data);
		$this->load->view('pesquisa_footer', $data);
		$this->load->view('templates/footer', $data);
	}
	
} 
