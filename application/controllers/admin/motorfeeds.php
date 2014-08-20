<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class MotorFeeds extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }
    
    function lista() {
    	
    	$this->load->model ( "motor_anuncio");
    	$lista = $this->motor_anuncio->BuscaTodos ();
    	
    	
    	$data = array(
    		'ativo' => 'feeds',
    		'motor' => $lista
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/motor_lista', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function novo() {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->model ( "motor_anuncio");
    	$this->load->model ( "tipo_anuncio");
    	
    	if ($method == "POST") {
    		$row = array(
    			'nome_completo' => $this->input->post('iNome'),
    			'email' => $this->input->post('iEmail'),
    			'data_nascimento' => $this->input->post('iDataNascimento'),
    			'senha' => base64_encode($this->input->post('iSenha')),
    			'ativo' => $this->input->post('iAtivo') == 'on' ? '1' : '0',
    			't_mb_perfil_acesso_pra_id' => $this->input->post('iAcesso')
    		);
    		
    		$this->motor_anuncio->Adicionar ($row);
    		
    		redirect("admin/motorfeeds/lista");
    	}
    	
    	
    	$lista = $this->tipo_anuncio->BuscaTodos ();
    	
    	$data = array(
    		'ativo' => 'feeds',
    		'tipoanuncio' => $lista
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/motor_cadastro', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function alteracao($id = FALSE) {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->model ( "motor_anuncio");
    	$this->load->model ( "tipo_anuncio" );
    	
    	if ($method == "POST") {
    		$row = array(
    				'nome_completo' => $this->input->post('iNome'),
    				'email' => $this->input->post('iEmail'),
    				'data_nascimento' => $this->input->post('iDataNascimento'),
    				'senha' => base64_encode($this->input->post('iSenha')),
    				'ativo' => $this->input->post('iAtivo') == 'on' ? '1' : '0',
    				't_mb_perfil_acesso_pra_id' => $this->input->post('iAcesso')
    		);
    		
    		$this->perfil->Alterar ($row, $id);
    		redirect("admin/motorfeeds/lista");
    	}
    	
    	$lista = $this->tipo_anuncio->BuscaTodos ();    	
    	$feeds = $this->motor_anuncio->BuscaPorID ($id);
    	
    	$data = array(
    		'ativo' => 'feeds',
    		'tipoanuncio' => $lista,
    		'anuncio' => $feeds[0]
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/motor_alteracao', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
}