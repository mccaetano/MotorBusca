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
    	
    	$this->load->model("tipo_anuncio");
    	
    	foreach ($lista as $motor) {
    		$tipoAnuncio =$this->tipo_anuncio->BuscaTipoAnuncio($motor->tan_id);
    		$xmlurl =  urlencode(base64_encode($motor->man_url_carga));
    		
    		$url = base_url().$tipoAnuncio->tan_endereco_carga."/".$xmlurl;
    		
    		$this->curl_post_async($url, FALSE);
       	}    	
    	
    }
    
    function curl_post_async($url, $params = array()){
    
    	$post_params = array();
    
    	foreach ($params as $key => &$val) {
    		if (is_array($val)) $val = implode(',', $val);
    		$post_params[] = $key.'='.urlencode($val);
    	}
    	$post_string = implode('&', $post_params);
    
    	$parts=parse_url($url);
    
    	$fp = fsockopen($parts['host'],
    			isset($parts['port'])?$parts['port']:80,
    			$errno, $errstr, 30);
    
    	$out = "POST ".$parts['path']." HTTP/1.1\r\n";
    	$out.= "Host: ".$parts['host']."\r\n";
    	$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    	$out.= "Content-Length: ".strlen($post_string)."\r\n";
    	$out.= "Connection: Close\r\n\r\n";
    	if (isset($post_string)) $out.= $post_string;
    
    	fwrite($fp, $out);
    	fclose($fp);
    }
    
    function imovelXML($xmlFile = FALSE) {    	
    	if (!$xmlFile) { 
    		log_message('error', "xml não enviado");
    		show_404(base_url("feeds/imovelXML"));
    		return; 
    	}
    	
    	$xmlFile = base64_decode(urldecode($xmlFile));    	
    	$xsd_document = base_url()."assets/xml/imovel.xsd";
    	$dom = new DomDocument();
    	var_dump(base_url()."assets/xml/imovel.xsd");
    	if (!$dom->load($xmlFile)) log_message('error', 'Could not load XML file: '.$xmlFile);
    	if (!$dom->schemaValidate($xsd_document)) log_message('error', 'XML file did not validate against schema: '.$xsd_document);
    	
    	$xmlData = simplexml_load_file($xmlFile);
    	
    	$this->load->model("anuncio_casa");
    	#$lista = $this->anuncio_casa->Adicionar();
    	 
    	foreach ($xmlData as $ad) {
    		
    	}
    	
    }
}