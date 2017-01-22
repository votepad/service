$(document).ready(function(){
  $(".eventsToUser").select2({language: "ru"});

  /*
  ** Submit form
  */
  $('.submit_btn').click(function () {
    var $invalid = false;
    var form = $(this).closest('form');

    $('input.input-area', form).each(function() {
      if ( $(this).val() == "" ) {
        $(this).addClass('invalid');
        $invalid = true;
      }

      if ( $(this).hasClass('invalid') )
        $invalid = true;
    });

    if ( $('.select2-selection.select2-selection--multiple', form).hasClass('invalid') ){
      $invalid = true;
    } else {
      if ( $('.select2-selection__choice', form).length == 0) {
        $('.select2-selection.select2-selection--multiple', form).addClass('invalid');
        $('.select2 + label', form).css('color','#F44336');
      }
    }


    if ( $invalid == false ) {
      form[0].submit();
    }
  });

  /*
  ** Validation
  */

  $(".position").blur( function(){
    if ( $(this).val() == "" ) {
      $(this).addClass('invalid');
    } else {
      $(this).removeClass('invalid');
    }
  });

  $('body').on('focus', '.select2-selection__rendered', function(){
    $(this).parent().parent().parent().parent().children('label').addClass('active');
    if ( $('li', this).length - 1 == 0) {
      $(this).parent().addClass('invalid');
      $(this).parent().parent().parent().parent().children('label').css('color','#F44336');
    } else {
      $(this).parent().removeClass('invalid');
      $(this).parent().parent().parent().parent().children('label').css('color','#616161');
    }
  });

  $("#position").inputmask({
    mask: '*{1,50}',
    showMaskOnHover: false,
    showMaskOnFocus: false,
    oncomplete: function(){
      $(this).removeClass("invalid");
    },
    onincomplete: function(){
      $(this).addClass("invalid");
    }
  });

  $("#username").inputmask({
    mask: '*{1,} *{1,} *{1,}',
    showMaskOnHover: false,
    showMaskOnFocus: false,
    oncomplete: function(){
      $(this).removeClass("invalid");
    },
    onincomplete: function(){
      $(this).addClass("invalid");
    }
  });
  $("#email").inputmask({
    alias: "email",
    showMaskOnHover: false,
    showMaskOnFocus: true,
    oncomplete: function(){
      $(this).removeClass("invalid");
    },
    onincomplete: function(){
      $(this).addClass("invalid");
    }
  });



  /*
  ** New User Btn Show/Hide
  */
  $('button[data-target="#newuser"]').click(function(){ $(this).addClass('displaynone'); });
  $('#canselnewUser').click(function(){
    $('button[data-target="#newuser"]').removeClass('displaynone');
    var form = $(this).closest('form');
    form[0].reset();
    $('.input-area', form).each(function(){
      $(this).removeClass('invalid');
    });
    $('.input-label', form).each(function(){
      $(this).removeClass('active');
    });
    $('.counter', form).each(function(){
      $(this).empty();
    });
    $('.select2-selection.select2-selection--multiple', form).removeClass('invalid');
    $('.select2 + label', form).css('color','#9e9e9e');
    $('.select2-selection__choice', form).remove();

  });

});
