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
		$this->load->model ( "tipo_anuncio" );
		
		$lista = $this->motor_anuncio->BuscaTodos ();
		
		if ($lista != FALSE) {
			foreach ( $lista as $motor ) {
				$tipoAnuncio = $this->tipo_anuncio->BuscaTipoAnuncio ( $motor->tan_id );
				$xmlurl = urlencode ( base64_encode ( $motor->man_url_carga ) );
				
				$url = $tipoAnuncio [0]->tan_endereco_carga . "/" . $xmlurl;
				var_dump ( $url );
				// this->curl_post_async ( $url, FALSE );
			}
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
		set_time_limit ( 0 );
		
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/imovelXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/imovel.xsd";
		$dom = new DomDocument ();
		
		if (! @$dom->load ( $xmlFile )) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		if (! @$dom->schemaValidate ( $xsd_document )) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			die ( 'XML file did not validate against schema: ' . $xsd_document );
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_casa" );
		$this->load->model ( "anuncio_casa_fotos" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "anuncio_casa_tipo" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			
			$match_data = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$";
			
			$pais = array (
					'ps_id' => 1,
					'ps_descricao' => 'Brasil' 
			);
			
			$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			if ($estado === FALSE) {
				$this->estado->Adicionar ( array (
						'es_id' => NULL,
						't_mb_pais_ps_id' => $pais ['ps_id'],
						'es_descricao' => mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) 
				) );
				$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			}
			
			$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			if ($cidade === FALSE) {
				$this->cidade->Adicionar ( array (
						't_mb_estado_es_id' => $estado [0]->es_id,
						'cd_descricao' => mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) 
				) );
				$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			}
			
			$propriedade_tipo = $this->tipo_imovel->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
			if ($propriedade_tipo === FALSE) {
				$this->tipo_imovel->Adicionar ( array (
						'pt_descricao' => mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) 
				) );
				$propriedade_tipo = $this->tipo_imovel->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
			}
			
			$anuncio_casa_tipo = $this->anuncio_casa_tipo->BuscaAnuncioCasaTipo ( mb_convert_encoding ( $ad->type, 'ISO-8859-1', 'auto' ) );
			if ($anuncio_casa_tipo === FALSE) {
				$this->anuncio_casa_tipo->Adicionar ( array (
						'pct_descricao' => mb_convert_encoding ( $ad->type, 'ISO-8859-1', 'auto' ) 
				) );
				$anuncio_casa_tipo = $this->anuncio_casa_tipo->BuscaAnuncioCasaTipo ( mb_convert_encoding ( $ad->type, 'ISO-8859-1', 'auto' ) );
			}
			
			$data_inclusao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$data_expiracao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$row = array (
					'ac_id_anuncio' => mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ),
					'ac_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'ac_mobile_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'ac_title' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'pct_id' => ( string ) $anuncio_casa_tipo [0]->pct_id,
					'ac_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'ac_preco' => mb_convert_encoding ( $ad->price, 'ISO-8859-1', 'auto' ),
					'pt_id' => ( string ) $propriedade_tipo [0]->pt_id,
					'ac_endereco' => mb_convert_encoding ( $ad->address, 'ISO-8859-1', 'auto' ),
					'ac_andar' => mb_convert_encoding ( $ad->floor_number, 'ISO-8859-1', 'auto' ),
					'ac_bairro' => mb_convert_encoding ( $ad->city_area, 'ISO-8859-1', 'auto' ),
					'ac_complemento' => mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ),
					'cd_id' => ( string ) $cidade [0]->cd_id,
					'es_id' => ( string ) $estado [0]->es_id,
					'ps_id' => ( string ) $pais ['ps_id'],
					'ac_caixa_postal' => mb_convert_encoding ( $ad->postcode, 'ISO-8859-1', 'auto' ),
					'ac_latitude' => mb_convert_encoding ( $ad->latitude, 'ISO-8859-1', 'auto' ),
					'ac_longitude' => mb_convert_encoding ( $ad->longitude, 'ISO-8859-1', 'auto' ),
					'ac_orientacao' => mb_convert_encoding ( $ad->orientation, 'ISO-8859-1', 'auto' ),
					'ac_agencia' => mb_convert_encoding ( $ad->agency, 'ISO-8859-1', 'auto' ),
					'ac_mls_database' => mb_convert_encoding ( $ad->mis_database, 'ISO-8859-1', 'auto' ),
					'ac_area_terreno' => mb_convert_encoding ( $ad->floor_area, 'ISO-8859-1', 'auto' ),
					'ac_area_construida' => mb_convert_encoding ( $ad->plot_area, 'ISO-8859-1', 'auto' ),
					'ac_quartos' => mb_convert_encoding ( $ad->rooms, 'ISO-8859-1', 'auto' ),
					'ac_banheiros' => mb_convert_encoding ( $ad->bathrooms, 'ISO-8859-1', 'auto' ),
					'ac_condicao' => mb_convert_encoding ( $ad->condition, 'ISO-8859-1', 'auto' ),
					'ac_ano' => mb_convert_encoding ( $ad->year, 'ISO-8859-1', 'auto' ),
					'ac_2D_tour' => mb_convert_encoding ( $ad->virtual_tour, 'ISO-8859-1', 'auto' ),
					'ac_perc_eco' => mb_convert_encoding ( $ad->eco_score, 'ISO-8859-1', 'auto' ),
					'ac_data_inclusao' => $data_inclusao->format ( "Y-m-d H:i:s" ),
					'ac_data_expiracao' => $data_expiracao->format ( "Y-m-d H:i:s" ),
					'ac_diretro_proprietario' => mb_convert_encoding ( $ad->by_owner, 'ISO-8859-1', 'auto' ),
					'ac_garagem' => mb_convert_encoding ( $ad->parking, 'ISO-8859-1', 'auto' ),
					'ac_finalizado' => mb_convert_encoding ( $ad->is_furnished, 'ISO-8859-1', 'auto' ),
					'ac_mobiliado' => mb_convert_encoding ( $ad->foreclosure, 'ISO-8859-1', 'auto' ),
					'ac_novo' => mb_convert_encoding ( $ad->is_new, 'ISO-8859-1', 'auto' ),
					'tan_id' => 1
			);
			$anuncio_casa = $this->anuncio_casa->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_casa === FALSE) {
				$anuncio_casa_id = $this->anuncio_casa->Adicionar ( $row );
				
				foreach ( $ad->pictures->picture as $picture ) {
					$row = array (
							'acf_titulo' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'acf_url' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'ac_id' => ( string ) $anuncio_casa_id 
					);
					$this->anuncio_casa_fotos->Adicionar ( $row );
				}
			} else {
				$this->anuncio_casa->Alterar ( $row, ( string ) $anuncio_casa [0]->ac_id );
			}
		}
	}
	function autoXML($xmlFile = FALSE) {
		set_time_limit ( 0 );
		
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/autoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/auto.xsd";
		$dom = new DomDocument ();
		
		if (! @$dom->load ( $xmlFile )) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		if (! @$dom->schemaValidate ( $xsd_document )) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			die ( 'XML file did not validate against schema: ' . $xsd_document );
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_auto" );
		$this->load->model ( "anuncio_auto_fotos" );
		$this->load->model ( "carro_tipo" );
		$this->load->model ( "carro_marca" );
		$this->load->model ( "carro_modelo" );
		$this->load->model ( "carro_combustivel" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			
			$pais = array (
					'ps_id' => 1,
					'ps_descricao' => 'Brasil' 
			);
			
			$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			if ($estado === FALSE) {
				$this->estado->Adicionar ( array (
						'es_id' => NULL,
						't_mb_pais_ps_id' => $pais ['ps_id'],
						'es_descricao' => mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) 
				) );
				$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			}
			
			$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			if ($cidade === FALSE) {
				$this->cidade->Adicionar ( array (
						't_mb_estado_es_id' => $estado [0]->es_id,
						'cd_descricao' => mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) 
				) );
				$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			}
			
			$carro_tipo = $this->carro_tipo->BuscaCarroTipo ( mb_convert_encoding ( $ad->car_type, 'ISO-8859-1', 'auto' ) );
			if ($carro_tipo === FALSE) {
				$this->carro_tipo->Adicionar ( array (
						'crt_descricao' => mb_convert_encoding ( $ad->car_type, 'ISO-8859-1', 'auto' ) 
				) );
				$carro_tipo = $this->carro_tipo->BuscaCarroTipo ( mb_convert_encoding ( $ad->car_type, 'ISO-8859-1', 'auto' ) );
			}
			
			$carro_marca = $this->carro_marca->BuscaCarroMarca ( mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) );
			if ($carro_marca === FALSE) {
				$this->carro_marca->Adicionar ( array (
						'cmr_descricao' => mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) 
				) );
				$carro_marca = $this->carro_marca->BuscaCarroMarca ( mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) );
			}
			
			$carro_modelo = $this->carro_modelo->BuscaCarroModelo ( mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ) );
			if ($carro_modelo === FALSE) {
				$this->carro_modelo->Adicionar ( array (
						'cmd_descricao' => mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ),
						'cmr_id' => ( string ) $carro_marca [0]->cmr_id 
				) );
				$carro_modelo = $this->carro_modelo->BuscaCarroModelo ( mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ) );
			}
			
			$carro_combustivel = $this->carro_combustivel->BuscaCarroCombustivel ( mb_convert_encoding ( $ad->fuel, 'ISO-8859-1', 'auto' ) );
			if ($carro_combustivel === FALSE) {
				$this->carro_combustivel->Adicionar ( array (
						'ccb_descricao' => mb_convert_encoding ( $ad->fuel, 'ISO-8859-1', 'auto' ) 
				) );
				$carro_combustivel = $this->carro_combustivel->BuscaCarroCombustivel ( mb_convert_encoding ( $ad->fuel, 'ISO-8859-1', 'auto' ) );
			}
			
			$data_inclusao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$data_expiracao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$row = array (
					'aa_anuncio_id' => mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ),
					'aa_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'aa_titulo' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'aa_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'aa_url_movel' => mb_convert_encoding ( $ad->mobile_url, 'ISO-8859-1', 'auto' ),
					'aa_preco' => mb_convert_encoding ( $ad->price, 'ISO-8859-1', 'auto' ),
					'aa_preco_moeda' => mb_convert_encoding ( $ad->price ['currency'], 'ISO-8859-1', 'auto' ),
					'crt_id' => ( string ) $carro_tipo [0]->crt_id,
					'aa_revendor' => mb_convert_encoding ( $ad->dealer, 'ISO-8859-1', 'auto' ),
					'cmr_id' => ( string ) $carro_marca [0]->cmr_id,
					'cmd_id' => ( string ) $carro_modelo [0]->cmd_id,
					'aa_cor' => mb_convert_encoding ( $ad->color, 'ISO-8859-1', 'auto' ),
					'aa_ano_modelo' => mb_convert_encoding ( $ad->year, 'ISO-8859-1', 'auto' ),
					'ccb_id' => ( string ) $carro_combustivel [0]->ccb_id,
					'aa_numero_portas' => mb_convert_encoding ( $ad->doors, 'ISO-8859-1', 'auto' ),
					'aa_numero_passageiros' => mb_convert_encoding ( $ad->seats, 'ISO-8859-1', 'auto' ),
					'aa_numero_marchas' => mb_convert_encoding ( $ad->gears, 'ISO-8859-1', 'auto' ),
					'aa_quilometragem' => mb_convert_encoding ( $ad->mileage, 'ISO-8859-1', 'auto' ),
					'aa_quilometragem_unidade' => mb_convert_encoding ( $ad->mileage ['unit'], 'ISO-8859-1', 'auto' ),
					'aa_transmissao' => mb_convert_encoding ( $ad->transmission, 'ISO-8859-1', 'auto' ),
					'aa_cilindros_motor' => mb_convert_encoding ( $ad->cylinders, 'ISO-8859-1', 'auto' ),
					'aa_cilindrada' => mb_convert_encoding ( $ad->engine_size, 'ISO-8859-1', 'auto' ),
					'aa_cilindrada_unidade' => mb_convert_encoding ( $ad->engine_size ['unit'], 'ISO-8859-1', 'auto' ),
					'aa_potencia' => mb_convert_encoding ( $ad->power, 'ISO-8859-1', 'auto' ),
					'aa_potencia_unidade' => mb_convert_encoding ( $ad->power ['unit'], 'ISO-8859-1', 'auto' ),
					'aa_consumo_combustivel' => mb_convert_encoding ( $ad->fuel_consumption, 'ISO-8859-1', 'auto' ),
					'aa_emi_co2' => mb_convert_encoding ( $ad->co2_emissions, 'ISO-8859-1', 'auto' ),
					'aa_emi_co2_unidade' => mb_convert_encoding ( $ad->co2_emissions ['unit'], 'ISO-8859-1', 'auto' ),
					'aa_eco_score' => mb_convert_encoding ( $ad->eco_score, 'ISO-8859-1', 'auto' ),
					'aa_novo' => mb_convert_encoding ( $ad->is_new, 'ISO-8859-1', 'auto' ),
					'aa_garantia' => mb_convert_encoding ( $ad->warranty, 'ISO-8859-1', 'auto' ),
					'cd_id' => ( string ) $cidade [0]->cd_id,
					'es_id' => ( string ) $estado [0]->es_id,
					'ps_id' => $pais ["ps_id"],
					'aa_caixa_postal' => mb_convert_encoding ( $ad->postcode, 'ISO-8859-1', 'auto' ),
					'aa_bairro' => mb_convert_encoding ( $ad->city_area, 'ISO-8859-1', 'auto' ),
					'aa_data_criacao' => $data_inclusao->format ( "Y-m-d H:i:s" ),
					'aa_data_expiracao' => $data_expiracao->format ( "Y-m-d H:i:s" ) ,
					'tan_id' => 2
			);
			
			$anuncio_auto = $this->anuncio_auto->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_auto === FALSE) {
				$anuncio_auto_id = $this->anuncio_auto->Adicionar ( $row );
				
				foreach ( $ad->pictures->picture as $picture ) {
					$row = array (
							'cft_titulo' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'cft_url' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'aa_id' => ( string ) $anuncio_auto_id 
					);
					$this->anuncio_auto_fotos->Adicionar ( $row );
				}
			} else {
				$this->anuncio_auto->Alterar ( $row, ( string ) $anuncio_auto [0]->aa_id );
			}
		}
	}
	function empregoXML($xmlFile = FALSE) {
		set_time_limit ( 0 );
		
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/empregoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/emprego.xsd";
		$dom = new DomDocument ();
		
		if (! @$dom->load ( $xmlFile )) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		if (! @$dom->schemaValidate ( $xsd_document )) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			die ( 'XML file did not validate against schema: ' . $xsd_document );
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_emprego" );
		$this->load->model ( "emprego_categoria" );
		$this->load->model ( "emprego_contrato" );
		$this->load->model ( "emprego_periodo" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			$pais = array (
					'ps_id' => 1,
					'ps_descricao' => 'Brasil' 
			);
			
			$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			if ($estado === FALSE) {
				$this->estado->Adicionar ( array (
						'es_id' => NULL,
						't_mb_pais_ps_id' => $pais ['ps_id'],
						'es_descricao' => mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) 
				) );
				$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			}
			
			$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			if ($cidade === FALSE) {
				$this->cidade->Adicionar ( array (
						't_mb_estado_es_id' => $estado [0]->es_id,
						'cd_descricao' => mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) 
				) );
				$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			}
			
			$emprego_categoria = $this->emprego_categoria->BuscaPorDescricao ( mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) );
			if ($emprego_categoria === FALSE) {
				$this->emprego_categoria->Adicionar ( array (
						'ect_descricao' => mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) 
				) );
				$emprego_categoria = $this->emprego_categoria->BuscaPorDescricao ( mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) );
			}
			
			$emprego_contrato = $this->emprego_contrato->BuscaPorDescricao ( mb_convert_encoding ( $ad->contract, 'ISO-8859-1', 'auto' ) );
			if ($emprego_contrato === FALSE) {
				$this->emprego_contrato->Adicionar ( array (
						'emc_descricao' => mb_convert_encoding ( $ad->contract, 'ISO-8859-1', 'auto' ) 
				) );
				$emprego_contrato = $this->emprego_contrato->BuscaPorDescricao ( mb_convert_encoding ( $ad->contract, 'ISO-8859-1', 'auto' ) );
			}
			
			$emprego_periodo = $this->emprego_periodo->BuscaPorDescricao ( mb_convert_encoding ( $ad->working_hours, 'ISO-8859-1', 'auto' ) );
			if ($emprego_periodo === FALSE) {
				$this->emprego_periodo->Adicionar ( array (
						'emp_descricao' => mb_convert_encoding ( $ad->working_hours, 'ISO-8859-1', 'auto' ) 
				) );
				$emprego_periodo = $this->emprego_periodo->BuscaPorDescricao ( mb_convert_encoding ( $ad->working_hours, 'ISO-8859-1', 'auto' ) );
			}
			
			$data_inclusao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$data_expiracao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$row = array (
					'aem_anuncio_id' => mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ),
					'aem_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'aem_titulo' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'aem_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'aem_url_movel' => mb_convert_encoding ( $ad->mobile_url, 'ISO-8859-1', 'auto' ),
					'ps_id' => $pais ["ps_id"],
					'cd_id' => ( string ) $cidade [0]->cd_id,
					'aem_bairro' => mb_convert_encoding ( $ad->city_area, 'ISO-8859-1', 'auto' ),
					'es_id' => ( string ) $estado [0]->es_id,
					'aem_caixapostal' => mb_convert_encoding ( $ad->postcode, 'ISO-8859-1', 'auto' ),
					'aem_experiencia' => mb_convert_encoding ( $ad->experience, 'ISO-8859-1', 'auto' ),
					'aem_requisitos' => mb_convert_encoding ( $ad->requirements, 'ISO-8859-1', 'auto' ),
					'aem_escolaridade' => mb_convert_encoding ( $ad->studies, 'ISO-8859-1', 'auto' ),
					'aem_salario' => mb_convert_encoding ( $ad->salary, 'ISO-8859-1', 'auto' ),
					'emp_id' => ( string ) $emprego_periodo [0]->emp_id,
					'aem_trabalhoexterno' => mb_convert_encoding ( $ad->telecommute, 'ISO-8859-1', 'auto' ),
					'emc_id' => ( string ) $emprego_contrato [0]->emc_id,
					'ect_id' => ( string ) $emprego_categoria [0]->ect_id,
					'aem_empresa' => mb_convert_encoding ( $ad->company, 'ISO-8859-1', 'auto' ),
					'aem_data_criacao' => $data_inclusao->format ( "Y-m-d H:i:s" ),
					'aem_data_expiracao' => $data_expiracao->format ( "Y-m-d H:i:s" ),
					'tan_id' => 3
			);
			
			$anuncio_emprego = $this->anuncio_emprego->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_emprego === FALSE) {
				$anuncio_emprego_id = $this->anuncio_emprego->Adicionar ( $row );
			} else {
				$this->anuncio_emprego->Alterar ( $row, ( string ) $anuncio_emprego [0]->aem_id );
			}
		}
	}
	
	function produtoXML($xmlFile = FALSE) {
		set_time_limit ( 0 );
		
		if (! $xmlFile) {
			log_message ( 'error', "xml não enviado" );
			show_404 ( base_url ( "feeds/produtoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/produto.xsd";
		$dom = new DomDocument ();
		
		if (! @$dom->load ( $xmlFile )) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		if (! $dom->schemaValidate ( $xsd_document )) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			die ( 'XML file did not validate against schema: ' . $xsd_document );
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_produto" );
		$this->load->model ( "produto_fotos" );
		$this->load->model ( "produto_categoria" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			$pais = array (
					'ps_id' => 1,
					'ps_descricao' => 'Brasil' 
			);
			
			$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			if ($estado === FALSE) {
				$this->estado->Adicionar ( array (
						'es_id' => NULL,
						't_mb_pais_ps_id' => $pais ['ps_id'],
						'es_descricao' => mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) 
				) );
				$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			}
			
			$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			if ($cidade === FALSE) {
				$this->cidade->Adicionar ( array (
						't_mb_estado_es_id' => $estado [0]->es_id,
						'cd_descricao' => mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) 
				) );
				$cidade = $this->cidade->BuscaCiadde ( mb_convert_encoding ( $ad->city, 'ISO-8859-1', 'auto' ) );
			}
			
			$produto_categoria = $this->produto_categoria->BuscaPorDescricao ( mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) );
			if ($produto_categoria === FALSE) {
				$this->produto_categoria->Adicionar ( array (
						'prc_descricao' => mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) 
				) );
				$produto_categoria = $this->produto_categoria->BuscaPorDescricao ( mb_convert_encoding ( $ad->category, 'ISO-8859-1', 'auto' ) );
			}
			
			$data_inclusao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_inclusao === FALSE) {
				$data_inclusao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$data_expiracao = DateTime::createFromFormat ( "d/m/Y", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "d/m/Y H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			if ($data_expiracao === FALSE) {
				$data_expiracao = DateTime::createFromFormat ( "Y/m/d H:i:s", mb_convert_encoding ( $ad->expiration_date, 'ISO-8859-1', 'auto' ), new DateTimeZone ( "America/Sao_Paulo" ) );
			}
			
			$row = array (
					'apr_anuncio_id' => mb_convert_encoding ( $ad->x, 'ISO-8859-1', 'auto' ),
					'apr_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'apr_titulo' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'apr_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'prc_id' => ( string ) $produto_categoria [0]->prc_id,
					'apr_url_movel' => mb_convert_encoding ( $ad->mobile_url, 'ISO-8859-1', 'auto' ),
					'apr_preco' => mb_convert_encoding ( $ad->price, 'ISO-8859-1', 'auto' ),
					'apr_preco_moeda' => mb_convert_encoding ( $ad->price['currency'], 'ISO-8859-1', 'auto' ),
					'apr_taxa_envio' => mb_convert_encoding ( $ad->shipping_cost, 'ISO-8859-1', 'auto' ),
					'apr_taxa_envio_moeda' => mb_convert_encoding ( $ad->shipping_cost['currency'], 'ISO-8859-1', 'auto' ),
					'apr_marca' => mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ),
					'apr_modelo' => mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ),
					'apr_caixapostal' => mb_convert_encoding ( $ad->postcode, 'ISO-8859-1', 'auto' ),
					'cd_id' => ( string ) $cidade [0]->cd_id,
					'es_id' => ( string ) $estado [0]->es_id,
					'ps_id' => $pais ["ps_id"],
					'apr_Endereco' => mb_convert_encoding ( $ad->address, 'ISO-8859-1', 'auto' ),
					'apr_bairro' => mb_convert_encoding ( $ad->city_area, 'ISO-8859-1', 'auto' ),
					'apr_data_criacao' => $data_inclusao ? $data_inclusao->format ( "Y-m-d H:i:s" ) : null,
					'apr_data_expiracao' => $data_expiracao ? $data_expiracao->format ( "Y-m-d H:i:s" ) : null,
					'tan_id' => 4 
			);
			
			$anuncio_produto = $this->anuncio_produto->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
				
			if ($anuncio_produto === FALSE) {
				$anuncio_produto_id = $this->anuncio_produto->Adicionar ( $row );

				foreach ( $ad->pictures->picture as $picture ) {
					$row = array (
							'prf_titulo' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'prf_url' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'apr_id' => ( string ) $anuncio_produto_id
					);
					$this->produto_fotos->Adicionar ( $row );
				}
			} else {
				$this->anuncio_produto->Alterar ( $row, ( string ) $anuncio_produto [0]->apr_id );
			}
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