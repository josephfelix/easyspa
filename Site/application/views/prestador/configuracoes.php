<div class="contentpanel"><!-- panel --><!-- panel --><!-- row -->
    <div class="row">
        <div class="col-md-12 mb10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title" style="font-size:14px; text-transform:uppercase;">Dados principais da
                        conta</h1>
                </div>
                <div class="panel-body">

                    <div>
                        <div class="col-sm-2">
                            <img src="<?= base_url() ?>assets/img/anonimo.jpg" width="104" height="104" alt=""/>

                            <div style="font-size:11px; text-align:left;"><a href="#">alterar imagem</a></div>
                        </div>

                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="col-sm-6">

                                    <div class="input-group mb15">
                                        <span class="input-group-addon">
											<i class="glyphicon glyphicon-envelope"></i>
										</span>
                                        <input type="text" value="<?=$dados->email?>" class="form-control" readonly/>
                                    </div>
                                    <input type="password" class="form-control pword" placeholder="Senha" readonly/>

                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-primary">Alterar</a>
                                </div>
                            </div>

                        </div>
                    </div>


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

                        <div class="form-group">
							 <div class="col-md-3">
                                <label class="labelnew">Tipo</label>
                                <select class="select2 padform" data-placeholder="Selecione">
                                    <option value="PF">Pessoa f&iacute;sica</option>
                                    <option value="PJ">Pessoa jur&iacute;dica</option>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label class="labelnew">CPF/CNPJ</label>
                                <input type="text" class="padform form-control" value="<?=$dados->cpfcnpj?>"/>
                            </div>
							
							<div class="col-sm-3">
                                <label class="labelnew">Data Nascimento</label>

                                <div class="input-group mb15" style="margin-top:-6px;">

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" placeholder="Data de Nascimento" value="<?=date('d/m/Y', strtotime($dados->datanascimento))?>" id="date" class="form-control"/>
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
                                <input type="text" class="padform form-control" value="<?=$dados->razaosocial?>"/>
                            </div>
							
							<div class="col-sm-3">
                                <label class="labelnew">Nome fantasia</label>
                                <input type="text" class="padform form-control" value="<?=$dados->nomefantasia?>"/>
                            </div>

                        </div>
						<?php 
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </row>
</div><!-- contentpanel -->