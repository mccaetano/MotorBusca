<?php 
if ( ! defined('BASEPATH')) { exit('No direct script access allowed');}

class Info extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
    }

	public function index()
	{
		echo phpinfo();
		exit();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */