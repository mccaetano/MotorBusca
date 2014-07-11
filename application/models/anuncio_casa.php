<?php
class Anuncio_casa extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function adicionar($anuncio) {
		$this->db->trans_begin();
		$retorno = $this->db->insert('t_mb_anuncio_casa', $anuncio);
		
		$this->db->trans_commit();
		$this->db->cache_delete_all();
		
		return $retorno;
	}
}