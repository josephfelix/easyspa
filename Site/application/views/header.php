<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>easySpa</title>
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.kwicks.min.css" type="text/css">
		<link href="<?=base_url()?>assets/css/fonts.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/easyspa_style.css" type="text/css">
		
		 <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBv0LKFuWL9wFdOsT_hHjoQIknA7FoAGM4&sensor=true"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.kwicks.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.backstretch.min.js"></script>
		<script type="text/javascript">
			const BASE_URL = '<?=base_url()?>';
		</script>
		<script type="text/javascript" src="<?=base_url()?>assets/js/easyspa.js"></script>
	</head>
	<body>
		<div class="topo-site">
			<div class="container">
				<a href="mailto:suporte@easyspa.club">
					<i class="fa fa-headphones"></i>
					&nbsp;suporte@easyspa.club
				</a>
				
				<a href="#">
					<i class="fa fa-phone"></i>
					&nbsp;(21) 0000-0000
				</a>
				
				<?php
					if ( $this->session->userdata('id') )
					{
				?>
					<a href="<?=base_url()?>login/sair">
						<i class="fa fa-sign-out"></i>
						&nbsp;Sair do easySpa
					</a>
				<?php
					} else
					{
				?>
					<a href="<?=base_url()?>login">
						<i class="fa fa-lock"></i>
						&nbsp;Entrar no sistema
					</a>
				<?php
					}
				?>
			</div>
		</div>
			<div class="boxtopo color-navbar-gray">
				<div class="container boxtopo">
					<nav class="navbar navbar-easyspa">
						  <div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							  <span class="sr-only">Toggle navigation</span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							  <span class="icon-bar"></span>
							</button>
							<a href="<?=base_url()?>">
								<img src="<?=base_url()?>assets/img/logo-site.png" alt="" class="logo">
							</a>
						  </div>
						  <div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-left">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Segmentos e Profissionais <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
									</ul>
								</li>
								<li>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EasyClub <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
									</ul>
								</li>
								<li>
									<a href="#">EasyBeauty</a>
								</li>
								<li>
									<a href="#">Por que se cadastrar?</a>
								</li>
							</ul>
							<?php
								if ( !$this->session->userdata('id') )
								{
							?>
							<ul class="nav navbar-nav navbar-right">
								<li>
									<a class="btn btn-easyspa" href="<?=base_url()?>cadastro">
										<i class="fa fa-plus"></i>&nbsp;Cadastre-se agora!
									</a>
								</li>
							</ul>
							<?php
								}
							?>
						  </div><!--/.nav-collapse -->
					  </nav>
				</div>
			</div>