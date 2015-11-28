<div class="sessao-conteudo">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-xs-12">
				<button type="button" id="sou-usuario" class="btn btn-lg btn-block btn-primary btn-large-login">
					<i class="fa fa-user"></i>
					Sou usu&aacute;rio
				</button>
			</div>
			
			<div class="col-lg-4 col-xs-12">
				<button type="button" id="sou-prestador" class="btn btn-lg btn-block btn-warning btn-large-login">
					<i class="fa fa-user-md"></i>
					Sou prestador de servi&ccedil;o
				</button>
			</div>
			
			<div class="col-lg-4 col-xs-12">
				<button type="button" id="sou-afiliado" class="btn btn-lg btn-block btn-danger btn-large-login">
					<i class="fa fa-users"></i>
					Sou afiliado
				</button>
			</div>
		</div>
		
		<?php 
			if ( !$this->input->get('tipo') )
			{
		?>
		<div align="center" id="escolha-opcoes">
			<hr class="hr-easyspa" />
			<div class="hr-texto">
				Escolha uma das opções acima para continuar
			</div>
		</div>
		<?php 
			}
		?>
		
		<div id="cadastro-usuario" <?=$this->input->get('tipo') == 'usuario' ? '' : 'class="hide"'?>>			
			<div class="panel panel-primary panel-cadastro">
				<div class="panel-heading">
					<h4 class="panel-title">Cadastro de usu&aacute;rio</h4>
				</div>
				<div class="panel-body">
					<?php 
						if ( $this->input->get('error') && 
							$this->input->get('error') > 0 && 
							$this->input->get('error') < 5 && 
							$this->input->get('tipo') == 'usuario' )
						{
					?>
						<div class="alert alert-danger" align="center">
							<strong>ERRO:</strong>&nbsp;
							<?php 
								switch ( $this->input->get('error') )
								{
									case 1:
										print 'E-mail inválido ou já existente, tente alterar seu e-mail para continuar.';
									break;
									case 2:
										print 'Informe um nome e sobrenome válido para continuar.';
									break;
									case 3:
										print 'Informe todos os seus dados de localização para continuar.';
									break;
									case 4:
										print 'Houve um erro no sistema, tente novamente o cadastro, se o erro persistir, por favor entre em contato com nossa equipe de atendimento em contato@easyspa.club';
									break;
								}
							?>
						</div>
					<?php
						} elseif ( $this->input->get('sucesso') && $this->input->get('tipo') == 'usuario' )
						{
					?>
						<div class="alert alert-success" align="center">
							<strong>Sucesso!</strong>&nbsp;O seu cadastro foi realizado com sucesso.
						</div>
					<?php
						}
					?>
					<form method="post" id="signup" action="<?=base_url()?>cadastro/usuario" class="form-horizontal form-bordered">
						<div class="row">
							<div class="col-lg-6">
								<fieldset>
									<legend>Sobre voc&ecirc;</legend>									
									<div class="form-group">
										<label for="nome" class="col-sm-3 control-label">Nome:</label>
										<div class="col-sm-9">
											<input type="text" name="nome" class="form-control square-input" id="nome" required />
										</div>
									</div>
									<div class="form-group">
										<label for="sobrenome" class="col-sm-3 control-label">Sobrenome:</label>
										<div class="col-sm-9">
											<input type="text" name="sobrenome" class="form-control square-input" id="sobrenome" required />
										</div>
									</div>
									<div class="form-group">
										<label for="celular" class="col-sm-3 control-label">Celular:</label>
										<div class="col-sm-9">
											<input type="text" name="celular" class="form-control square-input" id="celular" />
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">E-mail:</label>
										<div class="col-sm-9">
											<input type="email" name="email" class="form-control square-input" id="email" required />
										</div>
									</div>
									<div class="form-group">
										<label for="senha" class="col-sm-3 control-label">Senha:</label>
										<div class="col-sm-9">
											<input type="password" name="senha" class="form-control square-input" id="senha" required />
										</div>
									</div>
									<div class="form-group">
										<label for="foto" class="col-sm-3 control-label">Foto de perfil:</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-lg-3">
													<img src="<?=base_url()?>assets/img/anonimo.jpg" width="100" height="100" />
												</div>
												<div class="col-lg-9">
													<strong>Alterar foto</strong><br />
													<input type="file" name="foto" id="foto-usuario" />
													<button type="button" class="btn btn-easyspa">
														<i class="fa fa-camera"></i>&nbsp;Selecionar foto
													</button>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</div>
							<div class="col-lg-6">
								<fieldset>
									<legend>Endere&ccedil;o</legend>
									<div class="form-group">
										<label for="endereco" class="col-sm-3 control-label">Endere&ccedil;o:</label>
										<div class="col-sm-9">
											<input type="text" name="endereco" class="form-control square-input" id="endereco" required />
										</div>
									</div>
									<div class="form-group">
										<label for="complemento" class="col-sm-3 control-label">Complemento:</label>
										<div class="col-sm-9">
											<input type="text" name="complemento" class="form-control square-input" id="complemento" />
										</div>
									</div>
									<div class="form-group">
										<label for="bairro" class="col-sm-3 control-label">Bairro:</label>
										<div class="col-sm-9">
											<input type="text" name="bairro" class="form-control square-input" id="bairro" />
										</div>
									</div>
									<div class="form-group">
										<label for="estado" class="col-sm-3 control-label">Estado:</label>
										<div class="col-sm-9">
											<select name="estado" class="form-control square-input" onchange="buscarCidades(this, 'usuario')">
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
									</div>
									<div class="form-group">
										<label for="cidade" class="col-sm-3 control-label">Cidade:</label>
										<div class="col-sm-9">
											<select name="cidade" class="form-control square-input" id="cidades_usuario">
												<option>Selecione o estado primeiro</option>
											</select>
										</div>
									</div>
								</fieldset>
								<fieldset>
									<legend>Termos de uso</legend>
									<input type="checkbox" name="termos" required />&nbsp;Aceito os <a href="<?=base_url()?>termos" target="_blank">termos de uso</a> e desejo continuar
								</fieldset>
							</div>
						</div>
						<hr />
						<div align="center">
							<button class="btn btn-easyspa btn-lg" style="width:450px;" type="submit">
								<i class="fa fa-check"></i>&nbsp;Finalizar cadastro
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<div id="cadastro-prestador" <?=$this->input->get('tipo') == 'prestador' ? '' : 'class="hide"'?>>
			<div class="panel panel-warning panel-cadastro">
				<div class="panel-heading">
					<h4 class="panel-title">Cadastro de prestador</h4>
				</div>
				<div class="panel-body authenty signup-wizard signin-main">
					<?php 
						if ( $this->input->get('error') && 
							$this->input->get('error') > 0 && 
							$this->input->get('error') < 3 && 
							$this->input->get('tipo') == 'prestador' )
						{
					?>
						<div class="alert alert-danger" align="center">
							<strong>ERRO:</strong>&nbsp;
							<?php 
								switch ( $this->input->get('error') )
								{
									case 1:
										print 'E-mail inválido ou já existente, tente alterar seu e-mail para continuar.';
									break;
									case 2:
										print 'Ocorreu um erro ao criar sua conta, tente novamente mais tarde.';
									break;
								}
							?>
						</div>
					<?php
						} elseif ( $this->input->get('sucesso') && $this->input->get('tipo') == 'prestador' )
						{
					?>
						<div class="alert alert-success" align="center">
							<strong>Sucesso!</strong>&nbsp;O seu cadastro foi realizado com sucesso.
						</div>
					<?php
						}
					?>
					<div data-animation="fadeInUp" data-animation-delay=".6s" class="passos-cadastro">
						<div class="row nav-step">
							<div class="col-xs-3 active"><span></span></div>
							<div class="col-xs-3"><span></span></div>
							<div class="col-xs-3"><span></span></div>
							<div class="col-xs-3"><span></span></div>
						</div>								
						<div class="row nav-step-label">
							<div class="col-xs-3">Pessoal</div>
							<div class="col-xs-3">Atendimento</div>
							<div class="col-xs-3">Categoria</div>
							<div class="col-xs-3">Finalizar</div>
						</div>
					</div>
					<form method="POST" action="<?=base_url()?>cadastro/prestador" enctype="multipart/form-data" class="form-horizontal">
						<div data-animation="bounceInLeft" data-animation-delay=".2s">
							<div class="row">
								<ul class="page-container page-container-login">
									<li class="current" data-submit="checkForm1()">						
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<fieldset>
													<legend>Dados pessoais</legend>
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6 col-md-6 col-xs-12">
																<label class="label-cpf-cnpj">
																	<input type="radio" name="tipo" class="selecionar-tipo" value="PF" checked="checked">
																	Pessoa física
																</label>
															</div>
															<div class="col-lg-6 col-md-6 col-xs-12">
																<label class="label-cpf-cnpj">
																	<input type="radio" name="tipo" value="PJ" class="selecionar-tipo">
																	Pessoa jurídica
																</label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="form-nome" class="col-sm-3 control-label">Nome:</label>
														<div class="col-sm-9">
															<input type="text" name="nome" class="form-control square-input" id="form-nome">
														</div>
													</div>
													<div class="form-group">
														<label for="form-email" class="col-sm-3 control-label">E-mail:</label>
														<div class="col-sm-9">
															<input type="email" name="email" id="form-email" class="form-control square-input">
														</div>
													</div>
													<div class="form-group">
														<label for="form-senha" class="col-sm-3 control-label">Senha:</label>
														<div class="col-sm-9">
															<input type="password" name="senha" id="form-senha" class="form-control square-input" placeholder="Senha">
														</div>
													</div>
													<div class="form-group hide" id="form-group-telfixo">
														<label for="form-telefone" class="col-sm-3 control-label">Telefone fixo:</label>
														<div class="col-sm-9">
															<input type="text" name="telefone" id="form-telefone" class="form-control square-input">
														</div>
													</div>
													<div class="form-group">
														<label for="form-celular" class="col-sm-3 control-label">Telefone celular:</label>
														<div class="col-sm-9">
															<input type="text" name="celular" id="form-celular" class="form-control square-input" />
														</div>
													</div>
													<div class="form-group" id="form-group-cpf">
														<label for="form-cpf" class="col-sm-3 control-label">CPF:</label>
														<div class="col-sm-9">
															<input type="text" name="cpf" id="form-cpf" class="form-control square-input">
														</div>
													</div>
													<div class="form-group hide" id="form-group-cnpj">
														<label for="form-cnpj" class="col-sm-3 control-label">CNPJ:</label>
														<div class="col-sm-9">
															<input type="text" name="cnpj" id="form-cnpj" class="form-control square-input">
														</div>
													</div>
													<div class="form-group hide" id="form-group-razao">
														<label for="form-razaosocial" class="col-sm-3 control-label">Raz&atilde;o social:</label>
														<div class="col-sm-9">
															<input type="text" name="razaosocial" class="form-control square-input" id="form-razaosocial">
														</div>
													</div>
													<div class="form-group hide" id="form-group-nomefantasia">
														<label for="form-nomefantasia" class="col-sm-3 control-label">Nome fantasia:</label>
														<div class="col-sm-9">
															<input type="text" id="form-nomefantasia" name="nomefantasia" class="form-control square-input" />
														</div>
													</div>
												</fieldset>
											</div>
											<div class="col-lg-6 col-xs-12">
												<fieldset>
													<legend>Endere&ccedil;o</legend>
													<div class="form-group">
														<label for="form-endereco" class="col-sm-3 control-label">Endere&ccedil;o:</label>
														<div class="col-sm-9">
															<input type="text" name="endereco" class="form-control square-input" id="form-endereco" />
														</div>
													</div>
													<div class="form-group">
														<label for="form-bairro" class="col-sm-3 control-label">Bairro:</label>
														<div class="col-sm-9">
															<input type="text" name="bairro" class="form-control square-input" id="form-bairro" />
														</div>
													</div>
													<div class="form-group">
														<label for="select-estado" class="col-sm-3 control-label">Estado:</label>
														<div class="col-sm-9">
															<select id="select-estado" name="estado" class="form-control select-cadastro square-input" onchange="buscarCidades(this, 'prestador')">
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
													</div>
													<div class="form-group">
														<label for="cidades_prestador" class="col-sm-3 control-label">Cidade:</label>
														<div class="col-sm-9">
															<select id="cidades_prestador" name="cidade" class="form-control select-cadastro square-input">
																<option selected="selected">Selecione um estado primeiro</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="form-nascimento" class="col-sm-3 control-label">Data de nascimento:</label>
														<div class="col-sm-9">
															<input type="date" name="dataNascimento" class="form-control square-input" id="form-nascimento" />
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<textarea class="textarea-cadastro" name="apresentacao" rows="10" class="form-control square-input" placeholder="Escreva um pouco sobre você"></textarea>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<textarea class="textarea-cadastro" name="especialidades" rows="10" class="form-control square-input" placeholder="Escreva um pouco sobre suas especialidades"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4 col-lg-offset-4">
												<fieldset>
													<legend>Seus hor&aacute;rios de trabalho</legend>
												
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="segunda_feira" checked="checked" />
																Segunda-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_segunda_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_segunda_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="terca_feira" checked="checked" />
																Ter&ccedil;a-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_terca_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_terca_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="quarta_feira" checked="checked" />
																Quarta-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_quarta_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_quarta_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="quinta_feira" checked="checked" />
																Quinta-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_quinta_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_quinta_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="sexta_feira" checked="checked" />
																Sexta-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_sexta_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_sexta_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="sexta_feira" checked="checked" />
																Sexta-feira
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_sexta_feira" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_sexta_feira" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="sabado" />
																S&aacute;bado
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_sabado" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_sabado" value="18:00:00" />
															</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-lg-6">
																<br /><br />
																<input type="checkbox" name="domingo" />
																Domingo
															</div>
															<div class="col-lg-3">
																<strong>DE</strong>
																<input type="time" name="de_domingo" value="09:00:00" />
															</div>
															<div class="col-lg-3">
																<strong>AT&Eacute;</strong>
																<input type="time" name="ate_domingo" value="18:00:00" />
															</div>
														</div>
													</div>
												</fieldset>
											</div>
										</div>
									</li>
									<li data-submit="checkForm3()">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<h4 align="center">Selecione suas especialidades</h4>
												<table id="lista-todas" style="width:100%;">
													<tbody>
													</tbody>
												</table>
											</div>
											<div class="col-lg-6 col-xs-12">
												<h4 align="center" class="hide" id="titulo-especialidades">Especialidades escolhidas</h4>
												<table id="lista-escolhida" style="width:100%;display:none;">
													<thead>
														<th align="center" style="text-align:center;">
															Categoria
														</th>
														<th align="center" style="text-align:center;">
															Remover
														</th>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-lg-5 col-xs-12">						
												<fieldset>
													<legend>Foto principal</legend>
													<div class="form-group">
														<label class="col-sm-4 col-sm-offset-1 control-label" for="foto"><br>Foto principal (opcional):</label>
														<div class="col-sm-6">
															<img src="<?=base_url()?>assets/img/anonimo.jpg" width="100" height="100" />
														</div>
													</div>
													<strong>Alterar foto</strong><br>
													<input type="file" name="foto" id="foto-usuario">
													<button type="button" class="btn btn-easyspa" style="width:322px">
														<i class="fa fa-camera"></i>&nbsp;Selecionar foto
													</button>
												</fieldset>
											</div>
											<div class="col-lg-7 col-xs-12">
												<legend>Termos de uso</legend>
												<div style="width:320px;margin: auto;margin-top:12px;">
													<input type="checkbox" name="termos" required />&nbsp;Aceito os <a href="<?=base_url()?>termos" target="_blank">termos de uso</a> e desejo continuar
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<hr />
							
							<div class="page-footer">
								<div class="row btn-wrap">
									<div class="col-xs-6" id="prev" align="left">
										<button class="btn btn-easyspa nav-step-btn">
											<i class="fa fa-arrow-left"></i>&nbsp;Anterior
										</button> 
									</div>
									<div class="col-xs-6" id="next" align="right">
										<button class="btn btn-easyspa nav-step-btn">
											Pr&oacute;ximo&nbsp;
											<i class="fa fa-arrow-right"></i>
										</button>
									</div>
									<div class="col-xs-6" id="submit" align="right">
										<button class="btn btn-easyspa nav-step-btn" type="submit"><i class="fa fa-check"></i>&nbsp;Finalizar cadastro</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<div id="cadastro-afiliado" <?=$this->input->get('tipo') == 'afiliado' ? '' : 'class="hide"'?>>
			<div class="panel panel-danger panel-cadastro">
				<div class="panel-heading">
					<h4 class="panel-title">Cadastro de afiliado</h4>
				</div>
				<div class="panel-body">
					<?php 
						if ( $this->input->get('error') && $this->input->get('tipo') == 'afiliado' )
						{
					?>
						<div class="alert alert-danger" align="center">
							<strong>ERRO:</strong>&nbsp;
							<?php 
								switch ( $this->input->get('error') )
								{
									case 1:
										print 'E-mail inválido ou já existente, tente alterar seu e-mail para continuar.';
									break;
									case 2:
										print 'Informe um nome e sobrenome válido para continuar.';
									break;
									case 3:
										print 'Informe todos os seus dados de localização para continuar.';
									break;
									case 4:
										print 'Informe seu CPF ou CNPJ para continuar.';
									break;
									case 5:
										print 'Informe seus dados de comissionamento para continuar.';
									break;
									default: 
										print 'Houve um erro ao realizar seu cadastro, tente novamente, caso o erro aconteça novamente, por favor entre em contato através do endereço de e-mail contato@easyspa.club';
									break;
								}
							?>
						</div>
					<?php
						} elseif ( $this->input->get('sucesso') && $this->input->get('tipo') == 'afiliado' )
						{
					?>
						<div class="alert alert-success" align="center">
							<strong>Sucesso!</strong>&nbsp;O seu cadastro foi realizado com sucesso.
						</div>
					<?php
						}
					?>
					<form method="post" action="<?=base_url()?>cadastro/afiliado" id="signup" class="form-horizontal form-bordered">
						<div class="row">
							<div class="col-lg-6">
								<fieldset>
									<legend>Sobre voc&ecirc;</legend>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-xs-12" align="right">
												<label class="label-cpf-cnpj-afiliado">
													<input type="radio" name="tipo" class="selecionar-tipo-afiliado" value="PF" checked="checked">
													Pessoa física
												</label>
											</div>
											<div class="col-lg-6 col-md-6 col-xs-12">
												<label class="label-cpf-cnpj-afiliado">
													<input type="radio" name="tipo" value="PJ" class="selecionar-tipo-afiliado">
													Pessoa jurídica
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="nome" class="col-sm-3 control-label">Nome:</label>
										<div class="col-sm-9">
											<input type="text" name="nome" class="form-control square-input" id="nome" />
										</div>
									</div>
									<div class="form-group">
										<label for="sobrenome" class="col-sm-3 control-label">Sobrenome:</label>
										<div class="col-sm-9">
											<input type="text" name="sobrenome" class="form-control square-input" id="sobrenome" />
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">E-mail:</label>
										<div class="col-sm-9">
											<input type="email" name="email" class="form-control square-input" id="email" />
										</div>
									</div>
									<div class="form-group">
										<label for="senha" class="col-sm-3 control-label">Senha:</label>
										<div class="col-sm-9">
											<input type="password" name="senha" class="form-control square-input" id="senha" />
										</div>
									</div>
									<div class="form-group" id="form-group-cpf-afiliado">
										<label for="form-cpf-afiliado" class="col-sm-3 control-label">CPF:</label>
										<div class="col-sm-9">
											<input type="text" name="cpf" id="form-cpf-afiliado" class="form-control square-input">
										</div>
									</div>
									<div class="form-group hide" id="form-group-cnpj-afiliado">
										<label for="form-cnpj-afiliado" class="col-sm-3 control-label">CNPJ:</label>
										<div class="col-sm-9">
											<input type="text" name="cnpj" id="form-cnpj-afiliado" class="form-control square-input">
										</div>
									</div>
									<div class="form-group">
										<label for="form-telefone-afiliado" class="col-sm-3 control-label">Telefone fixo:</label>
										<div class="col-sm-9">
											<input type="text" name="telefone" id="form-telefone-afiliado" class="form-control square-input">
										</div>
									</div>
									<div class="form-group">
										<label for="form-celular-afiliado" class="col-sm-3 control-label">Celular:</label>
										<div class="col-sm-9">
											<input type="text" name="celular" class="form-control square-input" id="form-celular-afiliado" />
										</div>
									</div>
								</fieldset>
							</div>
							<div class="col-lg-6">
								<fieldset>
									<legend>Dados de localiza&ccedil;&atilde;o</legend>
									<div class="form-group">
										<label for="endereco" class="col-sm-3 control-label">Endere&ccedil;o:</label>
										<div class="col-sm-9">
											<input type="text" name="endereco" class="form-control square-input" id="endereco" />
										</div>
									</div>
									<div class="form-group">
										<label for="complemento" class="col-sm-3 control-label">Complemento:</label>
										<div class="col-sm-9">
											<input type="text" name="complemento" class="form-control square-input" id="complemento" />
										</div>
									</div>
									<div class="form-group">
										<label for="bairro" class="col-sm-3 control-label">Bairro:</label>
										<div class="col-sm-9">
											<input type="text" name="bairro" class="form-control square-input" id="bairro" />
										</div>
									</div>
									<div class="form-group">
										<label for="estado_afiliado" class="col-sm-3 control-label">Estado:</label>
										<div class="col-sm-9">
											<select name="estado" id="estado_afiliado" class="form-control square-input" onchange="buscarCidades(this, 'afiliado')">
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
									</div>
									<div class="form-group">
										<label for="cidades_afiliado" class="col-sm-3 control-label">Cidade:</label>
										<div class="col-sm-9">
											<select name="cidade" id="cidades_afiliado" class="form-control square-input">
												<option>Selecione o estado primeiro</option>
											</select>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<fieldset>
									<legend>Dados de comissionamento</legend>
									
									<div class="form-group">
										<label for="banco" class="col-sm-3 control-label">Banco:</label>
										<div class="col-sm-9">
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
									</div>
									<div class="form-group">
										<label for="agencia" class="col-sm-3 control-label">Ag&ecirc;ncia:</label>
										<div class="col-sm-9">
											<input type="text" name="agencia" class="form-control square-input" id="agencia" />
										</div>
									</div>
									<div class="form-group">
										<label for="conta" class="col-sm-3 control-label">Conta:</label>
										<div class="col-sm-9">
											<input type="text" name="conta" class="form-control square-input" id="conta" />
										</div>
									</div>
								</fieldset>
							</div>
							<div class="col-lg-6">
								<fieldset>
									<legend>Termos de uso</legend>
									<div style="width:320px;margin: auto;margin-top:12px;">
										<input type="checkbox" name="termos" required />&nbsp;Aceito os <a href="<?=base_url()?>afiliado/termos" target="_blank">termos de uso</a> e desejo continuar
									</div>
								</fieldset>
							</div>
						</div>
						<hr />
						<div align="center">
							<button class="btn btn-easyspa btn-lg" style="width:450px;" type="submit">
								<i class="fa fa-check"></i>&nbsp;Finalizar cadastro
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>
<link href="<?=base_url()?>assets/login/css/animation.css" rel="stylesheet">
<link href="<?=base_url()?>assets/login/css/orange.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/authenty-site.css" rel="stylesheet">
<script src="<?=base_url()?>assets/login/js/jquery.icheck.min.js"></script>
<script src="<?=base_url()?>assets/login/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/login/js/authenty.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/login/js/cadastrocliente.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#sou-usuario, #sou-prestador, #sou-afiliado').click(function()
		{
			$('#escolha-opcoes').addClass('hide');
		});
		$('#sou-usuario').click(function()
		{
			$('#cadastro-afiliado').addClass('hide');
			$('#cadastro-prestador').addClass('hide');
			$('#cadastro-usuario').removeClass('hide');
		});
		
		$('#sou-prestador').click(function()
		{
			$('#cadastro-afiliado').addClass('hide');
			$('#cadastro-usuario').addClass('hide');
			$('#cadastro-prestador').removeClass('hide');
		});
		
		$('#sou-afiliado').click(function()
		{
			$('#cadastro-prestador').addClass('hide');
			$('#cadastro-usuario').addClass('hide');
			$('#cadastro-afiliado').removeClass('hide');
		});
	});
	
	function buscarCidades(obj, tipo)
	{
		$('#cidades_' + tipo).find('option').html('Carregando...');
		$.get('<?=base_url()?>app/cidades/?estado='+$(obj).find('option:selected').val())
		.success(function(ret)
		{
			var json = JSON.parse(ret);
			$('#cidades_' + tipo).html('');
			for (var ind in json)
			{
				$('#cidades_' + tipo).append('<option value="'+json[ind].cidade+'">'+json[ind].cidade+'</option>');
			}
		});
	}
</script>