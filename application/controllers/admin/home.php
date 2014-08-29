<?php 
if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
				
		$data = array(
				'ativo' => '',
				'user' => $user
		);
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/home_admin', $data);
		$this->load->view('admin/templates/footer', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */