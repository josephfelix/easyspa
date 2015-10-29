angular.module('easyspa.controllers')
.controller('CategoriasUsuarioCtrl', function($scope, $rootScope, $ionicModal, $timeout, $location)
{
	if ( !localStorage.hasOwnProperty('login_easyspa_usuario') )
	{
		$location.path("/login");
		return;
	}
	
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.bairro;
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/usuario/mapa');
	}
	
	$scope.verMapa = function( categoria )
	{
		$rootScope.categoria = categoria;
		$rootScope.$apply();
		$location.path('/usuario/mapa');
	}
});