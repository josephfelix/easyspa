<?php
class Banners_model extends CI_Model
{
	public function pegar_banners_app($tipo, $cidade, $estado)
	{
		$this->db->where('tipo', $tipo);
		$this->db->where('inicia <= NOW()');
		$this->db->where('termina >= NOW()');
		$this->db->where("(cidade = '' OR cidade = '{$cidade}')");
		$this->db->where('estado', $estado);
		$this->db->order_by('rand()');
		$this->db->limit(1);
		$busca = $this->db->get('banners');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	public function pegar_banners( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('banners');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function pegar_banner( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('banners');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	
	public function inserir( $insert )
	{
		$this->db->insert('banners', $insert);
		return $this->db->insert_id();
	}
	
	public function excluir( $where = false )
	{
		$this->db->delete('banners', $where);
	}
}
?>