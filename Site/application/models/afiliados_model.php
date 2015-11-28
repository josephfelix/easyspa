<?php
class Afiliados_model extends CI_Model
{
	public function pegar_afiliados( $where = false )
	{
		if ( isset( $where['orderby'] ) && isset( $where['order'] ) )
		{
			$this->db->order_by($where['orderby'], $where['order']);
			unset($where['orderby']);
			unset($where['order']);
		}
		if ( $where )
			$this->db->where($where);
		$busca = $this->db->get('afiliados');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function pegar_afiliado( $where = false )
	{
		if ( $where )
			$this->db->where($where);
		$busca = $this->db->get('afiliados');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	
	public function inserir( $insert )
	{
		$this->db->insert('afiliados', $insert);
		return $this->db->insert_id();
	}
	
	public function alterar( $update, $where )
	{
		$this->db->where($where);
		$this->db->update('afiliados', $update);
	}
}
?>