$(document).ready(function(){
 
	$('.up').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 450);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.up').slideDown(300);
		} else {
			$('.up').slideUp(300);
		}
	});
 
         $("#animarscroll").on("click", function(){
            var posicion = $("#about").offset().top;
            $("html, body").animate({
                scrollTop: posicion
            }, 2000); 
        });

});