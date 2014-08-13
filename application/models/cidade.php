<?php
class Cidade extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($cidade) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_cidade', $cidade);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaCiadde($nome_cidade) {
		$this->db->where("cd_descricao", $nome_cidade);
		$query = $this->db->get('t_mb_cidade');
		$retorno = $query->results();
				
		return $retorno;
	}
	
	
}