<?php
class Tipo_Imovel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($tipo_Imovel) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_propriedade_tipo', $tipo_Imovel);
		$retorno = mysql_insert_id();
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaTipoImovel($nome_tipo) {
		$this->db->where("pt_descricao", $nome_tipo);
		$query = $this->db->get('t_mb_propriedade_tipo');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}