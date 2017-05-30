$(document).ready(function() {
	var navoffset=$('nav').offset().top;
	$(window).scroll(function(){
		var scrollT=$(window).scrollTop();
		if(scrollT>=navoffset){
			$('nav').addClass('fix');
		}else{
			$('nav').removeClass('fix');
		}
	});

	
});
