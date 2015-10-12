(function (angular) {

  angular.module('easyspa.controllers')
  .controller('PagamentoCtrl',function( $scope, $rootScope, $location, $ionicPopup, $ionicLoading, $http){
    $scope.tituloTela = "Pagamento"
    $scope.openBasic = false;
    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
  		if ( toState.name == 'pagamentoplanos' ){
  			$ionicPlatform.offHardwareBackButton(function(){});
  			$ionicPlatform.registerBackButtonAction(function(event){ event.preventDefault(); }, 100);
  		} else{
  			$ionicPlatform.onHardwareBackButton(function(){});
  		}
  	});
    $scope.openCollapse = function (plan) {
      if ( plan == 'basic'){
        $scope.openBasic = !$scope.openBasic;
      }
    }
  });

})(angular);
