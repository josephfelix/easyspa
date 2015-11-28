<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>easySpa | Programa de Afiliados</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/form-elements.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
		<script type="text/javascript">
			window.URL_INICIAL = '<?=base_url()?>';
		</script>
    </head>

    <body>

		<!-- Top menu -->
		

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>easySpa | Programa de Afiliados</strong></h1>
                            <div class="description">
                            	<p>
	                            	Em breve nossa equipe comercial entrar&aacute; em contato via e-mail com o passo a passo para vc se tornar um vendedor afiliado da easySpa
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-6 phone">
                    		<iframe width="560" height="315" src="https://www.youtube.com/embed/CR0b502N8y0" frameborder="0" allowfullscreen></iframe>
							<br />
							<div class="description">
								<p>
									Para ver a tabela de valores e planos, <a href="<?=base_url()?>upload/apresentacao_afiliado.pdf">clique aqui</a>.
								</p>
							</div>
                    	</div>
                        <div class="col-sm-5 form-box" style="margin-top:-50px;">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Cadastro de afiliados easySpa</h3>
                           		  <p>Trabalhe conosco, preencha os dados:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom" style="height:466px; text-align:center;"><br>
                               
                               <br><br>
                              <br>
                              <br>
                              ATEN&Ccedil;&Atilde;O: Para confirmar seu cadastro, voc&ecirc; deve clicar no link que foi enviado para seu e-mail. Caso n&atilde;o conste na caixa de entrada, por favor verifique sua caixa de spam.<br>
                              
<br>
							<?php
								if ( isset( $enviado ) )
								{
							?>
								E-mail enviado com sucesso!<br />
							<?php
								}
							?>
							<a class="btn btn-block" href="<?=base_url()?>afiliado/reenviar2/<?=$id_afiliado?>">Reenviar e-mail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.backstretch.min.js"></script>
        <script src="<?=base_url()?>assets/js/retina-1.1.0.min.js"></script>
        <script src="<?=base_url()?>assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="<?=base_url()?>assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>