<?php if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->lang->load("home", "portuguese");
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
		$this->load->view('templates/header');
    	$this->load->view('home');
		$this->load->view('templates/footer');
	}
	
	public function admin()
	{
		$this->load->view('admin/templates/header');
		$this->load->view('admin/home_admin');
		$this->load->view('admin/templates/footer');
	}
	
	public function template()
	{
		$this->load->view('admin/template');		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */