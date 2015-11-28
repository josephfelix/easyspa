angular.module('easyspa.controllers')
.controller('ListaUsuarioCtrl', 
	function(
		$scope, 
		$rootScope, 
		$location, 
		$ionicLoading, 
		$http,
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
	$scope.funcionarias = [];
	
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
	
	$scope.verPorTipo = function()
	{
		$location.path('/usuario/portipo');
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