<?php
class Estado extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($estado) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_estado', $estado);
		$retorno = $this->db->insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaEstado($nome_estado) {
		$this->db->where("es_descricao", $nome_estado);
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
	
	function BuscaPorPais($ps_id) {
		$this->db->where("t_mb_pais_ps_id", $ps_id);
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $retorno;
	}
}