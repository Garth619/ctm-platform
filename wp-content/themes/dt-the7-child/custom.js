jQuery(document).ready(function($){


$('a.header-elements-button-1').removeAttr("href");

$('.vc_custom_1553121858616, a.header-elements-button-1').on('click', function(e) {
  
  $('.mygform_overlay').fadeIn(300);
  
  $('.mygform_overlay').addClass('open');
  
});


$('.mygform_close').on('click', function(e) {
	
	$('.mygform_overlay').fadeOut(300);
	
	$('.mygform_overlay').removeClass('open');
  
});





/*
$(document).click(function (e){

		var container = $(".mygform_overlay.open");

		if (!container.is(e.target) && container.has(e.target).length === 0){

			$('.mygform_inner_overlay').fadeOut();
		
		}

	}); 
*/



}); // Document Ready

