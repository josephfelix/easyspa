angular.module('easyspa.controllers')
.controller('ChatCtrl',
function( $scope, $rootScope, $state, $stateParams, MockService, $ionicActionSheet, $ionicPopup, $ionicScrollDelegate, $timeout, $interval )
{
	var funcionaria = $stateParams.funcionaria;
	$scope.funcionaria = funcionaria;
	
	$scope.verPerfil = function( funcionaria )
	{
		$state.go('app.perfil', {id: funcionaria.id});
	}
	
	$scope.verRota = function( funcionaria )
	{
		$state.go('app.rota', {id: funcionaria.id, funcionaria: funcionaria});
	}
	
	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.cidade;
	
    $scope.toUser = {
		id: funcionaria.id,
		pic: URL_ASSETS_EASYSPA + 'upload/' + funcionaria.avatar,
		username: funcionaria.nome
    }

    $scope.user = {
		id: $rootScope.usuario.id,
		pic: $rootScope.usuario.foto,
		username: $rootScope.usuario.nome
    };

    $scope.input = {
		message: localStorage['userMessage-' + $scope.toUser.id] || ''
    };

    var messageCheckTimer;

    var viewScroll = $ionicScrollDelegate.$getByHandle('userMessageScroll');
    var footerBar; // gets set in $ionicView.enter
    var scroller;
    var txtInput; // ^^^

    $scope.$on('$ionicView.enter', function()
	{
      getMessages();
      
      $timeout(function() {
        footerBar = document.body.querySelector('#userMessagesView .bar-footer');
        scroller = document.body.querySelector('#userMessagesView .scroll-content');
        txtInput = angular.element(footerBar.querySelector('textarea'));
      }, 0);

      messageCheckTimer = $interval(function() {
        MockService.getUserMessages({
			user2: $scope.toUser.id,
			user1: $scope.user.id
		  }).then(function(data) {
			if ( JSON.stringify($scope.messages[$scope.messages.length-1]) != JSON.stringify(data[data.length-1]) )
			{
				$scope.doneLoading = true;
				$scope.messages = data;

				$timeout(function() {
				viewScroll.scrollBottom();
				}, 0);
			}
		  });
      }, 7000);
    });

    $scope.$on('$ionicView.leave', function() {
      // Make sure that the interval is destroyed
      if (angular.isDefined(messageCheckTimer)) {
        $interval.cancel(messageCheckTimer);
        messageCheckTimer = undefined;
      }
    });

    $scope.$on('$ionicView.beforeLeave', function() {
      if (!$scope.input.message || $scope.input.message === '') {
        localStorage.removeItem('userMessage-' + $scope.toUser.id);
      }
    });

    function getMessages() {
      // the service is mock but you would probably pass the toUser's GUID here
      MockService.getUserMessages({
        user2: $scope.toUser.id,
		user1: $scope.user.id
      }).then(function(data) {
        $scope.doneLoading = true;
        $scope.messages = data;

        $timeout(function() {
          viewScroll.scrollBottom();
        }, 0);
      });
    }

    $scope.$watch('input.message', function(newValue, oldValue) {
      if (!newValue) newValue = '';
      localStorage['userMessage-' + $scope.toUser.id] = newValue;
    });

    $scope.sendMessage = function(sendMessageForm)
	{
		var message = {
			from: $scope.user.id,
			to: $scope.toUser.id,
			text: $scope.input.message
		};

      // if you do a web service call this will be needed as well as before the viewScroll calls
      // you can't see the effect of this in the browser it needs to be used on a real device
      // for some reason the one time blur event is not firing in the browser but does on devices
      keepKeyboardOpen();
      
      MockService.sendMessage(message).then(function(data) {
		  $scope.messages.push(data);
		  $scope.input.message = '';
		  $scope.$apply();

		  $timeout(function() {
			keepKeyboardOpen();
			viewScroll.scrollBottom(true);
		  }, 0);

		/*   $timeout(function() {
			$scope.messages.push(MockService.getMockMessage());
			keepKeyboardOpen();
			viewScroll.scrollBottom(true);
		  }, 2000); */

      });
    };
    
    function keepKeyboardOpen() {
		return;
      txtInput.one('blur', function() {
        txtInput[0].focus();
      });
    }

    $scope.viewProfile = function(iduser) {
        $state.go('app.perfil', {id: iduser});
    };
    
    $scope.$on('taResize', function(e, ta) {
      if (!ta) return;
      
      var taHeight = ta[0].offsetHeight;
      
      if (!footerBar) return;
      
      var newFooterHeight = taHeight + 10;
      newFooterHeight = (newFooterHeight > 44) ? newFooterHeight : 44;
      
      footerBar.style.height = newFooterHeight + 'px';
      scroller.style.bottom = newFooterHeight + 'px'; 
    });
})


// services
.factory('MockService', ['$http', '$q', '$rootScope', '$stateParams',
  function($http, $q, $rootScope, $stateParams) {
    var me = {};

	me.sendMessage = function(message)
	{
		var endpoint = URL_EASYSPA + 'postchat';
		return $http.post(endpoint, message).then(function(response) {
			return response.data;
		}, function(err) {
		});
	}
    me.getUserMessages = function(d) {
      var endpoint = URL_EASYSPA + 'getchat';
      return $http.post(endpoint,
	  {
		user2: $stateParams.funcionaria.id,
		user1: $rootScope.usuario.id
	  }).then(function(response) {
		if ( response.data.status == 'OK' )
			return response.data.chat;
		return {};
      }, function(err) {
      });
      /* var deferred = $q.defer();
      
		 setTimeout(function() {
      	deferred.resolve(getMockMessages());
	    }, 1500);
      
      return deferred.promise; */
    };

    return me;
  }
])

// fitlers
.filter('nl2br', ['$filter',
  function($filter) {
    return function(data) {
      if (!data) return data;
      return data.replace(/\n\r?/g, '<br />');
    };
  }
])