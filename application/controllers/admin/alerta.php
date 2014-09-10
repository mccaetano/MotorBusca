<?php

class Alerta extends CI_Controller {
	
	function lista() {
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		 
		// get current user id
		$id = $this->auth->userid();
		 
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);


		$this->load->helper(array('form'));
		 
		$this->load->model ( "alertas");
		$lista = $this->alertas->ListaAlertaPerfil ();
		 
		 
		$data = array(
				'ativo' => 'alertas',
				'lista' => $lista,
				'user' => $user
		);
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/alerta_lista', $data);
		$this->load->view('admin/templates/footer', $data);
	}
}