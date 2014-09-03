<?php 
if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Acesso extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }
    
	public function login($pagereturn = FALSE)
	{
		if (!$pagereturn) { $pagereturn = "/"; } else { $pagereturn = base64_decode($pagereturn); } 
		
		$this->load->library('auth');
		
		$error = '';
		
		// form submitted
		if ($this->input->post('username') && $this->input->post('password')) {
			$remember = $this->input->post('remember') ? TRUE : FALSE;
		
			// get user from database
			$this->load->model('mbperfil', 'user_model');
			$user = $this->user_model->BuscaPorEMail($this->input->post('username'));
			
			if ($user) {
				// compare passwords
				if ($this->user_model->ChecaSenha($this->input->post('password'), $user[0]->senha)) {
					// mark user as logged in					
					$this->auth->login($user[0]->id_perfil, $remember);
					redirect($pagereturn);
				} else {
					$error = 'Wrong password';
				}
			} else {
				$error = 'User does not exist';
			}
		}
		
		$data = array(
				'ativo' => '',
				'error' => $error,
				'pagereturn' => base64_encode($pagereturn)
		);
		$this->load->view('templates/header', $data);
		$this->load->view('login', $data);
		$this->load->view('templates/footer', $data);
	}
	
	function logout() {	
		$this->load->library('auth');
		$this->auth->logout();
		redirect(base_url());
	}
}
