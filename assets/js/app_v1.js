/*
 *  Document Ready Function
*/

$(document).ready(function(){

    var start_on_small = false;
    if ($('body').width() + 17 < 992){
        start_on_small = true;
    }



    /*
     *  Get Page Link and Add Class to Link
    */
    var address = window.location.pathname.split('/');
    address1 =   '/' + address[1] + '/' + address[2] + '/' + address[3];
    address2 =   '/' + address[1] + '/' + address[2] + '/' + address[3] + '/' + address[4];
    $('.header_menu .header_button').each(function(){
        var temp = $(this).attr('href').split('/');
        temp = new RegExp(temp[1] + '/' + temp[2] + '/' + temp[3]);
        if ( temp.test(address1) ) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
    $('.jumbotron_nav .jumbotron_nav-btn').each(function(){
        var temp = $(this).attr('href').split('/');
        temp = new RegExp(temp[1] + '/' + temp[2] + '/' + temp[3] + '/' + temp[4]);
        if ( temp.test(address2) ) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });



     /*
      *  Show header_menu block
     */

     $('.header_menu').animateCss('fadeIn');
     $('.header_menu').css('opacity','1');


     /*
      *  Call 'header_menu_fun' for creating header_menu and navleft elements
     */
     var header_menu_nav_items = create_header_menu_elements();
     header_menu_fun();



     /*
      *  Window Resize Function
      *
      *  Call 'header_menu_fun' for updating elements in header_menu and navleft
     */

     $(window).resize(function(){

         header_menu_fun();

     });



     /*
      *  Open header_menu on tablet and mobile versions
     */

     $('#open_header_menu').click(function(){
         if ( ! $('.jumbotron_nav').hasClass('open') && ! $('.header_menu').hasClass('open') ) {
             $('body').addClass('hidden').append('<div class="backdrop"></div>');
         }
         $('.jumbotron_nav').removeClass('open');
         $('.header_menu').addClass('open');
     });



     /*
      *  Open jumbotron_nav on mobile versions
     */

     $('#open_jumbotron_nav').click(function(){
         if ( ! $('.jumbotron_nav').hasClass('open') && ! $('.header_menu').hasClass('open') ) {
             $('body').addClass('hidden').append('<div class="backdrop"></div>');
         }
         $('.header_menu').removeClass('open');
         $('.jumbotron_nav').addClass('open');
     });


     /*
      *  Close header_menu && jumbotron_nav
     */

     $('body').on('click', '.backdrop', function(){
         $('body').removeClass('hidden').removeClass('mobile-open');
         $('.header_menu').removeClass('open');
         $('.jumbotron_nav').removeClass('open');
         $(this).remove();
     });


     /*
      *  Header On hover open/close
     */
     $('.header_menu-dropdown').mouseover(function () {
         $(this).addClass('open');
     });
     $('.header_menu-dropdown').mouseout(function () {
         $(this).removeClass('open');
     });


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
                $(this).removeClass().addClass('card card-md clear_fix')
             });
         } else if ( $('body').width() + 17 < 680 ) {
             $('.card').each(function () {
                $(this).removeClass().addClass('card card-sm clear_fix')
             });
         } else {
             $('.card').each(function () {
                $(this).removeClass().addClass('card clear_fix')
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
      *  Functions
      *  - header_menu_fun()     -  creating and updating header_menu and navleft elements
      *
     */




     /*
      *   Create Header_Menu Dropdown
      *
      *   @var header_menu_nav_items
     */

     function header_menu_fun() {

         if ( $('body').width() + 17 > 992 && start_on_small == true){
             header_menu_nav_items = create_header_menu_elements();
             start_on_small = false;
             var count = 0;
             for (var i = 0; i < header_menu_nav_items.length; i++) {
                 if ( header_menu_nav_items[i].class == "header_global header_button dropdown-button") {
                     count += 1;
                 }
             }
             header_menu_nav_items.splice(0,count);
         }

         /*
          *  Vars
         */
         var
            header_menu_width = $('.header_menu').width(), // curent width of header_menu
            header_menu_nav_width = 80,  // width of header_menu_elements,  65 - min width for last element
            header_menu_elements = '',  // elements which shows in header_menu
            header_menu_dropdown = '',  // header_dropdown block
            header_menu_dropdown_elements = '', // elements which shows in header_dropdown block
            header_menu_dropdown_pull_right,  // for style - right: __px
            seperator = '',
            temp = true;  // temp - boolean for seperate elements from header_menu_nav_items to header_menu_elements and header_menu_dropdown_elements


         $('.header_menu').empty();

         /*
          * Add quick navigation on mobile vetsion
         */
         if ( $('body').width() + 17 < 681 ){
             var
                dropdown_global = '',
                temp;

            if ( $('.header_menu-dropdown .header_auth').hasClass('header_auth') ) {

                dropdown_global = '<a class="header_global header_button" data-toggle="modal" data-target="#auth_modal" style="margin:20px 0;">Авторизация</a>';
                $('.header_menu').append(dropdown_global);

            } else {

                $('.header_menu-dropdown .dropdown-menu .header_button').each(function(){
                    dropdown_global = dropdown_global +'<a href="' + $(this)[0]['href'] + '" class="header_global ' + $(this)[0]['className'] + '">' + $(this).html() + '</a>';
                });
                $('.header_menu').append('<p class="header_text header_text-title">Быстрая навигация</p><div class="divider"></div>' + dropdown_global);

            }


         }


         /*
          *  Creating header_menu_elements and header_menu_dropdown_elements
         */

         for (var i = 0; i < header_menu_nav_items.length; i++) {

             if ( temp && (header_menu_nav_width + header_menu_nav_items[i].width) < header_menu_width) {
                 header_menu_nav_width = header_menu_nav_width + header_menu_nav_items[i].width;
                 header_menu_elements = header_menu_elements + '<a href="' + header_menu_nav_items[i].href + '" class="' + header_menu_nav_items[i].class + '">' + header_menu_nav_items[i].html + '</a>';
             }

             else{
                 temp = false;
                 var temp_span = $.trim(header_menu_nav_items[i].html);
                 header_menu_dropdown_elements = header_menu_dropdown_elements + '<a href="' + header_menu_nav_items[i].href + '" class="' + header_menu_nav_items[i].class + ' dropdown-button">' + temp_span.substr(0,24) + ' dropdown-text' + temp_span.substr(24,temp_span.length) + '</a>';
             }

         }

         if ($('body').width() + 17 > 992){
             /*
              *  Add pull-right width for header_menu_dropdown_pull_right
              *
              *  @var header_menu_width
              *  @var header_menu_nav_width
             */

             header_menu_dropdown_pull_right = header_menu_width - header_menu_nav_width;


             /*
              *  Checking header_menu_dropdown_elements for empty
              *
              *  @var header_menu_dropdown_elements
             */

             if (header_menu_dropdown_elements != '') {

                 header_menu_dropdown = '<div class="dropdown"><a id="header_menu_dropdown" class="header_button dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="header_text">Ещё</span><i class="fa fa-caret-down header_icon" aria-hidden="true"></i></a><div class="dropdown-menu pull-right" style="right:' + header_menu_dropdown_pull_right + 'px" aria-labelledby="header_menu_dropdown">' + header_menu_dropdown_elements + '</div></div>';

             }

             $('.header_menu').append(header_menu_elements + header_menu_dropdown);

         } else {

             $('.header_menu').append('<p class="header_text header_text-title">Навигация</p><div class="divider"></div>' + header_menu_elements + header_menu_dropdown_elements);

         }

     }



     /*
      *  Create Header Menu Elements
      *
      *  @var header_menu_nav_items  -  array of header_menu elements
      *  @var temp
     */
     function create_header_menu_elements() {

      var
         temp_header_menu_nav_items = [],
         temp;


      /*
       *  Create header_menu_nav_items array
      */

      $('.header_menu .header_button').each(function(){

          temp = {
              html: $(this).html(),
              href: $(this)[0]['href'],
              class: $(this)[0]['className'],
              width: $(this).width() + 36
          }

          temp_header_menu_nav_items.push(temp);

      });

      return temp_header_menu_nav_items;

    }

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
 *  Bootstrap Notify Defaults Settings
 *
 *  simple example: $.notify$.notify( { message: 'Error' },{ type: 'danger' });
*/

$.notifyDefaults({
    template:   '<div data-notify="container" class="col-xs-10 col-sm-6 col-md-4 col-lg-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="font-size:20px;">×</button>' +
    		'<span data-notify="icon"></span> ' +
    		'<span data-notify="title">{1}</span> ' +
    		'<span data-notify="message">{2}</span>' +
    		'<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
    		'<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>',
    offset: {
        x: 20,
        y: 60,
    },
	delay: 2000,
});




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

        if ($(this).attr('length') ) {

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

});
