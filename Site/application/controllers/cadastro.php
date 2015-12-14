<?php
class Cadastro extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->model('funcionarias_model');
		$this->load->model('afiliados_model');
		
		$this->load->library('cliente_lib');
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
			if ( $this->cliente_lib->cadastrar() )
			{
				header('Location: ' . base_url() . 'cadastro/?tipo=prestador&sucesso=1');
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