<?php
class Carro_tipo extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_carro_tipo', $row);
		$retorno = $this->db->insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorId($id) {
		$this->db->where("crt_id", $id);
		$query = $this->db->get('t_mb_carro_tipo');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaCarroTipo($nome_tipo) {
		$this->db->where("crt_descricao", $nome_tipo);
		$query = $this->db->get('t_mb_carro_tipo');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}

	function ListaTodos() {
		$query = $this->db->get('t_mb_carro_tipo');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	
}