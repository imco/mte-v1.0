if(typeof google != 'undefined'){
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(initializeCharts);
}
function initializeCharts(){
	drawChart($('#data-primarias').html(),'graph-primarias','#0B9F49');
	$('.initialized').val(0);
	$('#primaria-init').val(1);
	$('.graph-button').click(function(e){
		e.preventDefault();
		var set = $(this).parent();
		set.toggleClass('on');
		if(set.children('.initialized').val() == 0){
			var id = set.children('.graph').attr('id');
			console.log(id);
			drawChart(set.children('.data').html(),id,set.children('.color').val());
			set.children('.initialized').val(1);
		}
	});
}

function drawChart(raw_data,id,color){
	raw_data = $.parseJSON(raw_data);
	var data = google.visualization.arrayToDataTable(raw_data);
	var options = {
	  legend: {position:'none'},
	  hAxis: {title: 'Puntuación'}, vAxis: {title: 'Escuelas'},
	  series: [{color: color}]
	};

	var chart = new google.visualization.ColumnChart(document.getElementById(id));
	chart.draw(data, options);
}

