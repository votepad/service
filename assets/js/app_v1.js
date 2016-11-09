/*
 * Animate CSS
*/
$.fn.extend({

    animateCss: function (animationName) {

        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });

    }

});



/*
 *  Change Collapse Icon (plus/minus)
*/

$(document).on('click', 'a[data-toggle="collapse"]', function(){

  if ( $(this).hasClass('collapsed') && $(this).children().hasClass('fa-plus') ) {
      $(this).children('.fa-plus').removeClass('fa-plus').addClass('fa-minus');
  }

  else{
      $(this).children('.fa-minus').removeClass('fa-minus').addClass('fa-plus');
  }

});



/*
 *  Refresh Date in Block
*/

$(document).on('click', 'a[data-toggle="refresh"]', function(){

  $block = $(this).closest('.block');
  $block.addClass('whirl');

  $(document).ajaxComplete(function(){
      $block.removeClass('whirl');
  });

});



/*
 * Inputes Fields  -
*/

$(function(){

  /*
   * Inpute
  */


  $('input').each(function(){

    if ($(this).attr('placeholder') || $(this).val() != '') {

      if ( ! $(this).next('label').hasClass('icon-label') ) {
          $(this).next('label').addClass('active');
      }

    }

    if ($(this).attr('length')) {
      $(this).closest('.input-field').append('<span class="counter"></span>')
    }

  });



  $('input').on('focus', function() {

    if ( $(this).val() == "") {

      if ( ! $(this).next('label').hasClass('icon-label') ) {
          $(this).next('label').addClass('active');

          var max_len = parseInt($(this).attr('length'));

          if( $(this).hasClass('nwe_site') )
              max_len = max_len -  14;

          $(this).closest('.input-field').find(".counter").append("0/" + max_len);

      }

    }

  });



  $('input').blur(function() {

    if ( $(this).val() == "" && ! $(this).attr('placeholder')) {

        $(this).next('label').removeClass('active');
        $(this).closest('.input-field').find(".counter").empty();

    }

  });



  $('input').keyup(function() {

    var cur_len = $(this).val().length;
    var max_len = parseInt($(this).attr('length'));

    if( $(this).hasClass('nwe_site') ) {

        if( cur_len >= 14 ) cur_len = cur_len - 14;
        max_len = max_len -  14;

    }

    $(this).closest('.input-field').find(".counter").empty().append(cur_len + "/" + max_len);

  });




  /*
   * Textarea
  */
  $('.input-textarea').on('init keyup focus', function(){resize($(this));});


  /*
   * Options
  */



  /*
   * Checkbox
  */
  $('[type="checkbox"]').focus(function(){ $(this).addClass('focus'); });
  $('[type="checkbox"]').blur(function(){ $(this).removeClass('focus'); });
  $('[type="checkbox"]').click(function(){ $(this).removeClass('focus'); });


  /*
   * Select
  */


  /*
   * Select 2
  */



});
