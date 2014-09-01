<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Alerta extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->lang->load("home", "portuguese");
    }
    
    
    function cadastro($tipoalerta) {
    	
    	$data = array(
    		"tipoalerta" => $tipoalerta
    	);
    	$this->load->view('templates/header', $data);
    	$this->load->view('alerta_cadastro_usuario', $data);
    	$this->load->view('templates/footer', $data);
    }
    
}