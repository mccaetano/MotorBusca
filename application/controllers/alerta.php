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
			$row = array(
				'alr_pesquisa' => mb_convert_encoding($this->input->post('iPesquisa'), 'ISO-8859-1', 'auto'),
				'tan_id' => $tipoalerta,
				'apr_id' => mb_convert_encoding($this->input->post('iPeriodo'), 'ISO-8859-1', 'auto'),
				'alr_data_criacao' => date('Y-m-d'),
				'id_perfil' => $id
			);
    		$this->load->model ( "alertas" );
    		$alr_id = $this->alertas->Adicionar($row);
    		
    		if ($tipoalerta == '1') {
    			$preco = explode(',',$this->input->post('iImovelPreco'));
	    		$row = array(
	    				'alr_id' => $alr_id,
	    				'pct_id' => mb_convert_encoding($this->input->post('iImovelTipoContrato'), 'ISO-8859-1', 'auto'),
	    				'pt_id' => mb_convert_encoding($this->input->post('iImovelTipoImovel'), 'ISO-8859-1', 'auto'),
	    				'cd_id' => mb_convert_encoding($this->input->post('iImovelCidade'), 'ISO-8859-1', 'auto'),
	    				'es_id' => mb_convert_encoding($this->input->post('iImovelEstado'), 'ISO-8859-1', 'auto'),
	    				'ali_preco_in' => $preco[0],
	    				'ali_preco_out' => $preco[1],
	    				'ali_quartos' => mb_convert_encoding($this->input->post('iImovelQuartos'), 'ISO-8859-1', 'auto')	    				
	    		);
    		
    			$this->load->model ( "alerta_imovel" );
    			$this->alerta_imovel->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '2') {
    			$preco = explode(',',$this->input->post('iAutoPreco'));
    			$row = array(
    					'alr_id' => $alr_id,
    					'crt_id' => mb_convert_encoding($this->input->post('iCarroTipo'), 'ISO-8859-1', 'auto'),
    					'cmr_id' => mb_convert_encoding($this->input->post('iCarroMarca'), 'ISO-8859-1', 'auto'),
    					'cmd_id' => mb_convert_encoding($this->input->post('iCarroModelo'), 'ISO-8859-1', 'auto'),
    					'cd_id' => mb_convert_encoding($this->input->post('iCarroCidade'), 'ISO-8859-1', 'auto'),
    					'es_id' => mb_convert_encoding($this->input->post('iCarroEstado'), 'ISO-8859-1', 'auto'),
    					'ala_preco_in' => $preco[0],
    					'ala_preco_out' => $preco[1],
    					'ala_novo' => mb_convert_encoding($this->input->post('iAuto0KM'), 'ISO-8859-1', 'auto')    					
    			);
    		
    			$this->load->model ( "alerta_auto" );
    			$this->alerta_auto->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '3') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'ect_id' => mb_convert_encoding($this->input->post('iEmpregoTipoContrato'), 'ISO-8859-1', 'auto'),
    					'emc_id' => mb_convert_encoding($this->input->post('iEmpregoCategoria'), 'ISO-8859-1', 'auto'),
    					'emp_id' => mb_convert_encoding($this->input->post('iEmpregoPeriodo'), 'ISO-8859-1', 'auto'),
    					'ps_id' => mb_convert_encoding($this->input->post('iEmpregoPais'), 'ISO-8859-1', 'auto'),
    					'es_id' => mb_convert_encoding($this->input->post('iEmpregoEstado'), 'ISO-8859-1', 'auto'),
    					'cd_id' => mb_convert_encoding($this->input->post('iEmpregoCidade'), 'ISO-8859-1', 'auto')
    			);
    		
    			$this->load->model ( "alerta_emprego" );
    			$this->alerta_emprego->Adicionar($row);
    		}
    		
    		if ($tipoalerta == '4') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'prc_id' => mb_convert_encoding($this->input->post('iProdutoCategoria'), 'ISO-8859-1', 'auto'),
    					'pmr_id' => mb_convert_encoding($this->input->post('iProdutoMarca'), 'ISO-8859-1', 'auto'),
    					'pmd_id' => mb_convert_encoding($this->input->post('iProdutoModelo'), 'ISO-8859-1', 'auto'),
    					'es_id' => mb_convert_encoding($this->input->post('iProdutoEstado'), 'ISO-8859-1', 'auto'),
    					'cd_id' => mb_convert_encoding($this->input->post('iProdutoCidade'), 'ISO-8859-1', 'auto')
    			);
    		
    			$this->load->model ( "alerta_produto" );
    			$this->alerta_produto->Adicionar($row);
    		}
    		


    		if ($tipoalerta == '5') {
    			$row = array(
    					'alr_id' => $alr_id,
    					'pt_id' => mb_convert_encoding($this->input->post('iTemporadaTipoImovel'), 'ISO-8859-1', 'auto'),
    					'ps_id' => mb_convert_encoding($this->input->post('iTemporadaPais'), 'ISO-8859-1', 'auto'),
    					'es_id' => mb_convert_encoding($this->input->post('iTemporadaEstado'), 'ISO-8859-1', 'auto'),
    					'cd_id' => mb_convert_encoding($this->input->post('iTemporadaCidade'), 'ISO-8859-1', 'auto')
    			);
    		
    			$this->load->model ( "alerta_temporada" );
    			$this->alerta_temporada->Adicionar($row);
    		}
    		
    		exit();
    		#redirect("alerta/lista");	
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
    
    function alteracao($tipoalerta = "1", $id = FALSE) {
    	$this->load->library('auth');
    	 
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/alteracao"));
    	}
    	 
    	// get current user id
    	$id = $this->auth->userid();
    	 
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');    	
    	$user = $this->user_model->BuscaPorID($id);
    	
    	$this->load->model('alertas');
    	
    	$data = array(
    			"tipoalerta" => $tipoalerta,
    			"user" => $user
    	);
    	$this->load->view('templates/header', $data);
    	$this->load->view('alerta_altera_usuario', $data);
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
    
}