$(document).ready(function(){
	if($('#content .container').hasClass('home'))
		twitterIni();
	$.cookie.defaults.path = '/';
	$('.jscrollpane').jScrollPane();
	$('.custom-select').customSelect();
	$('.calificacion-form').validate();
	$('.reporte-form').validate();
	$('.petition-form').validate();
	$('.contacto-form').validate();
	$('form.newsletter').validate();

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
		var max = $('.container').hasClass('B')?173:336;
		var x = e.pageX - $(this).offset().left;
		var y = e.pageY - $(this).offset().top;
		if((y >= 10 || y < 0) || (x < 0 || x > max)){
			var val = $('#rank-value').val();
			if(val != ''){
				set_rank_bar(Math.round(val/100*max));
			}else{
				$('#rank-bar .bar').hide();
				$('#rank-label').hide();
			}
		}
	});

	if($("#name-input") .length)
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

	$('#content .share-bt a.button-frame').click(function(e){
		e.preventDefault();
		$('#content .share-bt .social').toggleClass('on');
	});

	$('.wrap_cal span').click(function(){
		var span =  $(this).parent().find('span');
		if($(this).hasClass('on') && $(this).index()==0){
			span.removeClass('on');
		}else{
			span.removeClass('on');
			for(var i=0;i<=$(this).index();i++){
				$(span[i]).addClass('on');
			}
		}
		var promedio = $('.wrap_cal span.on').size() / $('.wrap_cal').size();
		promedio = promedio.toString().length>3?promedio.toFixed(1):promedio;
		$('.promedio span').html(promedio);
		$('#rank-value').val(promedio);
	});

	$('.menu a.logo + a + a').click(function(e){
		e.preventDefault();
		var cookie = $.cookie('escuelas'),
		    url = '/compara/escuelas/'+ (cookie != undefined ? cookie:'');
		location.href = url;
	});

	$('.search-estado select.custom-select').change(function(){
		var id;
		if((id = $(this).val())!=''){
			location.href = '/resultados-nacionales/entidad/'+id;		
		}
	});

	$('.peticion h1').click(function(){
		$('.wrap_peticion, .social.on').removeClass('on');
		$(this).next().addClass('on');
	});

	if($('#content .container').hasClass('perfil')){
		$('.menu a.logo + a + a + a').click(function(e){
			e.preventDefault();
			location.href = $('.califica a.title').attr('href');
		});

		$('.tabs a.result').click(function(){
		var texts = $('text[text-anchor="start"]'),
		    text;
		for(var i=0;i<texts.length;i++){
			text = $(texts[i]);
			text.text(text.text()+' grado');
		}
		});

	}

	if($('.container').hasClass('perfil')){
		var cct = $('span.CCT').html();
		var escuelas = $.cookie('escuelas') && $.cookie('escuelas').split('-') || [];
		if(escuelas.indexOf(cct)==-1){
			escuelas.push(cct);
			escuelas.sort();
			$.cookie('escuelas',escuelas.join('-'));
			$('a[href="'+cct+'"]').parent().parent().addClass('on');
		}
		/*if(!($.cookie('escuelas')) || $.cookie('escuelas').split('-').indexOf(cct)==-1){
			$('a[href="'+cct+'"]').trigger('click');	
			if(!$('a[href="'+cct+'"]').size()){
				toggle_escuela(cct);
			}
		}*/

	}

	if($('.container').hasClass('comparar')){
		$('#general-search').submit(function(e){
			e.preventDefault();
			var url='';
			$(this).find('[name]').each(function(i,val){
				url +='&'+$(val).attr('name')+'='+$(val).val();
			});
			window.location = $(this).attr('action')+url;
		});
	}
	
	if($('.container').hasClass('resultados')){
		$(window).unload(function(){
			add_escuelas_cookie();	
		});
	}

	$('#compara-main-button').click(function(e){
		e.preventDefault();
		add_escuelas_cookie();
		$(window).off();
		location.href = '/compara/escuelas/' + $.cookie('escuelas');
	});

	$('#content .comparar.resultados table tr.on .compara-escuela').click(function(e){
		e.preventDefault();
		var cct = $(this).attr('href'),
		url=document.URL.replace(new RegExp('-*'+cct),''),
		escuelas = $.cookie('escuelas') && $.cookie('escuelas').split('-') || [];
		escuelas.splice(escuelas.indexOf(cct),1);
		$.cookie('escuelas',escuelas.join('-'));
		if(document.URL != url)
			location.href = url;

	
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
	var max = $('.container').hasClass('B')?173:336;
	var rank = Math.round(x/max * 100);
	var offset = x - 12;
	$('#rank-bar .bar').css('width',x+'px').show();
	$('#rank-label').html(rank+'%').css('left',offset+'px').show();
	return rank;
}
function toggle_escuela(cct){
	var escuelas = $.cookie('escuelas') && $.cookie('escuelas').split('-') || [],
	index;
	if((index = escuelas.indexOf(cct)) != -1){
		escuelas.splice(index,1);
		escuelas.sort();
		$.cookie('escuelas',escuelas.join('-'));
	}
	//$('#compara-main-button').attr('href','/compara/escuelas/'+escuelas.join('-') || '');
	/*
	if(typeof($.cookie('escuelas')) == 'undefined'){		
		$.cookie('escuelas',[cct]);
	}else{
		var escuelas = $.cookie('escuelas').split('-');
		var index = escuelas.indexOf(cct);
		if(index != -1){
			escuelas.pop(index);
		}else{
			escuelas.push(cct);
		}
		//escuelas.sort();
		$.cookie('escuelas',escuelas.join('-'));
		if( $('.container.resultados').hasClass('comparar')){
			var url=document.URL.replace(new RegExp('-*'+cct),'');
			if(document.URL != url)
				location.href = url;
		}
	}
	*/
}
function twitterIni(){
    var username =  "mejoratuescuela",
	page_proxy = '/home/twitter';	
	$("#tweets .tweet p").html("cargando tweets...");
	$.getJSON(page_proxy, function(data){
		$("#tweets .tweet").css('display','none');
		$("#tweets").append('<ul></ul>');
		for(d in data){
			var x = data[d];
			$("#tweets ul").append('<li><a href="http://twitter.com/'+username+'" target="_blank" ><img src="'+x.user.profile_image_url+'" alt="'+username+'" /></a><p><a href="http://www.twitter.com/'+username+'/status/'+x.id_str+'" class="user"  target="_blank" >@'+username+'</a> '+x.text+'</p></li>');
	    	}
	    })
}

function add_escuelas_cookie(){
	var selector_table = $('.resultados.container table'),
	on = selector_table.find('tr.on'),
	cookie = $.cookie('escuelas'),
	escuelas = cookie && cookie.split('-') || [];
	for(var i=0;i<on.length;i++){
		var val = $(on[i]),
		cct = val.find('.compara-escuela').attr('href');
		if(escuelas.indexOf(cct)==-1)
			escuelas.push(cct);
	}
	escuelas.sort();
	if(escuelas.length){
		$.cookie('escuelas',escuelas.join('-'));
	}

}
