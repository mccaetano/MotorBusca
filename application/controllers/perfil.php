<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Perfil extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->lang->load("home", "portuguese");
    }
    
    function cadastro() {
    	$data = array();
    	$this->load->view('templates/header');
    	$this->load->view('perfil_cadastro');
    	$this->load->view('templates/footer');
    }
    
    function alteraremail() {
    	$data = array();
    	$this->load->view('templates/header');
    	$this->load->view('perfil_alteraremail');
    	$this->load->view('templates/footer');
    }
}