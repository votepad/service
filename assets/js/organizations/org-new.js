$().ready(function() {

var form_el1 = [
  {label: "Название организации", proc: "15", name:"org_name", flag:false},
  {label: "Сайт организации", proc: "15", name:"org_site", flag:false},
  {label: "Доверенное лицо", proc: "10", name:"org_user", flag:false},
  {label: "Телефон", proc: "10", name:"org_phone", flag:false},
  {label: "E-mail", proc: "15", name:"email", flag:false},
  {label: "Пароль", proc: "15", name:"password", flag:false},
  {label: "Официальный сайт организации", proc: "10", name:"official_org_site", flag:false},
  {label: "confirmrools", proc: "10", name:"confirmrools", flag:false},
];

var form_el2 = [
  {label: "Название организации", proc: "20", name:"org_name", flag:false},
  {label: "Сайт организации", proc: "20", name:"org_site", flag:false},
  {label: "Доверенное лицо", proc: "20", name:"org_user", flag:false},
  {label: "Телефон", proc: "10", name:"org_phone", flag:false},
  {label: "Официальный сайт организации", proc: "15", name:"official_org_site", flag:false},
  {label: "confirmrools", proc: "15", name:"confirmrools", flag:false},
];

var form_el = ""
if ( $('form').attr('id') == 'logged' ) {
  form_el = form_el2;
} else {
  form_el = form_el1;
}

/*
**  Find Element in Massive
*/
function find_el(name) {
  for (var i = 0; i < form_el.length; i++) {
    if (form_el[i].name == name) {
      return i;
    }
  }
}


/*
**  Progress Bar
*/
var width = 0;
function add_progress_bar(num) {
  width = width + parseInt(num);
  $('.pb_neworg span').empty().append(width + "%");
  $('.pb_wrapper').css('width', width + '%');
}
function remove_progress_bar(num) {
  width = width - parseInt(num);
  $('.pb_neworg span').empty().append(width + "%");
  $('.pb_wrapper').css('width', width + '%');
}


/*
**  Validate Elements
*/
function show_error(name) {

}

/*
**  Blur Input Element
*/
$('.input-area').blur(function(){
  var el_num = find_el($(this).attr('name'));
  if ( $(this).val() == "" ) {
    if ( form_el[el_num].flag == true  ) {
      remove_progress_bar(form_el[el_num].proc);
    }
    form_el[el_num].flag = false;
    //show_error(el_num);
  } else{
    if ( form_el[el_num].flag == false ) {
      add_progress_bar(form_el[el_num].proc);
      form_el[el_num].flag = true;
    }
  }
});

/*
**  Keyup Input Element
*/
$('#org_name').keyup(function(){
  if ($(this).val() != "") {
    $("#org_site").val(checkingsim($("#org_name").val()));
    if ( ! $('#org_site + label').hasClass('active') ) {
      $('#org_site + label').addClass('active');
    }
    $('#org_site').closest('.input-field').find(".counter").empty().append($('#org_site').val().length + "/" + $('#org_site').attr('length'));
    if ( ($('#org_site').val().length > $('#org_site').attr('length')) && ! $('#org_site').hasClass('invalid') ) {
      $('#org_site').addClass('invalid');
    } else if ($('#org_site').val().length <= $('#org_site').attr('length')) {
      $('#org_site').removeClass('invalid');
    }
  } else {
    if ( $(this).val() != "") {
      $('#org_site + label').removeClass('active');
      $('#org_site').removeClass('invalid');
      $('#org_site').closest('.input-field').find(".counter").empty();
    }
  }
});


/*
**  Next Step
*/
$('#next').click(function () {
  $('.step').each(function () {
    if ( $(this).hasClass('displayblock') ) {
      // hide current
      $(this).animateCss('fadeOutLeft');
      $(this).removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutLeft animated');

      // show next
      $(this).next().removeClass('displaynone').addClass('displayblock').animateCss('fadeInRight');

      // checking last element
      if ( $(this).next().index() == 3) {
        $('#next').removeClass('displayblock').addClass('displaynone');
        $('#submit').removeClass('displaynone').addClass('displayblock');
      } else {
        $('#previous').removeClass('displaynone').addClass('displayblock');
      }
      return false;
    }
  });
});

/*
**  Previous Step
*/
$('#previous').click(function () {
  $('.step').each(function () {
    if ( $(this).hasClass('displayblock') ) {
      // hide current
      $(this).animateCss('fadeOutRight');
      $(this).removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutRight animated');

      // show previous
      $(this).prev().removeClass('displaynone').addClass('displayblock').animateCss('fadeInLeft');

      // checking first element
      if ( $(this).prev().index() == 0 ) {
        $('#previous').removeClass('displayblock').addClass('displaynone');
      } else {
        $('#submit').removeClass('displayblock').addClass('displaynone');
        $('#next').removeClass('displaynone').addClass('displayblock');
      }
      return false;
    }
  });
});

/*
**  Submit Form
*/
$('#submit').click(function () {
  alert('sumbited');
});


    $('#new_org_logged').validate({
      errorClass: "error-input",
      rules: {
        org_name: "required",
        org_site: {
          required: true,
          minlength: 3,
          maxlength: 25
        },
        official_org_site: "required",
        org_phone: "required",
        confirmrools: "required"
      },
      messages: {
        org_name: "Пожалуйста, введите название организации.",
        org_site: {
          required: "Пожалуйста, введите название сайтаю",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        official_org_site: "Пожалуйста, укажите ссылку на официальный сайт.",
        org_phone: {
          required: "Пожалуйста, введите номер телефона.",
          minlength: "Пожалуйста, проверьте правильность ввода номера телефона.",
          maxlength: "Пожалуйста, проверьте правильность ввода номера телефона."
        },
        confirmrools: "Пожалуйста, согласитесь с правилами."
      },
      submitHandler: function(form) {
        alert($("#org_phone").val().replace(/[^+0-9]/gim,'').length);
        if($("#org_phone").val().replace(/[^+0-9]/gim,'').length != 12){
          not_logged.showErrors({
            'org_phone': 'Пожалуйста, введите проверьте правильность ввода номера телефона.'
          });
        } else{
          form.submit();
        }
      }
    });

  /*  var not_logged = $('#new_org_not_logged').validate({
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
        official_org_site: "required",
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
          required: "Пожалуйста, введите название сайта.",
          minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
          maxlength: jQuery.validator.format("Пожалуйста, введите не более {0} символов.")
        },
        official_org_site: "Пожалуйста, укажите ссылку на официальный сайт.",
        org_phone: {
          required: "Пожалуйста, введите номер телефона.",
        },
        confirmrools: "Пожалуйста, прочитайте и согласитесь с правилами."
      },
      submitHandler: function(form) {
        if ($('#org_user').val().split(/[\s\.\?]+/).length != 3) {
          not_logged.showErrors({
            'org_user': 'Пожалуйста, введите Фамилию Имя Отчeство.'
          });
        } else if($("#org_phone").val().replace(/[^+0-9]/gim,'').length != 12){
          not_logged.showErrors({
            'org_phone': 'Пожалуйста, введите проверьте правильность ввода номера телефона.'
          });
        } else{
          form.submit();
        }
      }
    });
*/
  $("#org_phone").inputmask("+7 (999) 999-9999");

  $("#org_site").keyup(function(){
    $("#org_site").val(checkingsim($("#org_site").val()));
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
