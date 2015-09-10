angular.module('easyspa.controllers')
.controller('LoginCtrl',
	function( $scope, $rootScope, $location, $ionicPopup, $ionicLoading, $http, $cordovaOauth )
	{
		$scope.dados = {};
		if ( localStorage.hasOwnProperty('login_easyspa') === true )
		{
			$rootScope.usuario = JSON.parse( localStorage.usuario_easyspa );
			$location.path("/app/home");
			return;
		}
		
		$scope.loginFacebook = function()
		{
			$cordovaOauth.facebook(FACEBOOK_APPID, ['email']).then(function(result)
			{
				$http.get("https://graph.facebook.com/v2.2/me", 
				{ 
					params: 
						{ 
							access_token: result.access_token, 
							fields: "id,name,picture,email", 
							format: "json" 
						}
				}).then(function(result)
				{
					$rootScope.facebook = {
						id: result.data.id,
						email: result.data.email,
						name: result.data.name.split(' '),
						picture: result.data.picture.data.url
					};
					$rootScope.$apply();
					
					$http.post( URL_EASYSPA + 'loginfacebook',
					{
						id: $rootScope.facebook.id,
						email: $rootScope.facebook.email
					})
					.then(function( result )
					{
						var json = result.data;
						if ( json.status == 'OK' )
						{
							$rootScope.usuario = {
								latitude: json.latitude,
								longitude: json.longitude,
								nome: json.nome,
								email: json.email,
								id: json.id,
								foto: $rootScope.facebook.picture,
								sobrenome: json.sobrenome,
								celular: json.celular,
								rua: json.rua,
								complemento: json.complemento,
								bairro: json.bairro,
								cidade: json.cidade,
								estado: json.estado,
								fbid: json.fbid,
								facebook: true
							};
							$rootScope.$apply();
							localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
							localStorage.login_easyspa = true;
							$location.path("/app/home");
						} else
						{
							$location.path('/cadastro');
						}
					});
				}, function(error) {
					alert("There was a problem getting your profile.  Check the logs for details.");
					console.log(error);
				});
			}, function(error) {
				alert("There was a problem signing in!  See the console for logs");
				console.log(error);
			});
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
				$http.post( URL_EASYSPA + 'login/?cache=' + Math.random(), 
				{
					email: dados.email,
					senha: dados.senha
				} )
				.then(function(response)
				{
					$ionicLoading.hide();
					var json = response.data;
					if ( json.status == 'OK' )
					{
						$rootScope.usuario = {
							latitude: json.latitude,
							longitude: json.longitude,
							nome: json.nome,
							email: json.email,
							id: json.id,
							foto: URL_ASSETS_EASYSPA + 'upload/' + json.foto,
							sobrenome: json.sobrenome,
							celular: json.celular,
							rua: json.rua,
							complemento: json.complemento,
							bairro: json.bairro,
							cidade: json.cidade,
							estado: json.estado,
							facebook: false
						};
						$rootScope.$apply();
						localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
						localStorage.login_easyspa = true;
						$location.path("/app/home");
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
	}
);