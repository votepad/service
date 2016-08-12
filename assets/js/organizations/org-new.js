$().ready(function() {

    $('#new_org_logged').validate({
      errorClass: "error-input",
      focusInvalid: false,
      rules: {
        orgname: "required",
        orgsite: {
          required: true,
          minlength: 3,
          maxlength: 25
        },
        orgphone: {
          required: true,
          minlength: 11,
          maxlength: 12
        },
        confirmrools: "required"
      },
      messages: {
        orgname: "Пожалуйста, введите название организации.",
        orgsite: {
          required: "Пожалуйста, введите название сайта",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        orgphone: {
          required: "Пожалуйста, введите номер телефона",
          minlength: "Пожалуйста, проверьте правильность ввода номера телефона.",
          maxlength: "Пожалуйста, проверьте правильность ввода номера телефона."
        },
        confirmrools: "Пожалуйста, согласитесь с правилами."
      },
    });

    $('#new_org_not_logged').validate({
      errorClass: "error-input",
      focusInvalid: false,
      rules: {
        orgname: "required",
        orguser: "required",
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        },
        orgsite: {
          required: true,
          minlength: 3,
          maxlength: 25
        },
        orgphone: {
          required: true,
          minlength: 11,
          maxlength: 12
        },
        confirmrools: "required"
      },
      messages: {
        orgname: "Пожалуйста, введите название организации.",
        orguser: "Пожалуйста, введите данные о доверенном лице.",
        email: {
          required: "Пожалуйста, введите адрес электронной почты",
          email: "Пожалуйста, проверьте правильность ввода адреса электронной почты."
        },
        password: {
          required: "Пожалуйста, придумайте пароль.",
          minlength: jQuery.validator.format("Минимальная длина пароля - {0} символов."),
        },
        orgsite: {
          required: "Пожалуйста, введите название сайта",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        orgphone: {
          required: "Пожалуйста, введите номер телефона",
          minlength: "Пожалуйста, проверьте правильность ввода номера телефона.",
          maxlength: "Пожалуйста, проверьте правильность ввода номера телефона."
        },
        confirmrools: "Пожалуйста, согласитесь с правилами."
      },
    });



    $("#orgname").keyup(function(){
      console.log($("#orgname").val());
      $("#orgsite").val(checkingsim($("#orgname").val()));
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