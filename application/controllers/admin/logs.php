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
		if (@is_file($this->logPath)) {
			echo nl2br(@file_get_contents($this->logPath));
		} else {
			echo 'The log cannot be found in the specified route '.$this->logPath;
		}
		exit;
		
		/*
		$data = array(
		);
		$this->load->view('logs_view', $data);
		*/
	}
	
	public function view()
	{
		
		$data = array(
			'log_path' => $this->config->item ( 'log_path' ) == '' ? 'application/logs/' : $this->config->item ( 'log_path' )
		);
		$this->load->view('logs_view', $data);
		
	}
	
	public function delete(){
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
