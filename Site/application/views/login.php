<div class="sessao-conteudo">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-xs-12 no-padding-right">
				<div class="border-right">
					<h1 class="title-easyspa" align="center">Ainda n&atilde;o tem conta no easySpa?</h1>
					<h4 align="center"><strong>Cadastre-se agora!</strong></h4>
					<br />
					<a href="<?=base_url()?>cadastro/?tipo=usuario" class="btn btn-lg btn-block btn-primary btn-login-left">
						<i class="fa fa-user"></i>
						Sou usu&aacute;rio
					</a>
					<hr />
					<a href="<?=base_url()?>cadastro/?tipo=prestador" class="btn btn-lg btn-block btn-warning btn-login-left">
						<i class="fa fa-user-md"></i>
						Sou prestador de servi&ccedil;o
					</a>
					<hr />
					<a href="<?=base_url()?>cadastro/?tipo=afiliado" class="btn btn-lg btn-block btn-danger btn-login-left">
						<i class="fa fa-users"></i>
						Sou afiliado
					</a>
				</div>
			</div>
			<div class="col-lg-6 col-xs-12 no-padding-left">				
				<h1 align="center" class="title-easyspa">Fazer login no easySpa</h1>
				<hr />
				<form method="POST">
					<?php
						if ( $error )
						{
					?>
						<div class="alert alert-danger">
						<strong>ERRO:</strong>&nbsp;
						<?php
							switch ( $error )
							{
								case 1:
									print 'Login ou senha incorretos.';
								break;
							}
						?>
						</div>
					<?php
						}
					?>
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<small>E-mail</small><br />
							<input type="email" class="form-control input-lg input-block square-input" name="email" /><br />
							<small>Senha</small><br />
							<input type="password" class="form-control input-lg input-block square-input" name="senha" /><br />
							<div class="row">
								<div class="col-lg-6">
									<small>
										<a href="#">Esqueci minha senha</a>
									</small>
								</div>
								<div class="col-lg-6" align="right">
									<button type="submit" class="btn btn-lg btn-easyspa">
										ENTRAR
									</button>
								</div>
							</div>
							<hr />
							<a href="<?=base_url()?>login/facebook" class="btn btn-block btn-lg btn-primary no-border-radius">
								<i class="fa fa-facebook"></i>&nbsp;Entrar usando facebook
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>