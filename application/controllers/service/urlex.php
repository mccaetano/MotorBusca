<?php
class Urlex extends CI_Controller {
	
	function sender($url = FALSE) {
		if (!$url) {
			log_message('error', 'url n�o informada');		
		}
		$this->load->helper('url');
		
		$url = base64_decode($url);
		redirect($url, 'refresh');
	}
}
