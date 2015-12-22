<div class="pageheader">
	<h2><i class="fa fa-home"></i> Dashboard </h2>

	<div class="breadcrumb-wrapper">
		<span class="label">Você está em:</span>
		<ol class="breadcrumb">
			<li>Dashboard</li>

		</ol>
	</div>
</div>
		
<div class="contentpanel"><!-- panel --><!-- panel -->
	<?php
		if ($this->input->get('cadastro'))
		{
	?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="alert alert-success">
						<strong>Sucesso!</strong><br />
						Seu an&uacute;ncio foi cadastrado com sucesso.
					</div>
				</div>
			</div>
		</div>
	<?php
		}
	?>
	
	
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1%"><a class="btn btn-success" style="color:#FFF;"><i class="fa fa-plus"></i>
                                        novo anúncio</a></td>
                                <td width="87%" style="padding-left:14px;"><span
                                        style="font-size:15px; padding-top:18px; color:#666;"> Possui mais de um estabelecimento? Crie novos anúncios com descontos progressivos e gere visibilidade para todos os pontos de sua rede de estabelecimentos.</span>
                                </td>
                                <td width="1%" valign="top">
                                    <div class="panel-btns">
                                        <a href="<?= base_url() ?>assets/painel/prestador/" class="panel-close"
                                           style="padding-top:8px;">&times;</a>

                                    </div>
                                </td>
                            </tr>
                        </table>


                    </h2>
                </div>
            </div>
            <!-- panel -->
        </div>
        <!-- col-md-6 --><!-- col-md-6 -->

    </div>
    <!-- row -->


    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-success panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-bottom:-10px;">anúncio(s)</small>
                                <h3><?= $total_anuncios ?> Anúncio(s)</h3>
                            </div>
                        </div>
                        <!-- row -->


                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-top:-8px;">ATIVO NESTE MOMENTO</small>

                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- stat -->

                </div>
                <!-- panel-heading -->
            </div>
            <!-- panel -->
        </div>


        <div class="col-sm-6 col-md-3">
            <div class="panel panel-dark panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-bottom:-10px;">PUBLICIDADE(S)</small>
                                <h3>0 Publicidade(s)</h3>
                            </div>
                        </div>
                        <!-- row -->


                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-top:-8px;">no site: 0 | no app: 0</small>

                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- stat -->

                </div>
                <!-- panel-heading -->
            </div>
            <!-- panel -->
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-primary panel-stat">
                <div class="panel-heading">

                    <div class="stat">
                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-bottom:-10px;">CUPON(S)</small>
                                <h3><?= $total_cupons ?> Cupons(s)</h3>
                            </div>
                        </div>
                        <!-- row -->


                        <div class="row">
                            <div class="col-xs-12">
                                <small class="stat-label" style="margin-top:-8px;">no site: <?= $total_cupons_site ?> |
                                    no app: <?= $total_cupons_app ?></small>

                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- stat -->

                </div>
                <!-- panel-heading -->
            </div>
            <!-- panel -->
        </div>


    </div>


	<?php 
		if ( is_array( $anuncios ) )
		{
			foreach ( $anuncios as $anuncio )
			{
	?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="margin-top:10px;">

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="1%"><i class="fa fa-tag" style="font-size:38px; color:#999;"></i></td>
                                <td width="87%" style="padding-left:10px;">
    <span style=" padding-right:20px; font-size:28px;">

<?=$anuncio->titulo?></span> <i class="fa fa-comments-o"></i> <span style="font-size:14px;"><a
                                            href="<?= base_url() ?>assets/painel/prestador/">abrir chat</a></span><br>


                                    <div style="font-size:10px; color:#999; margin-top:0px;"> STATUS DO ANÚNCIO: <?=$anuncio->ativo ? '<span class="text-success">ATIVO</span>' : '<span class="text-danger">INATIVO</span>'?> |
                                        ID <?=$anuncio->idanuncio?>
                                    </div>

                                </td>
                                <td width="1%" valign="top">
                                    <div class="panel-btns" style="margin-top:-20px;">
                                        <a href="<?= base_url() ?>assets/painel/prestador/" class="minimize"
                                           style="padding-top:8px;">&minus;</a>

                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>


                </div>

                <div class="panel-body panel-default nopadding">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 widget-photoday nopadding">
						<a href="<?=base_url()?>perfil/<?=$anuncio->idanuncio?>" target="_blank">
							<img src="<?=base_url()?>upload/<?=$anuncio->avatar?>" onerror="this.src='<?=base_url()?>assets/img/sem-avatar.jpg'" width="360px" alt=""
                                class="photoday" style="-moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    border-radius: 0px;"/></a></div>
                    <!-- col-md-4 -->

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" style="padding-left:30px;">
                        <div>
                            <div class="visible-lg" style="padding-bottom:10px;"></div>

                        </div>


                        <div class="visible-xs" style="padding-bottom:20px;"></div>
                        <div class="visible-sm" style="padding-bottom:40px;"></div>
                        <div class="visible-md" style="padding-bottom:40px;"></div>
                        <div class="visible-lg" style="padding-bottom:50px;"></div>

                        <div>
                            <div class="col-md-12 col-sm-12 nopadding">
                                
								<?php
									$avaliacoes = ($anuncio->avaliacoes == 0) ? 0 : $anuncio->pontuacao / $anuncio->avaliacoes;
									if ( $avaliacoes > 0 )
									{
										$star_complete = floor($avaliacoes);
										$star_half = ceil($avaliacoes - $star_complete);
										for ( $count = 1; $count <= $star_complete; $count++ )
										{
								?>
								<i class="fa fa-star" style="color:#FC0"></i> 
								<?php
										}
									
										for ( $count = 1; $count <= $star_half; $count++ )
										{
								?>
                                <i class="fa fa-star-half-o" style="color:#FC0"></i> 
								<?php
										}
									} else
									{
								?>
									<i class="fa fa-star-o"></i> 
									<i class="fa fa-star-o"></i> 
									<i class="fa fa-star-o"></i> 
									<i class="fa fa-star-o"></i> 
									<i class="fa fa-star-o"></i> 
								<?php
									}
								?>
								<span
                                    style="font-size:14px; font-weight:bold; padding-left:10px; padding-right:20px;"><?=$this->avaliacoes_lib->formatar($anuncio->pontuacao, $anuncio->avaliacoes)?></span>
                                <span class="profile-location" style="font-size:14px; padding-right:20px;"><i
                                        class="fa fa-pencil"></i><a
                                        href="<?= base_url() ?>cliente/anuncio/editar/<?=$anuncio->idanuncio?>">Editar</a></span>
                                <span class="profile-location" style="font-size:14px; padding-left:0px;">
									<i class="fa fa-eye"></i>
									<a href="<?=base_url()?>perfil/<?=$anuncio->idanuncio?>" target="_blank">
										Visualizar página
									</a>
								</span>
                            </div>

                        </div>
                        <div class="visible-sm" style="padding-bottom:30px;"></div>
                        <div class="visible-md" style="padding-bottom:30px;"></div>
                        <div class="visible-lg" style="padding-bottom:40px;"></div>
                        <div class="visible-xs"
                             style="border-bottom:#efefef solid 1px; width:100%; margin-top:20px; margin-bottom:10px;"></div>

                        <div>
                            <div class="col-md-7 col-sm-7 nopadding">
                                <div class="profile-location"><i class="fa fa-map-marker"></i> <?=$anuncio->endereco?>, <?=$anuncio->bairro?>, <?=$anuncio->cidade?> - <?=$anuncio->estado?>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 nopadding">
                                <div class="profile-location">
									<i class="fa fa-file-text"></i>&nbsp;<?=$anuncio->especialidades?>
                                </div>
                            </div>
                        </div>

                        <div class="mb10 hidden-sm"></div>
                        <div class="visible-xs"
                             style="border-bottom:#efefef solid 1px; width:100%; margin-bottom:10px;"></div>
                        <div>
                            <div class="col-md-7 col-sm-7 nopadding profile-position"><i class="fa fa-briefcase"></i>
                                <?=$this->categorias_lib->nome($anuncio->categoria_principal)?>
                            </div>
                        </div>
                        <div class="mb10 hidden-sm"></div>
                        <div class="visible-xs"
                             style="border-bottom:#efefef solid 1px; width:100%; margin-bottom:10px;"></div>
                        <div class="hidden-sm">
                            <div class="col-md-7 col-sm-7 nopadding profile-position">
								<i class="fa fa-share-alt"></i>&nbsp;<?=$anuncio->apresentacao?>
                            </div>
                            <div class="col-md-5 col-sm-5 nopadding">
                                <div class="profile-location">
									<i class="fa fa-phone"></i> <?=$anuncio->celular?> / <?=$anuncio->telefone?>
								</div>
                            </div>
                        </div>
                        <div class="visible-xs" style="margin-bottom:20px;"></div>
                    </div>
                </div>

            </div>


        </div>

    </div>
	<?php
		}
	}
	?>
</div><!-- contentpanel -->