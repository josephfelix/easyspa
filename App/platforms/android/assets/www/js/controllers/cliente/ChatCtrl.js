angular.module('easyspa.controllers')
.controller('ChatClienteCtrl',
function( $scope, $rootScope, $state, $stateParams, $ionicActionSheet, $ionicPopup, $ionicScrollDelegate, $timeout, $interval )
{
  $scope.tituloTela = "Chat" // Nome do usuário
  $scope.contato = {
    nome : "Maria Antonia"
  , foto : '/img/foto_cadastro.png'
  }

  $scope.messages =  [
    {
      id  : 1
      ,msg : "Lorem ipsum dolor sit amet, consectetur adipisicing elit."
      , userid : 1
    },
    {
      id  : 2
      ,msg : "architecto beatae. A doloremque voluptatum sint, labore beatae eaque temporibus!"
      , userid : 2
    },
    {
      id : 3
      ,msg : "soluta?"
      , userid : 1
    }

  ]


  $scope.showMoreOptions = function () {
    // Show the action sheet
     var hideSheet = $ionicActionSheet.show({
       buttons: [
         { text: 'Enviar Foto' },
         { text: 'Enviar Vídeo' }
       ],
       titleText: '',
       cancelText: 'Cancelar',
       cancel: function() {
            // add cancel code..
       },
       buttonClicked: function(index) {
         console.log(index);
         return true;
       }
     });

     // For example's sake, hide the sheet after two seconds
     $timeout(function() {
       hideSheet();
     }, 5000);
  }

})

// fitlers
.filter('nl2br', ['$filter',
  function($filter) {
    return function(data) {
      if (!data) return data;
      return data.replace(/\n\r?/g, '<br />');
    };
  }
])
