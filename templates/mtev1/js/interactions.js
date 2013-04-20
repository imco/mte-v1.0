$(document).ready(function(){
	$( "#name-input" ).autocomplete({
  		source: function(request,response){
  			$.post("/main/get_escuelas/",{
  				term : request.term,
  				entidad : $("#state-input").val(),
  				municipio : $("#municipio-input").val(),
  				localidad : $("#localidad-input").val(),
  				nivel : $("#nivel-input").val(),
  				json : true
  			},response,'json');
  		},
  		minLength: 3,
		select: function( event, ui ) {
			window.location = "/escuelas/index/"+ui.item.cct;
			return false;
		}
		/*focus: function( event, ui ) {
			//$( "#name-input" ).val(ui.item.label);
			return false;
		},*/
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ){
      return $("<li>").append("<a>"+item.label+"<span>"+item.address+"</span></a>").appendTo(ul);
    };
	$('#map-button').click(function(e){
		e.preventDefault();
		$('#general-search').attr('action','/mapa/');
		$('#general-search').submit();

	});
	$('#state-input').change(function(e){
		load_location_options(
			$("#municipio-input"),
			'load_municipios',
			{entidad:$(this).val(),json:true},
			"Municipio"
		);
		if($(this).val() != ''){
			load_location_options(
				$("#localidad-input"),
				'load_localidades',
				{entidad:$(this).val(),json:true},
				"Localidad"
			);
		}else{
			$("#localidad-input").prop('disabled', true);
			$("#localidad-input").html('<option value="">Localidad</option>');
		}

	});
	$('#municipio-input').change(function(){
		if($(this).val() != ""|| $("#state-input option:selected").val() != ""){
			load_location_options(
				$("#localidad-input"),
				'load_localidades',
				{municipio:$(this).val(),entidad:$("#state-input option:selected").val(),json:true},
				"Localidad"
			);
		}else{
			$("#localidad-input").prop('disabled', true);
			$("#localidad-input").html('<option value="">Localidad</option>');
		}
	});
});
function load_location_options(input,directive,options,name){
	input.prop('disabled', true);
	$.post('/main/'+directive,options,function(data){
		input.html('<option value="">'+name+'</option>');
		for(x in data){
			var item = data[x];
			input.append('<option value="'+item.id+'">'+item.nombre+'</option>');
		}
		input.prop('disabled', false);
		input.trigger('change');
	},'json');
}