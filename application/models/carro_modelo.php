<?php
class Carro_modelo extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_carro_modelo', $row);
		$retorno = $this->db->insert_id();
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorId($id) {
		$this->db->where("cmd_id", $id);
		$query = $this->db->get('t_mb_carro_modelo');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaCarroModelo($nome) {
		$this->db->where("cmd_descricao", $nome);
		$query = $this->db->get('t_mb_carro_modelo');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_carro_modelo');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaPorMarcaId($cmr_id) {
		$this->db->where("cmr_id", $cmr_id);
		$query = $this->db->get('t_mb_carro_modelo');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
}