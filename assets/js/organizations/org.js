$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip({
    template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
  });

  var urlPage = location.href;

  var settings = /setting/;
  var active_org_set_tab = urlPage.match(settings);

  if (active_org_set_tab) {
    $('.org-nav a:nth-child(1)').removeClass('active');
    $('.org-nav a:nth-child(2)').addClass('active');
  } else {
    $('.org-nav a:nth-child(2)').removeClass('active');
    $('.org-nav a:nth-child(1)').addClass('active');
  }

  

});
