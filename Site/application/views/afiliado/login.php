<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easySpa - Login Afiliado</title>

    <!-- Stylesheets -->
    <link href="<?=base_url()?>assets/login/css/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/login/css/animation.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/login/css/orange.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/login/css/preview.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/login/css/authenty.css" rel="stylesheet">
	
		<!-- Font Awesome CDN -->
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		
		<!-- Google Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>		
		
					  <div class="container authenty signin-main">	  
							<div class="form-wrap wrap">
								<div class="row">
									<div id="form_1" data-animation="bounceIn">
										<div class="form-header">
											<h1>&Aacute;rea de afiliados</h1>
											<img src="<?=base_url()?>assets/images/logo.png" />
									  </div>
									  <div class="form-main">
										<form method="POST">
											<div class="form-group">
												<input type="email" id="un_1" class="form-control" placeholder="Endere&ccedil;o de e-mail" name="email_easyspa" required="required">
												<input type="password" name="senha_easyspa" id="pw_1" class="form-control" placeholder="Sua senha" required="required">
											</div>
											<button id="signIn_1" type="submit" class="btn btn-block signin">Entrar</button>
										</form>
									  </div>
										<?php
											if ( $this->input->get('enviado') )
											{
										?>
											<div class="alert alert-success alert-login">
												<strong>ERRO:</strong>&nbsp;E-mail de confirma&ccedil;&atilde;o enviado com sucesso.
											</div>
										<?php
											}
											
											if ( $error )
											{
												if ( $error == 1 )
												{
										?>
											<div class="alert alert-danger alert-login">
												<strong>ERRO:</strong>&nbsp;Login ou senha incorretos.
											</div>
										<?php
												} elseif ( $error == 2 )
												{
										?>
											<div class="alert alert-warning alert-login">
												<strong>ERRO:</strong>&nbsp;&Eacute; necess&aacute;rio confirmar seu e-mail para entrar, caso n&atilde;o tenha confirmado seu e-mail <a href="<?=base_url()?>afiliado/reenviar/<?=$id_afiliado?>">clique aqui</a> para enviar novamente.
											</div>
										<?php
												}
											}
										?>
										<div class="form-footer">
											<div class="row">
												<div class="col-xs-7">
													<i class="fa fa-unlock-alt"></i>
													<a href="<?=base_url()?>afiliado/recuperar" id="forgot_from_1">Esqueci minha senha</a>
												</div>
												<div class="col-xs-5">
													<i class="fa fa-check"></i>
													<a href="<?=base_url()?>afiliado/cadastro" id="signup_from_1">Cadastrar</a>
												</div>
											</div>
										</div>		
								  </div>
								</div>
							</div>
					  </div>
				
		
	  
    <!-- js library -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
		<script src="<?=base_url()?>assets/login/js/bootstrap.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
		
		<!-- authenty js -->
	<!--	<script src="<?=base_url()?>assets/login/js/authenty.js"></script>-->
		
		
		<!-- preview scripts -->
		<script>
			$(document).ready(function() {
	
				/*
					Fullscreen background
				*/    
				$.backstretch([
				   "<?=base_url()?>assets/img/backgrounds/1.jpg"
				 , "<?=base_url()?>assets/img/backgrounds/2.jpg"
				 , "<?=base_url()?>assets/img/backgrounds/3.jpg"
				 ], {duration: 3000, fade: 750});
			});
		</script>
  </body>
</html>
