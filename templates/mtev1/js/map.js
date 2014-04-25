;
var markers = [];
var infoboxes = [];
$().ready(function(){
	//Only if school profile or search
	var container = $('.container');
	if(typeof google != 'undefined' && (container.hasClass('perfil') || container.hasClass('search-map')))
		initialize_map();
	$('#compare-map-tab').click(function(e){
		if($('#map-initialized').val() == 'false'){
			initialize_map();
			$('#map-initialized').val('true');
		}
	});
});

function initialize_map(){

	var data = $.parseJSON($("#map-data").html())
	, uniqueEscuela;
	if(data && data.escuelas){
		var c=0
		, uniqueEscuela = true;
		for(var l in data.escuelas){
			c++;
			if(c==2){
				uniqueEscuela = false;
				break;
			}
		}
	}
	if(uniqueEscuela){
		data.centerlat = data.escuelas[l].latitud;
		data.centerlong = data.escuelas[l].longitud;	
	}

	var center = new google.maps.LatLng(data.centerlat,data.centerlong);
	var mapOptions = {zoom: data.zoom,center: center,mapTypeId: google.maps.MapTypeId.ROADMAP};
	map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
	for(x in data.escuelas) add_marker(data.escuelas[x],map);
}
function add_marker(escuela,map){
	var position = new google.maps.LatLng(escuela.latitud,escuela.longitud);
	if(typeof($('#map-selected').val()) != 'undefined'){
		var icon = $('#map-selected').val() == escuela.cct ? escuela.semaforo : escuela.semaforo+'o';
	}else{
		var icon = escuela.semaforo;
	} ;
	var marker = new google.maps.Marker({
		position: position,
		map: map,
		title: escuela.nombre,
		icon : '/templates/mtev1/img/pins/'+icon+'.png',
  	});
  	var infobox = make_infobox(escuela,marker,map);

	markers.push(marker);
	infoboxes.push(infobox);
}
function make_infobox(escuela,marker,map){
	var content = $("#sample-infobox").clone();
	content.find('a').attr('href','/escuelas/index/'+escuela.cct).html(escuela.nombre);
    content.find('.rank').html(escuela.rank);
    content.find('.semafo').addClass('sem'+escuela.semaforo);
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
