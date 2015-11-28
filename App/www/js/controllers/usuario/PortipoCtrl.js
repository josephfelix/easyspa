angular.module('easyspa.controllers')
.controller('PortipoUsuarioCtrl', 
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
	if ( !localStorage.hasOwnProperty('login_easyspa_usuario') )
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
});