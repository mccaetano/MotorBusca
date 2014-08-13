<?php
if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class Feeds extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'url' 
		) );
		$this->lang->load ( "home", "portuguese" );
	}
	function index() {
		$data = array ();
		$this->load->view ( 'templates/header' );
		$this->load->view ( 'feeds_index' );
		$this->load->view ( 'templates/footer' );
	}
	function carregaanuncios() {
		$this->load->model ( "motor_anuncio" );
		$lista = $this->motor_anuncio->listaTodos ();
		
		$this->load->model ( "tipo_anuncio" );
		
		foreach ( $lista as $motor ) {
			$tipoAnuncio = $this->tipo_anuncio->BuscaTipoAnuncio ( $motor->tan_id );
			$xmlurl = urlencode ( base64_encode ( $motor->man_url_carga ) );
			
			$url = base_url () . $tipoAnuncio->tan_endereco_carga . "/" . $xmlurl;
			
			$this->curl_post_async ( $url, FALSE );
		}
	}
	function curl_post_async($url, $params = array()) {
		$post_params = array ();
		
		foreach ( $params as $key => &$val ) {
			if (is_array ( $val ))
				$val = implode ( ',', $val );
			$post_params [] = $key . '=' . urlencode ( $val );
		}
		$post_string = implode ( '&', $post_params );
		
		$parts = parse_url ( $url );
		
		$fp = fsockopen ( $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 80, $errno, $errstr, 30 );
		
		$out = "POST " . $parts ['path'] . " HTTP/1.1\r\n";
		$out .= "Host: " . $parts ['host'] . "\r\n";
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= "Content-Length: " . strlen ( $post_string ) . "\r\n";
		$out .= "Connection: Close\r\n\r\n";
		if (isset ( $post_string ))
			$out .= $post_string;
		
		fwrite ( $fp, $out );
		fclose ( $fp );
	}
	function imovelXML($xmlFile = FALSE) {
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/imovelXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/imovel.xsd";
		$dom = new DomDocument ();
		var_dump ( base_url () . "assets/xml/imovel.xsd" );
		if (! $dom->load ( $xmlFile ))
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
		if (! $dom->schemaValidate ( $xsd_document ))
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_casa" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			
			$match_data = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$";
			
			$pais = array(
				'ps_id' => 1,
				'ps_descricao' => 'Brasil'
			);
			
			$estado = $this->estado->BuscaEstado($ad->region);
			if ($estado === null) {
				$this->estado->Adiciona(array(
						't_mb_pais_ps_id' => $pais['ps_id'],
						'es_descricao' => $ad->region
				));
				$estado = $this->estado->BuscaEstado($ad->region);
			}
			
			$cidade = $this->cidade->BuscaCiadde($ad->city);
			if ($cidade === null) {
				$this->cidade->Adiciona(array(
					't_mb_estado_es_id' => $estado['es_id'],
					'cd_descricao' => $ad->city
				));
				$cidade = $this->cidade->BuscaCiadde($ad->city);
			}
			
			$propriedade_tipo = $this->tipo_imovel->BuscaTipoImovel($ad->property_type);
			if ($propriedade_tipo === null) {
				$this->tipo_imovel->Adiciona(array(
						'pt_descricao' => $ad->property_type
				));
				$propriedade_tipo = $this->tipo_imovel->BuscaTipoImovel($ad->property_type);
			}
			
			
			$row = array (
					'ac_id_anuncio' => $ad->id,
					'ac_url' => $ad->url,
					'ac_mobile_url' => $ad->url,
					'ac_title' => $ad->title,
					'pct_id' => 1,
					'ac_descricao' => $ad->content,
					'ac_preco' => $ad->price,
					'pt_id' => $propriedade_tipo['pt_id'],
					'pc_endereco' => $ad->address,
					'pc_andar' => $ad->floor_number,
					'pc_bairro' => $ad->city_area,
					'pc_complemento' => $ad->region,
					'cd_id' => $cidade['cd_id'],
					'pc_caixa_postal' => $ad->postcode,
					'pc_latitude' => $ad->latitude,
					'pc_longitude' => $ad->longitude,
					'pc_orientacao' => $ad->orientation,
					'pc_agencia' => $ad->agency,
					'pc_mls_database' => $ad->mis_database,
					'pc_area_terreno' => $ad->floor_area,
					'pc_area_construida' => $ad->plot_area,
					'pc_quartos' => $ad->rooms,
					'pc_banheiros' => $ad->bathrooms,
					'pc_condicao' => $ad->condition,
					'pc_ano' => $ad->year,
					'pc_2D_tour' => $ad->virtual_tour,
					'pc_perc_eco' => $ad->eco_score,
					'pc_data_inclusao' => $ad->date,
					'pc_data_expiracao' => $ad->expiration_date,
					'pc_diretro_proprietario' => $ad->by_owner,
					'pc_garagem' => $ad->parking,
					'pc_finalizado' => $ad->is_furnished,
					'pc_mobiliado' => $ad->foreclosure,
					'pc_novo' => $ad->is_new 
			);
			$lista = $this->anuncio_casa->Adicionar ( $row );
		}
	}
	function autoXML($xmlFile = FALSE) {
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/autoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/auto.xsd";
		$dom = new DomDocument ();
		var_dump ( base_url () . "assets/xml/auto.xsd" );
		if (! $dom->load ( $xmlFile ))
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
		if (! $dom->schemaValidate ( $xsd_document ))
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_auto" );
		
		foreach ( $xmlData as $ad ) {
			$row = array (
					'aa_url' => (string)$ad->url,
					'aa_titulo' => (string)$ad->title,
					'aa_descricao' => (string)$ad->content,
					'aa_url_movel' => (string)$ad,
					'aa_preco' => (string)$ad->price,
					'crt_id' => (string)$ad,
					'aa_revendor' => (string)$ad,
					'cmd_id' => (string)$ad,
					'cmr_id' => (string)$ad,
					'aa_cor' => (string)$ad,
					'aa_ano_modelo' => (string)$ad,
					't_mb_anuncio_autocol' => (string)$ad,
					'ccb_id' => (string)$ad,
					'aa_numero_portas' => (string)$ad,
					'aa_numero_passageiros' => (string)$ad,
					'aa_numero_marchas' => (string)$ad,
					'aa_quilometragem' => (string)$ad,
					'aa_transmissao' => (string)$ad,
					'aa_tamanho_motor' => (string)$ad,
					'aa_potencia' => (string)$ad,
					'aa_num_cilindros' => (string)$ad,
					'aa_consumo_combustivel' => (string)$ad,
					'aa_emi_co2' => (string)$ad,
					'aa_perc_eco' => (string)$ad,
					'aa_novo' => (string)$ad,
					'aa_garantia' => (string)$ad,
					'aa_caixa_postal' => (string)$ad,
					'aa_bairro' => (string)$ad,
					'aa_data_criacao' => (string)$ad,
					'aa_data_expiracao' => (string)$ad,
					't_mb_cidade_cd_id' => (string)$ad,
					't_mb_estado_es_id' => (string)$ad,
					't_mb_pais_ps_id' => (string)$ad 
			);
			$lista = $this->anuncio_casa->Adicionar ( $row );
		}
	}
	
	function empregoXML($xmlFile = FALSE) {
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/empregoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/emprego.xsd";
		$dom = new DomDocument ();
		var_dump ( base_url () . "assets/xml/emprego.xsd" );
		if (! $dom->load ( $xmlFile ))
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
		if (! $dom->schemaValidate ( $xsd_document ))
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_emprego" );
		
		foreach ( $xmlData as $ad ) {
			$row = array (
					'aem_id' => '',
					'aem_titulo' => '',
					'aem_url' => '',
					'aem_descricao' => '',
					'aem_url_movel' => '',
					'aem_caixapostal' => '',
					'ps_id' => '',
					'es_id' => '',
					'cd_id' => '',
					'aem_bairro' => '',
					'aem_experiencia' => '',
					'aem_requisitos' => '',
					'aem_escolaridade' => '',
					'aem_salario' => '',
					'emp_id' => '',
					'aem_trabalhoexterno' => '',
					'emc_id' => '',
					'ect_id' => '',
					'aem_empresa' => '',
					'aem_data_criacao' => '',
					'aem_data_expiracao' => '' 
			);
			$lista = $this->anuncio_emprego->Adicionar ( $row );
		}
	}
	
	function produtoXML($xmlFile = FALSE) {
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/produtoXML" ) );
			return;
		}
	
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/produto.xsd";
		$dom = new DomDocument ();
		var_dump ( base_url () . "assets/xml/auto.xsd" );
		if (! $dom->load ( $xmlFile ))
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
		if (! $dom->schemaValidate ( $xsd_document ))
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
	
		$xmlData = simplexml_load_file ( $xmlFile );
	
		$this->load->model ( "anuncio_produto" );
	
		foreach ( $xmlData as $ad ) {
			$row = array (
					'apr_id' => '', 'apr_titulo' => '', 'apr_url' => '', 'apr_descricao' => '', 'apr_url_movel' => '', 't_mb_anuncio_produtocol' => '', 'prc_id' => '', 'apr_preco' => '', 'apr_taxa_envio' => '', 'apr_marca' => '', 'apr_modelo' => '', 'apr_caixapostal' => '', 'cd_id' => '', 'es_id' => '', 'ps_id' => '', 'apr_Endereco' => '', 'apr_bairro' => '', 'apr_data_criacao' => '', 'apr_data_expiracao' => ''
			);
			$lista = $this->anuncio_produto->Adicionar ( $row );
		}
	}

	function temporadaXML($xmlFile = FALSE) {
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/temporadaXML" ) );
			return;
		}
	
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/temporada.xsd";
		$dom = new DomDocument ();
		var_dump ( base_url () . "assets/xml/temporada.xsd" );
		if (! $dom->load ( $xmlFile ))
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
		if (! $dom->schemaValidate ( $xsd_document ))
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
	
		$xmlData = simplexml_load_file ( $xmlFile );
	
		$this->load->model ( "anuncio_temporada" );
	
		foreach ( $xmlData as $ad ) {
			$row = array (
					'apr_id, apr_titulo, apr_url, apr_descricao, apr_url_movel, t_mb_anuncio_produtocol, prc_id, apr_preco, apr_taxa_envio, apr_marca, apr_modelo, apr_caixapostal, cd_id, es_id, ps_id, apr_Endereco, apr_bairro, apr_data_criacao, apr_data_expiracao' => ''
			);
			$lista = $this->anuncio_temporada->Adicionar ( $row );
		}
	}
}