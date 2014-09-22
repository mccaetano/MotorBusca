<?php
class Tipo_Imovel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($tipo_Imovel) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_tipo_imovel', $tipo_Imovel);
		$retorno = $this->db->insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaPorId($id) {
		$this->db->where("tpi_id", $id);
		$query = $this->db->get('t_mb_tipo_imovel');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaTipoImovel($nome_tipo) {
		$this->db->where("tpi_descricao", $nome_tipo);
		$query = $this->db->get('t_mb_tipo_imovel');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function ListaTodos() {
		$query = $this->db->get('t_mb_tipo_imovel');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
}