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
	}
	public function cadastro( $id_afiliado = false )
	{
		if ( $id_afiliado )
		{
			if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
			{
				$avatar = '#';
				if ( !empty( $_FILES['foto']['name'] ) )
				{
					$ext = pathinfo( $_FILES['foto']['name'], PATHINFO_EXTENSION );
					$arquivo = md5(uniqid(time())) . '.' . $ext;
					while ( file_exists('upload/' . $arquivo ) )
						$arquivo = md5(uniqid(time())) . '.' . $ext;
						
					$fp = fopen('upload/' . $arquivo, 'wb');
					fwrite( $fp, file_get_contents( $_FILES['foto']['tmp_name'] ) );
					fclose( $fp );
					$avatar = $arquivo;
				}
				
				$tipo = $this->input->post('tipo');
				if ( $tipo == 'PF' )
					$cpfcnpj = $this->input->post('cpf');
				else
					$cpfcnpj = $this->input->post('cnpj');
					
				$estado = $this->db->get_where('estados', array('id' => $this->input->post('estado')))->row()->estado;
					
				$id_funcionaria = $this->funcionarias_model->inserir(
					array(
						'idafiliado' => $id_afiliado,
						'tipo' => $tipo,
						'cpfcnpj' => $cpfcnpj,
						'razaosocial' => $this->input->post('razaosocial'),
						'nomefantasia' => $this->input->post('nomefantasia'),
						'premium' => 0,
						'precadastro' => 1,
						'pontuacao' => 0,
						'avaliacoes' => 0,
						'latitude' => '',
						'longitude' => '',
						'endereco' => $this->input->post('rua'),
						'bairro' => $this->input->post('bairro'),
						'cidade' => $this->input->post('cidade'),
						'estado' => $estado,
						'nome' => $this->input->post('nome'),
						'email' => $this->input->post('email'),
						'senha' => $this->input->post('senha'),
						'avatar' => $avatar,
						'apresentacao' => $this->input->post('apresentacao'),
						'especialidades' => $this->input->post('especialidades'),
						'telefone' => $this->input->post('telefone'),
						'celular' => $this->input->post('celular'),
						'data_inserido' => date('Y-m-d H:i:s')
					)
				);
				
				if ( $this->input->post('segunda_feira') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 1,
							'hora' => $this->input->post('de_segunda_feira')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 1,
							'hora' => $this->input->post('ate_segunda_feira')
						)
					);
				}
				
				if ( $this->input->post('terca_feira') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 2,
							'hora' => $this->input->post('de_terca_feira')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 2,
							'hora' => $this->input->post('ate_terca_feira')
						)
					);
				}
				
				if ( $this->input->post('quarta_feira') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 3,
							'hora' => $this->input->post('de_quarta_feira')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 3,
							'hora' => $this->input->post('ate_quarta_feira')
						)
					);
				}
				
				if ( $this->input->post('quinta_feira') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 4,
							'hora' => $this->input->post('de_quinta_feira')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 4,
							'hora' => $this->input->post('ate_quinta_feira')
						)
					);
				}
				
				if ( $this->input->post('sexta_feira') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 5,
							'hora' => $this->input->post('de_sexta_feira')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 5,
							'hora' => $this->input->post('ate_sexta_feira')
						)
					);
				}
				
				if ( $this->input->post('sabado') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 6,
							'hora' => $this->input->post('de_sabado')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 6,
							'hora' => $this->input->post('ate_sabado')
						)
					);
				}
				
				if ( $this->input->post('domingo') )
				{
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'DE',
							'dia' => 7,
							'hora' => $this->input->post('de_domingo')
						)
					);
					
					$this->db->insert('funcionarias_atendimento',
						array(
							'idfuncionaria' => $id_funcionaria,
							'tipo' => 'ATE',
							'dia' => 7,
							'hora' => $this->input->post('ate_domingo')
						)
					);
				}
				
				$categorias = $this->input->post('categoria');
				
				foreach ( $categorias as $categoria )
				{
					$this->db->insert('funcionarias_categoria',
						array(
							'idcategoria' => $categoria,
							'idfuncionaria' => $id_funcionaria
						)
					);
				}
				
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
			
				$avatar = '#';
				if ( !empty( $_FILES['file']['name'] ) )
				{
					$imgName = md5(uniqid(time())) . '.jpg';
					while ( file_exists( 'upload/' . $imgName ) )
						$imgName = md5(uniqid(time())) . '.jpg';
						
					$fp = fopen('upload/' . $imgName, 'wb');
					fwrite($fp, file_get_contents($_FILES['file']['tmp_name']));
					fclose($fp);
					
					$avatar = $imgName;
				}
					
				$idafiliado = $this->input->post('idafiliado');
				$nome = $this->input->post('nome');
				$categorias = $this->input->post('categoria');
				$apresentacao = $this->input->post('apresentacao');
				$especialidades = $this->input->post('especialidades');
				
				$endereco = $this->input->post('endereco');
				$bairro = $this->input->post('bairro');
				$cidade = $this->input->post('cidade');
				$estado = $this->input->post('estado');
				$email = $this->input->post('email');
				$senha = $this->input->post('senha');
				$latitude = $this->input->post('latitude');
				$longitude = $this->input->post('longitude');
				$telefone = $this->input->post('telefone');
				$celular = $this->input->post('celular');
				
				$segunda_feira = $this->input->post('segunda_feira');
				$terca_feira = $this->input->post('terca_feira');
				$quarta_feira = $this->input->post('quarta_feira');
				$quinta_feira = $this->input->post('quinta_feira');
				$sexta_feira = $this->input->post('sexta_feira');
				$sabado = $this->input->post('sabado');
				$domingo = $this->input->post('domingo');
				
				$de_segunda_feira = $this->input->post('de_segunda_feira');
				$de_terca_feira = $this->input->post('de_terca_feira');
				$de_quarta_feira = $this->input->post('de_quarta_feira');
				$de_quinta_feira = $this->input->post('de_quinta_feira');
				$de_sexta_feira = $this->input->post('de_sexta_feira');
				$de_sabado = $this->input->post('de_sabado');
				$de_domingo = $this->input->post('de_domingo');
				
				$ate_segunda_feira = $this->input->post('ate_segunda_feira');
				$ate_terca_feira = $this->input->post('ate_terca_feira');
				$ate_quarta_feira = $this->input->post('ate_quarta_feira');
				$ate_quinta_feira = $this->input->post('ate_quinta_feira');
				$ate_sexta_feira = $this->input->post('ate_sexta_feira');
				$ate_sabado = $this->input->post('ate_sabado');
				$ate_domingo = $this->input->post('ate_domingo');
				$id_funcionaria = $this->session->userdata('id');
				if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) )
				{
					if ( !is_object( $this->usuarios_model->pegar_usuario( array('email' => $email) ) ) &&
						 !is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $email ) )) &&
						 !is_object( $this->afiliados_model->pegar_afiliado(array('email' => $email))) )
					{
						if ( $id_funcionaria )
						{
							$this->db->insert('anuncios', array(
								'idfuncionaria' => $id_funcionaria,
								'titulo' => $nome,
								'avatar' => $avatar,
								'telefone' => $telefone,
								'celular' => $celular,
								'pontuacao' => 0,
								'avaliacoes' => 0,
								'latitude' => $latitude,
								'longitude' => $longitude,
								'endereco' => $endereco,
								'bairro' => $bairro,
								'cidade' => $cidade,
								'estado' => $estado,
								'especialidades' => $especialidades,
								'apresentacao' => $apresentacao,
								'data_inserido' => date('Y-m-d H:i:s')
							));
							
							$idanuncio = $this->db->insert_id();
							
							foreach ( $categorias as $categoria )
							{
								$this->db->insert('anuncio_categorias',
									array(
										'idcategoria' => $categoria,
										'idanuncio' => $idanuncio
									)
								);
							}
					
							if ( $domingo )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 0,
										'hora' => $de_domingo
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 0,
										'hora' => $ate_domingo
									)
								);
							}
							
							if ( $segunda_feira )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 1,
										'hora' => $de_segunda_feira
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 1,
										'hora' => $ate_segunda_feira
									)
								);
							}
							
							if ( $terca_feira )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 2,
										'hora' => $de_terca_feira
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 2,
										'hora' => $ate_terca_feira
									)
								);
							}
							
							if ( $quarta_feira )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 3,
										'hora' => $de_quarta_feira
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 3,
										'hora' => $ate_quarta_feira
									)
								);
							}
							
							if ( $quinta_feira )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 4,
										'hora' => $de_quinta_feira
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 4,
										'hora' => $ate_quinta_feira
									)
								);
							}
							
							if ( $sexta_feira )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 5,
										'hora' => $de_sexta_feira
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 5,
										'hora' => $ate_sexta_feira
									)
								);
							}
							
							if ( $sabado )
							{
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'DE',
										'dia' => 6,
										'hora' => $de_sabado
									)
								);
								
								$this->db->insert('anuncio_atendimento',
									array(
										'idanuncio' => $idanuncio,
										'tipo' => 'ATE',
										'dia' => 6,
										'hora' => $ate_sabado
									)
								);
							}
						}
					}
				}
			
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
	
	public function configuracoes()
	{
		if ( $this->session->userdata('tipo') == 'prestador' )
		{
			$this->load->view('prestador/header_painel');
			$this->load->view('prestador/configuracoes');
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
}
?>