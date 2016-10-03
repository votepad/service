$(document).ready(function(){
  'use strict';
  $('#org_phone').inputmask('+7 (999) 999-9999');

  var update_info = $('#update_main_info').validate({
      errorClass: "error-input",
      rules: {
        org_name: "required",
        org_user: "required",
        email: {
          required: true,
          email: true
        },
        org_phone: "required",
      },
      messages: {
        org_name: "Пожалуйста, введите название организации.",
        org_user: "Пожалуйста, введите данные о доверенном лице.",
        email: {
          required: "Пожалуйста, введите адрес электронной почты.",
          email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
        },
        org_phone: "Пожалуйста, введите номер телефона",
      },
      submitHandler: function(form) {
        if ($('#org_user').val().split(/[\s\.\?]+/).length != 3) {
          update_info.showErrors({
            'org_user': 'Пожалуйста, введите Фамилию Имя Отчeство'
          });
        } else if($("#org_phone").val().replace(/[^+0-9]/gim,'').length != 12){
          update_info.showErrors({
            'org_phone': 'Пожалуйста, введите проверьте правильность ввода номера телефона'
          });
        } else{
          form.submit();
        }
      }
    });

});
