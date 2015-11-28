<?php
class Cadastro extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->model('funcionarias_model');
		$this->load->model('afiliados_model');
	}
	public function index()
	{
		$estados = $this->db->get('estados')->result();
		$bancos = $this->db->get('bancos')->result();
		
		$this->load->view('header');
		$this->load->view('cadastro', array('estados' => $estados, 'bancos' => $bancos));
		$this->load->view('footer');
	}
	
	public function usuario()
	{
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$foto = '#';
			if ( !empty( $_FILES['foto']['tmp_name'] ) )
			{
				$imgName = md5(uniqid(time())) . '.jpg';
				while ( file_exists( 'upload/' . $imgName ) )
					$imgName = md5(uniqid(time())) . '.jpg';
					
				$fp = fopen('upload/' . $imgName, 'wb');
				fwrite($fp, file_get_contents($_FILES['foto']['tmp_name']));
				fclose($fp);
				
				$foto = $imgName;
			}
			
			$nome = $this->input->post('nome');
			$sobrenome = $this->input->post('sobrenome');
			if (!$nome || !$sobrenome)
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=usuario&error=2');
				die;
			}
			$celular = $this->input->post('celular');
			$endereco = $this->input->post('endereco');
			$complemento = $this->input->post('complemento');
			$bairro = $this->input->post('bairro');
			$cidade = $this->input->post('cidade');
			$this->db->where('id', $this->input->post('estado'));
			$item = $this->db->get('estados');
			$estado = $item->row()->estado;
			
			if ( !$endereco || !$complemento || !$bairro || !$cidade || !$estado )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=usuario&error=3');
				die;
			}
			
			$email = $this->input->post('email');
			if ( !filter_var($email, FILTER_VALIDATE_EMAIL) || 
				 is_object( $this->usuarios_model->pegar_usuario( array('email' => $email) ) ) ||
				 is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $email ) )) ||
				 is_object( $this->afiliados_model->pegar_afiliado(array('email' => $email))) )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=usuario&error=1');
				die;
			}
			$senha = md5($this->input->post('senha'));
			if ( $this->usuarios_model->inserir(array(
				'fbid' => '',
				'origem' => 'SITE',
				'latitude' => '',
				'longitude' => '',
				'email' => $email,
				'senha' => $senha,
				'nome' => $nome,
				'sobrenome' => $sobrenome,
				'celular' => $celular,
				'foto' => $foto,
				'endereco' => $endereco,
				'complemento' => $complemento,
				'bairro' => $bairro,
				'cidade' => $cidade,
				'estado' => $estado,
				'data' => date('Y-m-d H:i:s')
			)) )
				header('Location: ' . base_url() . 'cadastro/?tipo=usuario&sucesso=1');
			else
				header('Location: ' . base_url() . 'cadastro/?tipo=usuario&error=4');
		}
	}
	
	public function prestador()
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
			}
				
			$idafiliado = $this->input->post('idafiliado');
			$nome = $this->input->post('nome');
			$categorias = $this->input->post('categoria');
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
			
			if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) )
			{
				if ( !is_object( $this->usuarios_model->pegar_usuario( array('email' => $email) ) ) &&
					 !is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $email ) )) &&
					 !is_object( $this->afiliados_model->pegar_afiliado(array('email' => $email))) )
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
						
						header('Location: ' . base_url() . 'cadastro/?tipo=prestador&sucesso=1');
					} else
						header('Location: ' . base_url() . 'cadastro/?tipo=prestador&error=2');
				} else
					header('Location: ' . base_url() . 'cadastro/?tipo=prestador&error=1');
			} else
				header('Location: ' . base_url() . 'cadastro/?tipo=prestador&error=1');
		}
	}
	
	public function afiliado()
	{		
		if ( strtoupper( $this->input->server('REQUEST_METHOD') ) == 'POST' )
		{
			$tipo = $this->input->post('tipo');
			$nome = $this->input->post('nome');
			$sobrenome = $this->input->post('sobrenome');
			$email = $this->input->post('email');
			$senha = md5($this->input->post('senha'));
			if ( $tipo == 'PF' )
				$cpfcnpj = $this->input->post('cpf');
			else 
				$cpfcnpj = $this->input->post('cnpj');
			$telefone = $this->input->post('telefone');
			$celular = $this->input->post('celular');
			
			$endereco = $this->input->post('endereco');
			$complemento = $this->input->post('complemento');
			$bairro = $this->input->post('bairro');
			$cidade = $this->input->post('cidade');
			$this->db->where('id', $this->input->post('estado'));
			$item = $this->db->get('estados');
			$estado = $item->row()->estado;
			
			$banco = $this->input->post('banco');
			$agencia = $this->input->post('agencia');
			$conta = $this->input->post('conta');
			
			if ( !filter_var($email, FILTER_VALIDATE_EMAIL) || 
				 is_object( $this->usuarios_model->pegar_usuario( array('email' => $email) ) ) ||
				 is_object( $this->funcionarias_model->pegar_funcionaria( array('email' => $email ) )) ||
				 is_object( $this->afiliados_model->pegar_afiliado(array('email' => $email))) )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=1');
				die;
			}
			if (!$nome || !$sobrenome)
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=2');
				die;
			}
			if ( !$endereco || !$complemento || !$bairro || !$cidade || !$estado )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=3');
				die;
			}
			if ( !$cpfcnpj )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=4');
				die;
			}
			if ( !$banco || !$agencia || !$conta )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=5');
				die;
			}
			
			if ( $this->afiliados_model->inserir(
				array(
					'email' => $email,
					'senha' => md5($senha),
					'confirmado' => 0,
					'cod_recuperar' => md5(uniqid(time())),
					'nome' => $nome,
					'sobrenome' => $sobrenome,
					'tipo' => $tipo,
					'cpfcnpj' => $cpfcnpj,
					'telefone' => $telefone,
					'celular' => $celular,
					'estado' => $estado,
					'cidade' => $cidade,
					'endereco' => $endereco,
					'banco' => $banco,
					'agencia' => $agencia,
					'conta' => $conta,
					'data' => date('Y-m-d H:i:s')
				)) )
			{
				$content = $this->load->view('afiliado/email_confirmar', 
					array(
						'link_confirmar' => base_url() . 'afiliado/confirmar/?email=' . $email, 
						'email' => $email,
						'nome' => $nome, 
						'sobrenome' => $sobrenome
					), true);
				$headers = "From: afiliado@easyspa.club\r\n";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				@mail( $email, 'Olá '.$nome.' seja bem vindo(a) ao easySpa.', $content, $headers);	
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&sucesso=1');
			} else
				header('Location: ' . base_url() . 'cadastro/?tipo=afiliado&error=6');
		}
	}
}
?>