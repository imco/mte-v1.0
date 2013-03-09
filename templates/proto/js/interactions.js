$(document).ready(function(){
	$('#state-input').change(function(){
		$("#municipio-input").prop('disabled', true);
		$.post('/main/load_municipios/',{entidad:$(this).val(),json:true},function(data){
			$('#municipio-input').html('<option value="">Municipio</option>');
			for(x in data){
				var municipio = data[x];
				$('#municipio-input').append('<option value="'+municipio.id+'">'+municipio.nombre+'</option>');
			}
			$("#municipio-input").prop('disabled', false);
		},'json');
	});
});