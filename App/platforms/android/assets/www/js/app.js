angular.module('easyspa.controllers', []);
angular.module('easyspa', [
			'ionic',
			'easyspa.directives',
			'easyspa.controllers',
			'ngCordova',
			'ngMask'
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
  
  .state('loginusuario', {
    url: '/loginusuario',
	templateUrl: 'templates/usuario/login.html',
	controller: 'LoginUsuarioCtrl'
  })

  .state('logincliente', {
    url: '/logincliente',
    templateUrl: 'templates/cliente/login.html',
	controller: 'LoginClienteCtrl'
  })

  .state('cadastrousuario', {
    url: '/cadastrousuario',
    templateUrl: 'templates/usuario/cadastro.html',
	controller: 'CadastroUsuarioCtrl'
  })

  .state('cadastrocliente', {
    url: '/cadastrocliente',
    templateUrl: 'templates/cliente/cadastro.html',
		controller: 'CadastroClienteCtrl'
  })

	.state('pagamentoplanos', {
    url: '/pagamento/planos',
    templateUrl: 'templates/cliente/pagamento_planos.html',
		controller: 'PagamentoCtrl'
  })

	.state('pagamentocartoes', {
    url: '/pagamento/cartoes',
    templateUrl: 'templates/cliente/pagamento_cartao.html',
		controller: 'PagamentoCtrl'
  })
  
  
  .state('usuario', {
	url: '',
    abstract: true,
    templateUrl: 'templates/usuario/menu.html',
    controller: 'AppCtrl'
  })
  
  .state('cliente', {
	url: '',
    abstract: true,
    templateUrl: 'templates/cliente/menu.html',
    controller: 'AppCtrl'
  })
  
  /**
  * Rotas para o usuário
  */

   .state('usuario.home', {
    url: "/usuario/home",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/home.html",
		controller: 'HomeUsuarioCtrl'
      }
    }
  })

  .state('usuario.todascategorias', {
    url: "/usuario/todascategorias",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/todas_categorias.html",
		controller: 'CategoriasUsuarioCtrl'
      }
    }
  })

  .state('usuario.configuracoes', {
    url: "/usuario/configuracoes",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/configuracoes.html",
		controller: 'ConfiguracoesUsuarioCtrl'
      }
    }
  })

  .state('usuario.agenda', {
    url: "/usuario/agenda",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/agenda.html",
		controller: 'AgendaUsuarioCtrl'
      }
    }
  })

  .state('usuario.easyclub', {
    url: "/usuario/easyclub",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/easyclub.html",
		controller: 'EasyClubUsuarioCtrl'
      }
    }
  })

  .state('usuario.easybeauty', {
    url: "/usuario/easybeauty",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/easybeauty.html",
		controller: 'EasyBeautyUsuarioCtrl'
      }
    }
  })

  .state('usuario.conversas', {
    url: "/usuario/conversas",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/conversas.html",
		controller: 'ConversasUsuarioCtrl'
      }
    }
  })

  .state('usuario.mapa', {
    url: "/usuario/mapa",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/mapa.html",
		controller: 'MapaUsuarioCtrl'
      }
    }
  })

  .state('usuario.lista', {
    url: "/usuario/lista",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/lista.html",
		controller: 'ListaUsuarioCtrl'
      }
    }
  })

  .state('usuario.perfil', {
    url: "/usuario/perfil/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/perfil.html",
		controller: 'PerfilUsuarioCtrl'
      }
    }
  })

  .state('usuario.rota', {
    url: "/usuario/rota/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/rota.html",
		controller: 'RotaUsuarioCtrl'
      }
    },
		params: {
			funcionaria: null
		}
  })

  .state('usuario.perto', {
    url: "/usuario/perto",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/perto.html",
		controller: 'PertoUsuarioCtrl'
      }
    }
  })

  .state('usuario.portipo', {
    url: "/usuario/portipo",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/portipo.html",
		controller: 'PortipoUsuarioCtrl'
      }
    }
  })

  .state('usuario.sugestoes', {
    url: "/usuario/sugestoes",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/sugestoes.html",
		controller: 'SugestoesUsuarioCtrl'
      }
    }
  })

  .state('usuario.atendimentos', {
    url: "/usuario/atendimentos",
    views: {
      'menuContent': {
        templateUrl: "templates/usuario/atendimentos.html",
		controller: 'AtendimentosUsuarioCtrl'
      }
    }
  })
  
  
  
  
  /**
  * Rotas para o cliente (prestador)
  */

   .state('cliente.home', {
    url: "/cliente/home",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/home.html",
		controller: 'HomeClienteCtrl'
      }
    }
  })

  .state('cliente.todascategorias', {
    url: "/cliente/todascategorias",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/todas_categorias.html",
		controller: 'CategoriasClienteCtrl'
      }
    }
  })

  .state('cliente.configuracoes', {
    url: "/cliente/configuracoes",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/configuracoes.html",
		controller: 'ConfiguracoesClienteCtrl'
      }
    }
  })

  .state('cliente.agenda', {
    url: "/cliente/agenda",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/agenda.html",
		controller: 'AgendaClienteCtrl'
      }
    }
  })

  .state('cliente.easyclub', {
    url: "/cliente/easyclub",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/easyclub.html",
		controller: 'EasyClubClienteCtrl'
      }
    }
  })

  .state('cliente.easybeauty', {
    url: "/cliente/easybeauty",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/easybeauty.html",
		controller: 'EasyBeautyClienteCtrl'
      }
    }
  })

  .state('cliente.conversas', {
    url: "/cliente/conversas",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/conversas.html",
		controller: 'ConversasClienteCtrl'
      }
    }
  })

  .state('cliente.mapa', {
    url: "/cliente/mapa",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/mapa.html",
		controller: 'MapaClienteCtrl'
      }
    }
  })

  .state('cliente.lista', {
    url: "/cliente/lista",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/lista.html",
		controller: 'ListaClienteCtrl'
      }
    }
  })

  .state('cliente.perfil', {
    url: "/cliente/perfil/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/perfil.html",
		controller: 'PerfilClienteCtrl'
      }
    }
  })

  .state('chat', {
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

  .state('cliente.rota', {
    url: "/cliente/rota/:id",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/rota.html",
		controller: 'RotaClienteCtrl'
      }
    },
		params: {
			funcionaria: null
		}
  })

  .state('cliente.perto', {
    url: "/cliente/perto",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/perto.html",
		controller: 'PertoClienteCtrl'
      }
    }
  })

  .state('cliente.portipo', {
    url: "/cliente/portipo",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/portipo.html",
		controller: 'PortipoClienteCtrl'
      }
    }
  })

  .state('cliente.sugestoes', {
    url: "/cliente/sugestoes",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/sugestoes.html",
		controller: 'SugestoesClienteCtrl'
      }
    }
  })

  .state('cliente.atendimentos', {
    url: "/cliente/atendimentos",
    views: {
      'menuContent': {
        templateUrl: "templates/cliente/atendimentos.html",
		controller: 'AtendimentosClienteCtrl'
      }
    }
  });


	if ( !localStorage.hasOwnProperty('login_easyspa_usuario') )
	{
		if ( !localStorage.hasOwnProperty('login_easyspa_cliente') )
		{
			$urlRouterProvider.otherwise('/loginusuario');
		} else
		{
			$urlRouterProvider.otherwise('/cliente/home');
		}
	} else
	{
		$urlRouterProvider.otherwise('/usuario/home');
	}
});