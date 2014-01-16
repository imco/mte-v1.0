$(document).ready(function(){
    $('#singForm').submit(function(e){
        e.preventDefault();
        $.post('/peticiones/sign/', $(this).serialize(),function(data){
            $('.firma-count').html(data);
        });
        $(this).slideUp(300);
    });
	moveGalCustom();
    $.get('/peticiones/sienlace_firmas',function(data){
        $('#header .label .firma-count').html(data);
        $('#firma-count2').html(data).show().css('visibility','visible');
        $('#header .label').slideDown(400);
    });

});
/*$( window ).resize(function() {  setWhyText();  });*/
function setWhyText(){
    var container = $('.singin .whytext');
    container.removeClass('on');
    container.css('height', container.find('ol').height() + 'px').addClass('on');
}
function moveGalCustom(){
	if( $('.container .gallery .reel a').size() > 6 ){
		moveElement( );
	}
}
function moveElement( item ){
	reel = $('.container .gallery .reel');
	var left_value = parseInt(reel.css("left"));
	var w = $("#content .container .gallery .reel a").eq(1).find('img').width();
	//console.log('img: ' + );
	var time = left_value != 0 ? ( (- w - left_value) * 4500 ) / ( - w) : 4500;
	reel.animate({left:"-"+w+"px"},time,'linear',function(){
		var first_logo = $("#content .container .gallery .reel a").eq(0).detach();
		reel.css("left","0px");
		reel.append(first_logo);
		moveElement();
	});
}