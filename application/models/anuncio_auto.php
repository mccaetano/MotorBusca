<?php
class Anuncio_auto extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_anuncio_auto', $row);
		$retorno = mysql_insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
		
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("aa_id", $id);
		$retorno = $this->db->update('t_mb_anuncio_auto', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorAnuncioID($anuncio_id) {
		$this->db->where("aa_anuncio_id", $anuncio_id);
		$query = $this->db->get('t_mb_anuncio_auto');
		$retorno = $query->result();
	
		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
}
