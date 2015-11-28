<?php
class Anuncios_model extends CI_Model
{
	public function pegar_anuncios($where = array())
	{
		$this->db->where($where);
		$busca = $this->db->get('anuncios');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function pegar_anuncio($where = array())
	{
		$this->db->where($where);
		$busca = $this->db->get('anuncios');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	
	public function pegar_fotos( $idanuncio = 0)
	{
		$this->db->where('idanuncio', $idanuncio);
		$busca = $this->db->get('anuncio_fotos');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function categoria_principal( $idanuncio = 0 )
	{
		$this->db->where('idanuncio', $idanuncio);
		$this->db->order_by('id', 'ASC');
		$this->db->limit(1);
		$busca = $this->db->get('anuncio_categorias');
		if ( $busca->num_rows() > 0 )
			return $busca->row()->idcategoria;
		return false;
	}
	
	public function total_anuncios_ativos($idfuncionaria)
	{
		$this->db->where('idfuncionaria', $idfuncionaria);
		$this->db->where('ativo = 1');
		$busca = $this->db->get('anuncios');
		return $busca->num_rows();
	}
	
	public function disponivel( $idanuncio )
	{
		$dia = date('w')+1;
		$hora = date('H:i:s');
		$disponivel = false;
		
		$this->db->where('idanuncio', $idanuncio);
		$this->db->where('dia', $dia);
		$this->db->where('tipo', 'DE');
		$this->db->where('hora <=', $hora);
		$de = $this->db->get('anuncio_atendimento');
		if ( $de->num_rows() )
		{
			$this->db->where('idanuncio', $idanuncio);
			$this->db->where('dia', $dia);
			$this->db->where('tipo', 'ATE');
			$this->db->where('hora >', $hora);
			$ate = $this->db->get('anuncio_atendimento');
			if ( $ate->num_rows() )
			{
				$disponivel = true;
			}
		}
		return $disponivel;
	}
}
?>