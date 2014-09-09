<?php

if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}
class MotorFeeds extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'form' ,
				'url'
		) );
	}
	function lista() {
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		$this->load->model ( "motor_anuncio" );
		$lista = $this->motor_anuncio->ListaTodos ();
		
		$data = array (
				'ativo' => 'feeds',
				'motor' => $lista ,
				'user' => $user
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/motor_lista', $data );
		$this->load->view ( 'admin/templates/footer', $data );
	}
	function novo() {
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		$method = ( string ) $_SERVER ["REQUEST_METHOD"];
		
		$this->load->helper( "date" );
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
		
		$lista = $this->tipo_anuncio->ListaTodos ();
		
		$data = array (
				'ativo' => 'feeds',
				'tipoanuncio' => $lista ,
				'user' => $user
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/motor_cadastro', $data );
		$this->load->view ( 'admin/templates/footer', $data );
	}
	function alteracao($id = FALSE) {
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
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
		
		$lista = $this->tipo_anuncio->ListaTodos ();
		$feeds = $this->motor_anuncio->BuscaPorID ( $id );
		
		$data = array (
				'ativo' => 'feeds',
				'tipoanuncio' => $lista,
				'anuncio' => $feeds [0],
				'user' => $user 
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