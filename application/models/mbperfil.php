<?php
class Mbperfil extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_perfil', $row);
		$retorno = $this->db->insert_id();
	
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

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		return $retorno;
	}
	
	function BuscaPorID($id) {
		$this->db->where("id_perfil", $id);
		$query = $this->db->get('t_mb_perfil');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		return $retorno;
	}
	
	function BuscaPorEMail($email) {
		$this->db->where("email", $email);
		$query = $this->db->get('t_mb_perfil');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		return $retorno;
	}

	function ListaPerfil() {
		$query = $this->db->get('v_mb_perfil');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		return $retorno;
	}
	
	function ChecaSenha($senha, $usersenha) {
		
		$senha = base64_encode($senha);
		
		if ($senha === $usersenha) {
			return true;
		} else {
			return false;
		}
	}
	
}