<?php
class Anuncio_auto extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($anuncio) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_anuncio_auto', $anuncio);
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
		
		return $retorno;
	}
	
	function Alterar($anuncio, $ad_id) {
		$this->db->trans_begin();
		$this->db->where("ad_id", $ac_id);
		$retorno = $this->db->update('t_mb_anuncio_auto', $anuncio);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaAnuncioCasa($titulo) {
		$this->db->where("aa_title", $titulo);
		$query = $this->db->get('t_mb_anuncio_auto');
		$retorno = $query->result();
	
		if ($query->num_rows() <= 0) {
			return FALSE;
		}
			
		return $retorno;
	}
}
