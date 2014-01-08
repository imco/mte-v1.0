$(document).ready(function(){
    //setWhyText();
    $(".single-image").mxnphpSingleImage();
    $('.singin .seemore').click(function(e){
        e.preventDefault();
        var container = $('.singin .whytext');
        if( container.hasClass('ready') ){
            first = container.find('li.no').first();
            container.css('height', first.position().top + 'px').removeClass('ready');
        }else{
            container.css('height', container.find('ol').height() + 'px').addClass('ready');
        }
    });
    $('#singForm').submit(function(e){
        e.preventDefault();
        $.post('/home/sign/', $(this).serialize(),function(data){
            $('.firma-count').html(data);
        });
        $(this).slideUp(300);

    });
});
/*$( window ).resize(function() {  setWhyText();  });*/
function setWhyText(){
    var container = $('.singin .whytext');
    container.removeClass('on');
    container.css('height', container.find('ol').height() + 'px').addClass('on');
}