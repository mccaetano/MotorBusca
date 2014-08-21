<?php

if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class MotorFeeds extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'form' ,
				'date', 
				'url'
		) );
	}
	function lista() {
		$this->load->model ( "motor_anuncio" );
		$lista = $this->motor_anuncio->BuscaTodos ();
		
		$data = array (
				'ativo' => 'feeds',
				'motor' => $lista 
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/motor_lista', $data );
		$this->load->view ( 'admin/templates/footer', $data );
	}
	function novo() {
		$method = ( string ) $_SERVER ["REQUEST_METHOD"];
		
		$this->load->model ( "motor_anuncio" );
		$this->load->model ( "tipo_anuncio" );
		
		if ($method == "POST") {
						
			$row = array (					
					'man_descricao' => $this->input->post ( 'iDescricao' ),
					'man_data_criacao' => mdate('%Y-%m-%d', time()),
					'man_anunciante' => $this->input->post ( 'iAnunciante' ),
					'man_url_carga' => $this->input->post ( 'iURL' ),
					'man_data_ultima_carga' => null,
					'tan_id' => $this->input->post ( 'iTipoAnuncio' )
			);
			
			$this->motor_anuncio->Adicionar ( $row );
			
			redirect ( "admin/motorfeeds/lista" );
		}
		
		$lista = $this->tipo_anuncio->BuscaTodos ();
		
		$data = array (
				'ativo' => 'feeds',
				'tipoanuncio' => $lista 
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/motor_cadastro', $data );
		$this->load->view ( 'admin/templates/footer', $data );
	}
	function alteracao($id = FALSE) {
		$method = ( string ) $_SERVER ["REQUEST_METHOD"];
		
		$this->load->model ( "motor_anuncio" );
		$this->load->model ( "tipo_anuncio" );
		
		if ($method == "POST") {
			$row = array (
					'man_descricao' => $this->input->post ( 'iDescricao' ),
					'man_anunciante' => $this->input->post ( 'iAnunciante' ),
					'man_url_carga' => $this->input->post ( 'iURL' ),
					'man_data_ultima_carga' => null,
					'tan_id' => $this->input->post ( 'iTipoAnuncio' )
			);
			
			$this->motor_anuncio->Alterar ( $row, $id );
			redirect ( "admin/motorfeeds/lista" );
		}
		
		$lista = $this->tipo_anuncio->BuscaTodos ();
		$feeds = $this->motor_anuncio->BuscaPorID ( $id );
		
		$data = array (
				'ativo' => 'feeds',
				'tipoanuncio' => $lista,
				'anuncio' => $feeds [0] 
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/motor_alteracao', $data );
		$this->load->view ( 'admin/templates/footer', $data );
	}
	function exclusao($id = FALSE) {
		$this->load->model ( "motor_anuncio" );
		$this->motor_anuncio->Excluir ( $row, $id );
		redirect ( "admin/motorfeeds/lista" );
	}
}