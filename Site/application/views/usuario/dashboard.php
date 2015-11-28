<div class="sessao-conteudo">
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				<ul class="nav nav-tabs nav-stacked">
					<li class="active">
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
					<div class="tab-pane active itens-conta">
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="1" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon1.png" /><br />
									PÉS E MÃOS
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="3" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon2.png" /><br />
									CABELEIREIRO
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="5" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon3.png" /><br />
									DEPILAÇÃO
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="6" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon4.png" /><br />
								SOMBRANCELHA
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="4" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon5.png" /><br />
								MAQUIAGEM
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="9" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon6.png" /><br />
								ESTÉTICA CORPORAL
								</button>
							</form>
						</div>
						<div class="item-categoria-conta">
							<form method="POST" action="<?=base_url()?>buscar">
								<input type="hidden" name="categoria" value="8" />
								<input type="hidden" name="estado" value="<?=$idestado?>" />
								<input type="hidden" name="cidade" value="<?=$cidade?>" />
								<button class="button item-home" type="submit">
									<img src="<?=base_url()?>assets/img/icons/icon7.png" /><br />
								ESTÉTICA FACIAL
								</button>
							</form>
						</div>
					</div>
				</div>	
			</div>	
		</div>	
	</div>
</div>