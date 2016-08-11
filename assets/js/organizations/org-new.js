$().ready(function() {
    
  
  //$.validate();
    $('#new_org_logged').validate({
      errorClass: "error-input",
      rules: {
        orgname: "required",
        orgsite: {
          required: true,
          minlength: 3
        },
        orgphone: {
          required: true,
          minlength: 10
        },
        confirmrools: "required"
      },
      messages: {
        orgname: "Пожалуйста, введите название организации",
        orgsite: {
          required: "Пожалуйста, введите название сайта",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов.")
        },
        orgphone: {
          required: "Пожалуйста, введите номер телефона",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов.")
        },
        confirmrools: "Пожалуйста, согласитесь с правилами."
      }
    });

    $('#orgphone').on('blur', function(){
    $('#new_org_logged').validate().element('#orgphone')
});

$('#orgphone').inputmask('+7 (999) 999-9999', {
  onKeyValidation: function(result, opts) {
    alert(result);
  }
});

});