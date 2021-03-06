<?php
class Motor_anuncio extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_motor_anuncio', $row);
		$retorno = $this->db->insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("man_id", $id);
		$this->db->update('t_mb_motor_anuncio', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $id;
	}

	function Excluir($row, $id) {
		$this->db->trans_begin();
		$this->db->where("man_id", $id);
		$this->db->delete('t_mb_motor_anuncio');
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $id;
	}
	
	function BuscaTodos() {
		$query = $this->db->get("t_mb_motor_anuncio");
		$result = $query->result();
		
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $result;		
	}

	function ListaTodos() {
		$query = $this->db->get("v_mb_motor_anuncio");
		$result = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $result;
	}

	function BuscaPorId($id) {
		$this->db->where("man_id", $id);
		$query = $this->db->get("t_mb_motor_anuncio");
		$result = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
	
		return $result;
	}
	
	function SetarDataExecucao($id) {
		$this->load->helper('date');
		
		$data = date('Y-m-d');
		
		$row = array(
			'man_data_ultima_carga' => $data
		);
		
		$this->db->trans_begin();
		$this->db->where("man_id", $id);
		$this->db->update('t_mb_motor_anuncio', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $id;
	}
}