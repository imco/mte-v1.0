var app = angular.module("mte",[]);
app.controller("fileController", function ($scope) {
	$scope.entidades = $archivosEntidad;
	$scope.entidades.forEach(function(entidad){
		entidad.census = 'Centros';
		entidad.format = 'win';
		entidad.service = 'g';
	});
	$scope.options = [
		'Centros',
		'Inmuebles',
		'CONAFE',
	];
	$scope.getLink = function(entidad){
		var format = entidad.format == 'win' ? '': "UTF_";
		var key = format+entidad.census.toUpperCase()+"_"+entidad.service.toUpperCase()
		return entidad[key];
	}
});
