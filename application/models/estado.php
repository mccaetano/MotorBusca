<?php
class Estado extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($estado) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_estado', $estado);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaEstado($nome_estado) {
		$this->db->where("es_descricao", $nome_estado);
		$query = $this->db->get('t_mb_estado');
		$retorno = $query->results();
				
		return $retorno;
	}
	
	
}