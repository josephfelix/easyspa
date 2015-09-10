angular.module('easyspa.controllers', []);
angular.module('easyspa', [
			'ionic', 
			'easyspa.directives', 
			'easyspa.controllers',
			'ngCordova'
		])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if (window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

  .state('login', {
    url: '/login',
    templateUrl: 'templates/login.html',
	controller: 'LoginCtrl'
  })
  
  .state('logincomercial', {
    url: '/logincomercial',
    templateUrl: 'templates/logincomercial.html',
	controller: 'LoginComercialCtrl'
  })
  
  .state('cadastro', {
    url: '/cadastro',
    templateUrl: 'templates/cadastro.html',
	controller: 'CadastroCtrl'
  })
  
  .state('cadastrocomercial', {
    url: '/cadastrocomercial',
    templateUrl: 'templates/cadastrocomercial.html',
	controller: 'CadastroComercialCtrl'
  })
  
  .state('app', {
    url: '/app',
    abstract: true,
    templateUrl: 'templates/menu.html',
    controller: 'AppCtrl'
  })
  
  .state('app.home', {
    url: "/home",
    views: {
      'menuContent': {
        templateUrl: "templates/home.html",
		controller: 'HomeCtrl'
      }
    }
  })
  
  .state('app.todascategorias', {
    url: "/todascategorias",
    views: {
      'menuContent': {
        templateUrl: "templates/todas_categorias.html",
		controller: 'CategoriasCtrl'
      }
    }
  })
  
  .state('app.configuracoes', {
    url: "/configuracoes",
    views: {
      'menuContent': {
        templateUrl: "templates/configuracoes.html",
		controller: 'ConfiguracoesCtrl'
      }
    }
  })
  
  .state('app.agenda', {
    url: "/agenda",
    views: {
      'menuContent': {
        templateUrl: "templates/agenda.html",
		controller: 'AgendaCtrl'
      }
    }
  })
  
  .state('app.easyclub', {
    url: "/easyclub",
    views: {
      'menuContent': {
        templateUrl: "templates/easyclub.html",
		controller: 'EasyClubCtrl'
      }
    }
  })
  
  .state('app.easybeauty', {
    url: "/easybeauty",
    views: {
      'menuContent': {
        templateUrl: "templates/easybeauty.html",
		controller: 'EasyBeautyCtrl'
      }
    }
  })
  
  .state('app.conversas', {
    url: "/conversas",
    views: {
      'menuContent': {
        templateUrl: "templates/conversas.html",
		controller: 'ConversasCtrl'
      }
    }
  })
  
  .state('app.mapa', {
    url: "/mapa",
    views: {
      'menuContent': {
        templateUrl: "templates/mapa.html",
		controller: 'MapaCtrl'
      }
    }
  })
  
  .state('app.lista', {
    url: "/lista",
    views: {
      'menuContent': {
        templateUrl: "templates/lista.html",
		controller: 'ListaCtrl'
      }
    }
  })
  
  .state('app.perfil', {
    url: "/perfil/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/perfil.html",
		controller: 'PerfilCtrl'
      }
    }
  })
  
  .state('app.chat', {
    url: "/chat/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/chat.html",
		controller: 'ChatCtrl'
      }
    },
	params: {
		funcionaria: null
	}
  })
  
  .state('app.rota', {
    url: "/rota/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/rota.html",
		controller: 'RotaCtrl'
      }
    },
	params: {
		funcionaria: null
	}
  })
  
  .state('app.perto', {
    url: "/perto",
    views: {
      'menuContent': {
        templateUrl: "templates/perto.html",
		controller: 'PertoCtrl'
      }
    }
  })
  
  .state('app.portipo', {
    url: "/portipo",
    views: {
      'menuContent': {
        templateUrl: "templates/portipo.html",
		controller: 'PortipoCtrl'
      }
    }
  })
  
  .state('app.sugestoes', {
    url: "/sugestoes",
    views: {
      'menuContent': {
        templateUrl: "templates/sugestoes.html",
		controller: 'SugestoesCtrl'
      }
    }
  })
  
  
  .state('app.atendimentos', {
    url: "/atendimentos",
    views: {
      'menuContent': {
        templateUrl: "templates/atendimentos.html",
		controller: 'AtendimentosCtrl'
      }
    }
  })
  
  
	if ( !localStorage.hasOwnProperty('login_easyspa') )
	{
		$urlRouterProvider.otherwise('/login');
	} else
		$urlRouterProvider.otherwise('/app/home');
});
