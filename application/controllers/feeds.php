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
    
    function carregaanuncios() {
    	$this->load->model("motor_anuncio");
    	$lista = $this->motor_anuncio->listaTodos();
    	
    	$this->load->model("anuncio_casa");
    	
    	foreach ($lista as $motor) {
    		$xmlData = simplexml_load_file((string)$motor->man_url_carga);
    		
    		foreach ($xmlData as $ad) {    		
	    		switch ($motor->tan_id) {
	    			case 1: {
	    				$data = array(
	    					"ac_id" => "", 
	    					"ac_id_anuncio" => "", 
	    					"ac_url" => "", 
	    					"ac_mobile_url" => "", 
	    					"ac_title" => "", 
	    					"pct_id" => "", 
	    					"ac_descricao" => "", 
	    					"ac_preco" => "", 
	    					"pt_id" => "", 
	    					"ace_id" => "", 
	    					"pc_endereco" => "", 
	    					"pc_andar" => "", 
	    					"pc_bairro" => "", 
	    					"pc_complemento" => "", 
	    					"cd_id" => "", 
	    					"es_id" => "", 
	    					"ps_id" => "",
	    					"pc_caixa_postal" => "",
	    					"pc_latitude" => "", 
	    					"pc_longitude" => "",
	    					"pc_orientacao" => "", 
	    					"pc_agencia" => "", 
	    					"pc_mls_database" => "", 
	    					"pc_area_terreno" => "", 
	    					"pc_area_construida" => "", 
	    					"pc_quartos" => "", 
	    					"pc_banheiros" => "", 
	    					"pc_condicao" => "", 
	    					"pc_ano" => "", 
	    					"pc_2D_tour" => "", 
	    					"pc_perc_eco" => "", 
	    					"pc_data_inclusao" => "", 
	    					"pc_data_expiracao" => "", 
	    					"pc_anuncio_proprietario" => "", 
	    					"pc_diretro_proprietario" => "", 
	    					"pc_garagem" => "",
	    					"pc_finalizado" => "", 
	    					"pc_mobiliado" => "", 
	    					"pc_novo" => ""
	    				);
	    				
	    				$this->anuncio_casa->adicionar($data);
	    				break;
	    			}
	    			case 2: {
	    				$data = array(
	    					"aem_titulo" => "", 
	    					"aem_url" => "", 
	    					"aem_descricao" => "", 
	    					"aem_url_movel" => "", 
	    					"aem_caixapostal" => "", 
	    					"ps_id" => "", 
	    					"es_id" => "", 
	    					"cd_id" => "", 
	    					"aem_bairro" => "", 
	    					"aem_experiencia" => "", 
	    					"aem_requisitos" => "", 
	    					"aem_escolaridade" => "", 
	    					"aem_salario" => "", 
	    					"emp_id" => "", 
	    					"aem_trabalhoexterno" => "", 
	    					"emc_id" => "", 
	    					"ect_id" => "", 
	    					"aem_empresa" => "", 
	    					"aem_data_criacao" => "", 
	    					"aem_data_expiracao" => ""
	    				);
	    				 
	    				$this->anuncio_casa->adicionar($data);
	    				break;
	    			}
	    		}	
    		}
    	}    	
    	
    }
}