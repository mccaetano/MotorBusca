<?php
class Cidade extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($cidade) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_cidade', $cidade);
		$retorno = $this->db->insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaCiadde($nome_cidade) {
		$this->db->where("cd_descricao", $nome_cidade);
		$query = $this->db->get('t_mb_cidade');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
	


	function BuscaPorEstado($es_id) {
		$this->db->where("t_mb_estado_es_id", $es_id);
		$query = $this->db->get('t_mb_cidade');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_cidade');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
		
		return $retorno;
	}
}