angular.module('easyspa.controllers')
.controller('MenuUsuarioCtrl', function($scope, $rootScope, $location)
{
	if ( localStorage.hasOwnProperty('login_easyspa_usuario') )
	{
		$scope.nome = $rootScope.usuario.nome + ' ' + $rootScope.usuario.sobrenome;
		$scope.fotoPerfil = $rootScope.usuario.foto;
	}
	
	$scope.sairApp = function()
	{
		if ( confirm("Tem certeza que deseja sair?") )
		{
			$rootScope.usuario = {};
			$rootScope.$apply();
			localStorage.clear();
			$location.path('/loginusuario');
		}
	}
});