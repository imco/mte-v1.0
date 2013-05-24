var markers = [];
var infoboxes = [];
$().ready(function(){
	initialize_map();
});

function initialize_map(){
	var data = $.parseJSON($("#map-data").html());
	//console.log(data);
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
		title: escuela.nombre,
		icon : '/templates/mtev1/img/pins/'+escuela.semaforo+'.png',
  	});
  	var infobox = make_infobox(escuela,marker,map);

	markers.push(marker);
	infoboxes.push(infobox);
}
function make_infobox(escuela,marker,map){
	var content = $("#sample-infobox").clone();
	content.find('a').attr('href','/escuelas/index/'+escuela.cct).html(escuela.nombre);
    content.find('.rank').html(escuela.rank);
    content.find('.semaforo').addClass('sem'+escuela.semaforo);
    content.find('p').html(escuela.direccion);
	var options = {
		content: content.html(),
		pixelOffset: new google.maps.Size(-118,-191),
		closeBoxMargin: "0",
		closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
		infoBoxClearance: new google.maps.Size(1, 1)
	};
	
	var infobox = new InfoBox(options);
	
	google.maps.event.addListener(marker,'click',function(e){
		for(var i=0;i<infoboxes.length;i++) infoboxes[i].setMap(null);
		infobox.open(map,this);
	});
	
	return infobox;

}
function clear_map(){
	for(var i=0;i<markers.length;i++) markers[i].setMap(null);
	for(var i=0;i<infoboxes.length;i++) infoboxes[i].setMap(null);
}