angular.module('easyspa.controllers')
.controller('RotaClienteCtrl', 
	function(
		$scope, 
		$rootScope, 
		$location, 
		$cordovaGeolocation, 
		$ionicLoading, 
		$compile,
		$http,
		$ionicPopup,
		$state,
		$stateParams
	)
{	
	if ( !localStorage.hasOwnProperty('login_easyspa_cliente') )
	{
		$location.path("/login");
		return;
	}
	
	var funcionaria = $stateParams.funcionaria;
	$scope.funcionaria = funcionaria;
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;
	
	$scope.verPerfil = function( funcionaria )
	{
		$state.go('app.cliente.perfil', {id: funcionaria.id});
	}
	$scope.iniciarChat = function( funcionaria )
	{
		$state.go('app.cliente.chat', {id: funcionaria.id, funcionaria: funcionaria});
	}
	
	var myLatlng = new google.maps.LatLng($rootScope.usuario.latitude, $rootScope.usuario.longitude);
	var mapOptions = {
		center: myLatlng,
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("mapa-rota"), mapOptions);
	directionsService = new google.maps.DirectionsService();
	mapDisplay = new google.maps.DirectionsRenderer();
	mapDisplay.setMap(map);
	mapDisplay.setPanel(document.getElementById("instrucoes-rota"));
	var request = {
		origin: $rootScope.usuario.latitude + "," + $rootScope.usuario.longitude, 
		destination: funcionaria.latitude + "," + funcionaria.longitude,
		travelMode: google.maps.TravelMode.WALKING
	};
	directionsService.route(request, function(response, status)
	{
		if (status == google.maps.DirectionsStatus.OK) {
			mapDisplay.setDirections(response);
		}
	});
	
	$scope.travelMode = 1;
	$scope.alterarRota = function(opc)
	{
		var request = {
			origin: $rootScope.usuario.latitude + "," + $rootScope.usuario.longitude, 
			destination: funcionaria.latitude + "," + funcionaria.longitude,
			travelMode: google.maps.TravelMode.WALKING
		};
		if ( opc == 1 ) //andando
		{
			request.travelMode = google.maps.TravelMode.WALKING;
			$scope.travelMode = 1;
		} else if ( opc == 2 ) //carro
		{
			request.travelMode = google.maps.TravelMode.DRIVING;
			$scope.travelMode = 2;
		} else if ( opc == 3 ) //onibus ou trem
		{
			request.travelMode = google.maps.TravelMode.TRANSIT;
			$scope.travelMode = 3;
		} else if ( opc == 4 ) //bicicleta
		{
			request.travelMode = google.maps.TravelMode.BICYCLING;
			$scope.travelMode = 4;
		}	
		directionsService.route(request, function(response, status)
		{
			if (status == google.maps.DirectionsStatus.OK) {
				mapDisplay.setDirections(response);
			}
		});
	}
});