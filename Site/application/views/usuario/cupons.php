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
					<li class="active">
						<a href="<?=base_url()?>usuario/cupons">
							<i class="fa fa-dollar"></i>&nbsp;Promo&ccedil;&otilde;es ao redor
						</a>
					</li>
					<li>
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
						<div class="row">
							<?php
								if ( is_array($cupons) )
								{
									foreach ( $cupons as $cupom )
									{
							?>
								<div class="col-lg-4">
									<strong><?=$cupom->titulo?></strong><br />
									Desconto: <strong><?=$cupom->desconto?></strong><br />
									C&oacute;digo: <strong><?=$cupom->codigo?></strong><br />
									Endere&ccedil;o: <strong><?=$cupom->endereco?></strong>
								</div>
							<?php
									}
								} else
								{
							?>
								<div class="alert alert-info">
									Nenhum cupom foi encontrado em sua cidade.
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
</div>