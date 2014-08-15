<?php
class Carro_tipo extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($carro_tipo) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_carro_tipo', $carro_tipo);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaCarroTipo($nome_tipo) {
		$this->db->where("crt_descricao", $nome_tipo);
		$query = $this->db->get('t_mb_carro_tipo');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}