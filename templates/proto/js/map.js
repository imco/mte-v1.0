$().ready(function(){
	initialize_map();
});

function initialize_map(){
	var data = $.parseJSON($("#map-data").html());
	console.log(data);
	var center = new google.maps.LatLng(data.centerlat,data.centerlong);
	var mapOptions = {zoom: data.zoom,center: center,mapTypeId: google.maps.MapTypeId.ROADMAP};
	map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
	for(x in data.escuelas) add_marker(data.escuelas[x],map);
}
function add_marker(escuela,map){
	var position = new google.maps.LatLng(escuela.latitud,escuela.longitud);
	var marker = new google.maps.Marker({
		position: position,
		map: map,
		title: escuela.nombre
  	});
}