angular.module('easyspa.controllers')
.controller('PortipoCtrl', 
	function(
		$scope, 
		$rootScope, 
		$location, 
		$cordovaGeolocation, 
		$ionicLoading, 
		$compile,
		$http,
		$ionicPopup
	)
{
	if ( !localStorage.hasOwnProperty('login_easyspa') )
	{
		$location.path("/login");
		return;
	}
	
	if ( !$rootScope.categoria )
		$rootScope.categoria = 0;
	
	$scope.tituloTela = 'EasySpa, ' + $rootScope.usuario.cidade;
	$scope.categoria = $rootScope.categoria;
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}
	
	$scope.verSugestoes = function()
	{
		$location.path('/app/sugestoes');
	}
	
	$scope.verMapa = function()
	{
		$location.path('/app/mapa');
	}
	
	$scope.verPerto = function()
	{
		$location.path('/app/perto');
	}
	
	$scope.verPorTipo = function()
	{
		$location.path('/app/portipo');
	}
	
	$scope.verLista = function()
	{
		$location.path('/app/lista');
	}
});