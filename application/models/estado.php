<?php
class Estado extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($estado) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_estado', $estado);
		$retorno = mysql_insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaEstado($nome_estado) {
		$this->db->where("es_descricao", $nome_estado);
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
		
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->result();
	
		if ($query->num_rows() <= 0) {
			return FALSE;
		}
	
		return $retorno;
	}
}