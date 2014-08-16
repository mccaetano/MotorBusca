<?php
class Emprego_contrato extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_emprego_contrato', $row);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorDescricao($descricao) {
		$this->db->where("ect_descricao", $descricao);
		$query = $this->db->get('t_mb_emprego_contrato');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}
