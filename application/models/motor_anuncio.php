<?php
class Motor_anuncio extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function listaTodos() {
		$query = $this-db-get("t_mb_motor_anuncio");
		$result = $query->result();
		
		if ($result === FALSE) {
			return FALSE;
		}
		
		return $result;		
	}
}