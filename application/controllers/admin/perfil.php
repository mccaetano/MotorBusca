<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Perfil extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper ( array (
				'form' ,
				'date', 
				'url'
		) );
    }
    
    function lista() {
    	if (!$this->auth->loggedin()) {
    		redirect('admin/login');
    	}
    	
    	// get current user id
    	$id = $this->auth->userid();
    	
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	
    	$this->load->model ( "mbperfil" , "perfil");
    	$lista = $this->perfil->ListaPerfil ();
    	
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfis' => $lista,
    		'user' => $user
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_lista', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function novo() {
    	if (!$this->auth->loggedin()) {
    		redirect('admin/login');
    	}
    	
    	// get current user id
    	$id = $this->auth->userid();
    	
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	
    	$this->load->model ( "mbperfil", "perfil" );
    	$this->load->model ( "perfil_acesso");
    	
    	if ($method == "POST") {
    		$this->load->library('form_validation');
    		
    		$this->form_validation->set_rules('iURL', 'Url de Acesso', 'prep_url');
    		
    		if ($this->form_validation->run() == true) {    		
	    		$row = array(
	    			'nome_completo' => $this->input->post('iNome'),
	    			'email' => $this->input->post('iEmail'),
	    			'data_nascimento' => $this->input->post('iDataNascimento'),
	    			'senha' => base64_encode($this->input->post('iSenha')),
	    			'ativo' => $this->input->post('iAtivo') == 'on' ? '1' : '0',
	    			't_mb_perfil_acesso_pra_id' => $this->input->post('iAcesso')
	    		);
	    		
	    		$this->perfil->Adicionar ($row);
	    		
	    		redirect("home");
    		}
    	}
    	
    	
    	$lista = $this->perfil_acesso->BuscaTodos ();
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfil_acessos' => $lista,
    		'user' => $user
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_cadastro', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function alteracao($id = FALSE) {
    	if (!$this->auth->loggedin()) {
    		redirect('admin/login');
    	}
    	
    	// get current user id
    	$id = $this->auth->userid();
    	
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	$method =  (string)$_SERVER["REQUEST_METHOD"];
    	
    	$this->load->model ( "mbperfil", "perfil" );
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
    		'perfil' => $perfil[0],
    		'user' => $user
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_alteracao', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function exclusao($id = FALSE) {
    	
    	if (!$this->auth->loggedin()) {
    		redirect('admin/login');
    	}
    	
    	// get current user id
    	$id = $this->auth->userid();
    	
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	if (!$id) { redirect('admin/perfil/lista'); }
    		
    	$this->load->model ( "mbperfil", "perfil" );
    	
    	$this->perfil->Excluir ($row, $id);
    	redirect("admin/perfil/lista");
    	    	
    }
}