<?php
class Enderecos_model extends CI_Model
{
	public function pegar_enderecos( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('enderecos');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	public function pegar_endereco( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('enderecos');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	public function inserir( $insert )
	{
		$this->db->insert('enderecos', $insert);
		return $this->db->insert_id();
	}
}
?>