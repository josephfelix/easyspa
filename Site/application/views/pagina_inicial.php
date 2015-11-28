<div class="bkimgtop">
	<div class="boxnav">
		<div class="container">
			<span class="breadcumbbox">Ainda não possui nosso aplicativo? Baixe agora:&nbsp; 
				<a href="#" title="Baixe na Apple Store">
					<img src="<?=base_url()?>assets/img/apple-icon.png" width="15" height="19" alt="">
				</a>
				<a href="#" title="Baixe no Google Play">
					<img src="<?=base_url()?>assets/img/android-icon.png" width="16" height="19" alt="" style="padding-left:6px;">
				</a>
			</span>
		</div>
	</div>
	<div class="container">
		<div class="boxtxttop">
			<div class="tithome">Ache as melhores profissionais de beleza.</div>
			<div class="subtithome">Todas sempre bem próximas de você</div>
		</div>
		<form method="POST" action="<?=base_url()?>buscar">
			<div class="boxbusca">
				<div class="boxcamposbusca">
					<div class="inputbox">
						<div class="row">
							<div class="col-lg-4">
								<div class="sessao-pesquisa">
									<label for="select-categoria">
										O que busca
									</label>
									<select class="select-categoria" id="select-categoria" name="categoria">
										<option value="1">P&eacute;s e M&atilde;os</option>
										<option value="2">Massagem</option>
										<option value="3">Cabelereiro</option>
										<option value="4">Maquiagem</option>
										<option value="5">Depilação</option>
										<option value="6">Design de Sobrancelha</option>
										<option value="7">Cílios</option>
										<option value="8">Estética facial</option>
										<option value="9">Estética corporal</option>
										<option value="10">Práticas integrativas</option>
										<option value="11">Piercing / Tatuagem</option>
										<option value="12">Personal Trainer</option>
										<option value="13">Fisioterapia / Pilates / RPG</option>
										<option value="14">Nutrição</option>
										<option value="15">Odontologia</option>
										<option value="16">Salão</option>
										<option value="17">Academia</option>
										<option value="18">Spa</option>
										<option value="19">Clínica de Estética</option>
										<option value="20">Hidroterapia/Hidroginástica/Natação</option>
										<option value="21">Acupuntura / Auriculoterapia</option>
										<option value="22">Yoga / Reike</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="sessao-pesquisa">
									<label for="select-estado">
										Onde
									</label>
									<select id="select-estado" name="estado">
										<?php
											foreach ( $estados as $estado )
											{
										?>
										<option value="<?=$estado->id?>" <?=$estado->id==19?'selected="selected"':''?>><?=$estado->estado?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="sessao-pesquisa">
									<label for="select-cidade">
										Cidade
									</label>
									<select id="select-cidade" name="cidade">
										<?php
											foreach ( $cidades as $cidade )
											{
										?>
										<option value="<?=$cidade->cidade?>" <?=$cidade->cidade=='Rio de Janeiro'?'selected="selected"':''?>><?=$cidade->cidade?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-search-easyspa">
					<i class="fa fa-search"></i>
				</button>
			</div> 
		</form>
	</div> 
</div> 

<div class="sessao-features">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-xs-12">
				<div class="icon-feature"><i class="fa fa-map-marker"></i></div>
				<h2 align="center">
					Busque um profissional...
				</h2>
				<p align="center">O easySpa conta com diversos profissionais nas mais variadas categorias para atender você.</p>
			</div>
			
			<div class="col-lg-4 col-xs-12">
				<div class="icon-feature"><i class="fa fa-location-arrow"></i></div>
				<h2 align="center">
					Aguarde o atendimento
				</h2>
				<p align="center">Você fala em tempo real com o profissional escolhido e agenda o seu atendimento.</p>
			</div>
			
			<div class="col-lg-4 col-xs-12">
				<div class="icon-feature"><i class="fa fa-smile-o"></i></div>
				<h2 align="center">
					Você atendido em tempo real, sem precisar perder tempo.
				</h2>
			</div>
		</div>
	</div>
</div>

<div class="sessao-cupons">
	<div class="container">
		<h2 align="center" class="titulo-cupons">
			easyClub. Um clube de descontos para você
		</h2>
		<h5 align="center" class="subtitulo-cupons">
			Descontos exclusivos em produtos e serviços em todo Brasil. Aproveite!
		</h5>
		<div class="kwicks kwicks-horizontal lista-cupons">
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom1.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom2.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom3.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom4.png" />
			</a>
			
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom1.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom2.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom3.png" />
			</a>
			<a href="#">
				<img src="<?=base_url()?>assets/img/cupons/cupom4.png" />
			</a>
		</div>
	</div> 
</div>


<div class="sessao-blog">
<div class="container">
	<h1 class="titulo-blog titulo-blog-cor1">easy</h1>
	<h1 class="titulo-blog titulo-blog-cor2">Blog</h1>
	<br /><br />
	<div align="center">
	
		<style type='text/css'>
			.postagens-blog {
				height: 445px;
			}
			.postagens-blog > li {
				height: 145px;
				margin-top: 5px;
			}
			.postagem-blog {
				width: 1195px;
				height: 100%;
			}
			.postagem-blog > li {
				height: 100%;
				width: 145px;
				float: left;
				margin-left: 5px;
				background-color: #CACACA;
			}
		</style>
		<ul class="kwicks kwicks-vertical postagens-blog">
			<li>
				<ul class="kwicks kwicks-horizontal postagem-blog">
					<li></li><li></li><li></li>
					<li></li><li></li><li></li>
					<li></li>
					<li></li>
				</ul>
			</li>
			<li>
				<ul class="kwicks kwicks-horizontal postagem-blog">
					<li></li><li></li><li></li>
					<li></li><li></li><li></li>
					<li></li>
					<li></li>
				</ul>
			</li>
			<li>
				<ul class="kwicks kwicks-horizontal postagem-blog">
					<li></li><li></li><li></li>
					<li></li><li></li><li></li>
					<li></li>
					<li></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
</div>

<div class="sessao-estados">
<div class="container">
	<h2>Busque profissionais por estado</h2>
	<h5>Escolha o estado para visualizar os profissionais, cupons de desconto, promoções de produtos e muito mais!</h5>
	<br />
	<div class="row">
		<div class="col-lg-3 col-xs-12">
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Acre
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Ceará
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Mato Grosso
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Paraná
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Rio Grande do Sul
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Sergipe
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;São Paulo
			</a>
		</div>
		<div class="col-lg-3 col-xs-12">
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Alagoas
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Distrito Federal
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Mato Grosso do Sul
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Maranhão
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Pernambuco
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Rondônia
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Tocantins
			</a>
		</div>
		<div class="col-lg-3 col-xs-12">
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Amapá
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Espírito Santo
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Minas Gerais
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Piauí
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Paraíba
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Roraima
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Bahia
			</a>
		</div>
		<div class="col-lg-3 col-xs-12">
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Amazonas
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Goiás
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Pará
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Rio de Janeiro
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Rio Grande do Norte
			</a>
			<a href="#">
				<i class="fa fa-map-marker"></i>&nbsp;Santa Catarina
			</a>
		</div>
	</div>
</div>
</div>

<div class="sessao-cadastro-1">
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<h2>Deixe seus clientes encontrarem você, seus serviços ou produtos com a plataforma <span class="color1-text-easy">easy</span><span class="color2-text-spa">Spa</span></h2>
			<br />
			<p>
				o easySpa é uma plataforma de alta tecnologia que conecta você ao seu cliente em tempo real. Somos pioneiros neste tipo de serviço e por isso temos toda a expertise para divulgar seu serviço ou empresa.
				<br />
				O cadastro não demora nem 5 minutos e logo você estará apto a receber
			</p>
		</div>
		<div class="col-lg-4">
			<img src="<?=base_url()?>assets/img/sessao-cadastro-1.png" />
		</div>
	</div>
</div>
</div>

<div class="sessao-cadastro-2">
<div class="container">
	<a class="btn btn-easy-big" href="<?=base_url()?>cadastro">
		Clique e cadastre-se agora mesmo!
	</a>
</div>
</div>

<script type="text/javascript">
$(document).ready(function()
{
	$('#select-estado').change(function()
	{
		var estado = $(this).find('option:selected').val();
		$.get( BASE_URL + 'app/cidades/?estado=' + estado )
		.success(function(ret)
		{
			var json = JSON.parse( ret );
			$('#select-cidade').find('option').remove();
			for ( var ind in json )
			{
				$('#select-cidade').append('<option value="'+json[ind].cidade+'">'+json[ind].cidade+'</option>');
			}
		});
	});
	
	$('.bkimgtop').backstretch([
	   BASE_URL + "assets/img/cover-home.jpg"
	 , BASE_URL + "assets/img/cover-home2.jpg"
	 , BASE_URL + "assets/img/cover-home3.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB-2.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB3.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB4.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB5.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB6.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB7.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB8.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB9.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB10.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB11.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB12.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB13.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB14.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB15.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB16.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB17.jpg"
	 , BASE_URL + "assets/img/sharefacebook/FB18.jpg"
	 ], {duration: 5000, fade: 750});
	 
	$('.lista-cupons').kwicks({
		maxSize : 290,
		spacing : 5,
		behavior: 'menu'
	});
	
	$('.postagens-blog').kwicks({
		maxSize : 295,
		spacing : 5,
		isVertical: true,
		behavior: 'menu',
		selectOnClick: false
	});

	$('.postagem-blog').kwicks({
		maxSize: 295,
		spacing: 5,
		behavior: 'menu',
		selectOnClick: false
	});
});
</script>
