angular.module('easyspa.controllers')
.controller('AppCtrl', function($scope, $rootScope, $location, $cordovaGeolocation)
{
	if ( localStorage.hasOwnProperty("login_easyspa") === true )
	{
		$rootScope.usuario = JSON.parse( localStorage.usuario_easyspa );
		$scope.usuario = JSON.parse( localStorage.usuario_easyspa );
	
		$cordovaGeolocation.getCurrentPosition({enableHightAccuracy: false})
		.then(function(pos)
		{
			$rootScope.usuario.latitude = pos.coords.latitude;
			$rootScope.usuario.longitude = pos.coords.longitude;
			var myLatlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'latLng': myLatlng}, function(results, status)
			{
				if ( status == google.maps.GeocoderStatus.OK )
				{
					if ( results.length )
					{
						var endereco = results[0].address_components;
						$rootScope.usuario.endereco = {
							numero: endereco[0].long_name,
							rua: endereco[1].long_name,
							bairro: endereco[2].long_name,
							cidade: endereco[3].long_name,
							estado: endereco[4].long_name,
							pais: endereco[5].long_name
						};
					}
				}
			});
		});
	}
	
	$rootScope.offline = false;
	document.addEventListener("offline", function()
	{
		$rootScope.offline = true;
		$rootScope.$apply();
	}, false);
});