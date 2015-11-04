angular.module('easyspa.controllers')
.controller('LoginClienteCtrl',
	function(
		$scope,
		$http,
		$location,
		$ionicActionSheet,
		$ionicPopup,
		$rootScope,
		$ionicLoading,
		$cordovaCamera,
		$cordovaGeolocation,
		$cordovaInAppBrowser,
		$cordovaOauth,
		$ionicScrollDelegate
	)
{
	$scope.dados = {};
	if ( localStorage.hasOwnProperty('login_easyspa_cliente') === true )
	{
		$rootScope.usuario = JSON.parse( localStorage.usuario_easyspa );
		$location.path("/cliente/home");
		return;
	}
	$scope.doLogin = function( dados )
	{
		if ( !dados.email )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'Preencha o campo de e-mail para continuar.'
			});
			return;
		}

		if ( !dados.senha )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'Preencha o campo de senha para continuar.'
			});
			return;
		}

		$ionicLoading.show({
			content: 'Entrando...'
		});

		if ( !$rootScope.offline )
		{

			$http.post( URL_EASYSPA + 'logincomercial',
			{
				email: dados.email,
				senha: dados.senha
			} )
			.then(function(response)
			{
				$ionicLoading.hide();
				var json = response.data
				if ( json.status == 'OK' )
				{
					json.funcionaria = JSON.parse(json.funcionaria);
					$rootScope.usuario = {
						 id: json.funcionaria.id
						,tipo: json.funcionaria.tipo
						,cpfcnpj: json.funcionaria.cpfcnpj
						,facebook: false
					};

					if(json.anuncios){

						var anuncio = JSON.parse(json.anuncios)[0];
						$rootScope.usuario.nome = anuncio.titulo;
						$rootScope.usuario.sobrenome = "";
						$rootScope.usuario.celular = anuncio.celular;
						$rootScope.usuario.rua = anuncio.rua
						$rootScope.usuario.bairro = anuncio.bairro;
						$rootScope.usuario.cidade = anuncio.cidade
						$rootScope.usuario.fbId = ""
						$rootScope.usuario.facebook = false;
						$rootScope.usuario.foto = anuncio.avatar;
						$rootScope.usuario.estado = anuncio.estado;
						
						// apresentacao: "Olá eu sou o Goku"
						// avaliacoes: "0"
						// avatar: "#"
						// bairro: "Vila Liberdade"
						// celular: "11111111111"
						// cidade: "Presidente Prudente"
						// data_inserido: "2015-09-18 09:14:44"
						// endereco: "Rua Donato Armelin"
						// especialidades: "Sou um super developer"
						// estado: "São Paulo"
						// idanuncio: "6"
						// idfuncionaria: "15"
						// latitude: "-22.1352276"
						// longitude: "-51.399491"
						// pontuacao: "0"
						// telefone: ""
						// titulo: "Jorge Rafael"

					}


					$rootScope.$apply();

					localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
					localStorage.login_easyspa_cliente = true;
					dados.email = '';
					dados.senha = '';
					$location.path("/cliente/home");
				} else
				{
					$ionicPopup.alert({
						title: 'Erro!',
						template: 'Login ou senha incorretos!'
					});
				}
			});
		} else
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Ocorreu um erro no cadastro, cheque sua conexao com a internet para continuar.'
			});
		}
	}

});
