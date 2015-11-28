<div class="pageheader">
	<h2><i class="fa fa-plus"></i> Novo an&uacute;ncio </h2>

	<div class="breadcrumb-wrapper">
		<span class="label">Você está em:</span>
		<ol class="breadcrumb">
			<li>Anuncio</li>
			<li>Novo an&uacute;ncio</li>
		</ol>
	</div>
</div>
<div class="contentpanel">
	<!-- Novo anúncio -->
	<div class="panel panel-cadastro">
		<div class="panel-body authenty signup-wizard signin-main">		
			<div data-animation="fadeInUp" data-animation-delay=".6s">
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
			<form method="POST" enctype="multipart/form-data">
				<div data-animation="bounceInLeft" data-animation-delay=".2s">
					<div class="row">
						<ul class="page-container page-container-login">
							<li class="current" data-submit="checkForm1()">
								<div class="form-group">
									<input type="text" name="nome" class="form-control" id="form-nome"
										   placeholder="Nome">
								</div>
								<div class="form-group hide" id="form-group-telfixo">
									<input type="text" name="telefone" id="form-telefone" class="form-control"
										   placeholder="Telefone fixo">
								</div>
								<div class="form-group">
									<input type="text" name="celular" id="form-celular" class="form-control"
										   placeholder="Telefone celular"/>
								</div>
								<hr/>
								<h3>Endereço</h3>

								<div class="form-group">
									<input type="text" name="rua" class="form-control" id="form-rua"
										   placeholder="Rua">
								</div>
								<div class="form-group">
									<input type="text" name="bairro" class="form-control" id="form-bairro"
										   placeholder="Bairro">
								</div>
								<div class="form-group">
									<select id="select-estado" name="estado" class="form-control select-cadastro">
										<option value="0" selected="selected">Selecione um estado</option>
										<?php
										foreach ($estados as $estado)
										{
										?>
											<option value="<?=$estado->id ?>"><?=$estado->estado?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<select id="cidades_prestador" name="cidade" class="form-control select-cadastro">
										<option selected="selected">Selecione um estado primeiro</option>
									</select>
								</div>
							</li>
							<li>
								<div class="form-group">
									<textarea class="textarea-cadastro" name="apresentacao" rows="10"
											  class="form-control" placeholder="Apresenta&ccedil;&atilde;o"
											  style="width:313px"></textarea>
								</div>
								<div class="form-group">
									<textarea class="textarea-cadastro" name="especialidades" rows="10"
											  style="width:313px" class="form-control"
											  placeholder="Escreva sobre suas especialidades"></textarea>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="segunda_feira" checked="checked"/>
											Segunda-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_segunda_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_segunda_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="terca_feira" checked="checked"/>
											Ter&ccedil;a-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_terca_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_terca_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="quarta_feira" checked="checked"/>
											Quarta-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_quarta_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_quarta_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="quinta_feira" checked="checked"/>
											Quinta-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_quinta_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_quinta_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="sexta_feira" checked="checked"/>
											Sexta-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_sexta_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_sexta_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="sexta_feira" checked="checked"/>
											Sexta-feira
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_sexta_feira" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_sexta_feira" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="sabado"/>
											S&aacute;bado
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_sabado" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_sabado" value="18:00:00"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<br/><br/>
											<input type="checkbox" name="domingo"/>
											Domingo
										</div>
										<div class="col-lg-3">
											<strong>DE</strong>
											<input type="time" name="de_domingo" value="09:00:00"/>
										</div>
										<div class="col-lg-3">
											<strong>AT&Eacute;</strong>
											<input type="time" name="ate_domingo" value="18:00:00"/>
										</div>
									</div>
								</div>
							</li>
							<li>
								<h4 align="center" class="hide" id="titulo-especialidades">Especialidades
									escolhidas</h4>
								<table id="lista-escolhida" style="width:100%;display:none;">
									<thead>
									<th align="center" style="text-align:center;">
										Categoria
									</th>
									<th align="center" style="text-align:center;">
										Op&ccedil;&otilde;es
									</th>
									</thead>
									<tbody>
									</tbody>
								</table>
								<h4 align="center">Selecione suas especialidades</h4>
								<table id="lista-todas" style="width:100%;">
									<tbody>
									</tbody>
								</table>
							</li>
							<li>
								<fieldset>
									<legend>Foto de perfil (Opcional)</legend>
									<img src="<?= base_url() ?>assets/img/foto_cadastro.png"
										 height="130"/><br/><br/>
									<input type="file" name="foto"/>
								</fieldset>
								<hr/>
								<input type="checkbox" name="termos" required/>&nbsp;Eu li e aceito os <a
									href="<?= base_url() ?>termos" target="_blank">Termos de uso</a>.
							</li>
						</ul>
					</div>

					<hr />
					<div class="page-footer">
						<div class="row btn-wrap">
							<div class="col-xs-5 col-xs-offset-1" id="prev">
								<button class="btn btn-block btn-primary nav-step-btn">Anterior</button>
							</div>
							<div class="col-xs-5 col-xs-offset-1" id="next">
								<button class="btn btn-block btn-primary nav-step-btn">Pr&oacute;ximo</button>
							</div>
							<div class="col-xs-5 col-xs-offset-1" id="submit">
								<button class="btn btn-block btn-primary nav-step-btn" type="submit">Finalizar</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Fim -->
</div>
<link href="<?=base_url()?>assets/login/css/animation.css" rel="stylesheet">
<link href="<?=base_url()?>assets/login/css/orange.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/authenty-site.css" rel="stylesheet">
<link href="<?=base_url()?>assets/css/painel.css" rel="stylesheet">
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