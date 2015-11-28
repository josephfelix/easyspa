<div class="sessao-conteudo">
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				<ul class="nav nav-tabs nav-stacked">
					<li>
						<a href="<?=base_url()?>usuario/conta">
							<i class="fa fa-home"></i>&nbsp;Dashboard
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>usuario/perto">
							<i class="fa fa-map-marker"></i>&nbsp;Perto de mim
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>usuario/cupons">
							<i class="fa fa-dollar"></i>&nbsp;Promo&ccedil;&otilde;es ao redor
						</a>
					</li>
					<li class="active">
						<a href="<?=base_url()?>usuario/favoritos">
							<i class="fa fa-star"></i>&nbsp;Meus favoritos
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>usuario/historico">
							<i class="fa fa-comment"></i>&nbsp;Chat conversas
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>usuario/configuracoes">
							<i class="fa fa-cog"></i>&nbsp;Configura&ccedil;&otilde;es
						</a>
					</li>
					<li>
						<a href="<?=base_url()?>login/sair" onclick="return confirm('Tem certeza que deseja sair?')">
							<i class="fa fa-sign-out"></i>&nbsp;Sair
						</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-10">
				<div class="tab-content">
					<div class="tab-pane active">
						<?php
							if ( is_array( $anuncios ) )
							{
								foreach ( $anuncios as $anuncio )
								{
						?>
							<div class="item-busca">
								<a href="<?=base_url()?>perfil/<?=$anuncio->id?>">
									<div class="row">
										<div class="col-lg-2">
											<img src="http://placehold.it/150x150" />
										</div>
										<div class="col-lg-6">
											<h2><?=$anuncio->titulo?></h2>
											<h3><?=$anuncio->endereco?></h3>
											<br>
											<i class="fa fa-map-marker"></i>&nbsp;5km
										</div>
										<div class="col-lg-4">
										</div>
									</div>
								</a>
							</div>
						<?php
								}
							} else
							{
						?>
							<div class="alert alert-info">
								Nenhum anuncio foi encontrado nos seus favoritos.
							</div>
						<?php
							}
						?>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
</div>