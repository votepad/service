$(window).load(function(){
  $('.input-area').each(function(){
    /* checking textarea  */
    if ( $(this).hasClass('input-textarea') && $(this).val() != "") { resize($(this)); $(this).parent().children('.input-label').addClass('active'); }
    /* checking text value  */
    if ( $(this).attr('type') == "text" && $(this).val() != "") { $(this).parent().children('.input-label').addClass('active'); }
  });
});

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


/*
** Animate CSS
*/
$.fn.extend({
  animateCss: function (animationName) {
    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    this.addClass('animated ' + animationName).one(animationEnd, function() {
        $(this).removeClass('animated ' + animationName);
    });
  }
});


/**
 * Jquery Waiting Element
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
      if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {
        $img.css('transform', "translate3D(-50%," + parallax + "px, 0)");
      }

    }

    // Wait for image load
    $this.children("img").one("load", function() {
      updateParallax(true);
    }).each(function() {
      if(this.complete) $(this).load();
    });

    $(window).scroll(function() {
      window_width = $(window).width();
      updateParallax(false);
    });

    $(window).resize(function() {
      window_width = $(window).width();
      updateParallax(false);
    });

  });
});


/*
**  Select Btn Scripts
*/
$('select.select_btn').each(function(){
  var $select = $(this);

  var selectBoxContainer = $('<div>',{
  	width		: $select.parent('.select_wrapper', $select).outerWidth(),
  	class	: 'select_btn_area',
  	html		: '<div class="select_btn_text"></div>',
  });

  var dropDown = $('<ul>',{
    class:'select_btn_list',
    name: $select.attr('name'),
  });

  var selectBox = selectBoxContainer.find('.select_btn_text');

  $select.find('option').each(function(i){
  	var option = $(this);

    // creating btn
  	if(option.data('btn')){
  		selectBox.append(option.data('btn'));
  	}

  	// creating dropdown list
    if ( option.data('icon') != undefined ) {
      var li = $('<li class="' + option.data('class') + '"><i class="fa ' + option.data('icon') + '" aria-hidden="true"></i>' + '<span>' + option.data('text') + '</span></li>');
    } else {
      var li = $('<li class="' + option.data('class') + '">' + option.data('text') + '</li>');
    }


    // change select
  	li.click(function(){
  		dropDown.trigger('hide');
  		$select.val(option.val());
  		return false;
  	});

  	dropDown.append(li);
  });

  selectBoxContainer.append(dropDown.hide());
  $select.hide().after(selectBoxContainer);

  dropDown.bind('show',function(){
    $('.select_btn_text + .select_btn_list').each(function(){ $('.select_btn_list').css('display','none'); })

  	if(dropDown.is(':animated')){
  		return false;
  	}

  	selectBox.addClass('expanded');
  	dropDown.slideDown();

  }).bind('hide',function(){

  	if(dropDown.is(':animated')){
  		return false;
  	}

  	selectBox.removeClass('expanded');
  	dropDown.slideUp();

  }).bind('toggle',function(){
  	if(selectBox.hasClass('expanded')){
  		dropDown.trigger('hide');
  	}
  	else dropDown.trigger('show');
  });

  selectBox.click(function(){
  	dropDown.trigger('toggle');
  	return false;
  });


  $(document).click(function(){
  	dropDown.trigger('hide');
  });

});


/*
** Inputes Fields
*/
$(function(){
$('.input-area').each(function(){
  if ($(this).attr('length')) {
    $(this).closest('.input-field').append('<span class="counter"></span>')
  }
});
$('.input-area').on('focus', function() {
  if ( $(this).val() == "") {
    $(this).closest('.input-field').find('.input-label').addClass('active');
    var max_len = parseInt($(this).attr('length'));
    if( $(this).hasClass('nwe_site') ) max_len = max_len -  14;
    $(this).closest('.input-field').find(".counter").append("0/" + max_len);
  }
});
$('.input-area').blur(function() {
  if ( $(this).val() == "" && ! $(this).attr('placeholder')) {
      $(this).closest('.input-field').find('.input-label').removeClass('active');
      $(this).closest('.input-field').find(".counter").empty();
  }
});
$('.input-area').keyup(function() {
  var cur_len = $(this).val().length;
  var max_len = parseInt($(this).attr('length'));
  if( $(this).hasClass('nwe_site') ) {
    if( cur_len >= 14 ) cur_len = cur_len - 14;
    max_len = max_len -  14;
  }

  $(this).closest('.input-field').find(".counter").empty().append(cur_len + "/" + max_len);

});
$('[type="checkbox"]').focus(function(){ $(this).addClass('focus'); });
$('[type="checkbox"]').blur(function(){ $(this).removeClass('focus'); });
$('[type="checkbox"]').click(function(){ $(this).removeClass('focus'); });
$('.input-textarea').on('init keyup focus', function(){resize($(this));});


});


/*
** Authorization Form
** Forget Password Form
*/
$(function(){

  function validateEmail(email) {
    var re = /^([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)$/;
    return re.test(email);
  }
  function validatePassword(password) {
    if (password < 6) {
      return false;
    } else {
      return true;
    }
  }
  $('body').on('blur','.sign_in_form #email',function(){
    if (validateEmail($(this).val()) == false) {
      $(this).addClass('invalid');
    } else {
      $(this).removeClass('invalid');
    }
  });
  $('body').on('blur','.sign_in_form #password',function(){
    if (validatePassword($(this).val().length) == false) {
      $(this).addClass('invalid');
    } else {
      $(this).removeClass('invalid');
    }
  });


  $('body').on('click','#sign_in',function(){
      check_sign_in();
  });
  $('body').on('keyup','.sign_in_form', function(event){
    if (event.keyCode == 13)
      check_sign_in();
  });

  function check_sign_in() {
    var $form = $('.sign_in_form');
    var vaild = true;
    if (validateEmail($('#email', $form).val()) == false) {
      $('#email', $form).addClass('invalid');
      vaild = false;
    } else {
      $('#email', $form).removeClass('invalid');
    }

    if (validatePassword($('#password', $form).val().length) == false) {
      $('#password', $form).addClass('invalid');
      vaild = false;
    } else {
      $('#password', $form).removeClass('invalid');
    }
    if (vaild == true) {
      $form[0].submit();
    }
  }


  $('body').on('blur','.forget_password_form #email',function(){
    if (validateEmail($(this).val()) == false) {
      $(this).addClass('invalid');
    } else {
      $(this).removeClass('invalid');
    }
  });

  $('body').on('click','#forget_password',function(){
    var $form = $('.forget_password_form');
    var vaild = true;
    if (validateEmail($('#email', $form).val()) == false) {
      $('#email', $form).addClass('invalid');
      vaild = false;
    } else {
      $('#email', $form).removeClass('invalid');
    }

    var response = grecaptcha.getResponse();
    console.log(response.length);
    if (response.length == 0) {
      valid = false;
    }

    if (vaild == true) {
      $form[0].submit();
    }
  });

  $('body').on('click','#to_forget_password_form',function(){
    $('.sign_in_form').removeClass('displayblock').addClass('displaynone');
    $('.forget_password_form').removeClass('displaynone').addClass('displayblock');
  });

  $('body').on('click', '#to_sign_in_form',function(){
    $('.forget_password_form').removeClass('displayblock').addClass('displaynone');
    $('.sign_in_form').removeClass('displaynone').addClass('displayblock');
  });
});
