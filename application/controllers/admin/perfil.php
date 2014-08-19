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
    	if ($method == "POST") {
    		#redirect("admin/perfil/lista");
    	}
    	
    	$this->load->model ( "perfil_acesso");
    	$lista = $this->perfil_acesso->BuscaTodos ();
    	
    	$data = array(
    		'ativo' => 'perfil',
    		'perfil_acessos' => $lista
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('admin/perfil_cadastro', $data);
    	$this->load->view('admin/templates/footer', $data);
    }
    
    function alteracao() {
    	$data = array(
    		'ativo' => 'perfil'
    	);
    	$this->load->view('admin/templates/header', $data);
    	$this->load->view('perfil_alteraremail');
    	$this->load->view('templates/footer');
    }
}