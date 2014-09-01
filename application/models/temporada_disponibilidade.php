<?php
<?php
class Temporada_disponibilidade extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function Adicionar($row) {
		$this->db->trans_begin();
		$this->db->insert('t_mb_temporada_disponibilidade', $row);
		$retorno = $this->db->insert_id();
		$this->db->trans_commit();
		$this->db->cache_delete_all();

		return $retorno;
	}

	function Alterar($row, $id) {
		$this->db->trans_begin();
		$this->db->where("tds_id", $id);
		$retorno = $this->db->update('t_mb_temporada_disponibilidade', $row);

		$this->db->trans_commit();
		$this->db->cache_delete_all();

		return $retorno;
	}

	function ListaTodos() {
		$query = $this->db->get('t_mb_temporada_disponibilidade');
		$retorno = $query->result();

		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
	
	function BuscaPorID($id) {
		$this->db->where("tds_id", $id);
		$query = $this->db->get('t_mb_temporada_disponibilidade');
		$retorno = $query->result();
	
		if (($query) && $query->num_rows() <= 0) {
			$retorno = FALSE;
		}
		$query->free_result();
			
		return $retorno;
	}
}