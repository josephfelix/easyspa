(function (angular) {

  angular.module('easyspa.controllers')
  .controller('PagamentoCtrl',function(
    $scope, $rootScope, $location, $ionicPopup, $ionicLoading, $http, $filter, $ionicPlatform
    , $ionicScrollDelegate
    , $ionicSlideBoxDelegate
  ){
    var catPlanos = [
      {id: 1, nome: 'Pés e Mãos', plano : 1},
  		{id: 2, nome: 'Massagem', plano : 2},
  		{id: 3, nome: 'Cabelereiro',plano : 2},
  		{id: 4, nome: 'Maquiagem', plano: 2},
  		{id: 5, nome: 'Depilação', plano : 1},
  		{id: 6, nome: 'Design de Sobrancelha', plano: 1},
  		{id: 7, nome: 'Cílios', plano : 1},
  		{id: 8, nome: 'Estética facial', plano : 2},
  		{id: 9, nome: 'Estética corporal', plano: 2},
  		{id: 10, nome: 'Práticas integrativas', plano : 2},
  		{id: 11, nome: 'Piercing / Tatuagem',plano: 2},
  		{id: 12, nome: 'Personal Trainer',plano: 2},
  		{id: 13, nome: 'Fisioterapia / Pilates / RPG',plano: 2},
  		{id: 14, nome: 'Nutrição',plano: 2},
  		{id: 15, nome: 'Odontologia',plano: 2},
  		{id: 16, nome: 'Salão',plano: 2},
  		{id: 17, nome: 'Academia',plano: 2},
  		{id: 18, nome: 'Spa',plano: 2},
  		{id: 19, nome: 'Clínica de Estética',plano: 2},
  		{id: 20, nome: 'Hidroterapia/Hidroginástica/Natação',plano: 2},
  		{id: 21, nome: 'Acupuntura / Auriculoterapia',plano: 2},
  		{id: 22, nome: 'Yoga / Reike',plano: 2}
    ]

    // var catsSelecionadas = $rootScope.usuario.categorias;
    // var planoSelecionado;
    // for (var i = 0; i < catPlanos.length; i++) {
    //   if(catsSelecionadas[0] == catPlanos[i].id){
    //     planoSelecionado  = catPlanos[i].plano;
    //   }
    // }



    $scope.tituloTela = "Pagamento"
    $scope.openBasic = false;
    $scope.openPremium = false;
    $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
  		if ( toState.name == 'pagamentoplanos' || toState.name == 'pagamentocartoes' ){
  			$ionicPlatform.offHardwareBackButton(function(){});
  			$ionicPlatform.registerBackButtonAction(function(event){ event.preventDefault(); }, 100);
  		} else{
  			$ionicPlatform.onHardwareBackButton(function(){});
  		}
  	});
    $scope.openCollapse = function (plan) {
      if ( plan == 'basic'){ $scope.openBasic = !$scope.openBasic; }
      if ( plan == 'premium'){ $scope.openPremium = !$scope.openPremium; }
    }




    catsSelecionadas = [1,2,3]
    planoSelecionado = 1;
    var valorBase = planoSelecionado == 1 ? 19.90 : 29.90
    var valorSegundaCat = planoSelecionado == 1 ? 19.90 : 9.90
    var valorExtras  = 4.90
    var valorPlano;
    switch (catsSelecionadas.length) {
      case 1:
        valorPlano = valorBase;
        break;
      case 2:
        valorPlano = valorBase+valorSegundaCat;
      break;
      default:
        var qtdCat = catsSelecionadas.length - 2
        valorPlano = valorBase + valorSegundaCat + (qtdCat*valorExtras);
      break;

    }

    $scope.planoMensal = $filter('currency')(valorPlano, "R$", 2)
    var trimestral = (valorPlano*3) - ((valorPlano*3)*0.1);
    $scope.planoTrimestral = $filter('currency')(trimestral, "R$", 2)
    var semestral =  (valorPlano*6) - ((valorPlano*6)*0.2)
    $scope.planoSemestral = $filter('currency')(semestral, "R$", 2)
    var anual = (valorPlano*12) - ((valorPlano*12)*0.3)
    $scope.planoAnual = $filter('currency')(anual, "R$", 2)


    $scope.selecionarPagamento = function (valor) {
      $location.path('pagamento/cartoes');
    }

    $scope.anterior = function()
    {
        $ionicScrollDelegate.scrollTop(false);
        $ionicScrollDelegate.resize();
        $ionicSlideBoxDelegate.previous();
        $scope.data.currSlide = $scope.data.currSlide - 1;

    }

    $scope.proximo = function()
    {
      $ionicScrollDelegate.scrollTop(false);
      $ionicScrollDelegate.resize();
      $ionicSlideBoxDelegate.next();
      if(false){ // não está na parte de cadastro
        // $scope.data.currSlide = $scope.data.currSlide == 1 ? $scope.data.currSlide + 2;
      }else{
        // $scope.data.currSlide = $scope.data.currSlide + 1;
      }


    }
    $scope.disableSwipe = function() {
       $ionicSlideBoxDelegate.enableSlide(false);
    };
  });

})(angular);
