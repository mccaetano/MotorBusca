<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Alerta extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->lang->load("home", "portuguese");
    }
    
    
    function cadastro($tipoalerta = "1") {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->library('auth');
    	 
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/cadastro"));
    	}
    	 
    	// get current user id
    	$id = $this->auth->userid();
    	 
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	if ($method == "POST" && $this->input->post('btnGravar') == 'ok') {    	
			
    		
    		redirect("alerta/lista");	
    	}
    	
    	$this->load->model ( "tipo_anuncio" );
    	$this->load->model ( "propriedade_tipo" );
		$this->load->model ( "pesquisa_tipo_casa" );
		$this->load->model ( "carro_tipo" );
		$this->load->model ( "carro_marca" );
		$this->load->model ( "carro_modelo" );
		$this->load->model ( "anuncio_emprego" );
		$this->load->model ( "emprego_contrato" );
		$this->load->model ( "emprego_categoria" );
		$this->load->model ( "emprego_periodo" );
		$this->load->model ( "anuncio_produto" );
		$this->load->model ( "produto_categoria" );
		$this->load->model ( "produto_marca" );
		$this->load->model ( "produto_modelo" );
		$this->load->model ( "anuncio_temporada" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "alerta_periodo" );
		$this->load->model ( "pais" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );
		
		$ps_id = "1";
		$es_id = null;
		if ($tipoalerta == "1" || $tipoalerta == "2" || $tipoalerta == "4") { $ps_id = "1";}
		if ($tipoalerta == "3") { $ps_id = $this->input->post('iEmpregoPais') == null ? "1" : $ps_id = $this->input->post('iEmpregoPais'); }
		if ($tipoalerta == "5") { $ps_id = $this->input->post('iTemporadaPais') == null ? "1" : $ps_id = $this->input->post('iTemporadaPais'); }
		
    	if ($tipoalerta == "1") { $es_id = $this->input->post('iImovelEstado'); }
    	if ($tipoalerta == "2") { $es_id = $this->input->post('iCarroEstado'); }
    	if ($tipoalerta == "3") { $es_id = $this->input->post('iEmpregoEstado'); }
    	if ($tipoalerta == "4") { $es_id = $this->input->post('iProdutoEstado'); }
    	if ($tipoalerta == "5") { $es_id = $this->input->post('iTemporadaEstado'); }
		
		
		$tipo_anuncio = $this->tipo_anuncio->ListaTodos ();
    	$propriedade_tipo = $this->propriedade_tipo->ListaTodos ();
		$pesquisa_tipo_casa = $this->pesquisa_tipo_casa->ListaTodos ();
		$carro_tipo = $this->carro_tipo->ListaTodos ();
    	$carro_marca = $this->carro_marca->ListaTodos ();
    	$carro_modelo = $this->carro_modelo->BuscaPorMarcaId ($this->input->post("iCarroMarca"));
    	$emprego_contrato = $this->emprego_contrato->ListaTodos ();
    	$emprego_categoria = $this->emprego_categoria->ListaTodos ();
    	$emprego_periodo = $this->emprego_periodo->ListaTodos ();
    	$produto_categoria = $this->produto_categoria->ListaTodos ();
    	$produto_marca = $this->produto_marca->ListaTodos ();
    	$produto_modelo = $this->produto_modelo->ListaTodos ();
    	$tipo_imovel = $this->tipo_imovel->ListaTodos ();
    	$periodos = $this->alerta_periodo->ListaTodos ();
    	$pais = $this->pais->ListaTodos();
    	$estado = $this->estado->BuscaPorPais($ps_id);
    	$cidade = $this->cidade->BuscaPorEstado($es_id);
    	
    	$imovel_preco = array(
    		array(
    			"prc_id" => "10000,80000",
    			"prc_descricao" => "10.000 - 80.000"
    		),
    		array(
    			"prc_id" => "80000,100000",
    			"prc_descricao" => "80.000 - 100.000"
    		),
    		array(
    			"prc_id" => "100000,200000",
    			"prc_descricao" => "100.000 - 200.000"
    		),
    		array(
    			"prc_id" => "200000,300000",
    			"prc_descricao" => "200.000 - 300.000"
    		),
    		array(
    			"prc_id" => "300000,400000",
    			"prc_descricao" => "300.000 - 400.000"
    		),
    		array(
    			"prc_id" => "400000,500000",
    			"prc_descricao" => "400.000 - 500.000"
    		),
    		array(
    			"prc_id" => "500000,600000",
    			"prc_descricao" => "500.000 - 600.000"
    		),
    		array(
    			"prc_id" => "600000,700000",
    			"prc_descricao" => "600.000 - 700.000"
    		),
    		array(
    			"prc_id" => "700000,800000",
    			"prc_descricao" => "700.000 - 800.000"
    		),
    		array(
    			"prc_id" => "800000,900000",
    			"prc_descricao" => "800.000 - 900.000"
    		),
    		array(
    			"prc_id" => "100000,1000000",
    			"prc_descricao" => "900.000 - 1.000.000"
    		)
    	);
    	
    	$carro_preco = array(
    			array(
    					"prc_id" => "10000,80000",
    					"prc_descricao" => "10.000 - 80.000"
    			),
    			array(
    					"prc_id" => "80000,100000",
    					"prc_descricao" => "80.000 - 100.000"
    			),
    			array(
    					"prc_id" => "100000,200000",
    					"prc_descricao" => "100.000 - 200.000"
    			),
    			array(
    					"prc_id" => "200000,300000",
    					"prc_descricao" => "200.000 - 300.000"
    			),
    			array(
    					"prc_id" => "300000,400000",
    					"prc_descricao" => "300.000 - 400.000"
    			),
    			array(
    					"prc_id" => "400000,500000",
    					"prc_descricao" => "400.000 - 500.000"
    			),
    			array(
    					"prc_id" => "500000,600000",
    					"prc_descricao" => "500.000 - 600.000"
    			),
    			array(
    					"prc_id" => "600000,700000",
    					"prc_descricao" => "600.000 - 700.000"
    			),
    			array(
    					"prc_id" => "700000,800000",
    					"prc_descricao" => "700.000 - 800.000"
    			),
    			array(
    					"prc_id" => "800000,900000",
    					"prc_descricao" => "800.000 - 900.000"
    			),
    			array(
    					"prc_id" => "100000,1000000",
    					"prc_descricao" => "900.000 - 1.000.000"
    			)
    	);
    	
    	$carro_0km = array(
    			array(
    					"ckm_id" => "1",
    					"ckm_descricao" => "Usado"
    			),
    			array(
    					"ckm_id" => "2",
    					"ckm_descricao" => "Novo"
    			)
    	);
    	
    	$imovel_quartos = array(
    		array(
    			"qrt_id" => "1",
    			"qrt_descricao" => "1 Quarto"
    		),
    		array(
    			"qrt_id" => "2",
    			"qrt_descricao" => "2 Quarto"
    		),
    		array(
    			"qrt_id" => "3",
    			"qrt_descricao" => "3 Quarto"
    		),
    		array(
    			"qrt_id" => "4",
    			"qrt_descricao" => "5 Quarto"
    		)
    	);
    	
    	$data = array(
    		"tipo_anuncio" => $tipo_anuncio,
    		"propriedade_tipo" => $propriedade_tipo,
    		"pesquisa_tipo_casa" => $pesquisa_tipo_casa,
    		"carro_tipo" => $carro_tipo, 
    		"carro_marca" => $carro_marca,
    		"carro_modelo" => $carro_modelo,
    		"carro_preco" => $carro_preco,
    		"carro_0km" => $carro_0km,
    		"emprego_contrato" => $emprego_contrato,
    		"emprego_categoria" => $emprego_categoria,
    		"emprego_periodo" => $emprego_periodo,
    		"produto_categoria" => $produto_categoria,
    		"produto_marca" => $produto_marca,
    		"produto_modelo" => $produto_modelo,
    		"tipo_imovel" => $tipo_imovel,
    		"pais" => $pais,
    		"estado" => $estado,
    		"cidade" => $cidade,    		
    		"imovel_preco" => $imovel_preco,
    		"imovel_quartos" => $imovel_quartos,	    			
    		"tipoalerta" => $tipoalerta,
    		"periodos" => $periodos,
    		"user" => $user
    	);
    	$this->load->view('templates/header', $data);
    	$this->load->view('alerta_cadastro_usuario', $data);
    	$this->load->view('templates/footer', $data);
    }
    
	function alteracao($alr_id, $tipoalerta = "1") {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->library('auth');
    	 
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/cadastro"));
    	}
    	 
    	// get current user id
    	$id = $this->auth->userid();
    	 
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	if ($method == "POST" && $this->input->post('btnGravar') == 'ok') {    	
			$row = array(
				'alr_pesquisa' => mb_convert_encoding($this->input->post('iPesquisa'), 'ISO-8859-1', 'auto'),
				'tan_id' => $tipoalerta,
				'apr_id' => mb_convert_encoding($this->input->post('iPeriodo'), 'ISO-8859-1', 'auto'),
				'alr_data_criacao' => date('Y-m-d'),
				'id_perfil' => $id
			);
    		$this->load->model ( "alertas" );
    		$this->alertas->Alterar($row, $alr_id);
    		$this->alertas->LimparTipos($alr_id);
    		
    		if ($tipoalerta == '1') {
    			
    			$preco = array(null, null);
    			if ($this->input->post('iImovelPreco') != '') {
    				$preco = explode(',',$this->input->post('iImovelPreco'));
    			}
	    		$row = array(
	    				'alr_id' => $alr_id,
	    				'pct_id' => $this->input->post('iImovelTipoContrato') == '' ? null : $this->input->post('iImovelTipoContrato'),
	    				'pt_id' => $this->input->post('iImovelTipoImovel') == '' ? null : $this->input->post('iImovelTipoImovel'),
	    				'cd_id' => $this->input->post('iImovelCidade') == '' ? null : $this->input->post('iImovelCidade'),
	    				'es_id' => $this->input->post('iImovelEstado') == '' ? null : $this->input->post('iImovelEstado'),
	    				'ali_preco_in' => $preco[0],
	    				'ali_preco_out' => $preco[1],
	    				'ali_quartos' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iImovelQuartos')	    				
	    		);
    		
    			$this->load->model ( "alerta_imovel" );
    			$this->alerta_imovel->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '2') {
    			
    			$preco = array(null, null);
    			if ($this->input->post('iAutoPreco') != '') {
    				$preco = explode(',',$this->input->post('iAutoPreco'));
    			}
    			$row = array(
    					'alr_id' => $alr_id,
    					'crt_id' => $this->input->post('iCarroTipo') == '' ? null : $this->input->post('iCarroTipo'),
    					'cmr_id' => $this->input->post('iCarroMarca') == '' ? null : $this->input->post('iCarroMarca'),
    					'cmd_id' => $this->input->post('iCarroModelo') == '' ? null : $this->input->post('iCarroModelo'),
    					'cd_id' => $this->input->post('iCarroCidade') == '' ? null : $this->input->post('iCarroCidade'),
    					'es_id' => $this->input->post('iCarroEstado') == '' ? null : $this->input->post('iCarroEstado'),
    					'ala_preco_in' => $preco[0],
    					'ala_preco_out' => $preco[1],
    					'ala_novo' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iAuto0KM')    					
    			);
    		
    			$this->load->model ( "alerta_auto" );
    			$this->alerta_auto->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '3') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'ect_id' => $this->input->post('iEmpregoTipoContrato') == '' ? null : $this->input->post('iEmpregoTipoContrato'),
    					'emc_id' => $this->input->post('iEmpregoCategoria') == '' ? null : $this->input->post('iEmpregoCategoria'),
    					'emp_id' => $this->input->post('iEmpregoPeriodo') == '' ? null : $this->input->post('iEmpregoPeriodo'),
    					'ps_id' => $this->input->post('iEmpregoPais') == '' ? null : $this->input->post('iEmpregoPais'),
    					'es_id' => $this->input->post('iEmpregoEstado') == '' ? null : $this->input->post('iEmpregoEstado'),
    					'cd_id' => $this->input->post('iEmpregoCidade') == '' ? null : $this->input->post('iEmpregoCidade')
    			);
    		
    			$this->load->model ( "alerta_emprego" );
    			$this->alerta_emprego->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '4') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'prc_id' => $this->input->post('iProdutoCategoria') == '' ? null : $this->input->post('iProdutoCategoria'),
    					'pmr_id' => $this->input->post('iProdutoMarca') == '' ? null : $this->input->post('iProdutoMarca'),
    					'pmd_id' => $this->input->post('iProdutoModelo') == '' ? null : $this->input->post('iProdutoModelo'),
    					'es_id' => $this->input->post('iProdutoEstado') == '' ? null : $this->input->post('iProdutoEstado'),
    					'cd_id' => $this->input->post('iProdutoCidade') == '' ? null : $this->input->post('iProdutoCidade')
    			);
    		
    			$this->load->model ( "alerta_produto" );
    			$this->alerta_produto->Adicionar($row);
    		}
    		


    		if ($tipoalerta == '5') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'pt_id' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iTemporadaTipoImovel'),
    					'ps_id' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iTemporadaPais'),
    					'es_id' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iTemporadaEstado'),
    					'cd_id' => $this->input->post('iTemporadaCidade') == '' ? null : $this->input->post('iTemporadaCidade')
    			);
    		
    			$this->load->model ( "alerta_temporada" );
    			$this->alerta_temporada->Adicionar($row);
    		}
    		
    		redirect("alerta/lista");	
    	}
    	    	
    	$this->load->model ( "alertas" );
    	$this->load->model ( "alerta_imovel" );
    	$this->load->model ( "alerta_auto" );
    	$this->load->model ( "alerta_emprego" );
    	$this->load->model ( "alerta_produto" );
    	$this->load->model ( "alerta_temporada" );
    	$this->load->model ( "tipo_anuncio" );
    	$this->load->model ( "propriedade_tipo" );
		$this->load->model ( "pesquisa_tipo_casa" );
		$this->load->model ( "carro_tipo" );
		$this->load->model ( "carro_marca" );
		$this->load->model ( "carro_modelo" );
		$this->load->model ( "anuncio_emprego" );
		$this->load->model ( "emprego_contrato" );
		$this->load->model ( "emprego_categoria" );
		$this->load->model ( "emprego_periodo" );
		$this->load->model ( "anuncio_produto" );
		$this->load->model ( "produto_categoria" );
		$this->load->model ( "produto_marca" );
		$this->load->model ( "produto_modelo" );
		$this->load->model ( "anuncio_temporada" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "alerta_periodo" );
		$this->load->model ( "pais" );
		$this->load->model ( "estado" );
		$this->load->model ( "cidade" );
		
		$alerta = $this->alertas->BuscaPorId($alr_id);
		if (!isset($tipoalerta)) {
			$tipoalerta = $alerta[0]->tan_id;
		} 
		$alerta_auto = $this->alerta_auto->BuscaPorId($alr_id);
		$alerta_imovel = $this->alerta_imovel->BuscaPorId($alr_id);
		$alerta_emprego = $this->alerta_emprego->BuscaPorId($alr_id);
		$alerta_produto = $this->alerta_produto->BuscaPorId($alr_id);
		$alerta_temporada = $this->alerta_temporada->BuscaPorId($alr_id);
		
		$alerta_imovel_tipo_contrato = NULL;
		if ($method == "POST") {
			$alerta_imovel_tipo_contrato = $this->input->post("iImovelTipoContrato");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_tipo_contrato = $alerta_imovel[0]->pct_id;
			}
		}
		
		$alerta_imovel_tipo_imovel = NULL;
		if ($method == "POST") {
			$alerta_imovel_tipo_imovel = $this->input->post("iImovelTipoImovel");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_tipo_imovel = $alerta_imovel[0]->pt_id;
			}
		}
		
		$alerta_imovel_estado = NULL;
		if ($method == "POST") {
			$alerta_imovel_estado = $this->input->post("iImovelEstado");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_estado = $alerta_imovel[0]->es_id;
			}
		}
		
		$alerta_imovel_cidade = NULL;
		if ($method == "POST") {
			$alerta_imovel_cidade = $this->input->post("iImovelCidade");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_cidade = $alerta_imovel[0]->cd_id;
			}
		}
		
		$alerta_imovel_preco = NULL;
		if ($method == "POST") {
			$alerta_imovel_preco = $this->input->post("iImovelPreco");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_preco = $alerta_imovel[0]->ali_preco_in . ',' . $alerta_imovel[0]->ali_preco_out;
			}
		}
		
		$alerta_imovel_quartos = NULL;
		if ($method == "POST") {
			$alerta_imovel_quartos = $this->input->post("iImovelQuartos");
		} else {
			if ($alerta_imovel != null) {
				$alerta_imovel_quartos = $alerta_imovel[0]->ali_quartos;
			}
		}
		
		$alerta_auto_tipo = NULL;
		if ($method == "POST") {
			$alerta_auto_tipo = $this->input->post("iCarroTipo");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_tipo = $alerta_auto[0]->crt_id;
			}
		}
		
		$alerta_auto_preco = NULL;
		if ($method == "POST") {
			$alerta_imovel_preco = $this->input->post("iAutoPreco");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_preco = $alerta_auto[0]->ala_preco_in . ',' . $alerta_auto[0]->ala_preco_out;
			}
		}
		
		$alerta_auto_0km = NULL;
		if ($method == "POST") {
			$alerta_auto_0km = $this->input->post("iAuto0KM");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_0km = $alerta_auto[0]->ala_novo;
			}
		}
		
		$alerta_auto_marca = NULL;
		if ($method == "POST") {
			$alerta_auto_marca = $this->input->post("iCarroMarca");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_marca = $alerta_auto[0]->cmr_id;
			}
		}
		
		$alerta_auto_modelo = NULL;
		if ($method == "POST") {
			$alerta_auto_modelo = $this->input->post("iCarroModelo");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_modelo = $alerta_auto[0]->cmd_id;
			}
		}
		
		$alerta_auto_estado = NULL;
		if ($method == "POST") {
			$alerta_auto_estado = $this->input->post("iCarroEstado");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_estado = $alerta_auto[0]->es_id;
			}
		}
		
		$alerta_auto_cidade = NULL;
		if ($method == "POST") {
			$alerta_auto_cidade = $this->input->post("iCarroCidade");
		} else {
			if ($alerta_auto != null) {
				$alerta_auto_cidade = $alerta_auto[0]->cd_id;
			}
		}
		
		$ps_id = "1";
		$es_id = null;
		if ($tipoalerta == "1" || $tipoalerta == "2" || $tipoalerta == "4") { $ps_id = "1";}
		if ($tipoalerta == "3") { $ps_id = $this->input->post('iEmpregoPais') == null ? "1" : $ps_id = $this->input->post('iEmpregoPais'); }
		if ($tipoalerta == "5") { $ps_id = $this->input->post('iTemporadaPais') == null ? "1" : $ps_id = $this->input->post('iTemporadaPais'); }
		
    	if ($tipoalerta == "1") { $es_id = $this->input->post('iImovelEstado'); }
    	if ($tipoalerta == "2") { $es_id = $this->input->post('iCarroEstado'); }
    	if ($tipoalerta == "3") { $es_id = $this->input->post('iEmpregoEstado'); }
    	if ($tipoalerta == "4") { $es_id = $this->input->post('iProdutoEstado'); }
    	if ($tipoalerta == "5") { $es_id = $this->input->post('iTemporadaEstado'); }
		
		
		$tipo_anuncio = $this->tipo_anuncio->ListaTodos ();
    	$propriedade_tipo = $this->propriedade_tipo->ListaTodos ();
		$pesquisa_tipo_casa = $this->pesquisa_tipo_casa->ListaTodos ();
		$carro_tipo = $this->carro_tipo->ListaTodos ();
    	$carro_marca = $this->carro_marca->ListaTodos ();
    	$carro_modelo = $this->carro_modelo->BuscaPorMarcaId ($this->input->post("iCarroMarca"));
    	$emprego_contrato = $this->emprego_contrato->ListaTodos ();
    	$emprego_categoria = $this->emprego_categoria->ListaTodos ();
    	$emprego_periodo = $this->emprego_periodo->ListaTodos ();
    	$produto_categoria = $this->produto_categoria->ListaTodos ();
    	$produto_marca = $this->produto_marca->ListaTodos ();
    	$produto_modelo = $this->produto_modelo->ListaTodos ();
    	$tipo_imovel = $this->tipo_imovel->ListaTodos ();
    	$periodos = $this->alerta_periodo->ListaTodos ();
    	$pais = $this->pais->ListaTodos();
    	$estado = $this->estado->BuscaPorPais($ps_id);
    	$cidade = $this->cidade->BuscaPorEstado($es_id);
    	
    	$imovel_preco = array(
    		array(
    			"prc_id" => "10000,80000",
    			"prc_descricao" => "10.000 - 80.000"
    		),
    		array(
    			"prc_id" => "80000,100000",
    			"prc_descricao" => "80.000 - 100.000"
    		),
    		array(
    			"prc_id" => "100000,200000",
    			"prc_descricao" => "100.000 - 200.000"
    		),
    		array(
    			"prc_id" => "200000,300000",
    			"prc_descricao" => "200.000 - 300.000"
    		),
    		array(
    			"prc_id" => "300000,400000",
    			"prc_descricao" => "300.000 - 400.000"
    		),
    		array(
    			"prc_id" => "400000,500000",
    			"prc_descricao" => "400.000 - 500.000"
    		),
    		array(
    			"prc_id" => "500000,600000",
    			"prc_descricao" => "500.000 - 600.000"
    		),
    		array(
    			"prc_id" => "600000,700000",
    			"prc_descricao" => "600.000 - 700.000"
    		),
    		array(
    			"prc_id" => "700000,800000",
    			"prc_descricao" => "700.000 - 800.000"
    		),
    		array(
    			"prc_id" => "800000,900000",
    			"prc_descricao" => "800.000 - 900.000"
    		),
    		array(
    			"prc_id" => "100000,1000000",
    			"prc_descricao" => "900.000 - 1.000.000"
    		)
    	);
    	
    	$carro_preco = array(
    			array(
    					"prc_id" => "10000,80000",
    					"prc_descricao" => "10.000 - 80.000"
    			),
    			array(
    					"prc_id" => "80000,100000",
    					"prc_descricao" => "80.000 - 100.000"
    			),
    			array(
    					"prc_id" => "100000,200000",
    					"prc_descricao" => "100.000 - 200.000"
    			),
    			array(
    					"prc_id" => "200000,300000",
    					"prc_descricao" => "200.000 - 300.000"
    			),
    			array(
    					"prc_id" => "300000,400000",
    					"prc_descricao" => "300.000 - 400.000"
    			),
    			array(
    					"prc_id" => "400000,500000",
    					"prc_descricao" => "400.000 - 500.000"
    			),
    			array(
    					"prc_id" => "500000,600000",
    					"prc_descricao" => "500.000 - 600.000"
    			),
    			array(
    					"prc_id" => "600000,700000",
    					"prc_descricao" => "600.000 - 700.000"
    			),
    			array(
    					"prc_id" => "700000,800000",
    					"prc_descricao" => "700.000 - 800.000"
    			),
    			array(
    					"prc_id" => "800000,900000",
    					"prc_descricao" => "800.000 - 900.000"
    			),
    			array(
    					"prc_id" => "100000,1000000",
    					"prc_descricao" => "900.000 - 1.000.000"
    			)
    	);
    	
    	$carro_0km = array(
    			array(
    					"ckm_id" => "1",
    					"ckm_descricao" => "Usado"
    			),
    			array(
    					"ckm_id" => "2",
    					"ckm_descricao" => "Novo"
    			)
    	);
    	
    	$imovel_quartos = array(
    		array(
    			"qrt_id" => "1",
    			"qrt_descricao" => "1 Quarto"
    		),
    		array(
    			"qrt_id" => "2",
    			"qrt_descricao" => "2 Quarto"
    		),
    		array(
    			"qrt_id" => "3",
    			"qrt_descricao" => "3 Quarto"
    		),
    		array(
    			"qrt_id" => "4",
    			"qrt_descricao" => "5 Quarto"
    		)
    	);
    	
    	$data = array(
    		"alerta" => $alerta[0],
    		"alerta_auto" => isset($alerta_auto) ? $alerta_auto[0] : null,
    		"alerta_imovel_tipo_contrato" => $alerta_imovel_tipo_contrato,
    		"alerta_imovel_tipo_imovel" => $alerta_imovel_tipo_imovel,
    		"alerta_imovel_estado" => $alerta_imovel_estado,
    		"alerta_imovel_cidade" => $alerta_imovel_cidade,
    		"alerta_imovel_preco" => $alerta_imovel_preco,
    		"alerta_imovel_quartos" => $alerta_imovel_quartos,
    		"alerta_auto_tipo" => $alerta_auto_tipo,
    		"alerta_auto_preco" => $alerta_auto_preco,
    		"alerta_auto_0km" => $alerta_auto_0km,
    		"alerta_auto_marca" => $alerta_auto_marca,
    		"alerta_auto_modelo" => $alerta_auto_modelo,
    		"alerta_auto_estado" => $alerta_auto_estado,
    		"alerta_auto_cidade" => $alerta_auto_cidade,
    		"alerta_emprego" => isset($alerta_emprego) ? $alerta_emprego[0] : null,
    		"alerta_produto" => isset($alerta_produto) ? $alerta_produto[0] : null,
    		"alerta_temporada" => isset($alerta_temporada) ? $alerta_temporada[0] : null,    		
    		"tipo_anuncio" => $tipo_anuncio,
    		"propriedade_tipo" => $propriedade_tipo,
    		"pesquisa_tipo_casa" => $pesquisa_tipo_casa,
    		"carro_tipo" => $carro_tipo, 
    		"carro_marca" => $carro_marca,
    		"carro_modelo" => $carro_modelo,
    		"carro_preco" => $carro_preco,
    		"carro_0km" => $carro_0km,
    		"emprego_contrato" => $emprego_contrato,
    		"emprego_categoria" => $emprego_categoria,
    		"emprego_periodo" => $emprego_periodo,
    		"produto_categoria" => $produto_categoria,
    		"produto_marca" => $produto_marca,
    		"produto_modelo" => $produto_modelo,
    		"tipo_imovel" => $tipo_imovel,
    		"pais" => $pais,
    		"estado" => $estado,
    		"cidade" => $cidade,    		
    		"imovel_preco" => $imovel_preco,
    		"imovel_quartos" => $imovel_quartos,	    			
    		"tipoalerta" => $tipoalerta,
    		"periodos" => $periodos,
    		"user" => $user
    	); 
    	$this->load->view('templates/header', $data);
    	$this->load->view('alerta_alteracao_usuario', $data);
    	$this->load->view('templates/footer', $data);
    }
    
    function lista() {
    	$this->load->library('auth');
    	
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/lista"));
    	}
    	
    	// get current user id
    	$id = $this->auth->userid();
    	
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	$this->load->model("alertas");    	
    	$lista = $this->alertas->BuscaPorPerfil($user[0]->email);
    	
    	
    	$data = array(
    			"lista" => $lista,
    			"user" => $user
    	);
    	$this->load->view('templates/header', $data);
    	$this->load->view('alerta_lista_usuario', $data);
    	$this->load->view('templates/footer', $data);
    }
    
    function exclusao($alr_id = FALSE) {
    	$this->load->helper('url');
    	$this->load->library('auth');
    
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/lista"));
    	}
    
    	// get current user id
    	$id = $this->auth->userid();
    
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	 
    	$this->load->model('alertas');
    	$this->alertas->Excluir($alr_id);
    	
    	redirect(base_url() . "alerta/lista", "refresh");
    	
    }
    
    function cadastro_imovel() {
    	
    }
    
    private function incluir($alerta) {
    	$row = array(
    			'alr_pesquisa' => $alerta['alr_pesquisa'],
    			'tan_id' => $alerta['tan_id'],
    			'apr_id' => $alerta['apr_id'],
    			'alr_data_criacao' => date('Y-m-d'),
    			'id_perfil' => $alerta['id_perfil']
    	);
    	$this->load->model ( "alertas" );
    	$alr_id = $this->alertas->Adicionar($row);
    	
    	switch ($alerta->tan_id) {
    		case 1: {
    			$row = array(
    				'alr_id' => $alr_id,
    				'pct_id' => $alerta['pct_id'],
    				'pt_id' => $alerta['pt_id'],
    				'cd_id' => $alerta['cd_id'],
    				'es_id' => $alerta['es_id'],
    				'ali_preco_in' => $alerta['ali_preco_in'],
    				'ali_preco_out' => $alerta['ali_preco_out'],
    				'ali_quartos' => $alerta['ali_quartos']
    			);
    			 
    			$this->load->model ( "alerta_imovel" );
    			$this->alerta_imovel->Adicionar($row);
    			break;
    		}
    		case 2: {
    			$row = array(
    				'alr_id' => $alr_id,
    				'crt_id' => $alerta['crt_id'],
    				'cmr_id' => $alerta['cmr_id'],
    				'cmd_id' => $alerta['cmd_id'],
    				'cd_id' => $alerta['cd_id'],
    				'es_id' => $alerta['es_id'],
    				'ala_preco_in' => $alerta['ala_preco_in'],
    				'ala_preco_out' => $alerta['ala_preco_out'],
    				'ala_novo' => $alerta['ala_novo']
	    		);
	    	
	    		$this->load->model ( "alerta_auto" );
	    		$this->alerta_auto->Adicionar($row);
    			break;
    		}
    		case 3: {
    			$row = array(
    				'alr_id' => $alr_id,
    				'ect_id' => $alerta['ect_id'],
    				'emc_id' => $alerta['emc_id'],
    				'emp_id' => $alerta['emp_id'],
    				'ps_id' => $alerta['ps_id'],
    				'es_id' => $alerta['es_id'],
    				'cd_id' => $alerta['cd_id']
	    		);
	    	
	    		$this->load->model ( "alerta_emprego" );
	    		$this->alerta_emprego->Adicionar($row);
    			break;
    		}
    		case 4: {
    			$row = array(
    				'alr_id' => $alr_id,
    				'prc_id' => $alerta['prc_id'],
    				'pmr_id' => $alerta['pmr_id'],
    				'pmd_id' => $alerta['pmd_id'],
    				'es_id' => $alerta['es_id'],
    				'cd_id' => $alerta['cd_id']
	    		);
	    	
	    		$this->load->model ( "alerta_produto" );
	    		$this->alerta_produto->Adicionar($row);
    			break;
    		}
    		case 5: {
    			$row = array(
    				'alr_id' => $alr_id,
    				'pt_id' => $alerta['pt_id'],
    				'ps_id' => $alerta['ps_id'],
    				'es_id' => $alerta['es_id'],
    				'cd_id' => $alerta['cd_id']
	    		);
	    	
	    		$this->load->model ( "alerta_temporada" );
	    		$this->alerta_temporada->Adicionar($row);
    			break;
    		}
    	}    	
    }
    
}