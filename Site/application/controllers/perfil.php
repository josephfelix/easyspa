<?php
class Perfil extends CI_Controller
{
	public function index( $id )
	{
		date_default_timezone_set('America/Sao_Paulo');
		$this->load->model('anuncios_model');
		$anuncio = $this->anuncios_model->pegar_anuncio(array('idanuncio' => $id));
		if ( $anuncio )
		{
			$fotos = $this->anuncios_model->pegar_fotos($id);
			$disponivel = $this->anuncios_model->disponivel($id);
			
			$this->load->view('header');
			$this->load->view('perfil', array(
				'anuncio' => $anuncio, 
				'fotos' => $fotos,
				'disponivel' => $disponivel
			));
			$this->load->view('footer');
		} else
			header('Location: ' . base_url());
	}
}
?>