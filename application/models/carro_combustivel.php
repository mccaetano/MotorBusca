<?php
class Carro_combustivel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_carro_combustivel', $row);
		$retorno = mysql_insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaCarroCombustivel($nome) {
		$this->db->where("ccb_descricao", $nome);
		$query = $this->db->get('t_mb_carro_combustivel');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}