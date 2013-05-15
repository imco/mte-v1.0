google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var raw_data = $.parseJSON($('#data').html());
	var data = google.visualization.arrayToDataTable(raw_data);
	var options = {
	  title: 'Calificaciones',
	  legend: {position:'none'}
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}