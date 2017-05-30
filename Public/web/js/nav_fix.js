$(document).ready(function() {
	var navoffset=234;
	$(window).scroll(function(){
		var scrollT=$(window).scrollTop();
		if(scrollT>=navoffset){
			$('nav').addClass('fix');
		}else{
			$('nav').removeClass('fix');
		}
	});

	
});
