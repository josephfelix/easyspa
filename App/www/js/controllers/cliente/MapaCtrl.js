angular.module('easyspa.controllers')
.controller('MapaClienteCtrl', 
	function(
		$scope, 
		$rootScope, 
		$location, 
		$cordovaGeolocation, 
		$ionicLoading, 
		$compile,
		$http,
		$ionicPopup,
		$state
	)
{
	if ( !localStorage.hasOwnProperty('login_easyspa_cliente') )
	{
		$location.path("/login");
		return;
	}
	
	if ( !$rootScope.categoria )
		$rootScope.categoria = 0;
	
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;

	$scope.verPerfil = function( id )
	{
		$state.go('app.cliente.perfil', {id: id});
	}
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$location.path('/cliente/mapa');
	}
	
	$scope.verSugestoes = function()
	{
		$location.path('/cliente/sugestoes');
	}
	
	$scope.verMapa = function()
	{
		$location.path('/cliente/mapa');
	}
	
	$scope.verPerto = function()
	{
		$location.path('/cliente/perto');
	}
	
	$scope.verPorTipo = function()
	{
		$location.path('/cliente/portipo');
	}
	
	$scope.verLista = function()
	{
		$location.path('/cliente/lista');
	}
	
	$scope.init = function()
	{
		var myLatlng = new google.maps.LatLng($rootScope.usuario.latitude, $rootScope.usuario.longitude);
		var geocoder = new google.maps.Geocoder();
		
		var contentString = "<div>Voc&ecirc; est&aacute; aqui</div>";
		var compiled = $compile(contentString)($scope);

		var infowindow = new google.maps.InfoWindow({
			content: compiled[0]
		});
		
		var mapOptions = {
			center: myLatlng,
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("maps-todas"), mapOptions);
		
		$scope.map = map;
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Você está aqui',
			icon: 'img/map-eu.png'
		});
		infowindow.open(map,marker);
		google.maps.event.addListener(marker, 'click', function()
		{
			infowindow.open(map,marker);
		});
	}
	
	$rootScope.$watch('categoria', function()
	{
		$ionicLoading.show({
			content: 'Carregando...'
		});
		
		var params = {
			//bairro: $rootScope.usuario.endereco.bairro,
			cidade: $rootScope.usuario.cidade
		};
		
		if ( $rootScope.categoria != 0 )
			params.categoria = $rootScope.categoria;

		if ( $rootScope.markers )
		{
			for ( var ind in $rootScope.markers )
			{
				$rootScope.markers[ind].setMap(null);
			}
		}
		
		$rootScope.markers = [];
		
		$http.post( URL_EASYSPA + 'servicos/?cache=' + Math.random(), params )
		.then(function( result )
		{
			$ionicLoading.hide();
			var json = result.data;
			map = $scope.map;
			if ( json.status == 'OK' )
			{
				var funcionarias = json.funcionarias;
				for ( var ind in funcionarias )
				{
					latlng = new google.maps.LatLng(funcionarias[ind].latitude, funcionarias[ind].longitude);
					markerFuncionaria = new google.maps.Marker({
						position: latlng,
						map: map,
						title: funcionarias[ind].nome,
						icon: 'img/map-easyspa.png'
					});
					$rootScope.markers.push( markerFuncionaria );
					contentStringFuncionaria = "<div class='pointer' ng-click='verPerfil(\""+funcionarias[ind].id+"\")'><a href='#' class='nome-funcionaria'>"+funcionarias[ind].nome+"</a><span class='categoria-funcionaria'>"+categories[funcionarias[ind].categoria]+"</span></div>";
					htmlFuncionaria = $compile(contentStringFuncionaria)($scope);

					infowindowFuncionaria = new google.maps.InfoWindow({
						content: htmlFuncionaria[0]
					});
					infowindowFuncionaria.open(map, markerFuncionaria);
					google.maps.event.addListener(markerFuncionaria, 'click', function( location )
					{
						map.setCenter(location.latLng);
						/* alert(JSON.stringify(location));
						alert(JSON.stringify(latlng));*/
						new google.maps.InfoWindow({
							content: htmlFuncionaria[0]
						}).open(map, markerFuncionaria);
					});
				}
				map.setCenter(new google.maps.LatLng($rootScope.usuario.latitude, $rootScope.usuario.longitude));
			}
		});
	});
});