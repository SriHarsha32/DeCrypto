var isMob = false;

$( document ).ready(function() {      
    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

    if (isMobile.matches) {
        isMob = true;
    }
 });

$('#opener, #showlogin').on('click', function(e) {
		e.preventDefault();
		var lgnpanel = $('#slide-panel');
		var regpanel = $('#slide-panel2');
		
		if (regpanel.hasClass("visible")) {
			if(!isMob){
				regpanel.removeClass('visible').animate({'margin-right':'-400px'});
			}
			else{
				regpanel.removeClass('visible').animate({'margin-right':'-250px'});
			}
		}
		regpanel.hide();
		if (lgnpanel.hasClass("visible")) {
			$('#loginpanel').hide();
			if(!isMob){
				lgnpanel.removeClass('visible').animate({'margin-right':'-400px'});
			}
			else{
				lgnpanel.removeClass('visible').animate({'margin-right':'-250px'});
			}
			regpanel.delay(900).fadeIn();
		} else {
			$('#loginpanel').show();
			lgnpanel.show();
			lgnpanel.addClass('visible').animate({'margin-right':'0px'});
		}	
		return false;	
	});
	
$('#opener2, #showregister').on('click', function(e) {
		e.preventDefault();
		var lgnpanel = $('#slide-panel');
		var regpanel = $('#slide-panel2');
		if (lgnpanel.hasClass("visible")) {
			if(!isMob){
				lgnpanel.removeClass('visible').animate({'margin-right':'-400px'});
			}
			else{
				lgnpanel.removeClass('visible').animate({'margin-right':'-250px'});
			}
		}
		lgnpanel.hide();
		if (regpanel.hasClass("visible")) {
			$('#registerpanel').hide();
			if(!isMob){
				regpanel.removeClass('visible').animate({'margin-right':'-400px'});
			}
			else{
				regpanel.removeClass('visible').animate({'margin-right':'-250px'});
			}
			lgnpanel.delay(900).fadeIn();
		} else {
			$('#registerpanel').show();
			regpanel.show();
			regpanel.addClass('visible').animate({'margin-right':'0px'});
		}	
		return false;	
	});
