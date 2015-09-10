angular.module('easyspa.controllers')
.controller('CadastroCtrl',
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
		$cordovaInAppBrowser
	)
{
	$scope.escolheufoto = false;
	$scope.fotoUsuario = '#';
	var exclude = /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check = /@[\w\-]+\./;
	var checkend = /\.[a-zA-Z]{2,3}$/;
	$scope.localizou = false;
	$scope.cadastro = {fbid: ''};
	
	if ( $rootScope.facebook )
	{
		$scope.cadastro.nome = $rootScope.facebook.name[0];
		$scope.cadastro.sobrenome = $rootScope.facebook.name[1];
		$scope.cadastro.fbid = $rootScope.facebook.id;
		$scope.cadastro.email = $rootScope.facebook.email;
		$scope.fotoUsuario = $rootScope.facebook.picture;
	}
	
	$cordovaGeolocation.getCurrentPosition({enableHightAccuracy: false})
	.then(function(pos)
	{
		var myLatlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'latLng': myLatlng}, function(results, status)
		{
			if ( status == google.maps.GeocoderStatus.OK )
			{
				if ( results.length )
				{
					$scope.cadastro.latitude = pos.coords.latitude;
					$scope.cadastro.longitude = pos.coords.longitude;
					var endereco = results[0].address_components;
					$scope.cadastro.rua = endereco[1].long_name;
					$scope.cadastro.bairro = endereco[2].long_name;
					$scope.cadastro.cidade = endereco[3].long_name;
					$scope.cadastro.estado = endereco[4].long_name;
					$scope.localizou = true;
					$scope.$apply();
				}
			}
		});
	});
	
	$scope.selecionarFoto = function()
	{
		var fonte = [
			Camera.PictureSourceType.CAMERA,
			Camera.PictureSourceType.PHOTOLIBRARY
		];
	
		var options = {
			'androidTheme': window.plugins.actionsheet.ANDROID_THEMES.THEME_HOLO_LIGHT,
			'title': 'Selecione a origem da foto',
			'buttonLabels': ['Tirar foto agora (Câmera)', 'Buscar da galeria'],
			'androidEnableCancelButton' : true,
			'winphoneEnableCancelButton' : true,
			'addCancelButtonWithLabel': 'Cancelar',
			'position': [20, 40]
		};
		
		window.plugins.actionsheet.show(options, function( opc )
		{
			if ( opc != 3 )
			{
				$cordovaCamera.getPicture(
				{ 
					quality: 100, 
					destinationType: Camera.DestinationType.FILE_URI, 
					allowEdit: true,
					encodingType: 0, 
					sourceType: fonte[opc-1],
					mediaType: Camera.MediaType.PICTURE,
					correctOrientation: true,
					targetWidth: 175,
					targetHeight: 175
				}).then(function(imageData)
				{
					$scope.fotoUsuario = imageData;
					$scope.escolheufoto = true;
				}); 
				return true;
			}
		});
	}
	
	$scope.verTermos = function()
	{
		$cordovaInAppBrowser.open( URL_ASSETS_EASYSPA + 'termos', '_blank');
	}
	
	$scope.finalizarCadastro = function( cadastro )
	{
		if ( $rootScope.offline )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Ocorreu um erro no cadastro, cheque sua conexão com a internet para continuar.'
			});
			return;
		}
		
		if ( !cadastro.aceitou_termos )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: &Eacute; necess&aacute;rio aceitar os termos de uso para continuar!'
			});
			return;
		}
		
		if ( !cadastro.nome )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha seu nome para continuar!'
			});   
			return;
		}
		
		if ( !cadastro.sobrenome )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha seu sobrenome para continuar!'
			});   
			return;
		}
		
		if ( !cadastro.celular )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha um celular no formato (xx) xxxxx-xxxx para continuar!'
			});   
			return;
		}
		
		if ( !cadastro.email )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha um e-mail v&aacute;lido para continuar!'
			});   
			return;
		}
		
		if ( ( ( cadastro.email.search(exclude) != -1) || 
			   ( cadastro.email.search(check) ) == -1) ||
			   ( cadastro.email.search(checkend) == -1) )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: E-mail inválido, insira um e-mail no formato exemplo@gmail.com'
			});   
			return;
		}
		
		if ( !cadastro.senha )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Insira uma senha para continuar'
			});   
			return;
		}
		
		
		if ( !cadastro.rua || !cadastro.complemento || !cadastro.bairro || !cadastro.cidade || !cadastro.estado )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha corretamente os campos de endere&ccedil;o para continuar!'
			});   
			return;
		}
		
		
		var dadosEnviar = {
			nome: cadastro.nome,
			sobrenome: cadastro.sobrenome,
			celular: cadastro.celular,
			email: cadastro.email,
			senha: cadastro.senha,
			rua: cadastro.rua,
			complemento: cadastro.complemento,
			bairro: cadastro.bairro,
			cidade: cadastro.cidade,
			estado: cadastro.estado,
			latitude: cadastro.latitude,
			longitude: cadastro.longitude
		};
		
		if ( $rootScope.facebook )
			dadosEnviar.fbid = $rootScope.facebook.id;
			
		if ( $scope.escolheufoto )
		{
			$ionicLoading.show({
				content: 'Cadastrando...'
			});
			var imagem = $scope.fotoUsuario;
			var options = new FileUploadOptions();
			options.fileKey = "file";
			options.fileName = imagem.substr(imagem.lastIndexOf('/')+1);
			options.mimeType = "image/jpeg";
			options.params = dadosEnviar;
			
			var ft = new FileTransfer();
			ft.upload( 
				imagem, 
				encodeURI( URL_EASYSPA + 'registrar/?cache=' + Math.random() ), 
				function( result )
				{
					var json = JSON.parse( result.response );
					$ionicLoading.hide();
					if ( json.error == 0 )
					{
						$rootScope.usuario = {
							nome: dadosEnviar.nome,
							sobrenome: dadosEnviar.sobrenome,
							celular: dadosEnviar.celular,
							rua: dadosEnviar.rua,
							complemento: dadosEnviar.complemento,
							bairro: dadosEnviar.bairro,
							cidade: dadosEnviar.cidade,
							estado: dadosEnviar.estado,
							email: dadosEnviar.email,
							latitude: dadosEnviar.latitude,
							longitude: dadosEnviar.longitude,
							tipo: 'CADASTRO',
							id: json.id,
							foto: URL_EASYSPA + 'upload/' + json.foto,
							facebook: false
						};
						$rootScope.$apply();
						localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
						localStorage.login_easyspa = true;
						$ionicPopup.alert({
							title: 'Sucesso!',
							template: json.msg
						})
						.then(function()
						{
							$location.path("/app/home");
						});
					} else
					{
						$ionicPopup.alert({
							title: 'Erro!',
							template: 'ERRO: ' + json.msg
						});
					}
				}, 
				function(e)
				{
					$ionicLoading.hide();
					$ionicPopup.alert({
						title: 'Erro!',
						template: 'ERRO: Ocorreu um erro no cadastro, cheque sua conexão com a internet para continuar.'
					});
				}, options);
		} else
		{
			$ionicLoading.show({
				content: 'Cadastrando...'
			});
		
			dadosEnviar.foto = $scope.fotoUsuario;
			$http.post( URL_EASYSPA + 'registrar', dadosEnviar )
			.then(function(result)
			{
				var json = result.data;
				$ionicLoading.hide();
				if ( json.error == 0 )
				{
					$rootScope.usuario = {
						nome: dadosEnviar.nome,
						sobrenome: dadosEnviar.sobrenome,
						celular: dadosEnviar.celular,
						rua: dadosEnviar.rua,
						complemento: dadosEnviar.complemento,
						bairro: dadosEnviar.bairro,
						cidade: dadosEnviar.cidade,
						estado: dadosEnviar.estado,
						email: dadosEnviar.email,
						latitude: dadosEnviar.latitude,
						longitude: dadosEnviar.longitude,
						tipo: 'CADASTRO',
						id: json.id,
						foto: dadosEnviar.foto,
						facebook: false
					};
					$rootScope.$apply();
					localStorage.login_easyspa = true;
					localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
					$ionicPopup.alert({
						title: 'Sucesso!',
						template: json.msg
					});
					$location.path("/app/home");
				} else
				{
					$ionicPopup.alert({
						title: 'Erro!',
						template: 'ERRO: ' + json.msg
					});
				}
			});
		}
	}
});