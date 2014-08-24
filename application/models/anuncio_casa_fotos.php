<?php
class Anuncio_casa_fotos extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_anuncio_casa_fotos', $row);
		$retorno = mysql_insert_id();
		$this->db->trans_commit();
		$this->db->cache_delete_all();
		
		return $retorno;
	}
	
	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("acf_id", $id);
		$retorno = $this->db->update('t_mb_anuncio_casa_fotos', $row);
	
		$this->db->trans_commit();
		$this->db->cache_delete_all();
	
		return $retorno;
	}
	
	function BuscaAnuncioCasaFoto($id) {
		$this->db->where("acf_id_anuncio", $id);
		$query = $this->db->get('t_mb_anuncio_casa_fotos');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
}