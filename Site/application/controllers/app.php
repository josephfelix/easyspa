<?php
class App extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With');
		header('Access-Control-Allow-Methods: GET, PUT, POST');
		
		$this->load->model('usuarios_model');
		$this->load->model('enderecos_model');
		$this->load->model('funcionarias_model');
		$this->load->model('banners_model');
		$this->load->model('chat_model');
		$this->load->model('cupons_model');
	}
	
	public function index()
	{
	}
	
	public function verificarregistro()
	{ 
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			
			if ( !isset( $post->nome ) )
			{
				print json_encode(array('error' => 1, 'msg' => 'Insira um nome valido para continuar!'));
				die;
			}
			
			if ( !isset( $post->email ) )
			{
				print json_encode(array('error' => 1, 'msg' => 'Insira um e-mail valido para continuar!'));
				die;
			}
			
			if ( !isset( $post->senha ) )
			{
				print json_encode(array('error' => 1, 'msg' => 'Insira uma senha valida para continuar!'));
				die;
			}
			
			if ( filter_var( $post->email, FILTER_VALIDATE_EMAIL ) )
			{
				if ( !is_object( $this->usuarios_model->pegar_usuario( array('email' => $post->email) ) ) )
				{
					print json_encode(array('error' => 0));
				} else
					print json_encode(array('error' => 1, 'msg' => 'Endereco de e-mail ja registrado, use outro para continuar!'));
			} else
				print json_encode(array('error' => 1, 'msg' => 'Insira um e-mail valido para continuar!'));
		} else
			print json_encode(array('error' => 1, 'msg' => 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.'));
	}
	
	public function registrar()
	{ 
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			if ( !empty( $_FILES['file']['name'] ) )
			{
				$imgName = md5(uniqid(time())) . '.jpg';
				while ( file_exists( 'upload/' . $imgName ) )
					$imgName = md5(uniqid(time())) . '.jpg';
					
				$fp = fopen('upload/' . $imgName, 'wb');
				fwrite($fp, file_get_contents($_FILES['file']['tmp_name']));
				fclose($fp);
				
				$nome = $this->input->post('nome');
				$sobrenome = $this->input->post('sobrenome');
				$celular = $this->input->post('celular');
				$rua = $this->input->post('rua');
				$complemento = $this->input->post('complemento');
				$bairro = $this->input->post('bairro');
				$cidade = $this->input->post('cidade');
				$estado = $this->input->post('estado');
				$email = $this->input->post('email');
				$senha = $this->input->post('senha');
				$latitude = $this->input->post('latitude');
				$longitude = $this->input->post('longitude');
				$fbid = $this->input->post('fbid');
				$foto = $imgName;
			} else
			{
				$post = json_decode(file_get_contents('php://input'));
				$nome = $post->nome;
				$sobrenome = $post->sobrenome;
				$celular = $post->celular;
				$rua = $post->rua;
				$complemento = $post->complemento;
				$bairro = $post->bairro;
				$cidade = $post->cidade;
				$estado = $post->estado;
				$email = $post->email;
				$senha = $post->senha;
				$latitude = $post->latitude;
				$longitude = $post->longitude;
				$foto = $post->foto;
				$fbid = $post->fbid;
			}
			
			if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) )
			{
				if ( !is_object( $this->usuarios_model->pegar_usuario( array('email' => $email) ) ) )
				{
					$id_usuario = $this->usuarios_model->inserir(
						array(
								'latitude' => $latitude,
								'longitude' => $longitude,
								'nome' => $nome,
								'fbid' => $fbid,
								'tipo' => 'CADASTRO',
								'email' => $email,
								'senha' => md5($senha),
								'nome' => $nome,
								'sobrenome' => $sobrenome,
								'celular' => $celular,
								'foto' => $foto,
								'data' => date('Y-m-d H:i:s')
							)
						);
					if ( $id_usuario )
					{
						$this->enderecos_model->inserir(
							array(
								'idusuario' => $id_usuario,
								'rua' => $rua,
								'complemento' => $complemento,
								'bairro' => $bairro,
								'cidade' => $cidade,
								'estado' => $estado
							)
						);
						print json_encode(array('error' => 0, 'msg' => 'Conta criada com sucesso, clique em OK para continuar!', 'id' => $id_usuario, 'foto' => $foto));
					} else
						print json_encode(array('error' => 1, 'msg' => 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.'));
				} else
					print json_encode(array('error' => 1, 'msg' => 'Endereco de e-mail ja registrado, use outro para continuar!'));
			} else
				print json_encode(array('error' => 1, 'msg' => 'Insira um e-mail valido para continuar!'));
		} else
			print json_encode(array('error' => 1, 'msg' => 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.'));
	}

	public function login()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->email ) && isset( $post->senha ) )
			{					
				$usuario = $this->usuarios_model->pegar_usuario( array(
					'email' => $post->email,
					'tipo' => 'CADASTRO',
					'senha' => md5( $post->senha )
				) );
				
				if ( is_object( $usuario ) )
				{
					$endereco = $this->enderecos_model->pegar_endereco(array('idusuario' => $usuario->id));
					print json_encode(array(
						'status' => 'OK',
						'latitude' => $usuario->latitude,
						'longitude' => $usuario->longitude,
						'nome' => $usuario->nome,
						'sobrenome' => $usuario->sobrenome,
						'email' => $usuario->email,
						'celular' => $usuario->celular,
						'rua' => $endereco->rua,
						'complemento' => $endereco->complemento,
						'bairro' => $endereco->bairro,
						'cidade' => $endereco->cidade,
						'estado' => $endereco->estado,
						'id' => $usuario->id,
						'foto' => $usuario->foto
					));
					die;
				}
			}
		}
		print json_encode(array('status' => 'FAIL'));
	}
	
	public function logincomercial()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->email ) && isset( $post->senha ) )
			{					
				$funcionaria = $this->funcionarias_model->pegar_funcionaria( array(
					'email' => $post->email,
					'senha' => md5( $post->senha )
				) );
				
				if ( is_object( $funcionaria ) )
				{
					$anuncios = $this->db->get_where('anuncios', array('idfuncionaria' => $funcionaria->id));
					print json_encode(array(
						'status' => 'OK',
						'funcionaria' => json_encode( $funcionaria ),
						'anuncios' => json_encode( $anuncios )
					));
					die;
				}
			}
		}
		print json_encode(array('status' => 'FAIL'));
	}
	
	public function servicos()
	{ 
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->cidade ) )
			{
				$pegar = array('cidade' => $post->cidade);
				if ( isset( $post->categoria ) )
					$pegar['categoria'] = $post->categoria;
					
				if ( isset( $post->order ) )
				{
					if ( $post->order == 'qualificacao' )
					{
						$pegar['orderby'] = 'pontuacao';
						$pegar['order'] = 'DESC';
					} elseif ( $post->order == 'proximo' )
					{
						$pegar['orderby'] = 'distancia';
						$pegar['order'] = 'ASC';
						$pegar['latitude'] = $post->latitude;
						$pegar['longitude'] = $post->longitude;
					}
				}
					
				$funcionarias = $this->funcionarias_model->pegar_funcionarias( $pegar );
				
				/* if ( !is_array( $funcionarias ) )
				{
					unset( $pegar['bairro'] );
					$funcionarias = $this->funcionarias_model->pegar_funcionarias( $pegar );
				} */
				
				if ( is_array( $funcionarias ) )
				{
					print json_encode(
						array(
							'status' => 'OK',
							'funcionarias' => $funcionarias
						)
					);
				} else
					print json_encode(array('status' => 'FAIL'));
			} else
				print json_encode(array('status' => 'FAIL'));
		}
	}
	
	public function agenda()
	{ 
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
		}
	}
	
	public function perfil()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->id ) )
			{
				$funcionaria = $this->funcionarias_model->pegar_funcionaria(array('id' => $post->id));
				if ( is_object( $funcionaria ) )
				{
					print json_encode(array(
						'status' => 'OK',
						'funcionaria' => array(
							'id' => $funcionaria->id,
							'nome' => $funcionaria->nome,
							'categoria' => $funcionaria->categoria,
							'apresentacao' => $funcionaria->apresentacao,
							'especialidades' => $funcionaria->especialidades,
							'atendimento' => '',
							'bairro' => $funcionaria->bairro,
							'cidade' => $funcionaria->cidade,
							'latitude' => $funcionaria->latitude,
							'longitude' => $funcionaria->longitude
						)
					));
					die;
				}
			}
			print json_encode(array('status' => 'FAIL'));
		}
	}
	
	public function banner()
	{
		if ( $this->input->get('cidade') && $this->input->get('estado') )
		{
			$banners = array('LAND' => '', 'TOP' => '', 'HALF1' => '', 'HALF2' => '', 'HALF3' => '', 'HALF4' => '', 'BOTTOM1' => '', 'BOTTOM2' => '');
			foreach ( $banners as $tipo => $banner )
			{
				$banner_obj = $this->banners_model->pegar_banners_app($tipo, $this->input->get('cidade'), $this->input->get('estado'));
				if ( is_object( $banner_obj ) )
					$banners[$tipo] = array('link' => $banner_obj->link, 'banner' => $banner_obj->banner);
			}
			print json_encode( $banners );
		}
	}
	
	public function getchat()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			
			if ( isset( $post->user1 ) && isset( $post->user2 ) )
			{
				$conversa = $this->chat_model->pegar_conversa( $post->user1, $post->user2 ); 
				
				print json_encode(array('status' => 'OK', 'chat' => $conversa));
				die;
			}
		}
		print json_encode(array('status' => 'FAIL'));
	}
	
	public function postchat()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->from ) && isset( $post->to ) && isset( $post->text ) )
			{
				$this->chat_model->inserir( 
					array(
						'user1' => $post->from,
						'user2' => $post->to,
						'mensagem' => $post->text,
						'data' => date('Y-m-d H:i:s')
					)
				);
				print json_encode(
					array(
						'status' => 'OK',
						'user1' => $post->from,
						'user2' => $post->to,
						'mensagem' => $post->text,
						'data' => date('Y-m-d H:i:s')
					)
				);
				die;
			}
		}
		print json_encode(array('status' => 'FAIL'));
	}
	
	public function loginfacebook()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->id ) && isset( $post->email ) )
			{
				$usuario = $this->usuarios_model->pegar_usuario( array(
					'email' => $post->email,
					'tipo' => 'CADASTRO',
					'fbid' => $post->id
				) );
				
				if ( is_object( $usuario ) )
				{
					$endereco = $this->enderecos_model->pegar_endereco(array('idusuario' => $usuario->id));
					print json_encode(array(
						'status' => 'OK',
						'latitude' => $usuario->latitude,
						'longitude' => $usuario->longitude,
						'nome' => $usuario->nome,
						'sobrenome' => $usuario->sobrenome,
						'email' => $usuario->email,
						'celular' => $usuario->celular,
						'rua' => $endereco->rua,
						'complemento' => $endereco->complemento,
						'bairro' => $endereco->bairro,
						'cidade' => $endereco->cidade,
						'estado' => $endereco->estado,
						'id' => $usuario->id,
						'foto' => $usuario->foto,
						'fbid' => $usuario->fbid
					));
					die;
				}
			}
		}
	}
	
	public function mensagens()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->iduser ) )
			{
				$this->db->where('user1', $post->iduser);
				$this->db->group_by('user2');
				$this->db->order_by('data', 'DESC');
				$chats = $this->db->get('chat');
				if ( $chats->num_rows() > 0 )
				{
					$chats = $chats->result();
					foreach ( $chats as $key => $chat )
					{
						$funcionaria = $this->funcionarias_model->pegar_funcionaria(array('id' => $chat->user2));
						
						$chats[$key]->funcionaria = array(
							'id' => $funcionaria->id,
							'nome' => $funcionaria->nome,
							'categoria' => $funcionaria->categoria,
							'bairro' => $funcionaria->bairro,
							'cidade' => $funcionaria->cidade,
							'avatar' => $funcionaria->avatar
						);
					}
					print json_encode($chats);
				}
			}
		}
	}
	
	public function atendimentos()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->iduser ) )
			{
				$this->db->where('idusuario', $post->iduser);
				$this->db->where('data_agendada < NOW()');
				$busca = $this->db->get('atendimentos');
				if ( $busca->num_rows() > 0 )
				{
					$atendimentos = $busca->result();
					$naoAvaliados = array();
					$avaliados = array();
					foreach ( $atendimentos as $key => $atendimento )
					{
						$funcionaria = $this->funcionarias_model->pegar_funcionaria(array('id' => $atendimento->idfuncionaria));
						$atendimentos[$key]->funcionaria = array(
							'id' => $funcionaria->id,
							'nome' => $funcionaria->nome,
							'categoria' => $funcionaria->categoria,
							'bairro' => $funcionaria->bairro,
							'cidade' => $funcionaria->cidade,
							'avatar' => $funcionaria->avatar,
							'pontuacao' => $funcionaria->pontuacao,
							'avaliacoes' => $funcionaria->avaliacoes
						);
						
						$this->db->where('idfuncionaria', $funcionaria->id);
						$this->db->where('idusuario', $post->iduser);
						$busca = $this->db->get('avaliacoes');
						if ( !$busca->num_rows() )
							$naoAvaliados[] = $atendimentos[$key];
						else
							$avaliados[] = $atendimentos[$key];
					}
					
					print json_encode(array('atendimentos' => $avaliados, 'nao_avaliados' => $naoAvaliados));
				}
			}
		}
	}
	
	public function contato()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			if ( isset( $post->texto ) && isset( $post->email ) && isset( $post->tipo ) )
			{
				$this->db->insert('contato',
					array(
						'tipo' => $post->tipo,
						'email' => $post->email,
						'texto' => $post->texto,
						'data' => date('Y-m-d H:i:s')
					)
				);
				print json_encode(array('status' => 'OK'));
			} else
				print json_encode(array('status' => 'FAIL'));
		}
	}
	
	public function registrarfuncionaria()
	{ 
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
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
				
				$idafiliado = $this->input->post('idafiliado');
				$nome = $this->input->post('nome');
				$categorias = $this->input->post('categorias');
				$apresentacao = $this->input->post('apresentacao');
				$especialidades = $this->input->post('especialidades');
				
				$razaosocial = $this->input->post('razaosocial');
				$nomefantasia = $this->input->post('nomefantasia');
				
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
				$foto = $imgName;
				
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
				
				$tipo = $this->input->post('tipo');
				if ( $tipo == 'PF' )
					$cpfcnpj = $this->input->post('cpf');
				else
					$cpfcnpj = $this->input->post('cnpj');
				
				$dataNascimento = date('Y-m-d', strtotime($this->input->post('dataNascimento')));
				
			} else
			{
				$post = json_decode(file_get_contents('php://input'));
				$idafiliado = $post->idafiliado;
				$nome = $post->nome;
				$categorias = $post->categorias;
				$apresentacao = $post->apresentacao;
				$especialidades = $post->especialidades;
				
				$razaosocial = $post->razaosocial;
				$nomefantasia = $post->nomefantasia;
				
				$endereco = $post->endereco;
				$bairro = $post->bairro;
				$cidade = $post->cidade;
				$estado = $post->estado;
				$email = $post->email;
				$senha = $post->senha;
				$latitude = $post->latitude;
				$longitude = $post->longitude;
				$telefone = $post->telefone;
				$celular = $post->celular;
				$foto = $post->foto;
				
				$segunda_feira = $post->segunda_feira;
				$terca_feira = $post->terca_feira;
				$quarta_feira = $post->quarta_feira;
				$quinta_feira = $post->quinta_feira;
				$sexta_feira = $post->sexta_feira;
				$sabado = $post->sabado;
				$domingo = $post->domingo;
				
				$de_segunda_feira = $post->de_segunda_feira;
				$de_terca_feira = $post->de_terca_feira;
				$de_quarta_feira = $post->de_quarta_feira;
				$de_quinta_feira = $post->de_quinta_feira;
				$de_sexta_feira = $post->de_sexta_feira;
				$de_sabado = $post->de_sabado;
				$de_domingo = $post->de_domingo;
				
				$ate_segunda_feira = $post->ate_segunda_feira;
				$ate_terca_feira = $post->ate_terca_feira;
				$ate_quarta_feira = $post->ate_quarta_feira;
				$ate_quinta_feira = $post->ate_quinta_feira;
				$ate_sexta_feira = $post->ate_sexta_feira;
				$ate_sabado = $post->ate_sabado;
				$ate_domingo = $post->ate_domingo;
				
				$tipo = $post->tipo;
				if ( $tipo == 'PF' )
					$cpfcnpj = $post->cpf;
				else
					$cpfcnpj = $post->cnpj;
				
				$dataNascimento = date('Y-m-d', strtotime($post->dataNascimento));
			}
			
			if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) )
			{
				if ( !is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $email) ) ) )
				{
					$id_funcionaria = $this->funcionarias_model->inserir(
						array(
								'idafiliado' => $idafiliado,
								'tipo' => $tipo,
								'cpfcnpj' => $cpfcnpj,
								'datanascimento' => $dataNascimento,
								'razaosocial' => $razaosocial,
								'nomefantasia' => $nomefantasia,
								'premium' => 0,
								'precadastro' => 0,
								'email' => $email,
								'senha' => md5($senha),
								'data_inserido' => date('Y-m-d H:i:s')
							)
						);
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
						
						print json_encode(array('error' => 0, 'msg' => 'Conta criada com sucesso, clique em OK para continuar!', 'id' => $id_funcionaria, 'foto' => $foto));
					} else
						print json_encode(array('error' => 1, 'msg' => 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.'));
				} else
					print json_encode(array('error' => 1, 'msg' => 'Endereco de e-mail ja registrado, use outro para continuar!'));
			} else
				print json_encode(array('error' => 1, 'msg' => 'Insira um e-mail valido para continuar!'));
		} else
			print json_encode(array('error' => 1, 'msg' => 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.'));
	}
	
	public function checkfuncionaria()
	{
		$tipo = $this->input->get('tipo');
		$data = $this->input->get('data');
		if ( $tipo == 'email' )
		{
			if ( is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $data) ) ) )
				print json_encode(array('status' => 'FAIL'));
			else
				print json_encode(array('status' => 'OK'));
		} elseif ( $tipo == 'cpfcnpj' )
		{
			if ( is_object( $this->funcionarias_model->pegar_funcionaria( array('cpfcnpj' => $data) ) ) )
				print json_encode(array('status' => 'FAIL'));
			else
				print json_encode(array('status' => 'OK'));
		}
	}
	
	public function estados()
	{
		print json_encode($this->db->get('estados')->result());
	}
	
	public function cidades()
	{
		print json_encode($this->db->get_where('cidades', array('idestado' => $this->input->get('estado')))->result());
	}
	
	public function cupons()
	{
		$post = file_get_contents('php://input');
		if ( !empty( $post ) &&
			strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$post = json_decode( $post );
			$ordem = $post->ordem;
			if ( $post->ordem == 'data' )
			{
				$cupons = $this->cupons_model->pegar_cupons(array('orderby' => 'data_inserido', 'order' => 'DESC'));
			} elseif ( $post->ordem == 'distancia' )
			{
				$cupons = $this->cupons_model->pegar_cupons(
					array(
						'latitude' => $post->latitude,
						'longitude' => $post->longitude,
						'orderby' => 'distancia', 
						'order' => 'DESC'
					)
				);
			}
			print json_encode($cupons);
		}
	}
}
?>