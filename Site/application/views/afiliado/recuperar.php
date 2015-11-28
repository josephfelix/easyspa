<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easySpa - Recuperar senha</title>

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
											<h1>Recuperar conta</h1>
											<img src="<?=base_url()?>assets/images/logo.png" />
									  </div>
									  <div class="form-main">
										<form method="POST">
											<div class="form-group">
												<label style="color:#fff;">Informe seu endere&ccedil;o de e-mail</label>
												<input type="email" id="un_1" class="form-control" placeholder="Endere&ccedil;o de e-mail" name="email_easyspa" required="required">
											</div>
											<button id="signIn_1" type="submit" class="btn btn-block signin">Recuperar conta</button>
										</form>
									  </div>
										<?php
											if ( $error )
											{
										?>
											<div class="alert alert-danger alert-login">
												<strong>ERRO:</strong>&nbsp;o endere&ccedil;o de e-mail informado n&atilde;o pertence a nenhum afiliado cadastrado em nossa base de dados
											</div>
										<?php
											}
										?>
										<?php
											if ( $sucesso )
											{
										?>
											<div class="alert alert-success alert-login">
												<strong>Sucesso:</strong>&nbsp;o link para recuperar sua conta foi enviado para o e-mail informado. Caso n&atilde;o encontre o e-mail na caixa de entrada, verifique na caixa de spam.
											</div>
										<?php
											}
										?>
										<div class="form-footer">
											<i class="fa fa-chevron-left"></i>
											<a href="<?=base_url()?>afiliado/login" id="forgot_from_1">Voltar para login</a>
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
