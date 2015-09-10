angular.module('easyspa.controllers')
.controller('PerfilCtrl', 
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
	if ( !localStorage.hasOwnProperty('login_easyspa') )
	{
		$location.path("/login");
		return;
	}
	
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;	
	$ionicLoading.show({
		content: 'Carregando...'
	});
	
	$scope.iniciarChat = function( funcionaria )
	{
		$state.go('app.chat', {id: funcionaria.id, funcionaria: funcionaria});
	}
	
	$scope.iniciarRota = function( funcionaria )
	{
		$state.go('app.rota', {id: funcionaria.id, funcionaria: funcionaria});
	}
	
	$http.post( URL_EASYSPA + 'perfil', { id: $stateParams.id } )
	.then(function(result)
	{
		var json = result.data;
		$ionicLoading.hide();
		if ( json.status == 'OK' )
		{
			var funcionaria = json.funcionaria;
			$scope.funcionaria = funcionaria;
			$scope.nome = funcionaria.nome;
			$scope.categoria = categories[ funcionaria.categoria ];
			$scope.apresentacao = funcionaria.apresentacao;
			$scope.atendimento = funcionaria.atendimento;
			$scope.latitude = funcionaria.latitude;
			$scope.longitude = funcionaria.longitude;
			$scope.bairro = funcionaria.bairro;
			$scope.cidade = funcionaria.cidade;
			
			$scope.distance = MathEasySpa.calculateDistance(
				{
					latitude: funcionaria.latitude,
					longitude: funcionaria.longitude
				},
				{
					latitude: $rootScope.usuario.latitude,
					longitude: $rootScope.usuario.longitude
				}
			);

			if ( $scope.distance >= 1000 )
				$scope.distance = String(($scope.distance/1000).toFixed(2)).replace(/\./, ',') + 'km';
			else
				$scope.distance = String($scope.distance.toFixed(2)).replace(/\./, ',') + 'm';
		}
	});
});