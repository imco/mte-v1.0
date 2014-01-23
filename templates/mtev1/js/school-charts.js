if(typeof google != 'undefined' && google['load'] ){
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawCharts);
}

function drawCharts() {
	drawChart('matematicas');
	drawChart('espaniol');
}
function drawChart(materia){
	var raw_data = $.parseJSON($('#line-chart-data-'+materia).html());
	var data = google.visualization.arrayToDataTable(raw_data);
	var options = {
	   chartarea : {width:210,height:200}
	};
	var chart = new google.visualization.LineChart(document.getElementById('profile-line-chart-'+materia));
	chart.draw(data, options);
}
