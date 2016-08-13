$(document).ready(function(){
  $('.vk').hover(function(){$('.vk i').css("color","#4c75a3");}, function(){$('.vk i').css("color","#656565");});
  $('.facebook').hover(function(){$('.facebook i').css("color","#3b5998");}, function(){$('.facebook i').css("color","#656565");});
  $('.twitter').hover(function(){$('.twitter i').css("color","#35b0ed");}, function(){$('.twitter i').css("color","#656565");});
  /* add likes */
  $('.fav').on('click', function(){
    if ( $("i", this).hasClass('active') ) {
      $("i", this).removeClass('active');
    }
    else {
      $("i", this).addClass('active');
    }
  });
});