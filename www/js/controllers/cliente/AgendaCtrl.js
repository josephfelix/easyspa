angular.module('easyspa.controllers')
.controller('AgendaCtrl',function( $scope, $rootScope
	, $ionicScrollDelegate
	, $ionicSlideBoxDelegate )
	{

		$scope.currSlide = 0
		$scope.proximosAgendamentos = function () {
      $ionicScrollDelegate.scrollTop(false);
      $ionicScrollDelegate.resize();
      $ionicSlideBoxDelegate.previous();
			$scope.currSlide = 0
    }
    $scope.antigosAgendamentos = function () {
      $ionicScrollDelegate.scrollTop(false);
      $ionicScrollDelegate.resize();
      $ionicSlideBoxDelegate.next();
			$scope.currSlide = 1
    }
		$scope.disableSwipe = function() {
			 $ionicSlideBoxDelegate.enableSlide(false);
		};
	}
);
