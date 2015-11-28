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
                                    <input type="text" placeholder="Antonio" class="form-control" readonly/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Lacerda de Morais" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">

                                    <div class="input-group mb15">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" placeholder="antoniolacerda" class="form-control" readonly/>
                                    </div>

                                </div>
                                <div class="col-sm-4">
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
                        <a data-toggle="collapse" data-parent="#endereco" href="#collapse1">
                            Endereço
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="labelnew">Endereço</label>
                                <input type="text" title="Ex: Rua 7 de setembro, 224" data-toggle="tooltip"
                                       data-trigger="hover" class="padform form-control tooltips"/>
                            </div>
                            <div class="col-sm-2">
                                <label class="labelnew">Complemento</label>
                                <input type="text" title="Ex: Bloco 4 / Sala 306" data-toggle="tooltip"
                                       data-trigger="hover" class="padform form-control tooltips"/>
                            </div>
                            <div class="col-sm-4">
                                <label class="labelnew">Bairro</label>
                                <input type="text" title="Bairro onde está localizado o seu local" data-toggle="tooltip"
                                       data-trigger="hover" class="padform form-control tooltips"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="labelnew">Cidade</label>
                                <input type="text" title="Nome completo da cidade" data-toggle="tooltip"
                                       data-trigger="hover" class="padform form-control tooltips"/>
                            </div>
                            <div class="col-sm-4">
                                <label class="labelnew">Cep</label>
                                <input type="text" title="Ex: 00.000-000" data-toggle="tooltip" data-trigger="hover"
                                       class="padform form-control tooltips"/>
                            </div>
                            <div class="col-md-2">
                                <label class="labelnew">UF</label>
                                <select class="select2 padform" data-placeholder="Estado">
                                    <option value=""></option>
                                    <option value="Paraty">RJ</option>
                                    <option value="Angra">SP</option>
                                    <option value="Mangaratiba">MG</option>
                                    <option value="Petropolis">PR</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-12" style="height: 280px;border:none;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1833.3268670398643!2d-44.71222050000001!3d-23.2192865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9d6d1f66cfa627%3A0x8599c16a8fd44eb1!2sCentro+Hist%C3%B3rico%2C+Paraty+-+RJ!5e0!3m2!1spt-BR!2sbr!4v1441779792330"
                                width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group panel-group" id="dicassocial">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#endereco" href="#collapse2">
                            Dados extras
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">

                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="labelnew">Data Nascimento</label>

                                <div class="input-group mb15" style="margin-top:-6px;">

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" placeholder="Data de Nascimento" id="date" class="form-control"/>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <label class="labelnew">CPF</label>
                                <input type="text" class="padform form-control"/>
                            </div>

                            <div class="col-sm-6">
                                <label class="labelnew">POSSUI ALGUMA PROFISSÃO?</label>
                                <input type="text" class="padform form-control"/>
                            </div>

                        </div>

                        <div class="form-group" style="margin-top:-10px;">
                            <div class="col-sm-3">
                                <label class="labelnew">RG Nº</label>
                                <input type="text" class="padform form-control"/>
                            </div>


                            <div class="col-sm-3">
                                <label class="labelnew">Data de Expedição</label>

                                <div class="input-group mb15" style="margin-top:-6px;">

                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" placeholder="Data de Nascimento" id="date" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label class="labelnew">ORGÃO EXPEDIDOR</label>
                                <input type="text" class="padform form-control"/>
                            </div>
                        </div>


                        <div class="form-group" style="margin-top:-10px;">

                            <div class="col-md-3">
                                <label class="labelnew">ESCOLARIDADE</label>
                                <select class="select2 padform" data-placeholder="Selecione">
                                    <option value=""></option>
                                    <option value="Paraty">Ensino Fundamental</option>
                                    <option value="Paraty">Segundo Grau</option>
                                    <option value="Angra">Superior Incompleto</option>
                                    <option value="Mangaratiba">Superior Completo</option>
                                    <option value="Petropolis">Viúvo(a)</option>
                                    <option value="Petropolis">Pós-Graduado</option>
                                    <option value="Petropolis">Mestrado</option>
                                    <option value="Petropolis">Doutorado</option>
                                </select>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group panel-group" id="dicassocial">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#endereco" href="#collapse3">
                            Documentação (comprovantes)
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>Envie sua documentação para nossa equipe validar a sua conta</p>

                        <div class="col-sm-4">
                            <form action="files" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file"/>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <form action="files" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file"/>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <form action="files" class="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file"/>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-3">

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </row>
</div><!-- contentpanel -->