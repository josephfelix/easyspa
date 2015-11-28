<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="easySpa.Club - Espaço de beleza e bem-estar."/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="http://easyspa.club/cliente/cadastro/<?= $id_afiliado ?>"/>
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM10.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM13.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM11.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM15.jpg">
    <meta property="og:image" content="http://easyspa.club/assets/img/shareinstagram/INSTAGRAM8.jpg">
    <meta property="og:site_name" content="easySpa.Club - Espaço de beleza e bem-estar."/>
    <meta property="og:description"
          content="Seja um cliente do easySpa.club! O espaço de beleza e bem-estar que toda mulher merece."/>

    <title>easySpa - Cadastro comercial</title>

    <!-- Stylesheets -->
    <link href="<?= base_url() ?>assets/login/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/animation.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/orange.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/preview.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/css/authenty.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<section class="authenty signup-wizard signin-main">
    <div class="section-content">
        <div class="container">
            <div class="form-wrap">
                <div class="form-header" style="margin-left:-15px;width:430px;">
                    <h1>Cadastro de clientes</h1>
                    <img src="<?= base_url() ?>assets/images/logo.png">
                    <hr/>
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
                </div>

                <form method="POST" enctype="multipart/form-data">
                    <div data-animation="bounceInLeft" data-animation-delay=".2s">
                        <div class="row">
                            <ul class="page-container">
                                <li class="current" data-submit="checkForm1()">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-12">
                                                <label class="label-cpf-cnpj">
                                                    <input type="radio" name="tipo" class="selecionar-tipo" value="PF"
                                                           checked="checked">
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
                                        <input type="text" name="nome" class="form-control" id="form-nome"
                                               placeholder="Nome">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="form-email" class="form-control"
                                               placeholder="E-mail">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="senha" id="form-senha" class="form-control"
                                               placeholder="Senha">
                                    </div>
                                    <div class="form-group hide" id="form-group-telfixo">
                                        <input type="text" name="telefone" id="form-telefone" class="form-control"
                                               placeholder="Telefone fixo">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="celular" id="form-celular" class="form-control"
                                               placeholder="Telefone celular"/>
                                    </div>
                                    <div class="form-group" id="form-group-cpf">
                                        <input type="text" name="cpf" id="form-cpf" class="form-control"
                                               placeholder="CPF">
                                    </div>
                                    <div class="form-group hide" id="form-group-cnpj">
                                        <input type="text" name="cnpj" id="form-cnpj" class="form-control"
                                               placeholder="CNPJ">
                                    </div>
                                    <div class="form-group hide" id="form-group-razao">
                                        <input type="text" name="razaosocial" class="form-control"
                                               placeholder="Raz&atilde;o social">
                                    </div>
                                    <div class="form-group hide" id="form-group-nomefantasia">
                                        <input type="text" name="nomefantasia" class="form-control"
                                               placeholder="Nome fantasia">
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
                                            foreach ($estados as $estado) {
                                                ?>
                                                <option value="<?= $estado->id ?>"><?= $estado->estado ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select id="select-cidade" name="cidade" class="form-control select-cadastro">
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

                        <div class="page-footer">
                            <div class="row step-wrap">
                                <div class="col-xs-12">
                                    <span><span id="stepNo"></span> de 4</span>
                                </div>
                            </div>
                            <div class="row btn-wrap">
                                <div class="col-xs-6" id="prev">
                                    <button class="btn btn-block nav-step-btn">Anterior</button>
                                </div>
                                <div class="col-xs-6" id="next">
                                    <button class="btn btn-block nav-step-btn">Pr&oacute;ximo</button>
                                </div>
                                <div class="col-xs-6" id="submit">
                                    <button class="btn btn-block nav-step-btn" type="submit">Finalizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- js library -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>assets/login/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>

<!-- authenty js -->
<!--	<script src="<?= base_url() ?>assets/login/js/authenty.js"></script>-->


<!-- preview scripts -->
<script>
    $(document).ready(function () {

        /*
         Fullscreen background
         */
        $.backstretch([
            "<?=base_url()?>assets/img/backgrounds/1.jpg"
            , "<?=base_url()?>assets/img/backgrounds/2.jpg"
            , "<?=base_url()?>assets/img/backgrounds/3.jpg"
        ], {duration: 3000, fade: 750});
    });
</script>
<script src="<?= base_url() ?>assets/login/js/jquery.icheck.min.js"></script>
<script src="<?= base_url() ?>assets/login/js/waypoints.min.js"></script>

<!-- authenty js -->
<script src="<?= base_url() ?>assets/login/js/authenty.js"></script>


<!-- preview scripts -->
<script>
    (function ($) {

        // get full window size
        $(window).on('load resize', function () {
            var w = $(window).width();
            var h = $(window).height();

            $('section').height(h);
        });


        // set focus on input
        var firstInput = $('section').find('input[type=text], input[type=email]').filter(':visible:first');

        if (firstInput != null) {
            firstInput.focus();
        }

        $('section').waypoint(function (direction) {
            var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
            target.focus();
        }, {
            offset: 300
        }).waypoint(function (direction) {
            var target = $(this).find('input[type=text], input[type=email]').filter(':visible:first');
            target.focus();
        }, {
            offset: -400
        });


        // animation handler
        $('[data-animation-delay]').each(function () {
            var animationDelay = $(this).data("animation-delay");
            $(this).css({
                "-webkit-animation-delay": animationDelay,
                "-moz-animation-delay": animationDelay,
                "-o-animation-delay": animationDelay,
                "-ms-animation-delay": animationDelay,
                "animation-delay": animationDelay
            });
        });

        $('[data-animation]').waypoint(function (direction) {
            if (direction == "down") {
                $(this).addClass("animated " + $(this).data("animation"));
            }
        }, {
            offset: '90%'
        }).waypoint(function (direction) {
            if (direction == "up") {
                $(this).removeClass("animated " + $(this).data("animation"));
            }
        }, {
            offset: '100%'
        });

    })(jQuery);
</script>
<style type="text/css">
    #lista-todas tr td a {
        padding: 7px;
        display: block;
        color: #fff;
        background-color: #312E2E;
    }

    #lista-todas tr td a:hover, #lista-escolhida tr td a:hover {
        background-color: #5D5D5D;
    }

    #lista-escolhida tr td a {
        background-color: #2F2D2D;
        padding: 7px;
        color: #fff;
        display: block;
    }

    .error {
        border: solid 1px red !important;
        box-shadow: none !important;
    }

    .error:focus {
        box-shadow: none !important;
    }
</style>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/login/js/cadastrocliente.js"></script>
</body>
</html>