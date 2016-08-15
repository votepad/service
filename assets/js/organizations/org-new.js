$().ready(function() {

    $('#new_org_logged').validate({
      errorClass: "error-input",
      rules: {
        org_name: "required",
        org_site: {
          required: true,
          minlength: 3,
          maxlength: 25
        },
        org_phone: {
          required: true,
          minlength: 11,
          maxlength: 12
        },
        confirmrools: "required"
      },
      messages: {
        org_name: "Пожалуйста, введите название организации.",
        org_site: {
          required: "Пожалуйста, введите название сайта",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        org_phone: {
          required: "Пожалуйста, введите номер телефона",
          minlength: "Пожалуйста, проверьте правильность ввода номера телефона.",
          maxlength: "Пожалуйста, проверьте правильность ввода номера телефона."
        },
        confirmrools: "Пожалуйста, согласитесь с правилами."
      },
      submitHandler: function(form) {
        if($("#org_phone").val().replace(/[^+0-9]/gim,'').length != 12){
          not_logged.showErrors({
            'org_phone': 'Пожалуйста, введите проверьте правильность ввода номера телефона'
          });
        } else{
          form.submit();  
        }
      }
    });

    var not_logged = $('#new_org_not_logged').validate({
      errorClass: "error-input",
      focusInvalid: false,
      rules: {
        org_name: "required",
        org_user: "required",
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        org_site: {
          required: true,
          minlength: 3,
          maxlength: 25
        },
        org_phone: "required",
        confirmrools: "required"
      },
      messages: {
        org_name: "Пожалуйста, введите название организации.",
        org_user: "Пожалуйста, введите данные о доверенном лице.",
        email: {
          required: "Пожалуйста, введите адрес электронной почты.",
          email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
        },
        password: {
          required: "Пожалуйста, придумайте пароль.",
          minlength: jQuery.validator.format("Минимальная длина пароля - {0} символов."),
        },
        org_site: {
          required: "Пожалуйста, введите название сайта",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        org_phone: {
          required: "Пожалуйста, введите номер телефона",
        },
        confirmrools: "Пожалуйста, прочитайте и согласитесь с правилами."
      },
      submitHandler: function(form) {
        if ($('#org_user').val().split(/[\s\.\?]+/).length != 3) {
          not_logged.showErrors({
            'org_user': 'Пожалуйста, введите Фамилию Имя Отчeство'
          });
        } else if($("#org_phone").val().replace(/[^+0-9]/gim,'').length != 12){
          not_logged.showErrors({
            'org_phone': 'Пожалуйста, введите проверьте правильность ввода номера телефона'
          });
        } else{
          form.submit();  
        }
      }
    });

  $("#org_phone").inputmask("+7 (999) 999-9999");
  
  $("#org_site").keyup(function(){
    $("#org_site").val(checkingsim($("#org_site").val()));
  });
  $("#org_name").keyup(function(){
    $("#org_site").val(checkingsim($("#org_name").val()));
  });


  var checkingsim = function(str){
    var replacer = {"а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"e","ж":"zh","з":"z","и":"i","й":"y","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"kh","ц":"ts","ч":"ch","ш":"sh","щ":"shch","ъ":"ie","ы":"y","ь":"","э":"e","ю":"iu","я":"ya","a":"a","b":"b","c":"c","d":"d","e":"e","f":"f","g":"g","h":"h","i":"i","j":"j","k":"k","l":"l","m":"m","n":"n","o":"o","p":"p","q":"q","r":"r","s":"s","t":"t","u":"u","v":"v","w":"w","x":"x","y":"y","z":"z","-":"-","1":"1","2":"2","3":"3","4":"4","5":"5","6":"6","7":"7","8":"8","9":"9","0":"0"," ":"-"};
     
    if (str != undefined) {
      for (var i = 0; i < str.length; i++) {
        if (replacer [ str[i].toLowerCase() ] != undefined){
          replace = replacer [ str[i].toLowerCase() ];
          str = str.replace(str[i], replace);
        }
      }
      str = str.toLowerCase().replace(/[^-0-9a-z]/gim,'').replace(/-{2,}/gim, '-');
      return str;
    }
  };

});