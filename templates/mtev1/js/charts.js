google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
	var raw_data = $.parseJSON($('#data').html());
	var data = google.visualization.arrayToDataTable(raw_data);
	var options = {
	  legend: {position:'none'},
	  chartArea:{left:50,top:20,width:"90%",height:"90%"}
	};

	var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}
