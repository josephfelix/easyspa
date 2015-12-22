<?php
class Cliente extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('funcionarias_model');
		$this->load->model('usuarios_model');
		$this->load->model('afiliados_model');
		$this->load->model('cupons_model');
		$this->load->model('anuncios_model');
		
		$this->load->library('cliente_lib');
	}
	public function cadastro( $id_afiliado = false )
	{
		if ( $id_afiliado )
		{
			if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
			{
				$this->cliente->cadastrar($_POST, $id_afiliado);
				$this->load->view('prestador/sucesso_cadastro', array('id_afiliado' => $id_afiliado));
			} else
			{
				$estados = $this->db->get('estados')->result();
				$this->load->view('prestador/cadastro', array('estados' => $estados, 'id_afiliado' => $id_afiliado));
			}
		}
	}
	
	public function check()
	{
		$tipo = $this->input->get('tipo');
		$data = $this->input->get('data');
		if ( $tipo == 'email' )
		{
			if ( is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $data) ) ) ||
				 is_object( $this->usuarios_model->pegar_usuario( array('email' => $data) ) ) ||
				 is_object( $this->afiliados_model->pegar_afiliado( array('email' => $data)) ) )
					print json_encode(array('status' => 'FAIL'));
				else
					print json_encode(array('status' => 'OK'));
		} elseif ( $tipo == 'cpfcnpj' )
		{
			if ( is_object( $this->funcionarias_model->pegar_funcionaria( array('cpfcnpj' => $data) ) ) ||
				 is_object( $this->afiliados_model->pegar_afiliado( array('cpfcnpj' => $data)) ) )
					print json_encode(array('status' => 'FAIL'));
				else
					print json_encode(array('status' => 'OK'));
		}
	}
	
	public function conta()
	{
		if ( $this->session->userdata('tipo') == 'prestador' )
		{
			$id = $this->session->userdata('id');
			$total_anuncios = $this->anuncios_model->total_anuncios_ativos($id);
			$cupons = $this->cupons_model->pegar_cupons(array('idfuncionaria' => $id));
			$total_cupons = $cupons ? sizeof($cupons) : 0;
			$total_cupons_site = 0;
			$total_cupons_app = 0;
			if ( $total_cupons > 0 )
			{
				$total_cupons_site = array_filter($cupons, function($cupom)
				{
					if ($cupom->origem == 'SITE')
						return true;
				});
				$total_cupons_app = array_filter($cupons, function($cupom)
				{
					if ($cupom->origem == 'APP')
						return true;
				});
			}
			$anuncios = $this->anuncios_model->pegar_anuncios(array('idfuncionaria' => $id));
			if ( is_array( $anuncios ) )
			{
				foreach ( $anuncios as $key => $anuncio )
				{
					$anuncios[$key]->categoria_principal = $this->anuncios_model->categoria_principal( $anuncio->idanuncio );
				}
			}
			$this->load->view('prestador/header_painel');
			$this->load->view('prestador/dashboard',
				array(
					'total_anuncios' => $total_anuncios,
					'total_cupons' => $total_cupons,
					'total_cupons_site' => $total_cupons_site,
					'total_cupons_app' => $total_cupons_app,
					'anuncios' => $anuncios
				)
			);
			$this->load->view('prestador/footer_painel');
		} else
			header('Location: ' . base_url() . 'login');
	}
	
	public function anuncio($section = '', $param1 = 0)
	{
		if ($section == 'novo' && $param1 == 0)
		{
			if (strtoupper($this->input->server('REQUEST_METHOD')) == 'POST')
			{
				$this->cliente_lib->cadastrar_anuncio($this->session->userdata('id'));
				header('Location: ' . base_url() . 'cliente/conta/?cadastro=1');
			} else
			{
				$estados = $this->db->get('estados')->result();
				$this->load->view('prestador/header_painel');
				$this->load->view('prestador/novo_anuncio',
					array(
						'estados' => $estados
					)
				);
				$this->load->view('prestador/footer_painel');
			}
		} elseif ($section == 'editar' && $param1 != 0 )
		{
			$estados = $this->db->get('estados')->result();
			$anuncio = $this->anuncios_model->pegar_anuncio(array('idanuncio' => $param1));
			if ( $anuncio )
			{
				$this->load->view('prestador/header_painel');
				$this->load->view('prestador/editar_anuncio', 
					array(
						'anuncio' => $anuncio,
						'estados' => $estados
					)
				);
				$this->load->view('prestador/footer_painel');
			} else
				header('Location: ' . base_url() . 'cliente/conta');
		}
	}
	
	public function configuracoes($section = '')
	{
		if ( $this->session->userdata('tipo') == 'prestador' )
		{
			$sucesso_senha = false;
			$sucesso_dados = false;
			if ( strtoupper($this->input->server('REQUEST_METHOD')) == 'POST' )
			{
				if ( $section == 'senha' )
				{
					if ($this->input->post('senha') && !empty($this->input->post('senha')))
					{
						$this->funcionarias_model->alterar(
							array(
								'senha' => md5($this->input->post('senha'))
							),
							array(
								'id' => $this->session->userdata('id')
							)
						);
						$sucesso_senha = true;
					}
				} elseif ( $section == 'dados' )
				{
					$update = array();
					if ($this->input->post('datanascimento'))
					{
						list($dia, $mes, $ano) = explode('/', $this->input->post('datanascimento'));
						$update['datanascimento'] = join('-', array($ano, $mes, $dia));
					}
					if ($this->input->post('tipo'))
					{
						$update['tipo'] = $this->input->post('tipo');
					}
					if ($this->input->post('cpfcnpj'))
					{
						$update['cpfcnpj'] = $this->input->post('cpfcnpj');
					}
					if ($this->input->post('tipo') == 'PJ' && $this->input->post('razaosocial'))
					{
						$update['razaosocial'] = $this->input->post('razaosocial');
					}
					if ($this->input->post('tipo') == 'PJ' && $this->input->post('nomefantasia'))
					{
						$update['nomefantasia'] = $this->input->post('nomefantasia');
					}
					if (!empty($update))
					{
						$this->funcionarias_model->alterar($update, array('id' => $this->session->userdata('id')));
					}
					$sucesso_dados = true;
				}
			}
			
			$dados = $this->funcionarias_model->pegar_funcionaria(array('id' => $this->session->userdata('id')));
			$this->load->view('prestador/header_painel');
			$this->load->view('prestador/configuracoes', array(
				'dados' => $dados,
				'sucesso_senha' => $sucesso_senha,
				'sucesso_dados' => $sucesso_dados
			));
			$this->load->view('prestador/footer_painel');
		} else
			header('Location: ' . base_url() . 'login');
	}
	
	public function publicidade($section = '', $param1 = 0)
	{
		if ($section == 'novo' && $param1 == 0)
		{
			$this->load->view('prestador/header_painel');
			$this->load->view('prestador/nova_publicidade');
			$this->load->view('prestador/footer_painel');
		}
	}
	
	public function cupom($section = '', $param1 = 0)
	{
		if ($section == 'novo' && $param1 == 0)
		{
			$this->load->view('prestador/header_painel');
			$this->load->view('prestador/novo_cupom');
			$this->load->view('prestador/footer_painel');
		}
	}
	
	public function financeiro()
	{	
		$this->load->view('prestador/header_painel');
		$this->load->view('prestador/financeiro');
		$this->load->view('prestador/footer_painel');
	}
	
	public function central()
	{
		$this->load->view('prestador/header_painel');
		$this->load->view('prestador/central_cliente');
		$this->load->view('prestador/footer_painel');
	}
	
	public function ajuda()
	{
		$this->load->view('prestador/header_painel');
		$this->load->view('prestador/central_ajuda');
		$this->load->view('prestador/footer_painel');
	}
}
?>