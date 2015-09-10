angular.module('easyspa.controllers')
.controller('MenuCtrl', function($scope, $rootScope, $location)
{
	$scope.nome = $rootScope.usuario.nome + ' ' + $rootScope.usuario.sobrenome;
	$scope.fotoPerfil = $rootScope.usuario.foto;
	
	$scope.sairApp = function()
	{
		if ( confirm("Tem certeza que deseja sair?") )
		{
			$rootScope.usuario = {};
			$rootScope.$apply();
			localStorage.clear();
			$location.path('/login');
		}
	}
});