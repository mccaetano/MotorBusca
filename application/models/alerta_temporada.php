<?php
class Alerta_Temporada extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_alerta_temporada', $row);
		$retorno = $this->db->insert_id();
		$this->db->trans_commit();
		$this->db->cache_delete_all();

		return $retorno;
	}

	function Alterar($row, $id, $alerta) {
		$this->db->trans_begin();
		$this->db->where("alr_id", $alerta);
		$this->db->where("alt_id", $id);
		$retorno = $this->db->update('t_mb_alerta_temporada', $row);

		$this->db->trans_commit();
		$this->db->cache_delete_all();

		return $retorno;
	}

	function BuscaPorId($id) {
		$this->db->where("alt_id", $id);
		$query = $this->db->get('t_mb_alerta_temporada');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaPorAlerta($id) {
		$this->db->where("alr_id", $id);
		$query = $this->db->get('t_mb_alerta_temporada');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}

	function ListaTodos() {
		$query = $this->db->get('t_mb_alerta_temporada');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
}