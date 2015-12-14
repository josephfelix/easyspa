angular.module('easyspa.controllers')
.controller('MenuClienteCtrl', function($scope, $rootScope, $location)
{
	// $rootScope.usuario = JSON.parse( localStorage.usuario_easyspa );
	// $scope.usuario = JSON.parse( localStorage.usuario_easyspa );
	if ( localStorage.hasOwnProperty('login_easyspa_cliente') )
	{
		$scope.nome = $rootScope.usuario.nome + ' ' + $rootScope.usuario.sobrenome;
		$scope.fotoPerfil = $rootScope.usuario.foto;
		$scope.usuarioComercial = $rootScope.usuario.tipo ? true : false;
	}

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
})
.controller('tabs-dinamic-controller',function ($scope,$rootScope) {
	console.log("teste");
	$scope.chatNotificationsCounter = 10;
	$rootScope.haveMenu = true;
})
;