$(document).ready(function() {
  $('#fullpage').fullpage({
    anchors: ['Welcome', 'About', 'Organizator', 'Feedback'],
    menu: '#menu',
    slidesNavigation: true
  });
  
  $('#moveSlideRight').click(function(e){
    e.preventDefault();
    $.fn.fullpage.moveSlideRight();
  });
  
  (function () {
    var removeSuccess;
    removeSuccess = function () {
      return $('.button').removeClass('success');
    };
    $(document).ready(function () {
      return $('.button').click(function () {
        $(this).addClass('success');
        return setTimeout(removeSuccess, 3000);
      });
    });
  }.call(this));
  
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 1000);


  var slideCounter = 0;
  var allow = true;
  var slider = function(){
    $("#slide_"+slideCounter++).fadeToggle("slow", function(){
      $("#slide_"+slideCounter).fadeToggle("slow");
      $("#selector_"+slideCounter).prop('checked',true);
      allow = true;
    });
    allow = false;
    if (slideCounter == 5)
      slideCounter = 0;
  }
  
  var timer = setInterval(slider,10000);
  
  $('.selector input').on('click',function(){
    if (allow == true){
      clearInterval(timer);
      timer = setInterval(slider,10000);
      $("#slide_"+slideCounter).fadeToggle("slow", function(){
        $("#slide_"+slideCounter).fadeToggle("slow");
        allow = true;
      });
      allow = false;
      
      slideCounter = $(this).attr('id')[9];
    }
  });

  $('[data-toggle="tooltip"]').tooltip();

  $('.fa-envelope-o').on('click',function(){
    $(".alert").removeClass("bounceOut").addClass("bounceIn").css("display","block");
    $('.p4').css('background-color', 'rgba(0,0,0,.4)','opacity', '1.07');
    $('.getready').css('-webkit-user-select','none','-moz-user-select','none','-ms-user-select', 'none');
  });
  $('.alert-close').on('click',function(){
    $(".alert").removeClass("bounceIn").addClass("bounceOut");
    $('.p4').css('background-color', '#fff','opacity', '1');
    $('.getready').css('-webkit-user-select','auto','-moz-user-select','auto','-ms-user-select', 'auto');
  });
});