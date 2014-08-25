<?php
class Pais extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($pais) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_pais', $pais);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPais($nome_pais) {
		$this->db->where("ps_descricao", $nome_pais);
		$query = $this->db->get('t_mb_pais');
		$retorno = $query->results();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_pais');
		$retorno = $query->results();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $retorno;
	}
}