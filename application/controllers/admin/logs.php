<?php 
if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Logs extends CI_Controller {
 private $logPath; //path to the php log
    /**
    *   Class constructor
    */
    function __construct(){
        parent::__construct();
        $this->logPath = ini_get('error_log');
     }
 
	
	public function phpview()
	{
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		$data = array(
				'ativo' => 'logs',
				'log_path' => $this->logPath,
				'user' => $user
		);
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'admin/php_logs', $data);
		$this->load->view ( 'admin/templates/footer', $data );
		
	}
	
	public function view()
	{
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		$data = array(
				'ativo' => '',
			'log_path' => $this->config->item ( 'log_path' ) == '' ? 'application/logs/' : $this->config->item ( 'log_path' ),
				'user' => $user
		);		
		$this->load->view ( 'admin/templates/header', $data );
		$this->load->view ( 'logs_view', $data);
		$this->load->view ( 'admin/templates/footer', $data );
		
	}
	
	public function delete(){
		
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		if (@is_file($this->logPath)) {
			if (@unlink($this->logPath)) {
				echo 'PHP Error Log deleted';
			} else {
				echo 'There has been an error trying to delete the PHP Error log '.$this->logPath;
			}
		} else {
			echo 'The log cannot be found in the specified route  '.$this->logPath.'.';
		}
		exit;
	}
}
