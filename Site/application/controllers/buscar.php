<?php
class Buscar extends CI_Controller
{
	public function index( $token = false, $categoria_param = false )
	{
		if ( $token )
		{
			$busca = $this->db->get_where('buscas', array('token' => $token))->row();
			$anuncios_view = array();
			$anuncios = $this->db->get_where('anuncios',
				array(
					'cidade' => $busca->cidade,
					'estado' => $busca->estado,
					'latitude !=' => '',
					'longitude !=' => ''
				)
			);
			if ( $anuncios->num_rows() > 0 )
			{
				$anuncios = $anuncios->result();
				foreach ( $anuncios as $anuncio )
				{
					if ( $categoria_param )
					{
						$busca->categoria = $categoria_param;
					}
					$categoria = $this->db->get_where('anuncio_categorias',
						array(
							'idcategoria' => $busca->categoria,
							'idanuncio' => $anuncio->idanuncio
						)
					);
					if ( $categoria->num_rows() > 0 )
					{
						$anuncio->categoria = $busca->categoria;
						$anuncios_view[] = $anuncio;
					}
				}
			}
			$estados = $this->db->get_where('estados')->result();
			$idestado = 0;
			foreach ( $estados as $estado )
			{
				if ( $estado->estado == $busca->estado )
				{
					$idestado = $estado->id;
					break;
				}
			}
			$cidades = $this->db->get_where('cidades', array('idestado' => $idestado))->result();
			$this->load->view('header');
			$this->load->view('busca', array(
				'busca' => $busca, 
				'anuncios' => $anuncios_view,
				'estados' => $estados,
				'cidades' => $cidades,
				'token' => $token,
				'categoria' => $categoria_param
			));
			$this->load->view('footer');
		} else
		{
			$token = md5(uniqid(time()));
			$estado = $this->db->get_where('estados', array('id' => $this->input->post('estado')))->row()->estado;
			$this->db->insert('buscas',
				array(
					'token' => $token,
					'categoria' => $this->input->post('categoria'),
					'cidade' => $this->input->post('cidade'),
					'estado' => $estado,
					'data' => date('Y-m-d H:i:s')
				)
			);
			header('Location: ' . base_url() . 'buscar/' . $token);
		}
	}
}
?>