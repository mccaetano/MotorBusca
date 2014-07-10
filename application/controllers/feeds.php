<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Feeds extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->lang->load("home", "portuguese");
    }
    
    function index() {
    	$data = array();
    	$this->load->view('templates/header');
    	$this->load->view('feeds_index');
    	$this->load->view('templates/footer');
    }
    
    function carregaFeeds() {
    	
    }
}