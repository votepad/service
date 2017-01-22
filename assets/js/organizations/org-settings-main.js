$(document).ready(function(){
  /*
  ** Checkong Validation
  */
  function checking_el_valid($el, status) {
    if (status == "valid" ) {
      $el.removeClass('invalid');
    } else if ( status == "invalid" ) {
      $el.addClass('invalid');
    }
  }

  /*
  ** Submit form
  */
  $('#submit_btn').click(function () {
    var $invalid = false;
    var form = $('#update_main_info');

    $('input.input-area', form).each(function() {
      if ( $(this).val() == "" ) {
        $(this).addClass('invalid');
        $invalid = true;
      }

      if ( $(this).hasClass('invalid') )
        $invalid = true;
    });

    if ( $invalid == false ) {
      form[0].submit();
    }
  });

  /*
  ** Validation
  */

  $("#org_name").inputmask({
    mask: '*{1,60}',
    definitions: {
      '*': {
        validator: "[a-zA-Z0-9а-яА-Я№ ]",
      }
    },
    showMaskOnHover: false,
    showMaskOnFocus: false,
    oncomplete: function(){
      checking_el_valid($(this), "valid");
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });

  $("#official_org_site").inputmask({
    mask: '[\\http]|[\\http\\s]://*{1,}.a{2,}',
    definitions: {
      '*': {
        validator: "[a-zA-Zа-яА-Я0-9-]",
      },
      'a': {
        validator: "[a-zA-Zа-яА-Я0-9-_.~!*'();:@&=+$,/?#]",
      },
    },
    showMaskOnHover: false,
    showMaskOnFocus: true,
    positionCaretOnClick: "none",
    oncomplete: function(){
      checking_el_valid($(this), "valid");
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });
  $('#confirmrools').click(function(){
    if ( $(this).prop('checked') == true) {
      checking_el_valid($(this), "valid");
    } else {
      checking_el_valid($(this), "invalid");
    }
  });

});
