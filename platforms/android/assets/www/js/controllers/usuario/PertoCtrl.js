angular.module('easyspa.controllers')
.controller('PertoUsuarioCtrl', 
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
	if ( !localStorage.hasOwnProperty('login_easyspa_usuario') )
	{
		$location.path("/login");
		return;
	}
	
	if ( !$rootScope.categoria )
		$rootScope.categoria = 0;
	
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;
	$scope.categoria = categories[ $rootScope.categoria ];
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/usuario/mapa');
	}
	
	$scope.verSugestoes = function()
	{
		$location.path('/usuario/sugestoes');
	}
	
	$scope.verMapa = function()
	{
		$location.path('/usuario/mapa');
	}
	
	$scope.verPerto = function()
	{
		$location.path('/usuario/perto');
	}
	
	$scope.verLista = function()
	{
		$location.path('/usuario/lista');
	}
	
	$scope.verPerfil = function( funcionaria )
	{
		$state.go('app.usuario.perfil', {id: funcionaria.id});
	}
	
	$ionicLoading.show({
		content: 'Carregando...'
	});
	
	var params = {
		cidade: $rootScope.usuario.cidade,
		latitude: $rootScope.usuario.latitude,
		longitude: $rootScope.usuario.longitude,
		order: 'proximo'
	};
	
	$scope.funcionarias = [];
		
	if ( $rootScope.categoria != 0 )
		params.categoria = $rootScope.categoria;
	
	$http.post( URL_EASYSPA + 'servicos/?cache=' + Math.random(), params )
	.then(function( result )
	{
		$ionicLoading.hide();
		var json = result.data;
		if ( json.status == 'OK' )
		{
			var funcionarias = json.funcionarias;
			for ( var ind in funcionarias )
			{
				distancia = funcionarias[ind].distancia;
				if ( distancia < 1 )
					distancia = String(Math.ceil(distancia * 1000)).replace(/\./, ',') + 'm';
				else
					distancia = String(distancia.toFixed(2)).replace(/\./, ',') + 'km';
				$scope.funcionarias.push(
				{
					id: funcionarias[ind].id,
					categoria: categories[funcionarias[ind].categoria],
					distancia: distancia,
					avatar: URL_ASSETS_EASYSPA + 'upload/' + funcionarias[ind].avatar,
					bairro: funcionarias[ind].bairro,
					nome: funcionarias[ind].nome
				});
			}
		}
	});
});