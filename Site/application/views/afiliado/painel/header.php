<?php
$segment = $this->uri->segment(3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>easySpa - Afiliado</title>

  <link href="<?=base_url()?>assets/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?=base_url()?>assets/js/html5shiv.js"></script>
  <script src="<?=base_url()?>assets/js/respond.min.js"></script>
  <![endif]-->
	<script src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/zeroclipboard/ZeroClipboard.min.js"></script>
	<script type="text/javascript">
	  $(document).ready(function()
		{
			if ( $('#copiar-link').length )
			{
				var client = new ZeroClipboard($("#copiar-link"),
				{
					moviePath: "<?=base_url()?>assets/js/zeroclipboard/ZeroClipboard.swf"
				});
				client.on( "load", function(client)
				{
					client.on( "complete", function(client, args)
					{
						alert("Link copiado com sucesso!");
					});
				});
			}
		});
	</script>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <div class="logopanel">
        <img src="<?=base_url()?>assets/images/logo-header.png" />
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
				<?php
					if ( empty( $this->session->userdata('afiliado_foto') ) )
					{
				?>
                <img alt="" src="<?=base_url()?>assets/images/anonimo.jpg" class="media-object">
				<?php
					} else
					{
				?>
                <img alt="" src="<?=base_url()?>upload/<?=$this->session->userdata('afiliado_foto')?>" class="media-object">
				<?php
					}
				?>
                <div class="media-body">
                    <h4><?=$this->session->userdata('afiliado_nome')?></h4>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Menu</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
				<li><a href="<?=base_url()?>afiliado/painel/configuracoes"><i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&otilde;es</a></li>
                <li><a href="<?=base_url()?>afiliado/painel/ajuda"><i class="glyphicon glyphicon-question-sign"></i> Ajuda</a></li>
				<li><a href="<?=base_url()?>afiliado/painel/material"><i class="fa fa-video-camera"></i> Material publicit&aacute;rio</a></li>
				<li><a href="<?=base_url()?>afiliado/painel/treinamento"><i class="fa fa-download"></i> Treinamento de vendas</a></li>
                <li><a href="<?=base_url()?>afiliado/painel/sair"><i class="glyphicon glyphicon-log-out"></i> Sair</a></li>
            </ul>
        </div>
      
	  <br />
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li <?=$segment==''||$segment=='dashboard'?'class="active"':''?>>
			<a href="<?=base_url()?>afiliado/painel/dashboard">
				<i class="fa fa-money"></i> <span>Faturamento</span>
			</a>
		</li>
		<li <?=$segment=='material'?'class="active"':''?>><a href="<?=base_url()?>afiliado/painel/material"><i class="fa fa-download"></i> <span>Material publicit&aacute;rio</span></a></li>
		<li <?=$segment=='treinamento'?'class="active"':''?>><a href="<?=base_url()?>afiliado/painel/treinamento"><i class="fa fa-video-camera"></i> <span>Treinamento de vendas</span></a></li>
        <li <?=$segment=='ajuda'?'class="active"':''?>><a href="<?=base_url()?>afiliado/painel/ajuda"><i class="fa fa-laptop"></i> <span>Central de ajuda</span></a></li>
      </ul>      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
      
		<a class="menutoggle"><i class="fa fa-bars"></i></a>
		<div class="indicacaolink">
			<label for="copiar-link">Link de indica&ccedil;&atilde;o:</label>
			<?=base_url()?>cliente/cadastro/<?=$this->session->userdata('afiliado_logado')?>&nbsp;<a href="#" id="copiar-link" data-clipboard-text="<?=base_url()?>cliente/cadastro/<?=$this->session->userdata('afiliado_logado')?>"><i class="glyphicon glyphicon-share"></i>&nbsp;COPIAR LINK</a>
		</div>

      
		<!--<form class="searchform" action="index.html" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
      </form>-->
      
      <div class="header-right">
        <ul class="headermenu">
          <!-- <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i>
                <span class="badge">2</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">2 Newly Registered Users</h5>
                <ul class="dropdown-list user-list">
                  <li class="new">
                    <div class="thumb"><a href=""><img src="images/photos/user1.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Draniem Daamul (@draniem)</a> <span class="badge badge-success">new</span></h5>
                    </div>
                  </li>
                  <li class="new">
                    <div class="thumb"><a href=""><img src="images/photos/user2.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Zaham Sindilmaca (@zaham)</a> <span class="badge badge-success">new</span></h5>
                    </div>
                  </li>
                  <li>
                    <div class="thumb"><a href=""><img src="images/photos/user3.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Weno Carasbong (@wenocar)</a></h5>
                    </div>
                  </li>
                  <li>
                    <div class="thumb"><a href=""><img src="images/photos/user4.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Nusja Nawancali (@nusja)</a></h5>
                    </div>
                  </li>
                  <li>
                    <div class="thumb"><a href=""><img src="images/photos/user5.png" alt="" /></a></div>
                    <div class="desc">
                      <h5><a href="">Lane Kitmari (@lane_kitmare)</a></h5>
                    </div>
                  </li>
                  <li class="new"><a href="">See All Users</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-envelope"></i>
                <span class="badge">1</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have 1 New Message</h5>
                <ul class="dropdown-list gen-list">
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user1.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Draniem Daamul <span class="badge badge-success">new</span></span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                    <span class="thumb"><img src="images/photos/user2.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Nusja Nawancali</span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Weno Carasbong</span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                    <span class="thumb"><img src="images/photos/user4.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Zaham Sindilmaca</span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                    <span class="thumb"><img src="images/photos/user5.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Veno Leongal</span>
                      <span class="msg">Lorem ipsum dolor sit amet...</span>
                    </span>
                    </a>
                  </li>
                  <li class="new"><a href="">Read All Messages</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li>
            <div class="btn-group">
              <button class="btn btn-default dropdown-toggle tp-icon" data-toggle="dropdown">
                <i class="glyphicon glyphicon-globe"></i>
                <span class="badge">5</span>
              </button>
              <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">You Have 5 New Notifications</h5>
                <ul class="dropdown-list gen-list">
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user4.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Zaham Sindilmaca <span class="badge badge-success">new</span></span>
                      <span class="msg">is now following you</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user5.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Weno Carasbong <span class="badge badge-success">new</span></span>
                      <span class="msg">is now following you</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Veno Leongal <span class="badge badge-success">new</span></span>
                      <span class="msg">likes your recent status</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Nusja Nawancali <span class="badge badge-success">new</span></span>
                      <span class="msg">downloaded your work</span>
                    </span>
                    </a>
                  </li>
                  <li class="new">
                    <a href="">
                    <span class="thumb"><img src="images/photos/user3.png" alt="" /></span>
                    <span class="desc">
                      <span class="name">Nusja Nawancali <span class="badge badge-success">new</span></span>
                      <span class="msg">send you 2 messages</span>
                    </span>
                    </a>
                  </li>
                  <li class="new"><a href="">See All Notifications</a></li>
                </ul>
              </div>
            </div>
          </li>-->
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<?php
					if ( empty( $this->session->userdata('afiliado_foto') ) )
					{
				?>
                <img alt="" src="<?=base_url()?>assets/images/anonimo.jpg" />
				<?php
					} else
					{
				?>
                <img alt="" src="<?=base_url()?>upload/<?=$this->session->userdata('afiliado_foto')?>" />
				<?php
					}
				?>
				<?=$this->session->userdata('afiliado_nome')?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?=base_url()?>afiliado/painel/configuracoes"><i class="glyphicon glyphicon-cog"></i> Configura&ccedil;&otilde;es</a></li>
                <li><a href="<?=base_url()?>afiliado/painel/ajuda"><i class="glyphicon glyphicon-question-sign"></i> Ajuda</a></li>
                <li><a href="<?=base_url()?>afiliado/painel/sair"><i class="glyphicon glyphicon-log-out"></i> Sair</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->