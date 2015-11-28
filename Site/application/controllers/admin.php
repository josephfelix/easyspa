<?php
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->model('afiliados_model');
		$this->load->model('funcionarias_model');
	}
	
	public function index()
	{
		if ( $this->session->userdata('admin') )
		{
			$total_usuarios = sizeof($this->usuarios_model->pegar_usuarios(array('tipo' => 'CADASTRO')));
			$total_funcionarias = sizeof($this->funcionarias_model->pegar_funcionarias());
			
			$total_usuarios_mes = sizeof($this->usuarios_model->pegar_usuarios(array('data >=' => date('Y-m-01'))));
			$total_prestadoras_mes = sizeof($this->funcionarias_model->pegar_funcionarias(array('data_inserido >=' => date('Y-m-01'))));
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard', array('total_usuarios' => $total_usuarios, 'total_funcionarias' => $total_funcionarias, 'total_usuarios_mes' => $total_usuarios_mes, 'total_prestadoras_mes' => $total_prestadoras_mes));
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function login()
	{
		$erro = false;
		if ( $this->input->post('email') && $this->input->post('senha') )
		{
			$admin = $this->usuarios_model->pegar_usuario(
				array(
					'email' => $this->input->post('email'),
					'senha' => md5($this->input->post('senha')),
					'tipo' => 'ADMIN'
				));
			if ( is_object( $admin ) )
			{
				$this->session->set_userdata('admin', $admin->nome . ' ' . $admin->sobrenome);
				$this->session->set_userdata('admin_email', $admin->email);
				header('Location: ' . base_url() . 'admin');
				die;
			} else
				$erro = true;
		}
		
		$this->load->view('admin/login', array('erro' => $erro));
	}
	
	public function sair()
	{
		$this->session->sess_destroy();
		header('Location: ' . base_url() . 'admin/login');
	}
	
	public function faturamento()
	{
		if ( $this->session->userdata('admin') )
		{
			$this->load->view('admin/header');
			$this->load->view('admin/faturamento');
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function afiliados()
	{
		if ( $this->session->userdata('admin') )
		{
			$todos = $this->afiliados_model->pegar_afiliados(array('orderby' => 'idafiliado', 'order' => 'DESC'));
			$this->load->view('admin/header');
			$this->load->view('admin/afiliados', array('todos' => $todos));
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function prestadores()
	{
		if ( $this->session->userdata('admin') )
		{
			$this->load->view('admin/header');
			$this->load->view('admin/prestadoras');
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function mobile( $section = '' )
	{
		if ( $this->session->userdata('admin') )
		{
			
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function usuarios()
	{
		if ( $this->session->userdata('admin') )
		{
			$this->load->view('admin/header');
			$this->load->view('admin/usuarios');
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function relatorios()
	{
		if ( $this->session->userdata('admin') )
		{
			$this->load->view('admin/header');
			$this->load->view('admin/relatorios');
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
	
	public function ajuda()
	{
		if ( $this->session->userdata('admin') )
		{
			$this->load->view('admin/header');
			$this->load->view('admin/ajuda');
			$this->load->view('admin/footer');
		} else
			header('Location: ' . base_url() . 'admin/login');
	}
}
?>