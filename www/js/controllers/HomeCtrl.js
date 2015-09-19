angular.module('easyspa.controllers')
.controller('HomeCtrl', function($scope, $rootScope, $ionicModal, $timeout, $location, $http, $cordovaInAppBrowser, $ionicPlatform)
{
	$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
		if ( toState.name == 'app.home' )
		{
			$ionicPlatform.offHardwareBackButton(function(){});
			/* $ionicPlatform.registerBackButtonAction(function(event)
			{
				event.preventDefault();
			}, 100); */
		} else
		{
			$ionicPlatform.onHardwareBackButton(function(){});
		}
	});

	if ( !localStorage.hasOwnProperty('login_easyspa') )
	{
		$location.path("/login");
		return;
	}

	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;

	$scope.banners = {"LAND":{"link":"","banner":"#"},"TOP":{"link":"","banner":"#"},"HALF1":{"link":"","banner":"#"},"HALF2":{"link":"","banner":"#"},"HALF3":{"link":"","banner":"#"},"HALF4":{"link":"","banner":"#"},"BOTTOM1":{"link":"","banner":"#"},"BOTTOM2":{"link":"","banner":"#"}};

	$scope.verLink = function( link )
	{
		if ( link.length )
		{
			if ( (/http:\/\//i).test( link ) )
				$cordovaInAppBrowser.open( link, '_blank');
			else
				$location.path( link );
		}
	}

	$scope.usuarioComercial = $rootScope.usuario.tipo ? true : false;
	$scope.verMapa = function( categoria )
	{
		$rootScope.categoria = categoria;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}

	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}

	$http.get( URL_EASYSPA + 'banner/?cidade=' + encodeURIComponent($rootScope.usuario.cidade) + '&estado=' + encodeURIComponent($rootScope.usuario.estado) + '&cache=' + Math.random())
	.then(function(result)
	{
		var json = result.data;
		for ( var ind in json )
		{
			if ( json[ind].banner )
			{
				$scope.banners[ind].link = json[ind].link;
				$scope.banners[ind].banner = URL_ASSETS_EASYSPA + 'upload/' + json[ind].banner;
			}
		}
	});
});
