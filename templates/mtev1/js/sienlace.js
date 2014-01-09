$(document).ready(function(){
    //setWhyText();
    //$('.uniform-file').uniform();
    /*$('.singin .seemore').click(function(e){
        e.preventDefault();
        var container = $('.singin .whytext');
        if( container.hasClass('ready') ){
            first = container.find('li.no').first();
            container.css('height', first.position().top + 'px').removeClass('ready');
        }else{
            container.css('height', container.find('ol').height() + 'px').addClass('ready');
        }
    });*/
    $('#singForm').submit(function(e){
        e.preventDefault();
        $.post('/peticiones/sign/', $(this).serialize(),function(data){
            $('.firma-count').html(data);
        });
        $(this).slideUp(300);
    });
	moveGalCustom();
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
	/*reel.animate( { left: '-156px', } , 1500, { complete: function(){
		reel.append(item);
		reel.css('left','0');
		setTimeout(function(){
			moveElement( $('.container .gallery .reel a').first() );
		},4000);
	} } );
	reel.animate({
		left: "-156px",
	  }, {
		duration: 1500,
		complete: function() {
			$item = item.detach();
			reel.css('left','0');
			reel.append($item);
			setTimeout(function(){
				moveElement( $('.container .gallery .reel a').first() );
			},2000);
		}
	  });*/
	var left_value = parseInt(reel.css("left"));
	var time = left_value != 0 ? ( (-156 - left_value) * 4500 ) / ( - 156) : 4500;
	reel.animate({left:"-156px"},time,'linear',function(){
		var first_logo = $("#content .container .gallery .reel a").eq(0).detach();
		reel.css("left","0px");
		reel.append(first_logo);
		moveElement();
	});
}