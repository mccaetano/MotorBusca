<?php
class Anuncio_casa extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_anuncio_casa', $row);
		$retorno = $this->db->insert_id();
		$this->db->trans_commit();
		$this->db->cache_delete_all();
		
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("ac_id", $id);
		$retorno = $this->db->update('t_mb_anuncio_casa', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorAnuncioID($anuncio_id) {
		$this->db->where("ac_id_anuncio", $anuncio_id);
		$query = $this->db->get('t_mb_anuncio_casa');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	


	function AnuncioPesquisa($params) {
		$query = $this->db->query("CALL p_mb_anuncio_casa_pesquisa(?,?,?,?,?,?,?,?,?)", $params);
		$retorno = $query->result();
		
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
}