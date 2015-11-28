<?php
class Afiliado extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('afiliados_model');
	}
	public function index()
	{
		header('Location: ' . base_url() . 'afiliado/painel' );
	}
	public function cadastro()
	{
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			date_default_timezone_set('America/Sao_Paulo');
			if ( !is_object($this->afiliados_model->pegar_afiliado(array('email' => $this->input->post('email')))) )
			{
				$this->db->where('id', $this->input->post('estado'));
				$item = $this->db->get('estados');
				$estado = $item->row();
				
				$id_afiliado = $this->afiliados_model->inserir(
				array(
					'usuario' => $this->input->post('usuario'),
					'email' => $this->input->post('email'),
					'senha' => md5($this->input->post('senha')),
					'confirmado' => 0,
					'cod_recuperar' => md5(uniqid(time())),
					'nome' => $this->input->post('nome'),
					'sobrenome' => $this->input->post('sobrenome'),
					'tipo' => $this->input->post('tipo'),
					'cpfcnpj' => $this->input->post('tipo') == 'PF' ? $this->input->post('cpf') : $this->input->post('cnpj'),
					'telefone' => $this->input->post('telefone'),
					'celular' => $this->input->post('celular'),
					'estado' => $estado->estado,
					'cidade' => $this->input->post('cidade'),
					'endereco' => $this->input->post('endereco'),
					'cep' => $this->input->post('cep'),
					'banco' => $this->input->post('banco'),
					'agencia' => $this->input->post('agencia'),
					'conta' => $this->input->post('conta'),
					'data' => date('Y-m-d H:i:s')
				));
			} else
				$id_afiliado = 0;
			$email = $this->input->post('email');
			$content = $this->load->view('afiliado/email_confirmar', 
				array(
					'link_confirmar' => base_url() . 'afiliado/confirmar/?email=' . $email, 
					'email' => $this->input->post('email'), 
					'nome' => $this->input->post('nome'), 
					'sobrenome' => $this->input->post('sobrenome')
				), true);
				
			$headers = "From: afiliado@easyspa.club\r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			@mail( $email, 'Olá '.$this->input->post('nome').' seja bem vindo(a) ao easySpa.', $content, $headers);
			$this->load->view('afiliado/mensagem_confirmar', array('id_afiliado' => $id_afiliado));
			//sucesso_cadastro
		} else
		{
			$estados = $this->db->get('estados');
			$bancos = $this->db->get('bancos');
			$this->load->view('afiliado/cadastro', array('estados' => $estados->result(), 'bancos' => $bancos->result()));
		}
	}
	public function cidades()
	{
		if ( $this->input->get('estado') )
		{
			$this->db->where('idestado', $this->input->get('estado'));
			$busca = $this->db->get('cidades');
			if ( $busca->num_rows() > 0 )
			{
				print json_encode($busca->result());
			}
		}
	}
	public function checar()
	{
		if ( $this->input->get('usuario') )
		{
			if ( !is_object( $this->afiliados_model->pegar_afiliado( array( 'usuario' => $this->input->get('usuario') ) ) ) )
			{
				print json_encode(array('status' => 'OK'));
			} else
				print json_encode(array('status' => 'FAIL'));
		}
		
		if ( $this->input->get('cpf') )
		{
			if ( !is_object( $this->afiliados_model->pegar_afiliado( array( 'cpfcnpj' => $this->input->get('cpf') ) ) ) )
			{
				print json_encode(array('status' => 'OK'));
			} else
				print json_encode(array('status' => 'FAIL'));
		}
		
		if ( $this->input->get('cnpj') )
		{
			if ( !is_object( $this->afiliados_model->pegar_afiliado( array( 'cpfcnpj' => $this->input->get('cnpj') ) ) ) )
			{
				print json_encode(array('status' => 'OK'));
			} else
				print json_encode(array('status' => 'FAIL'));
		}
	}
	public function termos()
	{
		$this->load->view('afiliado/termos');
	}
	public function confirmar()
	{
		if ( $this->input->get('email') )
		{
			$this->afiliados_model->alterar(
				array(
					'confirmado' => 1
				),
				array(
					'email' => $this->input->get('email')
				)
			);
			$this->load->view('afiliado/sucesso_cadastro');
		}
	}
	
	public function painel( $param = '' )
	{
		if ( !$this->session->userdata('afiliado_logado') )
		{
			header('Location: ' . base_url() . 'afiliado/login');
		} else
		{
			if ( $param == 'sair' )
			{
				$this->session->sess_destroy();
				header('Location: ' . base_url() . 'afiliado/login');
				die;
			} elseif ( $param == 'ajuda' )
			{
				$this->load->view('afiliado/painel/header');
				$this->load->view('afiliado/painel/ajuda');
				$this->load->view('afiliado/painel/footer');
			} elseif ( $param == 'configuracoes' )
			{
				if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
				{
					$estado = $this->db->get_where('estados', array('id' => $this->input->post('estado')))->row()->estado; 
					$update = array(
						'nome' => $this->input->post('nome'),
						'sobrenome' => $this->input->post('sobrenome'),
						'tipo' => $this->input->post('tipo'),
						'cpfcnpj' => $this->input->post('tipo') == 'PF' ? $this->input->post('cpf') : $this->input->post('cnpj'),
						'telefone' => $this->input->post('telefone'),
						'celular' => $this->input->post('celular'),
						'estado' => $estado,
						'cidade' => $this->input->post('cidade'),
						'banco' => $this->input->post('banco'),
						'agencia' => $this->input->post('agencia'),
						'conta' => $this->input->post('conta')
					);
					if ( !empty( $_FILES['avatar']['tmp_name'] ) )
					{
						$ext = pathinfo( $_FILES['avatar']['name'], PATHINFO_EXTENSION );
						$nome = md5(uniqid(time())) . '.' . $ext;
						while ( file_exists( 'upload/' . $nome ) )
							$nome = md5(uniqid(time())) . '.' . $ext;
						$fp = fopen('upload/' . $nome, 'wb');
						fwrite( $fp, file_get_contents( $_FILES['avatar']['tmp_name'] ) );
						fclose( $fp );
						$update['avatar'] = $nome;
						$this->session->set_userdata('afiliado_foto', $nome);
					}
					$this->afiliados_model->alterar( $update,
						array(
							'idafiliado' => $this->session->userdata('afiliado_logado')
						)
					);
				}
				
				$afiliado = $this->afiliados_model->pegar_afiliado( array('idafiliado' => $this->session->userdata('afiliado_logado') ) );
				$estados = $this->db->get('estados')->result();
				
				$idestado = $this->db->get_where('estados', array('estado' => $afiliado->estado))->row()->id;
				$cidades = $this->db->get_where('cidades', array('idestado' => $idestado))->result();
				
				$bancos = $this->db->get('bancos')->result();
				$this->load->view('afiliado/painel/header');
				$this->load->view('afiliado/painel/configuracoes', array('afiliado' => $afiliado, 'estados' => $estados, 'cidades' => $cidades, 'bancos' => $bancos));
				$this->load->view('afiliado/painel/footer');
			} elseif ( $param == 'material' )
			{
				/* $dir = dir('assets/img/shareinstagram/');
				while ( $arquivos = $dir->read() )
				{
					print 
					'<div class="col-lg-3">
						<a href="<?=base_url()?>assets/img/shareinstagram/'.$arquivos.'" target="_blank">
							<img src="<?=base_url()?>assets/img/sharefacebook/'.$arquivos.'" width="100%" />
						</a>
						<br /><br />
					</div>';
				}
				$dir->close();
				die; */
				$this->load->view('afiliado/painel/header');
				$this->load->view('afiliado/painel/material');
				$this->load->view('afiliado/painel/footer');
			} elseif ( $param == 'treinamento' )
			{
				$this->load->view('afiliado/painel/header');
				$this->load->view('afiliado/painel/treinamento');
				$this->load->view('afiliado/painel/footer');
			} else
			{
				$this->load->view('afiliado/painel/header');
				$this->load->view('afiliado/painel/dashboard');
				$this->load->view('afiliado/painel/footer');
			}
		}
	}
	public function login()
	{
		if ( $this->session->userdata('afiliado_logado') )
		{
			header('Location: ' . base_url() . 'afiliado/painel');
			die;
		}
		
		$error = 0;
		$id_afiliado = 0;
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			if ( $this->input->post('email_easyspa') && $this->input->post('senha_easyspa') )
			{
				$email = $this->input->post('email_easyspa');
				$senha = md5($this->input->post('senha_easyspa'));
				$afiliado = $this->afiliados_model->pegar_afiliado( array('email' => $email, 'senha' => $senha ) );
				if ( is_object( $afiliado ) )
				{
					if ( !$afiliado->confirmado )
					{
						$error = 2;
						$id_afiliado = $afiliado->idafiliado;
					} else
					{
						$this->session->set_userdata('afiliado_logado', $afiliado->idafiliado);
						$this->session->set_userdata('afiliado_nome', $afiliado->nome);
						$this->session->set_userdata('afiliado_foto', $afiliado->avatar);
						header('Location: ' . base_url() . 'afiliado/painel');
						die;
					}
				} else
					$error = 1;
			}
		}
		
		$this->load->view('afiliado/login', array('error' => $error, 'id_afiliado' => $id_afiliado));
	}
	
	public function reenviar( $id_afiliado = false )
	{
		if ( $id_afiliado )
		{
			$afiliado = $this->afiliados_model->pegar_afiliado(array('idafiliado' => $id_afiliado));
			if ( is_object( $afiliado ) )
			{
				$email = $afiliado->email;
				$content = $this->load->view('afiliado/email_confirmar', 
					array(
						'link_confirmar' => base_url() . 'afiliado/confirmar/?email=' . $email, 
						'email' => $email, 
						'nome' => $afiliado->nome, 
						'sobrenome' => $afiliado->sobrenome
					), true);
					
				$headers = "From: afiliado@easyspa.club\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				@mail( $email, 'Olá '.$afiliado->nome.' seja bem vindo(a) ao easySpa.', $content, $headers);
				header('Location: ' . base_url() . 'afiliado/login/?enviado=1');
			}
		}
	}
	
	public function reenviar2( $id_afiliado = false )
	{
		if ( $id_afiliado )
		{
			$afiliado = $this->afiliados_model->pegar_afiliado(array('idafiliado' => $id_afiliado));
			if ( is_object( $afiliado ) )
			{
				$email = $afiliado->email;
				$content = $this->load->view('afiliado/email_confirmar', 
					array(
						'link_confirmar' => base_url() . 'afiliado/confirmar/?email=' . $email, 
						'email' => $email, 
						'nome' => $afiliado->nome, 
						'sobrenome' => $afiliado->sobrenome
					), true);
					
				$headers = "From: afiliado@easyspa.club\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				@mail( $email, 'Olá '.$afiliado->nome.' seja bem vindo(a) ao easySpa.', $content, $headers);
				$this->load->view('afiliado/mensagem_confirmar', array('enviado' => true, 'id_afiliado' => $id_afiliado));
			}
		}
	}
	
	public function recuperar( $cod_recuperar = false )
	{
		$error = false;
		$sucesso = false;
		if ( $cod_recuperar && is_object( $this->afiliados_model->pegar_afiliado( array('cod_recuperar' => $cod_recuperar ) ) ) )
		{
			if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
			{
				if ( $this->input->post('senha1') != false && 
					 $this->input->post('senha1') == $this->input->post('senha2') )
				{
					$this->afiliados_model->alterar(
						array(
							'senha' => md5( $this->input->post('senha1') ),
							'cod_recuperar' => md5(uniqid(time()))
						),
						array(
							'cod_recuperar' => $cod_recuperar
						)
					);
					$sucesso = true;
				} else
					$error = true;
			}
			
			$this->load->view('afiliado/alterar_senha', array('error' => $error, 'sucesso' => $sucesso));
		} else
		{
			if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
			{
				if ( $this->input->post('email_easyspa') )
				{
					$email = $this->input->post('email_easyspa');
					$afiliado = $this->afiliados_model->pegar_afiliado(array('email' => $email));
					if ( is_object( $afiliado ) )
					{
						$headers = "From: afiliado@easyspa.club\r\n";
						$headers .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						$content = $this->load->view('afiliado/email_recuperar', 
						array(
							'link_recuperar' => base_url() . 'afiliado/recuperar/' . $afiliado->cod_recuperar
						), true);
						@mail( $email, 'easySpa - Recuperar senha', $content, $headers);
						$sucesso = true;
					} else
						$error = true;
				}
			}
			
			$this->load->view('afiliado/recuperar', array('error' => $error, 'sucesso' => $sucesso));
		}
	}
	
	public function conta()
	{
		if ( $this->session->userdata('tipo') == 'afiliado' )
		{
			print 'conta de afiliado';
		}
	}
}
?>