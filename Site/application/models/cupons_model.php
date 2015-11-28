<?php
class Cupons_model extends CI_Model
{
	public function pegar_cupons($where = false)
	{
		if (isset($where['orderby']) && isset($where['order']))
		{
			if ($where['orderby'] == 'data' )
			{
				$this->db->order_by('data_inserido', $where['order']);
			} elseif ( $where['orderby'] == 'distancia' )
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
				$this->db->order_by( $where['orderby'], $where['order'] );
			}
			unset($where['orderby']);
			unset($where['order']);
		}
		if ($where)
			$this->db->where($where);
		$busca = $this->db->get('cupons');
		if ($busca->num_rows() > 0)
			return $busca->result();
		return false;
	}
	
	public function total_cupons($idfuncionaria = false)
	{
		if ($idfuncionaria)
			$this->db->where('idfuncionaria', $idfuncionaria);
		$busca = $this->db->get('cupons');
		return $busca->num_rows();
	}
}
?>