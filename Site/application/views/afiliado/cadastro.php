<!DOCTYPE html>
<html lang="en">
    <head>
<meta property="og:title" content="easySpa.Club - Espaço de beleza e bem-estar."/>
<meta property="og:type" content="product"/>
<meta property="og:url" content="<?=base_url()?>afiliado/cadastro"/>
<meta property="og:image" content="<?=base_url()?>assets/images/face1.jpg">
<meta property="og:image" content="<?=base_url()?>assets/images/face2.jpg">
<meta property="og:image" content="<?=base_url()?>assets/images/face3.jpg">
<meta property="og:image" content="<?=base_url()?>assets/images/face4.jpg">
<meta property="og:site_name" content="easySpa.Club - Espaço de beleza e bem-estar."/>
<meta property="og:description" content="Seja um afiliado do easySpa.club!"/>
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
		<style type="text/css">
			.label-cpf-cnpj {
				font-weight: normal;
				cursor: pointer;
			}
			select.form-control {
				height: 44px;
				border: solid 3px #DDD;
				background-color: #F8F8F8;
			}
		</style>
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
                   <!--  <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>EasySpa | Programa de Afiliados</strong></h1>
                            <div class="description">
                            	<p>
	                            	Em breve nossa equipe comercial entrará em contato via e-mail com o passo a passo para vc se tornar um vendedor afiliado da Easy spa
                            	</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                    	<div class="col-sm-6 phone text">
							<h1><strong>easySpa | Programa de Afiliados</strong></h1>
                            <div class="description">
                            	<p>
	                            	Em breve nossa equipe comercial entrará em contato via e-mail com o passo a passo para voc&ecirc; se tornar um vendedor afiliado da easySpa
                            	</p>
                            </div>
							<br />
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
                            <div class="form-bottom">
                            
                            <form method="post" action="" id="frmSS4" role="form" class="registration-form" onsubmit="return checarForm()">
									<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">Usu&aacute;rio</label>
			                        	<input type="text" name="usuario" placeholder="Usu&aacute;rio" class="form-first-name form-control" id="form-usuario" required />
			                        </div>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">Nome</label>
			                        	<input type="text" name="nome" placeholder="Nome" class="form-first-name form-control" id="form-first-name" required />
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-last-name">Sobrenome</label>
			                        	<input type="text" name="sobrenome" placeholder="Sobrenome" class="form-last-name form-control" id="form-last-name" required />
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-email">Email</label>
			                        	<input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email" required />
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="form-senha">Senha</label>
			                        	<input type="password" name="senha" placeholder="Senha" class="form-control" id="form-senha" required />
			                        </div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-xs-12">
												<label class="label-cpf-cnpj">
													<input type="radio" name="tipo" class="selecionar-tipo" value="PF" checked="checked" />
													Pessoa f&iacute;sica
												</label>
											</div>
											<div class="col-lg-6 col-md-6 col-xs-12">
												<label class="label-cpf-cnpj">
													<input type="radio" name="tipo" value="PJ" class="selecionar-tipo" />
													Pessoa jur&iacute;dica
												</label>
											</div>
										</div>
			                        </div>
									<div class="form-group" id="container-cpf">
			                        	<label class="sr-only" for="form-cpf">CPF</label>
			                        	<input type="text" name="cpf" placeholder="CPF" class="form-control" id="form-cpf">
			                        </div>
									<div class="form-group" id="container-cnpj" style="display:none;">
										<label class="sr-only" for="form-cnpj">CNPJ</label>
			                        	<input type="text" name="cnpj" placeholder="CNPJ" class="form-control" id="form-cnpj">
									</div>
									
									<div class="form-group">
			                        	<label class="sr-only" for="form-telefone">Telefone fixo</label>
			                        	<input type="text" name="telefone" placeholder="Telefone" class="form-control" id="form-telefone" required />
			                        </div>
									
									<div class="form-group">
			                        	<label class="sr-only" for="form-celular">Celular</label>
			                        	<input type="text" name="celular" placeholder="Celular" class="form-control" id="form-celular" required />
			                        </div>
									
									<h3 align="center">DADOS DE LOCALIZA&Ccedil;&Atilde;O</h3>
									
                                    <div class="form-group">
										<select name="estado" class="form-control" id="select-estado">
											<option value="0" selected="selected">Selecione um estado</option>
											<?php
												foreach ( $estados as $estado )
												{
											?>
											<option value="<?=$estado->id?>"><?=$estado->estado?></option>
											<?php
												}
											?>
										</select>
									</div>
									
                                    <div class="form-group">
			                        	<label class="sr-only" for="form-email">Cidade</label>
										<select name="cidade" class="form-control" id="select-cidade">
											<option value="0" selected="selected">Selecione sua cidade</option>
										</select>
			                        </div>
									
									<div class="form-group">
			                        	<label class="sr-only" for="form-endereco">Endere&ccedil;o completo</label>
			                        	<input type="text" name="endereco" placeholder="Endere&ccedil;o completo" class="form-control" id="form-endereco" required />
			                        </div>
									
									<div class="form-group">
			                        	<label class="sr-only" for="form-cep">CEP</label>
			                        	<input type="text" name="cep" placeholder="CEP" class="form-control" id="form-cep" required />
			                        </div>
									
									<h3 align="center">DADOS DE COMISSIONAMENTO</h3>
									<div class="form-group">
										<label class="sr-only" for="form-banco">Banco</label>
										<select name="banco" class="form-control">
											<option value="0" selected="selected">Selecione um banco</option>
											<?php
												foreach ( $bancos as $banco )
												{
											?>
											<option value="<?=$banco->codigo?> - <?=$banco->banco?>"><?=$banco->codigo?> - <?=$banco->banco?></option>
											<?php
												}
											?>
										</select>
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="form-agencia">Ag&ecirc;ncia</label>
		                        	   <input type="text" name="agencia" placeholder="Ag&ecirc;ncia" class="form-control" id="form-agencia" required />
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="form-conta">Conta</label>
		                        	   <input type="text" name="conta" placeholder="Conta" class="form-control" id="form-conta" required />
			                        </div>
									<input type="checkbox" name="termos" value="1" id="termos" required />&nbsp;Aceito os <a href="<?=base_url()?>afiliado/termos" target="_blank">termos de uso</a>.
									<br /><br />
		                          <button type="submit" class="btn btn-block">Cadastrar</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <script type="text/javascript">
// <![CDATA[

			function CheckMultiple4(frm, name) {
				for (var i=0; i < frm.length; i++)
				{
					fldObj = frm.elements[i];
					fldId = fldObj.id;
					if (fldId) {
						var fieldnamecheck=fldObj.id.indexOf(name);
						if (fieldnamecheck != -1) {
							if (fldObj.checked) {
								return true;
							}
						}
					}
				}
				return false;
			}
		function CheckForm4(f) {
			var email_re = /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
			if (!email_re.test(f.email.value)) {
				alert("Digite seu e-mail.");
				f.email.focus();
				return false;
			}
		
				return true;
			}
		
// ]]>
</script>


        <!-- Javascript -->
        <script src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.backstretch.min.js"></script>
        <script src="<?=base_url()?>assets/js/jquery.mask.js"></script>
        <script src="<?=base_url()?>assets/js/retina-1.1.0.min.js"></script>
        <script src="<?=base_url()?>assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="<?=base_url()?>assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>