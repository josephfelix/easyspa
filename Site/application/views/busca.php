<script type="text/javascript">
function initialize() {
    var mapCanvas = document.getElementById('map');
	var latitude = getCookie('lat');
	var longitude = getCookie('lng');
	var cidade = getCookie('cidade');
    var mapOptions = 
	{
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
		center: new google.maps.LatLng(latitude, longitude)
    };
	var map = new google.maps.Map(mapCanvas, mapOptions);
	
	
	if ( cidade == '<?=$busca->cidade?>' )
	{
		var infowindow = new google.maps.InfoWindow({
			content: '<div>Voc&ecirc; est&aacute; aqui</div>'
		});
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(latitude, longitude),
			map: map,
			title: 'Você está aqui',
			icon: '<?=base_url()?>assets/img/map-eu.png'
		});
		infowindow.open(map,marker);
		google.maps.event.addListener(marker, 'click', function()
		{
			infowindow.open(map,marker);
		});
	}
	
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({address: '<?=$busca->cidade?>, <?=$busca->estado?>'},
	function(result, status)
	{
		if ( status == google.maps.GeocoderStatus.OK )
		{
			map.setCenter(result[0].geometry.location);
		}
	});
	
	<?php
		foreach ( $anuncios as $anuncio )
		{
	?>
		var infowindow = new google.maps.InfoWindow({
			content: '<div><?=$anuncio->titulo?></div>'
		});

		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?=$anuncio->latitude?>, <?=$anuncio->longitude?>),
			map: map,
			title: '<?=$anuncio->titulo?>',
			icon: '<?=base_url()?>assets/img/map-easyspa.png'
		});
		infowindow.open(map,marker);
		google.maps.event.addListener(marker, 'click', function()
		{
			infowindow.open(map,marker);
		});
	<?php
		}
	?>
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style type="text/css">
#map {
	height: 600px;
	width: 100%;
}
.busca-mapa {
	position: relative;
    top: -128px;
}
</style>
<div id="map">
</div> 
<div class="busca-mapa">
	<div class="container">
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
											<option value="1" <?=$busca->categoria==1?'selected="selected"':''?>>P&eacute;s e M&atilde;os</option>
											<option value="2" <?=$busca->categoria==2?'selected="selected"':''?>>Massagem</option>
											<option value="3" <?=$busca->categoria==3?'selected="selected"':''?>>Cabelereiro</option>
											<option value="4" <?=$busca->categoria==4?'selected="selected"':''?>>Maquiagem</option>
											<option value="5" <?=$busca->categoria==5?'selected="selected"':''?>>Depilação</option>
											<option value="6" <?=$busca->categoria==6?'selected="selected"':''?>>Design de Sobrancelha</option>
											<option value="7" <?=$busca->categoria==7?'selected="selected"':''?>>Cílios</option>
											<option value="8" <?=$busca->categoria==8?'selected="selected"':''?>>Estética facial</option>
											<option value="9" <?=$busca->categoria==9?'selected="selected"':''?>>Estética corporal</option>
											<option value="10" <?=$busca->categoria==10?'selected="selected"':''?>>Práticas integrativas</option>
											<option value="11" <?=$busca->categoria==11?'selected="selected"':''?>>Piercing / Tatuagem</option>
											<option value="12" <?=$busca->categoria==12?'selected="selected"':''?>>Personal Trainer</option>
											<option value="13" <?=$busca->categoria==13?'selected="selected"':''?>>Fisioterapia / Pilates / RPG</option>
											<option value="14" <?=$busca->categoria==14?'selected="selected"':''?>>Nutrição</option>
											<option value="15" <?=$busca->categoria==15?'selected="selected"':''?>>Odontologia</option>
											<option value="16" <?=$busca->categoria==16?'selected="selected"':''?>>Salão</option>
											<option value="17" <?=$busca->categoria==17?'selected="selected"':''?>>Academia</option>
											<option value="18" <?=$busca->categoria==18?'selected="selected"':''?>>Spa</option>
											<option value="19" <?=$busca->categoria==19?'selected="selected"':''?>>Clínica de Estética</option>
											<option value="20" <?=$busca->categoria==20?'selected="selected"':''?>>Hidroterapia/Hidroginástica/Natação</option>
											<option value="21" <?=$busca->categoria==21?'selected="selected"':''?>>Acupuntura / Auriculoterapia</option>
											<option value="22" <?=$busca->categoria==22?'selected="selected"':''?>>Yoga / Reike</option>
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
											<option value="<?=$estado->id?>" <?=$busca->estado==$estado->estado?'selected="selected"':''?>><?=$estado->estado?></option>
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
											<option value="<?=$cidade->cidade?>" <?=$cidade->cidade==$busca->cidade?'selected="selected"':''?>><?=$cidade->cidade?></option>
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

<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="sidebar-box">
				<h3>CATEGORIAS</h3>	
				
				<a href="<?=base_url()?>buscar/<?=$token?>/1">Pés e Mãos</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/2">Massagem</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/3">Cabelereiro</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/4">Maquiagem</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/5">Depilação</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/6">Design de Sobrancelha</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/7">Cílios</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/8">Estética facial</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/9">Estética corporal</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/10">Práticas integrativas</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/11">Piercing / Tatuagem</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/12">Personal Trainer</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/13">Fisioterapia / Pilates / RPG</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/14">Nutrição</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/15">Odontologia</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/16">Salão</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/17">Academia</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/18">Spa</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/19">Clínica de Estética</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/20">Hidroterapia, Hidroginástica<br />e Natação</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/21">Acupuntura / Auriculoterapia</a>
				<hr />
				<a href="<?=base_url()?>buscar/<?=$token?>/22">Yoga / Reike</a>
			</div>
			<div class="sidebar-box">
				<h3>TIPO DE PRESTADOR</h3>
				<input type="checkbox" />&nbsp;Somente empresa<br />
				<input type="checkbox" />&nbsp;Somente pessoa f&iacute;sica
			</div>
			<div class="sidebar-box">
				<h3>DISPONIBILIDADE</h3>
				<input type="checkbox" />&nbsp;Livre para atendimento<br />
				<input type="checkbox" />&nbsp;Agendamento
			</div>
		</div>
		<div class="col-lg-9">
			<?php
				if ( !empty( $anuncios ) )
				{
			?>
			<h3 style="margin-top:0">AN&Uacute;NCIOS ENCONTRADOS</h3>
			<br />				
			<?php
					foreach ( $anuncios as $anuncio )
					{
			?>
			<div class="item-busca">
				<a href="<?=base_url()?>perfil/<?=$anuncio->idanuncio?>">
					<div class="row">
						<div class="col-lg-4">
							<img src="http://placehold.it/230x150" width="100%" height="100%" />
						</div>
						<div class="col-lg-4">
							<h2><?=$anuncio->titulo?></h2>
							<h3><?=$anuncio->bairro?>, <?=$anuncio->cidade?> - <?=$anuncio->estado?></h3>
							<br />
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
					Desculpe! Infelizmente o easySpa não está disponível neste região.<br />
					Para mais informações, por favor entre em contato conosco.
				</div>
			<?php
				}
			?>
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
});
</script>
