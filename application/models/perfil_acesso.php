<?php
class Perfil_Acesso extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_perfil_acesso', $row);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("pra_id", $id);
		$this->db->update('t_mb_perfil_acesso', $row);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaTodos() {
		$query = $this->db->get('t_mb_perfil_acesso');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}		
		return $retorno;
	}
	
	function BuscaPorId($id) {
		$this->db->where("pra_id", $id);
		$query = $this->db->get('t_mb_perfil_acesso');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}		
		return $retorno;
	}
	
	
}