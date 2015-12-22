<script type="text/javascript">
function alterarSenha(obj)
{
	$(obj).hide();
	$('#btn-salvar').removeClass('hide');
	$('#field-password').attr('readonly', false);
}
$(function()
{
	$("#image_file").change(function()
	{
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];	
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			$('#imagemperfil').attr('src','<?=base_url()?>assets/img/anonimo.jpg');
			return false;
		} else
		{
			var reader = new FileReader();	
			reader.onload = function(e)
			{
				$('#imagemperfil').attr('src', e.target.result);
			};
			reader.readAsDataURL(this.files[0]);
		}		
	});
});
</script>
<div class="contentpanel"><!-- panel --><!-- panel --><!-- row -->
    <div class="row">
        <div class="col-md-12 mb10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title" style="font-size:14px; text-transform:uppercase;">Dados principais da
                        conta</h1>
                </div>
                <div class="panel-body">
					<form method="POST" action="<?=base_url()?>cliente/configuracoes/senha">
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group">
									<div class="col-sm-6">

										<div class="input-group mb15">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-envelope"></i>
											</span>
											<input type="text" value="<?=$dados->email?>" class="form-control" readonly/>
										</div>
										<div class="input-group mb15">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-lock"></i>
											</span>
											<input type="password" name="senha" id="field-password" class="form-control pword" placeholder="Senha" readonly/>
										</div>

									</div>
									<div class="col-sm-6">
										<a class="btn btn-primary" href="javascript:;" onclick="alterarSenha(this)">Alterar senha</a>
										<button class="btn btn-primary hide" type="submit" id="btn-salvar">
											<i class="fa fa-save"></i>&nbsp;Salvar senha
										</button>
									</div>
								</div>
							</div>
						</div>
						<?php
							if ($sucesso_senha)
							{
						?>
							<br />
							<div class="alert alert-success">
								<strong>Sucesso!</strong>&nbsp;sua senha foi alterada com sucesso.
							</div>
						<?php
							}
						?>
					</form>


                </div>
            </div>
        </div>
    </div>

    <row>
        <div class="panel-group panel-group" id="dicassocial">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#endereco" href="#collapse2">
                            Dados extras
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse in">
                    <div class="panel-body">
						<form method="POST" action="<?=base_url()?>cliente/configuracoes/dados">
							<div class="form-group">
								 <div class="col-md-3">
									<label class="labelnew">Tipo</label>
									<select class="select2 padform" data-placeholder="Selecione" name="tipo">
										<option value="PF" <?=$dados->tipo=='PF'?'selected="selected"':''?>>Pessoa f&iacute;sica</option>
										<option value="PJ" <?=$dados->tipo=='PJ'?'selected="selected"':''?>>Pessoa jur&iacute;dica</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label class="labelnew">CPF/CNPJ</label>
									<input type="text" class="padform form-control" name="cpfcnpj" value="<?=$dados->cpfcnpj?>"/>
								</div>
								
								<div class="col-sm-3">
									<label class="labelnew">Data Nascimento</label>

									<div class="input-group mb15" style="margin-top:-6px;">

										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="text" placeholder="Data de Nascimento" name="datanascimento" value="<?=date('d/m/Y', strtotime($dados->datanascimento))?>" id="date" class="form-control"/>
									</div>
								</div>

							</div>

							<?php 
								if ( $dados->tipo == 'PJ' )
								{
							?>
							<div class="form-group" style="margin-top:-10px;">
									
								<div class="col-sm-3">
									<label class="labelnew">Raz&atilde;o social</label>
									<input type="text" class="padform form-control" name="razaosocial" value="<?=$dados->razaosocial?>"/>
								</div>
								
								<div class="col-sm-3">
									<label class="labelnew">Nome fantasia</label>
									<input type="text" class="padform form-control" name="nomefantasia" value="<?=$dados->nomefantasia?>"/>
								</div>

							</div>
							<?php 
								}
							?>
							<br />
							<div class="row">
								<button type="submit" class="btn btn-primary pull-right">
									<i class="fa fa-save"></i>&nbsp;Salvar configura&ccedil;&otilde;es
								</button>
							</div>
							
							<?php
							if ($sucesso_dados)
							{
							?>
								<br />
								<div class="alert alert-success">
									<strong>Sucesso!</strong>&nbsp;seus dados foram salvos com sucesso.
								</div>
							<?php
							}
							?>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </row>
</div><!-- contentpanel -->