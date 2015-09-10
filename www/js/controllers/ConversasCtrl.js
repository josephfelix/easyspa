angular.module('easyspa.controllers')
.controller('ConversasCtrl',
function( $scope, $rootScope, $http, $location, $ionicLoading, $state )
{
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}
	
	$scope.conversas = [];
	$scope.verConversa = function( conversa )
	{
		$state.go('app.chat', {id: conversa.funcionaria.id, funcionaria: conversa.funcionaria});
	}
	
	$ionicLoading.show({
		content: 'Carregando...'
	});
	
	$http.post( URL_EASYSPA + 'mensagens/?cache=' + Math.random(), {iduser: $rootScope.usuario.id} )
	.then(function( result )
	{
		$ionicLoading.hide();
		var json = result.data;
		for ( var ind in json )
		{
			json[ind].funcionaria.avatar = URL_ASSETS_EASYSPA + 'upload/' + json[ind].funcionaria.avatar;
			json[ind].funcionaria.categoria = categories[ json[ind].funcionaria.categoria ];
			$scope.conversas.push( json[ind] );
		}
	});
});