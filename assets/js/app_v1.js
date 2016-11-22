/*
 *  Document Ready Function
*/

$(document).ready(function(){

    /*
     *  Header Menu And Left Navigation
     *
     *  @var header_menu_nav_items  -  array of header_menu elements
     *  @var leftnav_elements_curent   -   array of navleft elements
     *  @var temp
    */

     var
        header_menu_nav_items = [],
        leftnav_elements_curent = $('.navleft_wrapper').html(),
        temp;


     /*
      *  Create header_menu_nav_items array
     */

     $('.header_menu .nav .nav_item').each(function(i){

         temp = {
             html: $(this).html(),
             width: $(this).width()
         }

         header_menu_nav_items.push(temp);

     });


     /*
      *  Show header_menu block
     */

     $('.header_menu .nav').animateCss('fadeIn');
     $('.header_menu .nav').css('opacity','1');


     /*
      *  Call 'header_menu_leftnav_fun' for creating header_menu and navleft elements
     */

     header_menu_leftnav_fun();



     /*
      *  Window Resize Function
      *
      *  Call 'header_menu_leftnav_fun' for updating elements in header_menu and navleft
     */

     $(window).resize(function(){

         header_menu_leftnav_fun();

     });



     /*
      *
     */

     $('#open_leftnav').click(function(){

        $('body').addClass('hidden').append('<div class="navleft-open_back"></div>');
        $('.navleft').addClass('open');

     });

     $('body').on('click', '.navleft-open_back', function(){

         $('body').removeClass('hidden')
         $('.navleft').removeClass('open');
         $(this).remove();

     });








     /*
      *  Functions
      *
      *  - header_menu_leftnav_fun()     -  creating and updating header_menu and navleft elements
      *  - textarea_resize()     -  resize textarea height
     */




     /*
      *   Create Header_Menu Dropdown
      *
      *   @var header_menu_nav_items
     */

     function header_menu_leftnav_fun() {

         /*
          *  Vars
         */
         var
            header_menu_width = $('.header_menu .nav').width(), // curent width of header_menu
            header_menu_nav_width = 65,  // width of header_menu_elements,  65 - min width for last element
            header_menu_elements = '',  // elements which shows in header_menu
            header_menu_dropdown = '',  // header_dropdown block
            header_menu_dropdown_elements = '', // elements which shows in header_dropdown block
            header_menu_dropdown_pull_right,  // for style - right: __px
            temp = true;  // temp - boolean for seperate elements from header_menu_nav_items to header_menu_elements and header_menu_dropdown_elements


         $('.header_menu .nav').empty();


         /*
          *  Creating header_menu_elements and header_menu_dropdown_elements
         */

         for (var i = 0; i < header_menu_nav_items.length; i++) {

             if ( header_menu_nav_width + header_menu_nav_items[i].width < header_menu_width && temp) {

                 header_menu_nav_width = header_menu_nav_width + header_menu_nav_items[i].width;
                 header_menu_elements = header_menu_elements + "<li class='nav_item'>" + header_menu_nav_items[i].html + "</li>";

             }

             else{

                 temp = false;
                 header_menu_dropdown_elements = header_menu_dropdown_elements + "<li class='nav_item'>" + header_menu_nav_items[i].html + "</li>";

             }

         }


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

             header_menu_dropdown = '<div class="nav_item dropdown"><a id="header_menu_dropdown" class="nav_link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="header_text">Ещё</span><i class="fa fa-caret-down header_icon" aria-hidden="true"></i></a><ul class="dropdown-menu pull-right" style="right:' + header_menu_dropdown_pull_right + 'px" aria-labelledby="header_menu_dropdown">' + header_menu_dropdown_elements + '</ul></div>';

         }


         /*
          *  Append header_menu_elements and header_menu_dropdown to header_menu block
          *
          *  @var header_menu_elements
          *  @var header_menu_dropdown
         */

         $('.header_menu .nav').append(header_menu_elements + header_menu_dropdown);



         /*
          *   Create NavLeft Element
          *
          *   @var  header_menu_elements
          *   @var  header_menu_dropdown_elements
          *   @var  leftnav_elements_curent
         */

         $('.navleft_wrapper').empty();

         if ($('body').width() + 17 < 992){

             $('.navleft_wrapper').append('<li class="nav_item"><p class="nav_text">Основные ссылки</p></li>' + header_menu_elements + header_menu_dropdown_elements + '<li role="separator" class="divider"></li>' + leftnav_elements_curent);

         } else{

             $('.navleft_wrapper').append(leftnav_elements_curent);

         }

     }




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


});








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

        //textarea_resize($(this));

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
