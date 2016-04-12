$(document).ready(function() {
  $('#fullpage').fullpage({
    anchors: ['Welcome', 'About', 'Organizator', /*'Customer', 'Review',*/ 'Feedback'],
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
});