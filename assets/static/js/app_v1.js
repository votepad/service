/*
 *  Document Ready Function
*/

$(document).ready(function(){



     /*
      *   Show/Hide Cards Dropdown Menu
     */
     $('.card_title-dropdown').mouseover(function () {
         $(this).addClass('open');
     });
     $('.card_title-dropdown').mouseout(function () {
         $(this).removeClass('open');
     });
     $('.card_title-dropdown-icon').click(function () {
         if ( ! $(this).parent().hasClass('open')) {
             $(this).parent().addClass('open');
         } else{
             $(this).parent().removeClass('open');
         }
     });


    /*
     *  Changing cards Style
    */
     change_card_style();
     function change_card_style() {
         if ( $('body').width() + 17 < 992 && $('body').width() + 17 > 680 ) {
             $('.card').each(function () {
                $(this).removeClass().addClass('card card-md clear-fix')
             });
         } else if ( $('body').width() + 17 < 680 ) {
             $('.card').each(function () {
                $(this).removeClass().addClass('card card-sm clear-fix')
             });
         } else {
             $('.card').each(function () {
                $(this).removeClass().addClass('card clear-fix')
             });
         }
     }

     $(window).resize(function() {
         change_card_style();
     });

     $('.card_title-text').click(function(){
         $(this).closest('.card').addClass('open');
     });


     /*
      * Remove Hidden class from long text in Cards
     */

     $('body').on('click', '.card_content-text-hidden', function(){
         $(this).parent().removeClass().addClass('card_content-text');
         $(this).remove();
     });



    /*
    * Input, textarea
    */
    $('input, textarea').on('focus', function() {

     if ( $(this).val() == "") {
        if ( ! $(this).next('label').hasClass('icon-label') ) {
            $(this).next('label').addClass('active');
            var max_len = parseInt($(this).attr('maxlength'));

            $(this).closest('.input-field').find(".counter").empty().append("0/" + max_len);
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

     var cur_len = $(this).val().length,
         max_len = parseInt($(this).attr('maxlength'));

     $(this).closest('.input-field').find(".counter").empty().append(cur_len + "/" + max_len);

    });

    /*
    * Textarea
    */
    $('textarea').on('init keyup focus', function(){
       textarea_resize($(this));
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

    /*
    * Radio
    */

    $('input[type="radio"]').on('blur click', function(){
       $(this).removeClass('focus');
    });

});




/*
 *   Resize Textarea Size
 *
 *   @var element
*/

function textarea_resize(element) {
    /*
     *  Vars
    */
    var
        textarea,
        originalHeight,
        endHeight;


    Array.prototype.forEach.call(element.length ? element : [element], function (x) {
        textarea = x;
    });

    originalHeight = parseInt(element.height());

    textarea.style.height = 'auto';

    endHeight = textarea.scrollHeight;

    if (originalHeight == endHeight) {

        textarea.style.height = endHeight + 'px';

    } else {

        element.height(originalHeight);

        element.animate({

            height: endHeight

        }, 50);

    }

}







/*
 *  Animate CSS - function for adding and remove class for animated element
 *
 *  @var AnimationClassName
 *
 *  example: $(element).animateCss('fadeIn');
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
 *  Jquery Waiting Element function
 *
 *  @var delay
 *
 *  example: $(element).wait(500).removeClass('open');
*/


(function ($) {
  $.fn.wait = function(delay) {
      return new jQueryWaiting(this, delay);
  };

  function jQueryWaiting ($el, delay) {
      var item = this;
      this._$el = $el;
      this._Queue = [];
      this._delayCompleted = false;

      if (typeof delay === 'number' && delay < Infinity && delay >= 0 )
          this.timeout = window.setTimeout(function () {
              item._QueueActions();
          }, delay);
      else
          return $el;
  }

  jQueryWaiting.prototype._QueueActions = function(){
      this._delayCompleted = true;
      var next;
      while (this._Queue.length > 0) {
          next = this._Queue.pop();
          this._$el = this._$el[next.fnc].apply(this._$el, next.arg);
      }
      return this;
  };

  jQueryWaiting.prototype._addToQueue = function(fnc, arg){
      this._Queue.unshift({ fnc: fnc, arg: arg });
      if (this._delayCompleted)
          return this._QueueActions();
      else
          return this;
  };

  for (var fnc in $.fn) {
      // Skip Object.prototype and Non-function properties
      if (typeof $.fn[fnc] !== 'function' || !$.fn.hasOwnProperty(fnc))
          continue;

      jQueryWaiting.prototype[fnc] = (function (fnc) {
          return function(){
              // Add methods for elements after Waiting Element
              var arg = Array.prototype.slice.call(arguments);
              return this._addToQueue(fnc, arg);
          };
      })(fnc);
  }
})(jQuery);


/*
**  Parallax Scripts
*/

$(function(){
  var window_width = $(window).width();

  return $('body').find('.parallax').each(function(i) {
    var $this = $(this);

    function updateParallax(initial) {
      var container_height;
      if (window_width < 601) {
        container_height = ($this.height() > 0) ? $this.height() : $this.children("img").height();
      }
      else {
        container_height = ($this.height() > 0) ? $this.height() : 500;
      }
      var $img = $this.children("img").first();
      var img_height = $img.height();
      var parallax_dist = img_height - container_height;
      var bottom = $this.offset().top + container_height;
      var top = $this.offset().top;
      var scrollTop = $(window).scrollTop();
      var windowHeight = window.innerHeight;
      var windowBottom = scrollTop + windowHeight;
      var percentScrolled = (windowBottom - top) / (container_height + windowHeight);
      var parallax = Math.round((parallax_dist * percentScrolled));

      if (initial) {
        $img.css('display', 'block');
      }
      else if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {
        $img.css('transform', "translate3D(-50%," + parallax + "px, 0)");
      }

    }

    // Wait for image load
    $this.children("img").one("load", function() {
        updateParallax(true);
        updateParallax(false);
    }).each(function() {
        if(this.complete) $(this).load();
    });

    $(window).scroll(function() {
        window_width = $(window).width();
        if ( window_width < 600 ) {
            updateParallax(true);
        } else {
            updateParallax(false);
        }
    });

    $(window).resize(function() {
        window_width = $(window).width();
        if ( window_width < 600 ) {
            updateParallax(true);
        } else {
            updateParallax(false);
        }
    });

  });
});










/*   NOT READY   -   NEEDS TO BE MODIFY   */





/*
 *  Document on load Page - dafault options which shoud be done onload window
 *
*/

$(window).on('load', function(){

    /*
     *  Input and Textarea
     *
     *  - adding '.active' for elements which have placeholder or value
     *  - creating 'counter' for elements which have 'lenght' attribute
    */

    $('input, textarea').each(function(){

        if ( $(this).attr('placeholder') || $(this).val() != '') {

            if ( ! $(this).next('label').hasClass('icon-label') ) {
                $(this).next('label').addClass('active');
            }

        }

        if ($(this).attr('maxlength') ) {

            $(this).closest('.input-field').append('<span class="counter" style="right:15px; top:-10px"></span>');
        }
    });



    /*
     *  Textarea
     *  - create height for textarea
     *
     *  @var element
    */

    $('textarea').each( function() {

        textarea_resize($(this));

    });



    /*
     *  Switch
     *
     *  adding default cursor for label of switch
    */

    $('.switch label input[type=checkbox][disabled]').each(function(){

        $(this).parent().css('cursor','default');

    });

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
