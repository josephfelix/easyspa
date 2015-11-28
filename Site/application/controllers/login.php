<?php
class Login extends CI_Controller
{
	public function index()
	{
		$this->load->model('usuarios_model');
		$this->load->model('funcionarias_model');
		$this->load->model('afiliados_model');
		
		$error = 0;
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$email = $this->input->post('email');
			$senha = md5($this->input->post('senha'));
			if ( $email && $senha )
			{
				$usuario = $this->usuarios_model->pegar_usuario(
					array(
						'email' => $email,
						'senha' => $senha,
						'tipo' => 'CADASTRO'
					)
				);
				if ( $usuario )
				{
					$this->session->set_userdata('tipo', 'usuario');
					$this->session->set_userdata('id', $usuario->id);
					$this->session->set_userdata('email', $usuario->email);
					$this->session->set_userdata('estado', $usuario->estado);
					$this->session->set_userdata('cidade', $usuario->cidade);
					$this->session->set_userdata('latitude', $usuario->latitude);
					$this->session->set_userdata('longitude', $usuario->longitude);
					header('Location: ' . base_url() . 'usuario/conta');
					die;
				}
				
				$prestador = $this->funcionarias_model->pegar_funcionaria(
					array(
						'email' => $email,
						'senha' => $senha
					)
				);
				
				if ( $prestador )
				{
					$this->session->set_userdata('tipo', 'prestador');
					$this->session->set_userdata('id', $prestador->id);
					$this->session->set_userdata('email', $prestador->email);
					header('Location: ' . base_url() . 'cliente/conta');
					die;
				}
				
				$afiliado = $this->afiliados_model->pegar_afiliado(
					array(
						'email' => $email,
						'senha' => $senha
					)
				);
				
				if ( $afiliado )
				{
					$this->session->set_userdata('tipo', 'afiliado');
					$this->session->set_userdata('id', $afiliado->id);
					$this->session->set_userdata('email', $afiliado->email);
					header('Location: ' . base_url() . 'afiliado/conta');
					die;
				}
				
				$error = 1;
			}
		}
		$this->load->view('header');
		$this->load->view('login', array('error' => $error));
		$this->load->view('footer');
	}
	
	public function sair()
	{
		$this->session->sess_destroy();
		header('Location: ' . base_url() . 'login');
	}
}
?>