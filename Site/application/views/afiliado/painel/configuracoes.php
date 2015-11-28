<div class="pageheader">
  <h2><i class="fa fa-cog"></i> Configura&ccedil;&otilde;es</h2>
</div>
<script src="<?=base_url()?>assets/js/jquery.mask.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$('.selecionar-tipo').click(function()
	{
		if ( $(this).val() == 'PF' )
		{
			$('#container_cnpj').addClass('hide');
			$('#container_cpf').removeClass('hide');
			$('#cpf').val('').focus();
		} else
		{
			$('#container_cpf').addClass('hide');
			$('#container_cnpj').removeClass('hide');
			$('#cnpj').val('').focus();
		}
	});
	
	$('#select-estado').change(function()
	{
		$('#select-cidade').find('option').each(function()
		{
			if ( $(this).val() != '0' )
				$(this).remove();
		});
		$('#select-cidade option:selected').html('Carregando...');
		$.get('<?=base_url()?>afiliado/cidades/?estado='+$(this).find('option:selected').val())
		.success(function(result)
		{
			$('#select-cidade option:selected').html('Selecione uma cidade');
			var json = JSON.parse( result );
			for ( var x in json )
			{
				$('#select-cidade').append('<option value="'+json[x].cidade+'">'+json[x].cidade+'</option>');
			}
		});
	});
	
	$('#cep').mask('99999-999');
	$('#cpf').mask('999.999.999-99');
	$('#cnpj').mask('99.999.999/9999-99');
	$('#telefone').mask('(99) 9999-9999');
	$('#celular').mask('(99) 99999-9999');
});
</script>
<div class="contentpanel">
    <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Configura&ccedil;&otilde;es</h4>
		</div>
		<div class="panel-body panel-body-nopadding">
			<form method="post" id="signup" class="form-horizontal form-bordered" enctype="multipart/form-data">
				<div class="form-group">
					<label for="nome" class="col-sm-3 control-label">Nome:</label>
					<div class="col-sm-6">
						<input type="text" name="nome" class="form-control" id="nome" value="<?=$afiliado->nome?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="sobrenome" class="col-sm-3 control-label">Sobrenome:</label>
					<div class="col-sm-6">
						<input type="text" name="sobrenome" class="form-control" id="sobrenome" value="<?=$afiliado->sobrenome?>" />
					</div>
				</div>
				<div class="form-group">
					<label for="sobrenome" class="col-sm-3 control-label">Tipo:</label>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<input type="radio" name="tipo" class="selecionar-tipo" value="PF" <?=$afiliado->tipo=='PF'?'checked="checked"':''?> />&nbsp;Pessoa f&iacute;sica
							</div>
							<div class="col-sm-6">
								<input type="radio" name="tipo" value="PJ" class="selecionar-tipo" <?=$afiliado->tipo=='PJ'?'checked="checked"':''?> />&nbsp;Pessoa jur&iacute;dica
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group <?=$afiliado->tipo=='PJ'?'hide':''?>" id="container_cpf">
					<label for="cpf" class="col-sm-3 control-label">CPF:</label>
					<div class="col-sm-6">
						<input type="text" name="cpf" class="form-control" id="cpf" value="<?=$afiliado->cpfcnpj?>" />
					</div>
				</div>
				<div class="form-group <?=$afiliado->tipo=='PF'?'hide':''?>" id="container_cnpj">
					<label for="cnpj" class="col-sm-3 control-label">CNPJ:</label>
					<div class="col-sm-6">
						<input type="text" name="cnpj" class="form-control" id="cnpj" value="<?=$afiliado->cpfcnpj?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="telefone" class="col-sm-3 control-label">Telefone:</label>
					<div class="col-sm-6">
						<input type="text" name="telefone" class="form-control" id="telefone" value="<?=$afiliado->telefone?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="celular" class="col-sm-3 control-label">Celular:</label>
					<div class="col-sm-6">
						<input type="text" name="celular" class="form-control" id="celular" value="<?=$afiliado->celular?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="celular" class="col-sm-3 control-label">Estado:</label>
					<div class="col-sm-6">
						<select name="estado" class="form-control" id="select-estado">
							<?php
								foreach ( $estados as $estado )
								{
							?>
								<option value="<?=$estado->id?>" <?=$afiliado->estado==$estado->estado?'selected="selected"':''?>><?=$estado->estado?></option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="celular" class="col-sm-3 control-label">Cidade:</label>
					<div class="col-sm-6">
						<select name="cidade" class="form-control" id="select-cidade">
							<option value="0">Selecione uma cidade</option>
							<?php
								foreach ( $cidades as $cidade )
								{
							?>
								<option value="<?=$cidade->cidade?>" <?=$afiliado->cidade==$cidade->cidade?'selected="selected"':''?>><?=$cidade->cidade?></option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="celular" class="col-sm-3 control-label">Banco:</label>
					<div class="col-sm-6">
						<select name="banco" class="form-control">
							<?php
								foreach ( $bancos as $banco )
								{
							?>
								<option value="<?=$banco->codigo . ' - ' . $banco->banco?>" <?=$afiliado->banco==($banco->codigo . ' - ' . $banco->banco)?'selected="selected"':''?>><?=$banco->codigo . ' - ' . $banco->banco?></option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="agencia" class="col-sm-3 control-label">Ag&ecirc;ncia:</label>
					<div class="col-sm-6">
						<input type="text" name="agencia" class="form-control" id="agencia" value="<?=$afiliado->agencia?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="conta" class="col-sm-3 control-label">Conta:</label>
					<div class="col-sm-6">
						<input type="text" name="conta" class="form-control" id="conta" value="<?=$afiliado->conta?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="foto" class="col-sm-3 control-label">Foto atual:</label>
					<div class="col-sm-6">
						<?php
							if ( empty( $afiliado->avatar ) )
							{
						?>
						<img src="<?=base_url()?>assets/images/anonimo.jpg" />
						<?php
							} else
							{
						?>
						<img src="<?=base_url()?>upload/<?=$afiliado->avatar?>" width="100" height="100" />
						<?php
							}
						?>
						<hr />
						Alterar foto:<br />
						<input type="file" name="avatar" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-3">
						<input type="submit" value="Alterar dados" class="btn btn-primary btn-block" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div><!-- contentpanel -->