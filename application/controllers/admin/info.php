<?php 
if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Info extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }

	public function index()
	{
		if (!$this->auth->loggedin()) {
			redirect('admin/login');
		}
		
		// get current user id
		$id = $this->auth->userid();
		
		// get user from database
		$this->load->model('mbperfil', 'user_model');
		$user = $this->user_model->BuscaPorID($id);
		
		echo phpinfo();
		exit();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */