<?php
class Tipo_anuncio extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function BuscaTipoAnuncio($tan_id = FALSE) {
		
		$this->db->where("tan_id", $tan_id);
		$query = $this->db->get("t_mb_tipo_anuncio");
		$result = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}

		return $result;
	}
	
	function BuscaTodos() {
		
		$query = $this->db->get("t_mb_tipo_anuncio");
		$result = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $result;
	}
}