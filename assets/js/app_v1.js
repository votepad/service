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
 * On load Page
*/
$(window).on('load', function(){

    /*
     *  Input, textarea
    */
    $('input, textarea').each(function(){

      if ( $(this).attr('placeholder') || $(this).val() != '') {
        if ( ! $(this).next('label').hasClass('icon-label') ) {
            $(this).next('label').addClass('active');
        }
      }

      if ($(this).attr('length') ) {
          $(this).closest('.input-field').append('<span class="counter" style="right:15px; top:-10px"></span>');
      }
    });


    /*
     * Textarea
    */
    $('textarea').each(function(){
        resize($(this));
    });


    /*
     *  Switch
    */
    $('.switch label input[type=checkbox][disabled]').each(function(){
        $(this).parent().css('cursor','default');
    });

});




/*
 * Inputes Fields
*/

$(function(){

  /*
   * Input, textarea
  */
  $('input, textarea').on('focus', function() {

    if ( $(this).val() == "") {
      if ( ! $(this).next('label').hasClass('icon-label') ) {
          $(this).next('label').addClass('active');
          var max_len = parseInt($(this).attr('length'));

          if ( $(this).hasClass('nwe_site'))  // http://nwe.ru/
              max_len = max_len -  14;

          $(this).closest('.input-field').find(".counter").append("0/" + max_len);
      }
    }

  });

  $('input, textarea').blur(function() {

    if ( $(this).val() == "" && ! $(this).attr('placeholder')) {
        $(this).next('label').removeClass('active');
        $(this).closest('.input-field').find(".counter").empty();
    }

  });

  $('input, textarea').keyup(function() {

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
  $('textarea').on('init keyup focus', function(){
      resize($(this));
  });


  /*
   * Checkbox
  */
  $('input[type="checkbox"], input[type="radio"]').focus(function(){
      $(this).addClass('focus');
  });

  $('input[type="checkbox"]').on('blur click', function(){
      $(this).removeClass('focus');
  });

  $('input[type="checkbox"]').on('click', function(){
      if ( $(this).is(':checked') == true ) {
          $(this).removeClass('invalid');
      } else if ( $(this).attr('required') ){
          $(this).addClass('invalid');
      }
  });


  /*
   * Radio
  */

  $('input[type="radio"]').on('blur click', function(){
      $(this).removeClass('focus');
  });

});


/*
 * Resize Textarea Size
*/
function resize(el) {
    var ta;
    Array.prototype.forEach.call(el.length ? el : [el], function (x) {
        ta = x;
    });
    var originalHeight = parseInt(el.height());
    ta.style.height = 'auto';
    var endHeight = ta.scrollHeight;

    if (originalHeight == endHeight) {
        ta.style.height = endHeight + 'px';
    } else {
        el.height(originalHeight);
        el.animate({
            height: endHeight
        }, 50);
    }
}
