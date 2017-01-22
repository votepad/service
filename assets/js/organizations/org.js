$(document).ready(function(){
  
change_user_menu_tooltip_placement();


$(window).resize(function() {
  change_user_menu_tooltip_placement();
});

/*
**  Tooltip Template
*/

$('[data-toggle="tooltip"]').tooltip({
  template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
});


function change_user_menu_tooltip_placement() {
  if ($(window).width() < 992) {
    $('.user-menu li[data-toggle="tooltip"]').each(function(){
      var text = $(this).attr('data-original-title');
      $(this).tooltip('destroy');
      $(this).tooltip({placement: 'bottom',title: text});
    });
  } else {
    $('.user-menu li[data-toggle="tooltip"]').each(function(){
      var text = $(this).attr('data-original-title');
      $(this).tooltip('destroy');
      $(this).tooltip({placement: 'right',title: text});
    });
  }
}

var urlPage = location.href;

var main = /main/;
var team = /team/;

var check_settings_tab_main = urlPage.match(main);
var check_settings_tab_team = urlPage.match(team);

$('.org-nav a:nth-child(1)').addClass('active');
$('.org-nav a:nth-child(2)').removeClass('active');

if (check_settings_tab_main) {
  $('#topmenu a:nth-child(1)').addClass('active');
  $('.org-nav a:nth-child(1)').removeClass('active');
  $('.org-nav a:nth-child(2)').addClass('active');
} else if (check_settings_tab_team) {
  $('#topmenu a:nth-child(2)').addClass('active');
  $('.org-nav a:nth-child(1)').removeClass('active');
  $('.org-nav a:nth-child(2)').addClass('active');
}

});
