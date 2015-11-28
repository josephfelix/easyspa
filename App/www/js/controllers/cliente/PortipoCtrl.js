angular.module('easyspa.controllers')
.controller('PortipoClienteCtrl', 
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
	if ( !localStorage.hasOwnProperty('login_easyspa_cliente') )
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
});