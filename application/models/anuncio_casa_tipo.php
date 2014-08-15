<?php
class Anuncio_casa_Tipo extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($pesquisa_casa_tipo) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_pesquisa_casa_tipo', $pesquisa_casa_tipo);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaAnuncioCasaTipo($nome_tipo) {
		$this->db->where("pct_descricao", $nome_tipo);
		$query = $this->db->get('t_mb_pesquisa_casa_tipo');
		$retorno = $query->result();

		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
	
	
}