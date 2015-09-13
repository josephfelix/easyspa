angular.module('easyspa.controllers')
.controller('CadastroComercialCtrl',
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
		$ionicSlideBoxDelegate,
		$ionicScrollDelegate,
		$timeout
	)
{
	$scope.escolheufoto = false;
	$scope.fotoUsuario = '#';

	$scope.segunda_feira = true;
	$scope.terca_feira = true;
	$scope.quarta_feira = true;
	$scope.quinta_feira = true;
	$scope.sexta_feira = true;
	$scope.sabado = false;
	$scope.domingo = false;

	$scope.de_segunda_feira = '09:00:00';
	$scope.de_terca_feira = '09:00:00';
	$scope.de_quarta_feira = '09:00:00';
	$scope.de_quinta_feira = '09:00:00';
	$scope.de_sexta_feira = '09:00:00';
	$scope.de_sabado = '09:00:00';
	$scope.de_domingo = '09:00:00';

	$scope.ate_segunda_feira = '18:00:00';
	$scope.ate_terca_feira = '18:00:00';
	$scope.ate_quarta_feira = '18:00:00';
	$scope.ate_quinta_feira = '18:00:00';
	$scope.ate_sexta_feira = '18:00:00';
	$scope.ate_sabado = '18:00:00';
	$scope.ate_domingo = '18:00:00';

	var exclude = /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check = /@[\w\-]+\./;
	var checkend = /\.[a-zA-Z]{2,3}$/;
	$scope.localizou = false;
	$scope.cadastro = {fbid: '', categoria: 1, tipo: 'PF', categorias:[]};

	$scope.categorias = [
		{id: 1, nome: 'Pés e Mãos'},
		{id: 2, nome: 'Massagem'},
		{id: 3, nome: 'Cabelereiro'},
		{id: 4, nome: 'Maquiagem'},
		{id: 5, nome: 'Depilação'},
		{id: 6, nome: 'Design de Sobrancelha'},
		{id: 7, nome: 'Cílios'},
		{id: 8, nome: 'Estética facial'},
		{id: 9, nome: 'Estética corporal'},
		{id: 10, nome: 'Práticas integrativas'},
		{id: 11, nome: 'Piercing / Tatuagem'},
		{id: 12, nome: 'Personal Trainer'},
		{id: 13, nome: 'Fisioterapia / Pilates / RPG'},
		{id: 14, nome: 'Nutrição'},
		{id: 15, nome: 'Odontologia'},
		{id: 16, nome: 'Salão'},
		{id: 17, nome: 'Academia'},
		{id: 18, nome: 'Spa'},
		{id: 19, nome: 'Clínica de Estética'},
		{id: 20, nome: 'Hidroterapia/Hidroginástica/Natação'},
		{id: 21, nome: 'Acupuntura / Auriculoterapia'},
		{id: 22, nome: 'Yoga / Reike'}
	];
	if ( $rootScope.facebook )
	{
		$scope.cadastro.nome = $rootScope.facebook.name[0];
		$scope.cadastro.sobrenome = $rootScope.facebook.name[1];
		$scope.cadastro.fbid = $rootScope.facebook.id;
		$scope.cadastro.email = $rootScope.facebook.email;
		$scope.fotoUsuario = $rootScope.facebook.picture;
	}

	$scope.marcarCategoria = function( id, nome )
	{
		$scope.cadastro.categorias.push( {id: id, nome:nome} );
		$scope.categorias[id-1].oculto = true;
		if ( id > 10 )
		{
			for ( var ind in $scope.categorias )
			{
				$scope.categorias[ind].oculto = true;
			}
			$scope.categoriasocultas = true;
		} else
		{
			for ( var ind = 10; ind <= $scope.categorias.length; ind++ )
			{
				$scope.categorias[ind].oculto = true;
			}
			$scope.categoriasocultas = false;
		}
		$scope.$apply();
	}

	$scope.removerCategoria = function( categoria )
	{
		$scope.cadastro.categorias.splice( $scope.cadastro.categorias.indexOf( categoria ), 1 );
		$scope.categorias[categoria.id-1].oculto = false;
		if ( categoria.id > 10 )
		{
			for ( var ind in $scope.categorias )
			{
				$scope.categorias[ind].oculto = false;
			}
			$scope.categoriasocultas = false;
		} else
		{
			for ( var ind = 10; ind <= $scope.categorias.length; ind++ )
			{
				$scope.categorias[ind].oculto = false;
			}
			$scope.categoriasocultas = false;
		}
		$scope.$apply();
	}

	$scope.data = {};
	$scope.data.currSlide = 0;
	$scope.anterior = function()
	{
		$scope.data.currSlide = $scope.data.currSlide - 1;
		$ionicSlideBoxDelegate.previous();
		$timeout( function() {
			$ionicScrollDelegate.scrollTop();
      $ionicScrollDelegate.resize();
    }, 50);
	}

	$scope.proximo = function()
	{

		$scope.data.currSlide = $scope.data.currSlide + 1;
		$ionicSlideBoxDelegate.next();
		$timeout( function() {
			$ionicScrollDelegate.scrollTop();
      $ionicScrollDelegate.resize();
    }, 50);
		
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
				template: 'ERRO: é necessário aceitar os termos de uso para continuar!'
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

		if ( !cadastro.email )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Preencha um e-mail válido para continuar!'
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

		if ( !$scope.segunda_feira && !$scope.terca_feira && !$scope.quarta_feira &&
			 !$scope.quinta_feira && !$scope.sexta_feira && !$scope.sabado && !$scope.domingo )
		{
			$ionicPopup.alert({
				title: 'Erro!',
				template: 'ERRO: Marque pelo menos 1 dia da semana para continuar!'
			});
			return;
		}


		var dadosEnviar = {
			nome: cadastro.nome,
			email: cadastro.email,
			senha: cadastro.senha,
			apresentacao: cadastro.apresentacao,
			especialidades: cadastro.especialidades,
			cpf: cadastro.cpf,
			cnpj: cadastro.cnpj,
			tipo: cadastro.tipo,
			categoria: cadastro.categoria,
			rua: cadastro.rua,
			complemento: cadastro.complemento,
			bairro: cadastro.bairro,
			cidade: cadastro.cidade,
			estado: cadastro.estado,
			latitude: cadastro.latitude,
			longitude: cadastro.longitude,
			segunda_feira: $scope.segunda_feira,
			terca_feira: $scope.terca_feira,
			quarta_feira: $scope.quarta_feira,
			quinta_feira: $scope.quinta_feira,
			sexta_feira: $scope.sexta_feira,
			sabado: $scope.sabado,
			domingo: $scope.domingo,

			de_segunda_feira: $scope.de_segunda_feira,
			de_terca_feira: $scope.de_terca_feira,
			de_quarta_feira: $scope.de_quarta_feira,
			de_quinta_feira: $scope.de_quinta_feira,
			de_sexta_feira: $scope.de_sexta_feira,
			de_sabado: $scope.de_sabado,
			de_domingo: $scope.de_domingo,

			ate_segunda_feira: $scope.ate_segunda_feira,
			ate_terca_feira: $scope.ate_terca_feira,
			ate_quarta_feira: $scope.ate_quarta_feira,
			ate_quinta_feira: $scope.ate_quinta_feira,
			ate_sexta_feira: $scope.ate_sexta_feira,
			ate_sabado: $scope.ate_sabado,
			ate_domingo: $scope.ate_domingo
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
				encodeURI( URL_EASYSPA + 'registrarfuncionaria/?cache=' + Math.random() ),
				function( result )
				{
					var json = JSON.parse( result.response );
					$ionicLoading.hide();
					if ( json.error == 0 )
					{
						$rootScope.usuario = {
							nome: dadosEnviar.nome,
							rua: dadosEnviar.rua,
							complemento: dadosEnviar.complemento,
							bairro: dadosEnviar.bairro,
							cidade: dadosEnviar.cidade,
							estado: dadosEnviar.estado,
							email: dadosEnviar.email,
							latitude: dadosEnviar.latitude,
							longitude: dadosEnviar.longitude,
							id: json.id,
							foto: URL_ASSETS_EASYSPA + 'upload/' + json.foto
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
			$http.post( URL_EASYSPA + 'registrarfuncionaria', dadosEnviar )
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
						id: json.id,
						foto: dadosEnviar.foto
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


	$scope.disableSwipe = function() {
	   $ionicSlideBoxDelegate.enableSlide(false);
	};


});
