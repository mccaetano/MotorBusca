<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Perfil extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }
    
    function lista() {
    	
    	$this->load->model ( "mbPerfil" , "perfil");
    	$lista = $this->perfil->BuscaTodos ();
    	
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfis' => $lista
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_lista', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function novo() {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->model ( "mbPerfil", "perfil" );
    	$this->load->model ( "perfil_acesso");
    	
    	if ($method == "POST") {
    		$row = array(
    			'nome_completo' => $this->input->post('iNome'),
    			'email' => $this->input->post('iEmail'),
    			'data_nascimento' => $this->input->post('iDataNascimento'),
    			'senha' => base64_encode($this->input->post('iSenha')),
    			'ativo' => $this->input->post('iAtivo') == 'on' ? '1' : '0',
    			't_mb_perfil_acesso_pra_id' => $this->input->post('iAcesso')
    		);
    		
    		$this->perfil->Adicionar ($row);
    		
    		redirect("admin/perfil/lista");
    	}
    	
    	
    	$lista = $this->perfil_acesso->BuscaTodos ();
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfil_acessos' => $lista
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_cadastro', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function alteracao($id = FALSE) {
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->model ( "mbPerfil", "perfil" );
    	$this->load->model ( "perfil_acesso" );
    	
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
    		redirect("admin/perfil/lista");
    	}
    	    	
    	$lista = $this->perfil_acesso->BuscaTodos ();    	
    	$perfil = $this->perfil->BuscaPorID ($id);
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfil_acessos' => $lista,
    		'perfil' => $perfil[0]
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_alteracao', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
}