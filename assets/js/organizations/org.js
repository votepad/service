$(document).ready(function(){

/*
**  Tooltip Template
*/

$('[data-toggle="tooltip"]').tooltip({
  template: '<div class="tooltip" role="tooltip"><div class="tooltip-inner"></div></div>'
});

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
