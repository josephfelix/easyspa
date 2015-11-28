<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
<div class="cover-perfil" style="background-image:url('<?=base_url()?>assets/img/cover-perfil.png')">
</div>
<div class="container">
	<div class="panel panel-default pagina-perfil square-input">
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2">
					<img src="http://placehold.it/150x150" />
				</div>
				<div class="col-lg-7">
					<h1><strong><?=$anuncio->titulo?></strong> <a href="#" alt="Favoritar" class="btn-favoritar"><i class="fa fa-heart-o"></i></a></h1>
					<div class="avaliacao-container">
						<i class="fa fa-star star-positive"></i>
						<i class="fa fa-star star-positive"></i>
						<i class="fa fa-star star-positive"></i>
						<i class="fa fa-star star-negative"></i>
						<i class="fa fa-star star-negative"></i>
					</div>
					<br />
					<i class="fa fa-map-marker"></i>&nbsp;<?=$anuncio->endereco?>, <?=$anuncio->bairro?> - <?=$anuncio->cidade?> - <?=$anuncio->estado?>
				</div>
				<div class="col-lg-3">
					<button class="btn btn-easyspa botao-agendar-perfil" type="button">
						Clique para agendar<br />
						um hor&aacute;rio com<br />
						<?=$anuncio->titulo?>
					</button>
				</div>
			</div>			
			<br /><br />
			<div class="row">
				<div class="col-lg-9">
					<div class="fotorama" data-width="100%" data-height="350" data-nav="thumbs"
					data-thumbheight="48" data-fit="cover" data-arrows="false">
						<img src="http://s.fotorama.io/1.jpg" style="width:100px;height:100px" />
						<img src="http://s.fotorama.io/2.jpg" style="width:100px;height:100px" />
					</div>
				</div>
				<div class="col-lg-3">
					<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?=$anuncio->latitude?>,<?=$anuncio->longitude?>&zoom=17&size=250x250&sensor=false&&markers=color:red%7Clabel:C%7C<?=$anuncio->latitude?>,<?=$anuncio->longitude?>" width="100%" height="250px" />
				</div>
			</div>
		</div>
	</div>
</div>