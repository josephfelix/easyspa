angular.module('easyspa.controllers')
.controller('CadastroClienteCtrl',
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
	$scope.escolheufoto = {value : false};
	$scope.fotoUsuario = {value: '#'};


	$scope.cadastro = {};
	$scope.cadastro.apresentacao = { value : ""}
	$scope.cadastro.especialidades = { value : ""}

  $scope.cadastro.fbid = ""
	$scope.cadastro.categoria = 1
	$scope.cadastro.tipo = "PF"
	$scope.cadastro.categorias = [];
	$scope.cadastro.dataNascimento = "";
	$scope.cadastro.email = "";
	$scope.cadastro.senha = "";
	$scope.cadastro.cpf = "";
	$scope.cadastro.cnpj = "";
	$scope.cadastro.razaosocial = ""
	$scope.cadastro.nomefantasia = ""
	$scope.cadastro.idafiliado = "";
	$scope.cadastro.celcpf = ""
	$scope.cadastro.telcnpj = ""
	$scope.cadastro.celcnpj = ""
	$scope.cadastro.rua = "";
	$scope.cadastro.complemento = "";
	$scope.cadastro.bairro = "";
	$scope.cadastro.cidade = "";
	$scope.cadastro.estado = "";
	$scope.cadastro.latitude = "";
	$scope.cadastro.longitude = "";
	$scope.cadastro.idafiliado = "";

	$scope.segunda_feira =  $scope.segunda_feira ||   { value:true};
	$scope.terca_feira =  $scope.terca_feira ||   { value:true};
	$scope.quarta_feira =  $scope.quarta_feira ||   { value:true};
	$scope.quinta_feira =  $scope.quinta_feira ||   { value:true};
	$scope.sexta_feira =  $scope.sexta_feira ||   { value:true};
	$scope.sabado =  $scope.sabado ||   { value:false};
	$scope.domingo =  $scope.domingo ||   { value:false};

  $scope.de_segunda_feira = $scope.de_segunda_feira ||   {value: new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_terca_feira   = $scope.de_terca_feira ||   {value:new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_quarta_feira  = $scope.de_quarta_feira ||    {value:new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_quinta_feira  = $scope.de_quinta_feira ||    {value:new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_sexta_feira   = $scope.de_sexta_feira ||   {value:new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_sabado        = $scope.de_sabado ||    {value:new Date(2015, 0, 1, 9, 0, 0)};
  $scope.de_domingo       = $scope.de_domingo ||   {value:new Date(2015, 0, 1, 9, 0, 0)};


	$scope.ate_segunda_feira  = $scope.ate_segunda_feira ||  {value: new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_terca_feira  = $scope.ate_terca_feira ||  {value:new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_quarta_feira  = $scope.ate_quarta_feira ||  {value:new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_quinta_feira  = $scope.ate_quinta_feira ||  {value:new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_sexta_feira  = $scope.ate_sexta_feira ||  {value:new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_sabado  = $scope.ate_sabado ||  {value:new Date(2015, 0, 1, 18, 0, 0)};
	$scope.ate_domingo  = $scope.ate_domingo ||  {value:new Date(2015, 0, 1, 18, 0, 0)};

	var exclude = /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
	var check = /@[\w\-]+\./;
	var checkend = /\.[a-zA-Z]{2,3}$/;
	$scope.localizou = false;


	$scope.categorias = [
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

		$ionicScrollDelegate.scrollTop(false);
			$ionicScrollDelegate.resize();
			$ionicSlideBoxDelegate.previous();
			$scope.data.currSlide = $scope.data.currSlide - 1;

	}

	$scope.proximo = function()
	{

		if(!validStage($scope.data.currSlide)) { return ;}
		if($scope.invalidStage){ return;}

		$ionicScrollDelegate.scrollTop(false);
		$ionicScrollDelegate.resize();
		$ionicSlideBoxDelegate.next();
		$scope.data.currSlide = $scope.data.currSlide + 1;

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
					$scope.cadastro.estado = endereco[5].long_name;
					$scope.localizou = true;
					if(!$scope.localizou){
						carregarListaDeEstados();
					}
					$scope.$apply();
				}
			}
		});
	});
	carregarListaDeEstados();
	$scope.listarCidade =function (estado) {
		$http.get(URL_EASYSPA+"cidades",{estado:estado.id}).then(function (result) {
			console.log(result);
			$scope.estadosDB = result.data
		})
	}
	function carregarListaDeEstados(){

		$http.get(URL_EASYSPA+"estados").then(function (result) {
			console.log(result);
			$scope.estadosDB = result.data
		})
	}

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
					console.log(imageData);
					$scope.fotoUsuario = { value : imageData };
					$scope.escolheufoto = { value : true} ;
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
		var categorias = []
		for (var i = 0; i < cadastro.categorias.length; i++) {
			categorias.push(cadastro.categorias[i].id)
		}



		var dadosEnviar = {
			 nome: cadastro.nome
			,email: cadastro.email
			,senha: cadastro.senha
			,apresentacao: cadastro.apresentacao.value
			,especialidades: cadastro.especialidades.value
			,dataNascimento : cadastro.dataNascimento
			,cpf: cadastro.cpf
			,cnpj: cadastro.cnpj
			,tipo: cadastro.tipo
			,telefone: cadastro.telcnpj
			,nomefantasia:cadastro.nomefantasia
			,razaosocial:cadastro.razaosocial
			,celular : cadastro.celcpf || cadastro.celcnpj
			,categorias: categorias
			,idafiliado: cadastro.idafiliado || 0
			,endereco: cadastro.rua
			,complemento: cadastro.complemento
			,bairro: cadastro.bairro
			,cidade: cadastro.cidade
			,estado: cadastro.estado
			,latitude: cadastro.latitude
			,longitude: cadastro.longitude
			,segunda_feira: $scope.segunda_feira.value
			,terca_feira: $scope.terca_feira.value
			,quarta_feira: $scope.quarta_feira.value
			,quinta_feira: $scope.quinta_feira.value
			,sexta_feira: $scope.sexta_feira.value
			,sabado: $scope.sabado.value
			,domingo: $scope.domingo.value
			,de_segunda_feira: $scope.de_segunda_feira.value
			,de_terca_feira: $scope.de_terca_feira.value
			,de_quarta_feira: $scope.de_quarta_feira.value
			,de_quinta_feira: $scope.de_quinta_feira.value
			,de_sexta_feira: $scope.de_sexta_feira.value
			,de_sabado: $scope.de_sabado.value
			,de_domingo: $scope.de_domingo.value
			,ate_segunda_feira: $scope.ate_segunda_feira.value
			,ate_terca_feira: $scope.ate_terca_feira.value
			,ate_quarta_feira: $scope.ate_quarta_feira.value
			,ate_quinta_feira: $scope.ate_quinta_feira.value
			,ate_sexta_feira: $scope.ate_sexta_feira.value
			,ate_sabado: $scope.ate_sabado.value
			,ate_domingo: $scope.ate_domingo.value
		};

		if ( $rootScope.facebook )
			dadosEnviar.fbid = $rootScope.facebook.id;

		if ( $scope.escolheufoto.value )
		{
			$ionicLoading.show({
				content: 'Cadastrando...'
			});
			var imagem = $scope.fotoUsuario.value;
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
							foto: URL_ASSETS_EASYSPA + 'upload/' + json.foto,
							categorias : categorias
						};
						$rootScope.$apply();
						localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );
						localStorage.login_easyspa_cliente = true;
						$ionicPopup.alert({
							title: 'Sucesso!',
							template: json.msg
						}).then(function () {
							$location.path('/pagamento/planos');
							// $location.path("/cliente/home");
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

			dadosEnviar.foto = $scope.fotoUsuario.value;
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
						idafiliado : dadosEnviar.idafiliado,
						bairro: dadosEnviar.bairro,
						cidade: dadosEnviar.cidade,
						estado: dadosEnviar.estado,
						email: dadosEnviar.email,
						latitude: dadosEnviar.latitude,
						longitude: dadosEnviar.longitude,
						id: json.id,
						foto: dadosEnviar.foto,
						categorias : categorias
					};
					$rootScope.$apply();
					localStorage.login_easyspa_cliente = true;
					localStorage.usuario_easyspa = JSON.stringify( $rootScope.usuario );

					$ionicPopup.alert({
						title: 'Sucesso!',
						template: json.msg
					}).then(function () {
						$location.path('/pagamento/planos');
						// $location.path("/cliente/home");
					});

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
	function InvalidAlert(text){
		$ionicPopup.alert({
     title: 'Atenção',
     template: text === "" ? "Preencha todos os Campos" : text
   });
	}
	$scope.invalidStage = null;

	$scope.validOnServer = function (type,data) {
		if(!data){return ;}
		$http({
			url: "http://easyspa.club/app/checkfuncionaria/"
			,method: "GET"
			,params : {  tipo :type , data: data   }
		})
		.then(function (response) {
				if(response.data.status != "OK"){
					type =  type == "email"? "E-mail" : "CPF ou CNPJ"
					var msg = type+ " já cadastrado"
					InvalidAlert(msg);
					$scope.invalidStage = true;
				}else{
					$scope.invalidStage = false;
				}
		})
	}
	function validStage(index){

		if(index === 0){ // Valida a parte inicial

			if(!$scope.cadastro.nome 			  ||$scope.cadastro.nome          === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.email 			||$scope.cadastro.email         === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.senha       ||$scope.cadastro.senha         === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.rua         ||$scope.cadastro.rua           === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.complemento ||$scope.cadastro.complemento   === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.bairro      ||$scope.cadastro.bairro        === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.cidade      ||$scope.cadastro.cidade        === ""){ InvalidAlert(""); return false;}
			if(!$scope.cadastro.estado      ||$scope.cadastro.estado        === ""){ InvalidAlert(""); return false;}
			if($scope.cadastro.tipo == "PF"){
				  // Validando pessoa fisica
					if(!$scope.cadastro.dataNascimento || new Date($scope.cadastro.dataNascimento) == "Invalid Date") {InvalidAlert("Data Inválida"); return false;}
					if(!$scope.cadastro.cpf || $scope.cadastro.cpf          === "") { InvalidAlert(""); return false;}
					if(!$scope.cadastro.celcpf || $scope.cadastro.celcpf       === "") { InvalidAlert(""); return false;}
			}else{
				  // Valida pessoa fisica
					if(!$scope.cadastro.razaosocial || $scope.cadastro.razaosocial  === "") { InvalidAlert(""); return false;}
					if(!$scope.cadastro.nomefantasia || $scope.cadastro.nomefantasia === "") { InvalidAlert(""); return false;}
					if(!$scope.cadastro.cnpj || $scope.cadastro.cnpj         === "") { InvalidAlert(""); return false;}
					if(!$scope.cadastro.telcnpj||$scope.cadastro.telcnpj      === "") { InvalidAlert(""); return false;}
					// if($scope.cadastro.celcnpj      === "") { InvalidAlert(""); return false;}
			}







		}

		if(index === 1){

			if(!$scope.cadastro.apresentacao || $scope.cadastro.apresentacao.value === "")     { InvalidAlert(""); return false;}
			if(!$scope.cadastro.especialidades || $scope.cadastro.especialidades.value === "") { InvalidAlert(""); return false;}

			var diaSemana = "";
			if($scope.segunda_feira.value){
				diaSemana = "Segunda Feira";

				if(!$scope.de_segunda_feira.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_segunda_feira.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.terca_feira.value){
				diaSemana = "Terça Feira";
				if(!$scope.de_terca_feira.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_terca_feira.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.quarta_feira.value){
				diaSemana = "Quarta Feira";
				if(!$scope.de_quarta_feira.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_quarta_feira.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.quinta_feira.value){
				diaSemana = "Quinta Feira";
				if(!$scope.de_quinta_feira.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_quinta_feira.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.sexta_feira.value){
				diaSemana = "Sexta Feira";
				if(!$scope.de_sexta_feira.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_sexta_feira.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.sabado.value){
				diaSemana = "Sábado";
				if(!$scope.de_sabado.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_sabado.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}
			if($scope.domingo.value){
				diaSemana = "Domingo";
				if(!$scope.de_domingo.value) { InvalidAlert("Determine um horário inicial de atendimento para "+diaSemana); return false;}
				if(!$scope.ate_domingo.value){ InvalidAlert("Determine um horário final de atendimento para "+diaSemana); return false;}
			}

		}

		if(index === 2){}

		return true;
	}

});
