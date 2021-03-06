<?php

class Pais extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($pais) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_pais', $pais);
		$retorno = $this->db->insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorId($id) {
		$this->db->where("ps_id", $id);
		$query = $this->db->get('t_mb_pais');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaPais($nome_pais) {
		$this->db->where("ps_descricao", $nome_pais);
		$query = $this->db->get('t_mb_pais');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_pais');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $retorno;
	}
}