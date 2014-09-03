<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Alerta extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->lang->load("home", "portuguese");
    }
    
    
    function cadastro($tipoalerta = "1") {
    	$this->load->library('auth');
    	 
    	if (!$this->auth->loggedin()) {
    		redirect('acesso/login/' . base64_encode("alerta/cadastro"));
    	}
    	 
    	// get current user id
    	$id = $this->auth->userid();
    	 
    	// get user from database
    	$this->load->model('mbperfil', 'user_model');
    	$user = $this->user_model->BuscaPorID($id);
    	
    	$this->load->model("tipo_anuncio");
    	$tipoanuncios = $this->tipo_anuncio->ListaTodos();
    	$this->load->model("alerta_periodo");
    	$periodos = $this->alerta_periodo->ListaTodos();
    	
    	$data = array(
    		"tipoalerta" => $tipoalerta,
    		"tipoaunucios" => $tipoanuncios,
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