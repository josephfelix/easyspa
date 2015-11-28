<?php
	$uri = $this->uri->uri_string();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon"
          href="<?= base_url() ?>assets/painel/prestador/<?= base_url() ?>assets/painel/prestador/images/favicon.png"
          type="image/png">

    <title>easySpa.Club. Espaço de beleza e bem-estar</title>

    <link rel="stylesheet" href="<?= base_url() ?>assets/painel/prestador/css/style.default.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>assets/painel/prestador/css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/painel/prestador/css/jquery.tagsinput.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/painel/prestador/css/colorpicker.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/painel/prestador/css/dropzone.css"/>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	
	
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		window.BASE_URL = '<?=base_url()?>';
	</script>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/painel/prestador/js/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/painel/prestador/js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>


<section>

    <div class="leftpanel">
        <div class="logopanel">
            <h1><img src="<?= base_url() ?>assets/painel/prestador/images/logoeasyspa-jpg.jpg" width="115" height="27"
                     alt=""/></h1>
        </div>
        <!-- logopanel -->

        <div class="leftpanelinner">

            <div class="infosummary">

                <ul style="border:none;">
                    <li>
                        <div>
                            <img src="<?= base_url() ?>assets/img/anonimo.jpg" alt="" width="150px" height="150px"
                                 class="center-block border-radius"/>
                        </div>

                    </li>
                </ul>
            </div>
            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li <?=($uri == 'cliente/conta')?'class="active"':''?>><a href="<?= base_url() ?>cliente/conta"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a></li>

                <li <?=($uri == 'cliente/anuncio/novo')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/anuncio/novo"> 
						<i class="fa fa-tags"></i> <span>Criar novo anúncio</span>
					</a>
				</li>
                <li <?=($uri == 'cliente/publicidade/novo')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/publicidade/novo">
						<i class="fa fa-mobile"></i> <span>Criar Publicidade</span>
					</a>
				</li>
                <li <?=($uri == 'cliente/cupom/novo')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/cupom/novo">
						<i class="fa fa-ticket"></i> <span>Criar cupons de desconto</span>
					</a>
				</li>
                <li <?=($uri == 'cliente/financeiro')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/financeiro">
						<i class="fa fa-credit-card"></i> <span>Financeiro</span>
					</a>
                </li>
                <li <?=($uri == 'cliente/central')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/central">
						<i class="fa fa-life-ring"></i> <span>Central do Cliente</span>
					</a>
                </li>
                <li <?=($uri == 'cliente/ajuda')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/ajuda">
						<i class="fa fa-question-circle"></i> <span>Central de Ajuda</span>
					</a>
				</li>
                <li <?=($uri == 'cliente/configuracoes')?'class="active"':''?>>
					<a href="<?=base_url()?>cliente/configuracoes">
						<i class="fa fa-cog"></i> <span>Minhas Configurações</span>
					</a>
				</li>
            </ul>
            <!-- infosummary -->

        </div>
        <!-- leftpanelinner -->
    </div>
    <!-- leftpanel -->

    <div class="mainpanel">

        <div class="headerbar">

            <a class="menutoggle"><i class="fa fa-bars"></i></a>


            <div class="header-right">
                <ul class="headermenu">

                    <li>
                        <div class="btn-group">
                            <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                                <i class="fa fa-life-ring"></i>
                                <span class="badge">1</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-head pull-right">
                                <h5 class="title">Você tem 1 Mensagem</h5>
                                <ul class="dropdown-list gen-list">
                                    <li class="new">
                                        <a href="<?= base_url() ?>assets/painel/prestador/">
                                            <span class="thumb"><i class="fa fa-tags"
                                                                   style="font-size:25px; margin-top:5px;"></i></span>
                    <span class="desc">
                      <span class="name">Um novo boleto foi gerado <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>assets/painel/prestador/">
                                            <span class="thumb"><i class="fa fa-tags"
                                                                   style="font-size:25px; margin-top:5px;"></i></span>
                    <span class="desc">
                      <span class="name">Nova mensagem do setor financeiro <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>assets/painel/prestador/">
                                            <span class="thumb"><i class="fa fa-tags"
                                                                   style="font-size:25px; margin-top:5px;"></i></span>
                    <span class="desc">
                      <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>assets/painel/prestador/">
                                            <span class="thumb"><i class="fa fa-tags"
                                                                   style="font-size:25px; margin-top:5px;"></i></span>
                    <span class="desc">
                      <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>assets/painel/prestador/">
                                            <span class="thumb"><i class="fa fa-tags"
                                                                   style="font-size:25px; margin-top:5px;"></i></span>
                    <span class="desc">
                      <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url() ?>assets/img/anonimo.jpg" alt=""/>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="<?= base_url() ?>cliente/configuracoes"><i
                                            class="glyphicon glyphicon-cog"></i> Minhas Configurações</a></li>
                                <li><a href="<?= base_url() ?>cliente/ajuda"><i
                                            class="glyphicon glyphicon-question-sign"></i> Central de Ajuda</a></li>
                                <li><a href="<?= base_url() ?>login/sair"
                                       onclick="return confirm('Tem certeza que deseja sair?')"><i
                                            class="glyphicon glyphicon-log-out"></i> Sair do Sistema</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- header-right -->

        </div>
        <!-- headerbar -->