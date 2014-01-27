if(typeof google != 'undefined' && google['load'] ){
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawCharts);
}

function drawCharts() {
	drawChart('matematicas');
	drawChart('espaniol');
}
function drawChart(materia){
	var raw_data = $.parseJSON($('#line-chart-data-'+materia).html()),
	data = google.visualization.arrayToDataTable(raw_data),
	options = {
	   chartArea : {width:295,height:94,left:40,top:35},
	   legend: {position:'none'}
	},
	nLine = raw_data[0].length-1,
	template = "<p><span class='circle' style='background:C'></span>N</p>",
	colors = ["#3366cc","#dc3912","#ff9900","#109618","#990099","#0099c6"],	
	content =$('.legend_chart .wrap_lc').html(""),
	temp;
	for(var i=1;i<=nLine;i++){
		temp = $(template.replace('N',raw_data[0][i]).replace('C',colors[i-1]));
		content.append(temp);
	}

	var chart = new google.visualization.LineChart(document.getElementById('profile-line-chart-'+materia));
	chart.draw(data, options);
}
