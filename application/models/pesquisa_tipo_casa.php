<?php
class Pesquisa_tipo_casa extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_pesquisa_casa_tipo', $row);
		$retorno = mysql_insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_pesquisa_casa_tipo');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}