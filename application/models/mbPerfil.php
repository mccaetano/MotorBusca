<?php
class MbPerfil extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_perfil', $row);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("id_perfil", $id);
		$this->db->update('t_mb_perfil', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $id;
	}
	
	function Excluir($row, $id) {
		$this->db->trans_begin();
		$this->db->where("id_perfil", $id);
		$this->db->delete('t_mb_perfil', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $id;
	}
	
	function BuscaTodos() {
		$query = $this->db->get('t_mb_perfil');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}		
		return $retorno;
	}
	


	function BuscaPorID($id) {
		$this->db->where("id_perfil", $id);
		$query = $this->db->get('t_mb_perfil');
		$retorno = $query->result();
	
		if ($query->num_rows() <= 0) {
			return FALSE;
		}
		return $retorno;
	}
	
	
}