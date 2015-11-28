angular.module('easyspa.controllers')
.controller('AtendimentosClienteCtrl', function($scope, $rootScope, $ionicLoading, $location, $http)
{
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/cliente/mapa');
	}
	
	$scope.votar = function( nota )
	{
		if ( confirm('Você deseja qualificar a prestadora em ' + nota + ' estrelas?' ) )
		{
			alert(nota);
		}
	}
	
	$ionicLoading.show({
		content: 'Carregando...'
	});
	
	$scope.atendidos = [];
	$scope.naoAvaliados = [];
	$http.post( URL_EASYSPA + 'atendimentos/?cache=' + Math.random(), {iduser: $rootScope.usuario.id} )
	.then(function( result )
	{
		$ionicLoading.hide();
		var json = result.data;
		for ( var ind in json.atendimentos )
		{
			json.atendimentos[ind].funcionaria.avatar = URL_ASSETS_EASYSPA + 'upload/' + json.atendimentos[ind].funcionaria.avatar;
			json.atendimentos[ind].funcionaria.categoria = categories[ json.atendimentos[ind].funcionaria.categoria ];
			$scope.atendidos.push( json.atendimentos[ind] );
		}
		
		for ( var ind in json.nao_avaliados )
		{
			json.nao_avaliados[ind].funcionaria.avatar = URL_ASSETS_EASYSPA + 'upload/' + json.nao_avaliados[ind].funcionaria.avatar;
			json.nao_avaliados[ind].funcionaria.categoria = categories[ json.nao_avaliados[ind].funcionaria.categoria ];
			$scope.naoAvaliados.push( json.nao_avaliados[ind] );
		}
		
	});
});