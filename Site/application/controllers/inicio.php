<?php
class Inicio extends CI_Controller
{
	public function index()
	{
		$estados = $this->db->get('estados')->result();
		$cidades = $this->db->get_where('cidades', array('idestado' => 19))->result();
		$this->load->view('header');
		$this->load->view('pagina_inicial', array('estados' => $estados, 'cidades' => $cidades));
		$this->load->view('footer');
	}
}
?>