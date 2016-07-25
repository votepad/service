$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
  });


  $('.vk').hover(function(){$('.vk md-icon').css("color","#4c75a3");}, function(){$('.vk md-icon').css("color","#656565");});
  $('.facebook').hover(function(){$('.facebook md-icon').css("color","#3b5998");}, function(){$('.facebook md-icon').css("color","#656565");});
  $('.twitter').hover(function(){$('.twitter md-icon').css("color","#35b0ed");}, function(){$('.twitter md-icon').css("color","#656565");});
  /* add likes */
  $('.fav').on('click', function(){
  	if ( $("md-icon", this).hasClass('active') ) {
  		$("md-icon", this).removeClass('active');
  	}
  	else {
  		$("md-icon", this).addClass('active');
  	}
  });

});