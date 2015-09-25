angular.module('easyspa.controllers')
.controller('CategoriasCtrl', function($scope, $rootScope, $ionicModal, $timeout, $location)
{
	if ( !localStorage.hasOwnProperty('login_easyspa') )
	{
		$location.path("/login");
		return;
	}

	$scope.tituloTela = 'easySpa, ' + $rootScope.usuario.bairro;
	// $scope.categorias = [
	// 	{id: 1, nome: 'Pés e Mãos'},
	// 	{id: 2, nome: 'Massagem'},
	// 	{id: 3, nome: 'Cabelereiro'},
	// 	{id: 4, nome: 'Maquiagem'},
	// 	{id: 5, nome: 'Depilação'},
	// 	{id: 6, nome: 'Design de Sobrancelha'},
	// 	{id: 7, nome: 'Cílios'},
	// 	{id: 8, nome: 'Estética facial'},
	// 	{id: 9, nome: 'Estética corporal'},
	// 	{id: 10, nome: 'Práticas integrativas'},
	// 	{id: 11, nome: 'Piercing / Tatuagem'},
	// 	{id: 12, nome: 'Personal Trainer'},
	// 	{id: 13, nome: 'Fisioterapia / Pilates / RPG'},
	// 	{id: 14, nome: 'Nutrição'},
	// 	{id: 15, nome: 'Odontologia'},
	// 	{id: 16, nome: 'Salão'},
	// 	{id: 17, nome: 'Academia'},
	// 	{id: 18, nome: 'Spa'},
	// 	{id: 19, nome: 'Clínica de Estética'},
	// 	{id: 20, nome: 'Hidroterapia/Hidroginástica/Natação'},
	// 	{id: 21, nome: 'Acupuntura / Auriculoterapia'},
	// 	{id: 22, nome: 'Yoga / Reike'}
	// ];
	$scope.todasCategorias = function()
	{
		$rootScope.categoria = 0;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}

	$scope.verMapa = function( categoria )
	{
		$rootScope.categoria = categoria;
		$rootScope.$apply();
		$location.path('/app/mapa');
	}
});
