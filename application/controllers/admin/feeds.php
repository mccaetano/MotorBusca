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
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		$this->load->model ( "motor_anuncio" );
		$this->load->model ( "tipo_anuncio" );
		log_message('info', 'iniciando carga de anuncios');
		$lista = $this->motor_anuncio->BuscaTodos ();
		
		if ($lista != FALSE) {
			foreach ( $lista as $motor ) {
				$tipoAnuncio = $this->tipo_anuncio->BuscaTipoAnuncio ( $motor->tan_id );
				log_message('info', 'Carregando(' . $motor->tan_id . '): ' . $motor->man_url_carga);
				$xmlurl = urlencode ( base64_encode ( $motor->man_url_carga ) );
				
				$url = base_url () . $tipoAnuncio [0]->tan_endereco_carga . $motor->man_id . '/' . $xmlurl;
				
				$this->curl_post_async ( $url, FALSE );
			}
		}
		$data = array(
				'ativo' => 'feeds',
				'log_path' => $this->config->item ( 'log_path' ) == '' ? 'application/logs/' : $this->config->item ( 'log_path' ),
				'user' => $user
		);
		redirect(base_url() . "admin/logs/view");
		
	}
	function curl_post_async($url, $params = array()) {
		$post_params = array ();
		if ($params) {
			foreach ( $params as $key => &$val ) {
				if (is_array ( $val ))
					$val = implode ( ',', $val );
				$post_params [] = $key . '=' . urlencode ( $val );
			}
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
	function imovelXML($id = FALSE, $xmlFile = FALSE) {
		set_time_limit ( 0 );
		log_message('info', 'Carregando imoveis para: ' . base64_decode ( urldecode ( $xmlFile ) ));
		
		if (! $xmlFile) {
			log_message ( 'error', "xml n�o enviado" );
			show_404 ( base_url ( "feeds/imovelXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/imovel.xsd";
		$dom = new DomDocument ();
		
		try {
			$dom->load ( $xmlFile );
		} catch (Exception $e) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			log_message ( 'error', $e->getMessage() );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		
		try {
			if (!@$dom->schemaValidate ( $xsd_document )) {
				log_message ( 'error', 'XML file did not validate against schema: ' . $xmlFile );
				$errors = libxml_get_errors();
				foreach ($errors as $error) {
					log_message ( 'error', libxml_display_error($error));
				}
				libxml_clear_errors();
			}
		} catch (Exception $e) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			log_message ( 'error', $e->getMessage() );
			die ( 'XML file did not validate against schema: ' . $xsd_document . "/ " . $e->getMessage());
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_casa" );
		$this->load->model ( "anuncio_casa_fotos" );
		$this->load->model ( "propriedade_tipo" );
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
			
			$propriedade_tipo = $this->propriedade_tipo->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
			if ($propriedade_tipo === FALSE) {
				$this->propriedade_tipo->Adicionar ( array (
						'pt_descricao' => mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) 
				) );
				$propriedade_tipo = $this->propriedade_tipo->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
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
					'ac_data_inclusao' => $data_inclusao ? $data_inclusao->format ( "Y-m-d H:i:s" ) : null,
					'ac_data_expiracao' => $data_expiracao ? $data_expiracao->format ( "Y-m-d H:i:s" ) : null,
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
							'acf_titulo' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'acf_url' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'ac_id' => ( string ) $anuncio_casa_id 
					);
					$this->anuncio_casa_fotos->Adicionar ( $row );
				}
			} else {
				$this->anuncio_casa->Alterar ( $row, ( string ) $anuncio_casa [0]->ac_id );
			}
		}		
		$this->load->model ('motor_anuncio');
		$this->motor_anuncio->SetarDataExecucao($id);
		log_message('info', 'Termino imoveis para: ' . $xmlFile);
	}
	function autoXML($id = FALSE, $xmlFile = FALSE) {
		set_time_limit ( 0 );
		log_message('info', 'Carregando autos para' . base64_decode ( urldecode ( $xmlFile ) ));
		
		if (! $xmlFile) {
			log_message ( 'error', "xml n�o enviado" );
			show_404 ( base_url ( "feeds/autoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/auto.xsd";
		$dom = new DomDocument ();
		
		try {
			$dom->load ( $xmlFile );
		} catch (Exception $e) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			log_message ( 'error', $e->getMessage() );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		
		try {
			if (!@$dom->schemaValidate ( $xsd_document )) {
				log_message ( 'error', 'XML file did not validate against schema: ' . $xmlFile );
				$errors = libxml_get_errors();
				foreach ($errors as $error) {
					log_message ( 'error', libxml_display_error($error));
				}
				libxml_clear_errors();
			}
		} catch (Exception $e) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			log_message ( 'error', $e->getMessage() );
			die ( 'XML file did not validate against schema: ' . $xsd_document . "/ " . $e->getMessage());
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
					'aa_data_criacao' => $data_inclusao == FALSE ? null : $data_inclusao->format ( "Y-m-d H:i:s" ),
					'aa_data_expiracao' => $data_expiracao == FALSE ? null : $data_expiracao->format ( "Y-m-d H:i:s" ),
					'tan_id' => 2 
			);
			
			$anuncio_auto = $this->anuncio_auto->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_auto === FALSE) {
				$anuncio_auto_id = $this->anuncio_auto->Adicionar ( $row );
				
				if ($ad->pictures != null) {
					foreach ( $ad->pictures->picture as $picture ) {
						$row = array (
								'cft_titulo' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
								'cft_url' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
								'aa_id' => ( string ) $anuncio_auto_id 
						);
						$this->anuncio_auto_fotos->Adicionar ( $row );
					}
				}
			} else {
				$this->anuncio_auto->Alterar ( $row, ( string ) $anuncio_auto [0]->aa_id );
			}
		}		
		$this->load->model ('motor_anuncio');
		$this->motor_anuncio->SetarDataExecucao($id);
		log_message('info', 'Termino auto para: ' . $xmlFile );
	}
	function empregoXML($id = FALSE, $xmlFile = FALSE) {
		set_time_limit ( 0 );
		log_message('info', 'Carregando empregos para' . base64_decode ( urldecode ( $xmlFile ) ));
		
		if (! $xmlFile) {
			log_message ( 'error', "xml n�o enviado" );
			show_404 ( base_url ( "feeds/empregoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/emprego.xsd";
		$dom = new DomDocument ();
		
		try {
			$dom->load ( $xmlFile );
		} catch (Exception $e) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			log_message ( 'error', $e->getMessage() );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		
		try {
			if (!@$dom->schemaValidate ( $xsd_document )) {
				log_message ( 'error', 'XML file did not validate against schema: ' . $xmlFile );
				$errors = libxml_get_errors();
				foreach ($errors as $error) {
					log_message ( 'error', libxml_display_error($error));
				}
				libxml_clear_errors();
			}
		} catch (Exception $e) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			log_message ( 'error', $e->getMessage() );
			die ( 'XML file did not validate against schema: ' . $xsd_document . "/ " . $e->getMessage());
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
					'aem_data_criacao' => $data_inclusao ? $data_inclusao->format ( "Y-m-d H:i:s" ) : null,
					'aem_data_expiracao' => $data_expiracao ? $data_expiracao->format ( "Y-m-d H:i:s" ) : null,
					'tan_id' => 3 
			);
			
			$anuncio_emprego = $this->anuncio_emprego->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_emprego === FALSE) {
				$anuncio_emprego_id = $this->anuncio_emprego->Adicionar ( $row );
			} else {
				$this->anuncio_emprego->Alterar ( $row, ( string ) $anuncio_emprego [0]->aem_id );
			}
		}		
		$this->load->model ('motor_anuncio');
		$this->motor_anuncio->SetarDataExecucao($id);
		log_message('info', 'Termino Emprego para: ' . $xmlFile);
	}
	function produtoXML($id = FALSE, $xmlFile = FALSE) {
		set_time_limit ( 0 );
		log_message('info', 'Carregando produtos para' . base64_decode ( urldecode ( $xmlFile ) ));
		
		if (! $xmlFile) {
			log_message ( 'error', "xml n�o enviado" );
			show_404 ( base_url ( "feeds/produtoXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/produto.xsd";
		$dom = new DomDocument ();
		
		try {
			$dom->load ( $xmlFile );
		} catch (Exception $e) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			log_message ( 'error', $e->getMessage() );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		
		try {
			if (!@$dom->schemaValidate ( $xsd_document )) {
				log_message ( 'error', 'XML file did not validate against schema: ' . $xmlFile );
				$errors = libxml_get_errors();
				foreach ($errors as $error) {
					log_message ( 'error', libxml_display_error($error));
				}
				libxml_clear_errors();
			}
		} catch (Exception $e) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			log_message ( 'error', $e->getMessage() );
			die ( 'XML file did not validate against schema: ' . $xsd_document . "/ " . $e->getMessage());
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_produto" );
		$this->load->model ( "produto_fotos" );
		$this->load->model ( "produto_categoria" );
		$this->load->model ( "produto_marca" );
		$this->load->model ( "produto_modelo" );
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
			
			$produto_marca = $this->produto_marca->BuscaPorDescricao ( mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) );
			if ($produto_marca === FALSE) {
				$pmr_id = $this->produto_marca->Adicionar ( array (
						'pmr_descricao' => mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) 
				) );
				$produto_marca = $this->produto_marca->BuscaPorDescricao ( mb_convert_encoding ( $ad->make, 'ISO-8859-1', 'auto' ) );
			} else {				
				$pmr_id = $produto_marca[0]->pmr-id;
			}
			
			$produto_modelo = $this->produto_modelo->BuscaPorDescricao ( mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ) );
			if ($produto_modelo === FALSE) {
				$this->produto_modelo->Adicionar ( array (
						'pmd_descricao' => mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ) ,
						'pmr_id' => $pmr_id
				) );
				$produto_modelo = $this->produto_modelo->BuscaPorDescricao ( mb_convert_encoding ( $ad->model, 'ISO-8859-1', 'auto' ) );
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
					'apr_anuncio_id' => mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ),
					'apr_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'apr_titulo' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'apr_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'prc_id' => ( string ) $produto_categoria [0]->prc_id,
					'apr_url_movel' => mb_convert_encoding ( $ad->mobile_url, 'ISO-8859-1', 'auto' ),
					'apr_preco' => mb_convert_encoding ( $ad->price, 'ISO-8859-1', 'auto' ),
					'apr_preco_moeda' => mb_convert_encoding ( $ad->price ['currency'], 'ISO-8859-1', 'auto' ),
					'apr_taxa_envio' => mb_convert_encoding ( $ad->shipping_cost, 'ISO-8859-1', 'auto' ),
					'apr_taxa_envio_moeda' => mb_convert_encoding ( $ad->shipping_cost ['currency'], 'ISO-8859-1', 'auto' ),
					'pmr_id' => ( string ) $produto_marca [0]->pmr_id,
					'pmd_id' => ( string ) $produto_modelo [0]->pmd_id,
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
							'prf_titulo' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'prf_url' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'apr_id' => ( string ) $anuncio_produto_id 
					);
					$this->produto_fotos->Adicionar ( $row );
				}
			} else {
				$this->anuncio_produto->Alterar ( $row, ( string ) $anuncio_produto [0]->apr_id );
			}
		}		
		$this->load->model ('motor_anuncio');
		$this->motor_anuncio->SetarDataExecucao($id);
		log_message('info', 'Termino Produto para: ' . $xmlFile);
	}
	function temporadaXML($id = FALSE, $xmlFile = FALSE) {
		set_time_limit ( 0 );
		log_message('info', 'Carregando temporadas para' . base64_decode ( urldecode ( $xmlFile ) ));
		
		if (! $xmlFile) {
			log_message ( 'error', "xml n�o enviado" );
			show_404 ( base_url ( "feeds/temporadaXML" ) );
			return;
		}
		
		$xmlFile = base64_decode ( urldecode ( $xmlFile ) );
		$xsd_document = base_url () . "assets/xml/temporada.xsd";
		$dom = new DomDocument ();
		
		try {
			$dom->load ( $xmlFile );
		} catch (Exception $e) {
			log_message ( 'error', 'Could not load XML file: ' . $xmlFile );
			log_message ( 'error', $e->getMessage() );
			die ( 'Could not load XML file: ' . $xmlFile );
		}
		
		try {
			if (!@$dom->schemaValidate ( $xsd_document )) {
				log_message ( 'error', 'XML file did not validate against schema: ' . $xmlFile );
				$errors = libxml_get_errors();
				foreach ($errors as $error) {
					log_message ( 'error', libxml_display_error($error));
				}
				libxml_clear_errors();
			}
		} catch (Exception $e) {
			log_message ( 'error', 'XML file did not validate against schema: ' . $xsd_document );
			log_message ( 'error', $e->getMessage() );
			die ( 'XML file did not validate against schema: ' . $xsd_document . "/ " . $e->getMessage());
		}
		
		$xmlData = simplexml_load_file ( $xmlFile );
		
		$this->load->model ( "anuncio_temporada" );
		$this->load->model ( "temporada_fotos" );
		$this->load->model ( "tipo_imovel" );
		$this->load->model ( "temporada_disponibilidade" );
		$this->load->model ( "temporada_comentarios" );
		$this->load->model ( "estado" );
		$this->load->model ( "pais" );
		$this->load->model ( "cidade" );
		
		foreach ( $xmlData as $ad ) {
			$pais = $this->pais->BuscaPais ( mb_convert_encoding ( $ad->country, 'ISO-8859-1', 'auto' ) );
			if ($pais === FALSE) {
				$this->pais->Adicionar ( array (
						'ps_descricao' => mb_convert_encoding ( $ad->country, 'ISO-8859-1', 'auto' ) 
				) );
				$pais = $this->pais->BuscaPais ( mb_convert_encoding ( $ad->country, 'ISO-8859-1', 'auto' ) );
			}
			
			$estado = $this->estado->BuscaEstado ( mb_convert_encoding ( $ad->region, 'ISO-8859-1', 'auto' ) );
			if ($estado === FALSE) {
				$this->estado->Adicionar ( array (
						'es_id' => NULL,
						't_mb_pais_ps_id' => $pais [0]->ps_id,
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
			
			$tipo_imovel = $this->tipo_imovel->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
			if ($tipo_imovel === FALSE) {
				$this->tipo_imovel->Adicionar ( array (
						'tpi_descricao' => mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) 
				) );
				$tipo_imovel = $this->tipo_imovel->BuscaTipoImovel ( mb_convert_encoding ( $ad->property_type, 'ISO-8859-1', 'auto' ) );
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
					'atm_anuncio_id' => mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ),
					'ps_id' => $pais[0]->ps_id,
					'atm_url' => mb_convert_encoding ( $ad->url, 'ISO-8859-1', 'auto' ),
					'atm_titulo' => mb_convert_encoding ( $ad->title, 'ISO-8859-1', 'auto' ),
					'atm_descricao' => mb_convert_encoding ( $ad->content, 'ISO-8859-1', 'auto' ),
					'atm_url_movel' => mb_convert_encoding ( $ad->mobile_url, 'ISO-8859-1', 'auto' ),
					'tpi_id' => $tipo_imovel[0]->tpi_id,
					'atm_atividades' => mb_convert_encoding ( $ad->activitie, 'ISO-8859-1', 'auto' ),
					'atm_transporte' => mb_convert_encoding ( $ad->transport_information, 'ISO-8859-1', 'auto' ),
					'atm_distancia_praia' => mb_convert_encoding ( $ad->distance_to->beach, 'ISO-8859-1', 'auto' ),
					'atm_distnacia_praia_unidade' => mb_convert_encoding ( $ad->distance_to->beach['meters'], 'ISO-8859-1', 'auto' ),
					'atm_distancia_centro' => mb_convert_encoding ( $ad->distance_to->center, 'ISO-8859-1', 'auto' ),
					'atm_distancia_centro_unidade' => mb_convert_encoding ( $ad->distance_to->center['meters'], 'ISO-8859-1', 'auto' ),
					'atm_descricao_regiao' => mb_convert_encoding ( $ad->zone_information, 'ISO-8859-1', 'auto' ),
					'atm_endereco' => mb_convert_encoding ( $ad->address, 'ISO-8859-1', 'auto' ),
					'atm_bairro' => mb_convert_encoding ( $ad->neighborhood, 'ISO-8859-1', 'auto' ),
					'atm_area_local' => mb_convert_encoding ( $ad->city_area, 'ISO-8859-1', 'auto' ),
					'cd_id' => $cidade[0]->cd_id,
					'es_id' => $estado[0]->es_id,
					'atm_cep' => mb_convert_encoding ( $ad->postcode, 'ISO-8859-1', 'auto' ),
					'atm_zona_turistica' => mb_convert_encoding ( $ad->zone, 'ISO-8859-1', 'auto' ),
					'atm_latitude' => mb_convert_encoding ( $ad->latitude, 'ISO-8859-1', 'auto' ),
					'atm_longitude' => mb_convert_encoding ( $ad->longitude, 'ISO-8859-1', 'auto' ),
					'atm_orientacao' => mb_convert_encoding ( $ad->orientation, 'ISO-8859-1', 'auto' ),
					'atm_agencia' => mb_convert_encoding ( $ad->agency, 'ISO-8859-1', 'auto' ),
					'atm_contato_nome' => mb_convert_encoding ( $ad->contact_name, 'ISO-8859-1', 'auto' ),
					'atm_contato_email' => mb_convert_encoding ( $ad->contact_email, 'ISO-8859-1', 'auto' ),
					'atm_contato_telefone' => mb_convert_encoding ( $ad->contact_telephone, 'ISO-8859-1', 'auto' ),
					'atm_preco_periodo' => mb_convert_encoding ( $ad->rate['period'], 'ISO-8859-1', 'auto' ),
					'atm_preco_alta' => mb_convert_encoding ( $ad->rate->high_season, 'ISO-8859-1', 'auto' ),
					'atm_preco_baixa' => mb_convert_encoding ( $ad->rate->low_season, 'ISO-8859-1', 'auto' ),
					'atm_preco_media' => mb_convert_encoding ( $ad->rate->mid_season, 'ISO-8859-1', 'auto' ),
					'atm_preco_moeda' => mb_convert_encoding ( $ad->rate['currency'], 'ISO-8859-1', 'auto' ),
					'atm_cuto_extra' => mb_convert_encoding ( $ad->extra_charges, 'ISO-8859-1', 'auto' ),
					'atm_formas_pagamento' => mb_convert_encoding ( $ad->payment_information, 'ISO-8859-1', 'auto' ),
					'atm_url_reserva' => mb_convert_encoding ( $ad->booking_url, 'ISO-8859-1', 'auto' ),
					'atm_dia_entrada' => mb_convert_encoding ( $ad->check_in_week_day, 'ISO-8859-1', 'auto' ),
					'atm_hora_entrada' => mb_convert_encoding ( $ad->check_in_time, 'ISO-8859-1', 'auto' ),
					'atm_hora_saida' => mb_convert_encoding ( $ad->check_out_time, 'ISO-8859-1', 'auto' ),
					'atm_tempo_maximo' => mb_convert_encoding ( $ad->minimum_stay, 'ISO-8859-1', 'auto' ),
					'atm_pessoas_maximo' => mb_convert_encoding ( $ad->max_people, 'ISO-8859-1', 'auto' ),
					'atm_area_construida' => mb_convert_encoding ( $ad->floor_area, 'ISO-8859-1', 'auto' ),
					'atm_area_contruida_unidade' => mb_convert_encoding ( $ad->floor_area['unit'], 'ISO-8859-1', 'auto' ),
					'atm_area_terreno' => mb_convert_encoding ( $ad->plot_area, 'ISO-8859-1', 'auto' ),
					'atm_area_terreno_unidade' => mb_convert_encoding ( $ad->plot_area['unit'], 'ISO-8859-1', 'auto' ),
					'atm_numero_comodos' => mb_convert_encoding ( $ad->rooms, 'ISO-8859-1', 'auto' ),
					'atm_numero_quartos' => mb_convert_encoding ( $ad->bedrooms, 'ISO-8859-1', 'auto' ),
					'atm_numero_banheiro' => mb_convert_encoding ( $ad->bathrooms, 'ISO-8859-1', 'auto' ),
					'atm_num_cama_casal' => mb_convert_encoding ( $ad->double_bed, 'ISO-8859-1', 'auto' ),
					'atm_num_cama_solteiro' => mb_convert_encoding ( $ad->single_bed, 'ISO-8859-1', 'auto' ),
					'atm_num_sofa_cama' => mb_convert_encoding ( $ad->sofa_bed, 'ISO-8859-1', 'auto' ),
					'atm_data' => $data_inclusao ? $data_inclusao->format ( "Y-m-d H:i:s" ) : null,
					'atm_data_expiracao' => $data_expiracao ? $data_expiracao->format ( "Y-m-d H:i:s" ) : null,
					'atm_anuncio_particular' => mb_convert_encoding ( $ad->by_owner, 'ISO-8859-1', 'auto' ),
					'atm_servico_limpeza' => mb_convert_encoding ( $ad->cleaning_service, 'ISO-8859-1', 'auto' ),
					'atm_alojamento_completo' => mb_convert_encoding ( $ad->complete_rental, 'ISO-8859-1', 'auto' ),
					'atm_suporte_GLS' => mb_convert_encoding ( $ad->gay_friendly, 'ISO-8859-1', 'auto' ),
					'atm_reserva_online' => mb_convert_encoding ( $ad->online_reservation, 'ISO-8859-1', 'auto' ),
					'atm_area_fumantes' => mb_convert_encoding ( $ad->smoking, 'ISO-8859-1', 'auto' ),
					'atm_churrasqueira' => mb_convert_encoding ( $ad->barbecue, 'ISO-8859-1', 'auto' ),
					'atm_roupa_cama' => mb_convert_encoding ( $ad->bed_linen, 'ISO-8859-1', 'auto' ),
					'atm_ar_condicionado' => mb_convert_encoding ( $ad->air_conditioning, 'ISO-8859-1', 'auto' ),
					'atm_aquecedor' => mb_convert_encoding ( $ad->central_heating, 'ISO-8859-1', 'auto' ),
					'atm_playground' => mb_convert_encoding ( $ad->children_play_area, 'ISO-8859-1', 'auto' ),
					'atm_cafeteria' => mb_convert_encoding ( $ad->coffee_maker, 'ISO-8859-1', 'auto' ),
					'atm_utensilios_cozinha' => mb_convert_encoding ( $ad->cooking_utensils, 'ISO-8859-1', 'auto' ),
					'atm_berco' => mb_convert_encoding ( $ad->cot, 'ISO-8859-1', 'auto' ),
					'atm_lavaloucas' => mb_convert_encoding ( $ad->dishwasher, 'ISO-8859-1', 'auto' ),
					'atm_secadora' => mb_convert_encoding ( $ad->dryer, 'ISO-8859-1', 'auto' ),
					'atm_dvd' => mb_convert_encoding ( $ad->dvd, 'ISO-8859-1', 'auto' ),
					'atm_ventilador' => mb_convert_encoding ( $ad->fan, 'ISO-8859-1', 'auto' ),
					'atm_chamine' => mb_convert_encoding ( $ad->fireplace, 'ISO-8859-1', 'auto' ),
					'atm_academia_ginatica' => mb_convert_encoding ( $ad->gym, 'ISO-8859-1', 'auto' ),
					'tan_id' => 5 
			);
			
			$anuncio_temporada = $this->anuncio_temporada->BuscaPorAnuncioID ( mb_convert_encoding ( $ad->id, 'ISO-8859-1', 'auto' ) );
			
			if ($anuncio_temporada === FALSE) {
				$anuncio_temporada_id = $this->anuncio_temporada->Adicionar ( $row );
				
				foreach ( $ad->pictures->picture as $picture ) {
					$row = array (
							'tft_titulo' => mb_convert_encoding ( $picture->picture_title, 'ISO-8859-1', 'auto' ),
							'tft_url' => mb_convert_encoding ( $picture->picture_url, 'ISO-8859-1', 'auto' ),
							'atm_id' => ( string ) $anuncio_temporada_id 
					);
					$this->temporada_fotos->Adicionar ( $row );
				}
				
				foreach ( $ad->availability->month as $dips ) {
					$row = array (
							'tds_mes' => mb_convert_encoding ( $dips['value'], 'ISO-8859-1', 'auto' ),
							'tds_valor' => mb_convert_encoding ( $dips, 'ISO-8859-1', 'auto' ),
							'tds_ano' => mb_convert_encoding ( $dips['year'], 'ISO-8859-1', 'auto' ),
							'atm_id' => ( string ) $anuncio_temporada_id
					);
					$this->temporada_disponibilidade->Adicionar ( $row );
				}
				
				foreach ( $ad->comments->comment as $coment ) {
					$row = array (
							'atm_id' => ( string ) $anuncio_temporada_id,
							'tcm_titulo' => mb_convert_encoding ((string) $coment->comment_title, 'ISO-8859-1', 'auto' ),
							'tcm_descricao' => mb_convert_encoding ((string) $coment->comment_description, 'ISO-8859-1', 'auto' )
					);
					$this->temporada_comentarios->Adicionar ( $row );
				}
			} else {
				$this->anuncio_temporada->Alterar ( $row, ( string ) $anuncio_temporada [0]->atm_id );
			}
		}		
		$this->load->model ('motor_anuncio');
		$this->motor_anuncio->SetarDataExecucao($id);
		log_message('info', 'Termino Temporada para: ' . $xmlFile);
	}
}