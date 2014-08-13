<?php
//$url = 'http://166.78.45.120/solr/mte/select?q=juan%0A&wt=json&indent=true';
//$url = 'http://198.101.247.25:8983/solr/mte/select?q=juan%0A&wt=json&indent=true';
/*
$url = 'http://10.180.5.165:8983/solr/mte/select?q=juan%0A&wt=json&indent=true';
$homepage = file_get_contents($url);
echo "$url<br/><br/>$homepage<br/><br/>";


$url = 'http://166.78.45.120/solr/mte/select?q=juan%0A&wt=json&indent=true';
$homepage = file_get_contents($url);
echo "$url<br/><br/>$homepage<br/><br/>";

$url = 'http://198.101.247.25:8983/solr/mte/select?q=juan%0A&wt=json&indent=true';
$homepage = file_get_contents($url);
echo "$url<br/><br/>$homepage<br/><br/>";
*/


// Obtiene la geolocalización de la página freegeoip.net
$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
$url = "http://freegeoip.net/json/$IP";
$location_request = file_get_contents($url);
$location = json_decode($location_request);
echo $location->{"latitude"} . "," . $location->{"longitude"};
echo '<script>
	var position = new Object();
	position.coords = new Object();
	position.coords.latitude = ' . $location->{"latitude"} . ';
	position.coords.longitude = ' . $location->{"longitude"} . ';
	</script>';

	
	/*
	$url = "http://www.elhacker.net/api.html?ap=geoloc&host=$IP";
	echo "$url";
	$location_request = file_get_contents($url);
	echo "<script>" . $location_request . "</script>";
	*/
?>

<section id="wrapper">
Click the allow button to let the browser find your location.
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<article>
</article>
<script>
function success(position) {
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcontainer';
  mapcanvas.style.height = '400px';
  mapcanvas.style.width = '600px';
  document.querySelector('article').appendChild(mapcanvas);
  var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  var options = {
    zoom: 15,
    center: coords,
    mapTypeControl: false,
    navigationControlOptions: {
    	style: google.maps.NavigationControlStyle.SMALL
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("mapcontainer"), options);
  var marker = new google.maps.Marker({
      position: coords,
      map: map,
      title:"You are here!"
  });
}

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success);
  //intenta utilizar la geolocalización de HTML5 (GPS, WIFI o ISP en ese orden de disponibilidad) si no se puede o el usuario no acepta utiliza las coordenadas de freegeoip (nivel ciudad)
  if(!document.getElementById("mapcontainer") && position.coords.latitude && position.coords.longitude){
	success(position);
  }
} else {
	if(!document.getElementById("mapcontainer") && position.coords.latitude && position.coords.longitud){
		success(position);
	}else{
		error('Geo Location is not supported');
	}
}
</script>
</section>