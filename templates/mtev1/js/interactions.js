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
	//Sienlace special banner
	$('#sienlace-banner span').click(function(e){
		e.stopImmediatePropagation();
		$(this).parent().hide();
	});
	//Masonry Home
	$('#notas-container').masonry({
	  itemSelector: '.white-box.column',
	  gutter: 16
	});
	$('.mejora.container').imagesLoaded( function() {
	    $('.mejora.container .wrap').masonry({
		  itemSelector: '.mejorar',
		  gutter: 16
		});
	});
	
	$('.comments.container').masonry({
	  itemSelector: '.comment',
	  gutter: 16
	});

	/*
	var actualURL = document.URL;
	if(actualURL.indexOf("/escuelas/index") != -1)
		 $(".comparador_select").fadeTo(100, 0.1).fadeTo(300, 1.0);
	*/

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
		if(!$(this).hasClass('static')){
			e.preventDefault();
			$('#content .share-bt .social').toggleClass('on');
		}
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
		var next = $(this).next();
		next.addClass('on');
		if(!(next.find('.content').hasClass('jscrollpane'))){
			next.find('.content').addClass('jscrollpane').jScrollPane();
		}
	});
	if($('#content .container').hasClass('peticion')){
		$('.wrap_peticion.on .content').addClass('jscrollpane').jScrollPane();	
	}


	if($('#content .container').hasClass('perfil')){
		$('.menu a.logo + a + a + a').click(function(e){
			e.preventDefault();
			//location.href = $('.califica a.title').attr('href');
			window.location =$('.califica a.title').attr('href'); 
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
		//este agrega la escuela 'vista'
		var cct = $('span.CCT').html();
		var escuelas = $.cookie('escuelas_vistas') && $.cookie('escuelas_vistas').split('-') || [];
		if(escuelas.indexOf(cct)==-1){
			escuelas.push(cct);
			escuelas.sort();
			$.cookie('escuelas_vistas',escuelas.join('-'));
			//$('a[href="'+cct+'"]').parent().parent().addClass('on');
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
	
	if($('.container').hasClass('resultados') || $('.container').hasClass('califica_select')){
		$(window).unload(add_escuelas_cookie);
	}

	$('#compara-main-button').click(function(e){
		e.preventDefault();
		add_escuelas_cookie();
		$(window).off();
		location.href = '/compara/escuelas/' + $.cookie('escuelas');
	});

	$('a[href="/califica-tu-escuela/califica/"]').click(function(e){
		e.preventDefault();
		add_escuelas_cookie();
		$(window).off();
		if(!$('#content .container').hasClass('perfil'))
			location.href = '/califica-tu-escuela/califica/' + $.cookie('escuelas');
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

	$('.perfil .sort').click(function(e){
		e.preventDefault();
		var comments = $('.comment').remove(),
		temp = $(this).attr('href');
		$('.perfil .sort.on').removeClass('on');
		$(this).addClass('on');
		if($(this).hasClass('recientes')){
			comments.sort(function(a,b){
				var t1 = new Date($(a).find('.timestamp').html()),
				t2 = new Date($(b).find('.timestamp').html());
				if(temp=='top')
					return t1>t2?-1:1;
				else
					return t1>t2?1:-1;
			})
		}else{
			comments.sort(function(a,b){
				var l1 = parseFloat($(a).find('.likes').html()),
				l2 = parseFloat($(b).find('.likes').html());
				if(temp=='top')
					return l1>l2?-1:1;
				else
					return l1>l2?1:-1;

			})
		}
		$(this).attr('href',$(this).attr('href')=='top'?'bottom':'top');
		$('.container.comments').append(comments.removeAttr('style'))
		.masonry({
	  		itemSelector: '.comment',
	  		gutter: 16
		});;
	});

	$('form[action="/escuelas/calificar/"]').submit(function(e){
		if($(this).find('select').hasClass('error')){
			$(this).find('.customSelect.custom-select').css('background-color','#ee8888');
			e.preventDefault();
		}else{
			$(this).find('.customSelect.custom-select').css('background-color','white');
		}
	});

	$('form[action="/escuelas/calificar/"] select').change(function(e){
		$(this).parent().find('.customSelect.custom-select').css('background-color','white');
	});

	if($('.container').hasClass('perfil')){
		$.get('/main/load_estado_petitions/',{estado_petition:$('span[itemprop="addressRegion"]').html()},function(data){
			var template = '<h2>Peticiones</h2><ul>',
			petition;
			for(var i in data){
				petition = data[i];
				template += '<li><a href="/peticiones/index/'+petition.count+'" >'+petition.title+'"</a></li>';
			}

			if(data.length){
				template +='</ul>'
				$('.petitions').append(template);
			}
		},'json');
		setTimeout(function(){
			$('.comparador_select').fadeTo('slow',0.23).fadeTo('slow',1);
		},270);

		$('.comparador_select').data('indica',true);
	}

	$('.share-bt .social .btns a').each(function(i,val){
		$.get('/main/shorten_url/',{url:val.href},function(data){
			val.href = val.href.replace($('span.'+val.className).html(),data);
		},'json',val)
	})

	//mejora view
	$('.mejorar').click(function(){
		input_data_view_mejora(this);
		console.log("altura de mejora "+ $('.mejora').outerHeight(true));
		var displayTop = ($('.mejora').height() / 2) ;
		$('.display').css('top',displayTop+'px');	
		$('.display').show('slow');
		var displayoffset = $('.display').offset();
		$('body').animate({scrollTop:displayoffset.top-20},200);//scroll 213
		$('.mejora .overlay-transparent').show();
	});
	$('.mejora .overlay-transparent').click(function(){
		$(this).hide();
		$('.display').hide();
	})

	$('.display .move').click(function(e){
		e.preventDefault();
		var index = $('.mejorar.on'),
		next;
		if(this.href.split('#')[1]=='next'){
			if((next = index.next('.mejorar')).length){
				console.log(next);
				input_data_view_mejora(next);
			}else{
				input_data_view_mejora($('.mejorar:first-child'));
			}
		}else{
			if((next = index.prev('.mejorar')).length){
				input_data_view_mejora(next);
			}else{
				input_data_view_mejora($('.mejorar').last('.mejorar'));
			}
		
		}

	});

	$('.mejorar h1 a').click(function(e){
		e.preventDefault();
	});

	$('.mejorar a.more, .mejorar a.download').click(function(e){
		e.stopPropagation();
	});

	$('.comparador_select').not('.on').click(function(){
		var $this = $(this);
		$this.toggleClass('on').find('.open_wrap').toggle('slow');
		if($this.data('indica')){
			var cct = $('span.CCT').html();
			console.log(true);
			$this.data('indica',false);
			$this.find('.hidden:contains("'+cct+'")').parent().fadeTo('slow',0.23).fadeTo('slow',1);
		}

	});

	$('.comparador_select ul').on('click','li',function(e){
		e.preventDefault();
		e.stopPropagation();
		var $this = $(this),
		cct = $this.find('.hidden').html();
		$this.toggleClass('uncheck');
		if(!$($('.compara-escuela[href="'+ cct +'"]')[0]).trigger('click').length){
			toggle_escuela(cct);
		}
		$this.hide('slow',function(){
			var contents = {selected:'visited',visited:'selected'},
			content = $this.parent().parent().attr('class');
			$('.'+contents[content]+' ul').append(this);
			$this.removeClass().show('slow');
			var contentCountActual = $('.N'+content+' span'),
			contentCount = $('.N'+contents[content] +' span');
			contentCountActual.html(+(contentCountActual.html())-1);
			contentCount.html(+(contentCount.html())+1);
		});

	});
	
	/*
	$('.comparador_select .visited ul li').click(function(e){
		e.stopPropagation();
		$(this).toggleClass('uncheck');
	});
	*/

	$(document).keyup(function(e){
		if(e.keyCode == $.ui.keyCode.ESCAPE){
			$('.overlay-transparent').trigger('click');
		}
	});

	$('.display .close').click(function(){
		$('.overlay-transparent').trigger('click');
	});
});

function load_location_options(input,directive,options,name){
	input.prop('disabled', true);
	input.next().addClass('customSelectDisabled');
	$.post('/main/'+directive,options,function(data){
		input.html('<option value="">'+name+'</option>');
		for(x in data){
			var item = data[x];
			item.nombre = item.nombre[0].toLocaleUpperCase() + item.nombre.substr(1);
			input.append('<option value="'+item.id+'">'+item.nombre+'</option>');
		}
		input.prop('disabled', false);
		input.next().removeClass('customSelectDisabled');
		input.trigger('change');
	},'json');
}
/*function set_rank_bar(x){
	var max = $('.container').hasClass('B')?173:336;
	var rank = Math.round(x/max * 100);
	var offset = x - 12;
	$('#rank-bar .bar').css('width',x+'px').show();
	$('#rank-label').html(rank+'%').css('left',offset+'px').show();
	return rank;
}*/
function toggle_escuela(cct){
	var escuelas = $.cookie('escuelas') && $.cookie('escuelas').split('-') || [],
	index;
	if((index = escuelas.indexOf(cct)) !== -1){
		escuelas.splice(index,1);
	}else{
		escuelas.push(cct);
		escuelas.sort();
	}
	$.cookie('escuelas',escuelas.join('-'));
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
		data = data.statuses;
		$("#tweets .tweet").css('display','none');
		$("#tweets").append('<ul></ul>');
		for(d in data){
			var x = data[d];
			console.log(x);
			var text = replaceMentions(replaceHashTags(replaceURLWithHTMLLinks(x.text)));
			if(x.user.screen_name != 'clocsc') $("#tweets ul").append('<li><a href="https://twitter.com/'+x.user.screen_name+'" target="_blank" ><img src="'+x.user.profile_image_url+'" alt="'+x.user.screen_name+'" /></a><p><a href="http://www.twitter.com/'+x.user.screen_name+'/status/'+x.id_str+'" class="user"  target="_blank" >@'+x.user.screen_name+'</a> '+text+'</p></li>');
		}
		var heightX5Tweets = 0,
		tweets = $("#tweets ul li");
		for(i=0;i<5;i++){
			heightX5Tweets += parseInt($(tweets[i]).css('height'));
			heightX5Tweets += 18;//border padding margin
		}
		$('#tweets ul').css('height',heightX5Tweets);
		//console.log(heightX5Tweets);
		$('#tweets ul').jScrollPane();
	})
}
function replaceURLWithHTMLLinks(text) {
    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
    return text.replace(exp,"<a href='$1'>$1</a>"); 
}
function replaceHashTags(text) {
    var exp = /#(\S*)/ig;
    return text.replace(exp,"<a href='http://twitter.com/#!/search/$1'>#$1</a>"); 
}
function replaceMentions(text) {
    var exp = /@(\w{3,})/ig;
    return text.replace(exp,"<a href='http://twitter.com/$1'>@$1</a>"); 
}


function add_escuelas_cookie(){
	//var selector_table = $('.resultados.container table'),
	var selector_table = $('.resultados table'),
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

function input_data_view_mejora(mejorar){
	mejorar = $(mejorar);
	var index = $('.wrap .mejorar').removeClass('on').index(mejorar),
	url = mejorar.find('a.more')[0].href,
	title = mejorar.find('h2').html()
	display = $('.display');
	mejorar.addClass('on');
	display.find('.header p').html(title);
	display.find('.left img')[0].src = mejorar.find('h1 a')[0].href;
	display.find('.wrap_content p + a')[0].href = url; 
	var tweet = "<a href='https://twitter.com/share' class='twitter-share-button' data-url='"+url+"' data-text='"+title+"'>Tweet</a>",
	template_share = '<div class="fb-like" data-href="'+url+'" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>'+tweet+'<div class="fb-comments" data-href="'+url+'" data-width="340" data-numposts="5" data-colorscheme="dark"></div>';
	$('.info_share').html(template_share);
	FB.XFBML.parse(display[0]);
	twttr.widgets.load();
}


