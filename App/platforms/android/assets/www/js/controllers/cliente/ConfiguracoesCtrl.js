angular.module('easyspa.controllers')
.controller('ConfiguracoesClienteCtrl',
function( $scope, $rootScope, $http, $location, $cordovaInAppBrowser, $window, $ionicLoading, $ionicPopup )
{
	if ( !localStorage.hasOwnProperty('login_easyspa_cliente') )
	{
		$location.path("/login");
		return;
	}
	
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/cliente/mapa');
	}
	
	$scope.shownGroup = null;
	$scope.group1 = 1;
	$scope.group3 = 3;
	$scope.group4 = {texto: '', email: $rootScope.usuario.email};
	$scope.group5 = {texto: '', email: $rootScope.usuario.email};
	$scope.group6 = 6;
	$scope.latitude = $rootScope.usuario.latitude;
	$scope.longitude = $rootScope.usuario.longitude;
	
	$scope.toggleGroup = function(group)
	{
		if ( $scope.isGroupShown(group) )
		{
			$scope.shownGroup = null;
		} else
		{
			$scope.shownGroup = group;
		}
	}
	
	$scope.isGroupShown = function(group)
	{
		return $scope.shownGroup === group;
	}
	
	$scope.verTermos = function()
	{
		$cordovaInAppBrowser.open( URL_ASSETS_EASYSPA + 'termos', '_blank' );
	}
	
	$scope.enviarForm = function( tipo, group )
	{
		$ionicLoading.show({
			content: 'Enviando...'
		});
		
		$http.post( URL_EASYSPA + 'contato',
		{
			texto: group.texto,
			email: group.email,
			tipo: (tipo == 1 ? 'ANUNCIAR' : 'SUGESTAO')
		})
		.then(function(result)
		{
			$ionicLoading.hide();
			var json = result.data;
			if ( json.status == 'OK' )
			{
				$ionicPopup.alert({
					title: 'Sucesso!',
					template: 'A mensagem foi enviada com sucesso! Aguarde e responderemos para o e-mail informado.'
				});
				$scope.group4.texto = '';
				$scope.group5.texto = '';
				$scope.$apply();
			} else
			{
				$ionicPopup.alert({
					title: 'Erro!',
					template: 'Houve um erro ao enviar a mensagem de contato, por favor tente novamente mais tarde.'
				});
			}
		});
	}
});