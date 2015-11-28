angular.module('easyspa.controllers')
.controller('ListaClienteCtrl', 
	function(
		$scope, 
		$rootScope, 
		$location, 
		$ionicLoading, 
		$http,
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
	$scope.categoria = categories[ $rootScope.categoria ];
	$scope.funcionarias = [];
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
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
	
	$scope.verPerfil = function( funcionaria )
	{
		$state.go('app.cliente.perfil', {id: funcionaria.id});
	}
	
	$ionicLoading.show({
		content: 'Carregando...'
	});
	
	var params = {
		cidade: $rootScope.usuario.cidade,
		order: 'qualificacao'
	};
		
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
				$scope.funcionarias.push(
				{
					id: funcionarias[ind].id,
					categoria: categories[funcionarias[ind].categoria],
					avatar: URL_ASSETS_EASYSPA + 'upload/' + funcionarias[ind].avatar,
					bairro: funcionarias[ind].bairro,
					nome: funcionarias[ind].nome
				});
			}
		}
	});
});