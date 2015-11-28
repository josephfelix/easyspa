<?php
class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata('tipo') != 'usuario' )
		{
			header('Location: ' . base_url() . 'login');
			die;
		}
	}
	public function index()
	{
		header('Location: ' . base_url() . 'usuario/conta');
	}
	public function conta()
	{		
		$idestado = $this->db->get_where('estados', array('estado' => $this->session->userdata('estado')))->row()->id;
		$cidade = $this->session->userdata('cidade');
		
		$this->load->view('header');
		$this->load->view('usuario/dashboard', array('idestado' => $idestado, 'cidade' => $cidade));
		$this->load->view('footer');
	}
	
	public function perto()
	{
		$this->load->model('funcionarias_model');
		$funcionarias = $this->funcionarias_model->pegar_funcionarias(
			array(
				'orderby' => 'distancia',
				'order' => 'DESC',
				'latitude' => $this->session->userdata('latitude'),
				'longitude' => $this->session->userdata('longitude'),
				'cidade' => $this->session->userdata('cidade')
			)
		);
		$this->load->view('header');
		$this->load->view('usuario/perto', array('funcionarias' => $funcionarias));
		$this->load->view('footer');
	}
	
	public function cupons()
	{
		$this->load->model('cupons_model');
		$cupons = $this->cupons_model->pegar_cupons(array('orderby' => 'data', 'order' => 'DESC'));
		$this->load->view('header');
		$this->load->view('usuario/cupons', array('cupons' => $cupons));
		$this->load->view('footer');
	}
	
	public function favoritos()
	{
		$this->load->model('funcionarias_model');
		$favoritos = $this->db->get_where('favoritos', array('idusuario' => $this->session->userdata('id')));
		$anuncios = false;
		if ( $favoritos->num_rows() > 0 )
		{
			$favoritos = $favoritos->result();
			$anuncios = array();
			foreach ( $favoritos as $favorito )
			{
				$anuncios[] = $this->funcionarias_model->pegar_funcionaria(array('id' => $favorito->idfuncionaria));
			}
		}
		$this->load->view('header');
		$this->load->view('usuario/favoritos', array('anuncios' => $anuncios));
		$this->load->view('footer');
	}
	
	public function historico()
	{
		$this->load->view('header');
		$this->load->view('usuario/historico');
		$this->load->view('footer');
	}
	
	public function configuracoes()
	{
		$this->load->view('header');
		$this->load->view('usuario/configuracoes');
		$this->load->view('footer');
	}
}
?>