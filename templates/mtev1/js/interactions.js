$(document).ready(function(){	
	twitterIni();
	$.cookie.defaults.path = '/';
	$('.jscrollpane').jScrollPane();
	$('.custom-select').customSelect();
	$('.calificacion-form').validate();
	$('.reporte-form').validate();
	$('.petition-form').validate();

	$('#ver-en-mapa').click(function(e){
		e.preventDefault();
		$('#general-search').attr('action',$(this).attr('href'));
		$('#general-search').submit();
	});

	$('.compara-tabs a').click(function(e){
		e.preventDefault();
		var index = $(this).index();
		$('.compara-tabs a.on').removeClass('on');
		$(this).addClass('on');
		$('.compara-tab-container .tab.on').removeClass('on');
		$('.compara-tab-container .tab').eq(index).addClass('on');
	})

	$('.compara-escuela').on('click',function(e){
		e.preventDefault();
		var tr = $(this).parent().parent().toggleClass('on');
		var cct = $(this).attr('href');
		toggle_escuela(cct);
	});

	$('#content .perfil .tabs li a').click(function(e){
		e.preventDefault();
		var index = 4 - $(this).parent().index();
		$('#content .perfil .tabs li.on').removeClass('on');
		$(this).parent().addClass('on');
		$('#content .perfil .tab-container .tab.on').removeClass('on');
		$('#content .perfil .tab-container .tab').eq(index).addClass('on').jScrollPane();
		if($(this).html() == 'Resultados Educativos' ) drawCharts();
	})
	$('#rank-bar').mousemove(function(e){
		set_rank_bar(e.pageX - $(this).offset().left);
	});
	$('#rank-bar').click(function(e){
		var rank = set_rank_bar(e.pageX - $(this).offset().left);
		$('#rank-value').val(rank);
	});
	$('#rank-bar').mouseout(function(e){
		var x = e.pageX - $(this).offset().left;
		var y = e.pageY - $(this).offset().top;
		if((y >= 10 || y < 0) || (x < 0 || x > 336)){
			var val = $('#rank-value').val();
			if(val != ''){
				set_rank_bar(Math.round(val/100*336));
			}else{
				$('#rank-bar .bar').hide();
				$('#rank-label').hide();
			}
		}
	});

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
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ){
      return $("<li>").append("<a>"+item.label+"<span>"+item.address+"</span></a>").appendTo(ul);
    };
    
	$('#map-button').click(function(e){
		e.preventDefault();
		$('#general-search').attr('action','/mapa/');
		$('#general-search').submit();

	});
	$('#state-input').change(function(e){
		$("#localidad-input").prop('disabled', true).next().addClass('customSelectDisabled');
		load_location_options(
			$("#municipio-input"),
			'load_municipios',
			{entidad:$(this).val(),json:true},
			"Municipio"
		);
	});

	$('#municipio-input').change(function(){
		if($(this).val() != "" || ($("#state-input option:selected").val() != "" && $("#state-input option:selected").val() != 7 && $("#state-input option:selected").val() != 20 && $("#state-input option:selected").val() != 30)){
			load_location_options(
				$("#localidad-input"),
				'load_localidades',
				{municipio:$(this).val(),entidad:$("#state-input option:selected").val(),json:true},
				"Localidad"
			);
		}else{
			$("#localidad-input").prop('disabled', true).next().addClass('customSelectDisabled');
			$("#localidad-input").html('<option value="">Localidad</option>');
		}
	});

	$('#content .home .circle a.line').hover(function(){
		var x=[27,23,19];
		var i=$(this).index();
		var xP=$(this).position().left;
		$(this).parent().find('.line1').css({'left':xP+x[i-1] + 'px','display':'block'});
		$(this).parent().find('.line2').css({'left':89+xP+x[i-1]+'px','display':'block'});
	},function(){
			$(this).parent().find('.line1').css('display','none');	
			$(this).parent().find('.line2').css('display','none');	
	});
});
function load_location_options(input,directive,options,name){
	input.prop('disabled', true);
	input.next().addClass('customSelectDisabled');
	$.post('/main/'+directive,options,function(data){
		input.html('<option value="">'+name+'</option>');
		for(x in data){
			var item = data[x];
			input.append('<option value="'+item.id+'">'+item.nombre+'</option>');
		}
		input.prop('disabled', false);
		input.next().removeClass('customSelectDisabled');
		input.trigger('change');
	},'json');
}
function set_rank_bar(x){
	var rank = Math.round(x/336 * 100);
	var offset = x - 12;
	$('#rank-bar .bar').css('width',x+'px').show();
	$('#rank-label').html(rank+'%').css('left',offset+'px').show();
	return rank;
}
function toggle_escuela(cct){
	if(typeof($.cookie('escuelas')) == 'undefined'){		
		$.cookie('escuelas',[cct]);
	}else{
		var escuelas = $.cookie('escuelas').split('-');
		var index = escuelas.indexOf(cct);
		if(index != -1){
			escuelas.splice(index,1);
		}else{
			escuelas.push(cct);
		}
		escuelas.sort();
		$.cookie('escuelas',escuelas.join('-'));
		$('#compara-main-button').attr('href','/compara/escuelas/'+escuelas.join('-'));
	}
}
function twitterIni(){
	$("#tweets").tweet({
		username: "***REMOVED***",
		count: 3,
		avatar_size: 50,
		loading_text: "cargando tweets...",
		template: '<a href="{user_url}"><img src="{avatar_url}" alt="{screen_name}" /></a><p><a href="{tweet_url}" class="user">@{screen_name}</a> {text}</p>'
	});
}