<?php
class Funcionarias_model extends CI_Model
{
	public function pegar_funcionarias( $where = false )
	{
		if ( isset( $where['orderby'] ) && isset( $where['order'] ) )
		{
			if ( $where['orderby'] == 'distancia' )
			{
				$latitude = $where['latitude'];
				$longitude = $where['longitude'];
				unset($where['latitude']);
				unset($where['longitude']);
				
				$this->db->select("*, (111.045 * DEGREES(ACOS(COS(RADIANS({$latitude}))
                 * COS(RADIANS(latitude))
                 * COS(RADIANS({$longitude}) - RADIANS(longitude))
                 + SIN(RADIANS({$latitude}))
                 * SIN(RADIANS(latitude))))) AS distancia");
			}
			$this->db->order_by( $where['orderby'], $where['order'] );
			unset( $where['orderby'] );
			unset( $where['order'] );
		}
		
		
		if ( isset( $where['limit'] ) )
		{
			$this->db->limit( $where['limit'] );
			unset( $where['limit'] );
		}
		
		$this->db->join('anuncios', 'anuncios.idfuncionaria = funcionarias.id');
		
		if ( isset( $where['categoria'] ) )
		{
			$this->db->join('anuncio_categorias', "anuncio_categorias.idanuncio = anuncios.idanuncio AND idcategoria = {$where['categoria']}");
			unset($where['categoria']);
		}
		
		if ( $where )
			$this->db->where($where);
		$busca = $this->db->get('funcionarias');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function pegar_funcionaria( $where = false )
	{
		if ( $where )
			$this->db->where($where);
		$this->db->join('anuncios', 'anuncios.idfuncionaria = funcionarias.id');
		$busca = $this->db->get('funcionarias');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	
	public function inserir( $insert )
	{
		$this->db->insert('funcionarias', $insert);
		return $this->db->insert_id();
	}
	
	public function alterar( $update, $where )
	{
		$this->db->where($where);
		$this->db->update('funcionarias', $update);
	}
	
	public function total_anuncios($idfuncionaria)
	{
		$this->db->where('idfuncionaria', $idfuncionaria);
		$busca = $this->db->get('anuncios');
		return $busca->num_rows();
	}
}
?>