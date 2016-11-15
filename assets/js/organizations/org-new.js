$().ready(function() {

  var url = "http://pronwe";

  var form_el = [
      {
          label: "Название организации",
          proc: "20",
          name: "org_name",
          flag: false
      },
      {
          label: "Сайт организации",
          proc: "15",
          name: "org_site",
          flag: false
      },
      {
          label: "Доверенное лицо",
          proc: "15",
          name: "org_user",
          flag: false
      },
      {
          label: "Телефон",
          proc: "10",
          name: "org_phone",
          flag: false
      },
      {
          label: "E-mail",
          proc: "15",
          name:"email",
          flag: false
      },
      {
          label: "Пароль",
          proc: "15",
          name:"password",
          flag: false
      },
      {
          label: "Официальный сайт организации",
          proc: "5",
          name: "official_org_site",
          flag: false
      },
      {
          label: "confirmrools",
          proc: "5",
          name:"confirmrools",
          flag: false
      },
  ];


    /**
     *
     * @param {String} name
     * @returns {number}
     */
    function find_el(name) {

        for (var i = 0; i < form_el.length; i++) {

            if (form_el[i].name == name) {
                return i;
            }
        }
    }


    /**
     *
     * @param $el
     * @param status
     */
    function checking_el_valid($el, status) {

        var el_num = find_el($el.attr('name'));

        if (status == "valid" ) {

            $el.removeClass('invalid');

            if ( form_el[el_num].flag == false ) {

                form_el[el_num].flag = true;

                add_progress_bar(form_el[el_num].proc);

            }

        } else if ( status == "invalid" ) {

            $el.addClass('invalid');

            if ( form_el[el_num].flag == true ) {

                form_el[el_num].flag = false;

                remove_progress_bar(form_el[el_num].proc);

            }
        }
    }

    /**
     *
     * @type {number}
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


    /**
     *  Next Step
     */
    $('#btnnext').click(function () {

        var $step = $(this).closest('.block').find('.step.displayblock');

        var $invalid = false;

        $('.input-area', $step).each(function() {

            if ( $(this).val() == "" ) {

                $(this).addClass('invalid');

                $invalid = true;

            }

            if ( $(this).hasClass('invalid') )

                $invalid = true;

        });


        if ( $invalid == false ) {

            // hide current

            $step.animateCss('fadeOutLeft');

            $step.removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutLeft animated');

            // show next

            $step.next().removeClass('displaynone').addClass('displayblock').animateCss('fadeInRight');
            $step.next().wait(800).removeClass('fadeInRight animated')


            // checking last element

            if ( $step.next().index() == $('.step').length - 1 ) {

                $('#btnnext').removeClass('displayblock').addClass('displaynone');

                $('#btnsubmit').removeClass('displaynone').addClass('displayblock');

            } else {

                $('#btnprevious').removeClass('displaynone').addClass('displayblock');

            }
        }
    });


    /**
     * Previous step
     */

    $('#btnprevious').click(function () {
        var $step = $(this).closest('.block').find('.step.displayblock');

        // hide current

        $step.animateCss('fadeOutRight');
        $step.removeClass('displayblock').wait(800).addClass('displaynone').removeClass('fadeOutRight animated');

        // show previous
        $step.prev().removeClass('displaynone').addClass('displayblock').animateCss('fadeInLeft');
        $step.prev().wait(800).removeClass('fadeInLeft animated');

        // checking first element

        if ( $step.prev().index() == 0 ) {

            $('#btnprevious').removeClass('displayblock').addClass('displaynone');

        } else {

            $('#btnsubmit').removeClass('displayblock').addClass('displaynone');

            $('#btnnext').removeClass('displaynone').addClass('displayblock');

        }
  });

    /**
     * Submit form
     */
    $('#btnsubmit').click(function () {
        var $form = $(this).closest('form');
        var $invalid = false;

        $('.input-area', $form).each(function() {

            if ( $(this).val() == "" ) {

                $(this).addClass('invalid');

                $invalid = true;

            }

            if ( $(this).attr('type') == 'checkbox' && $(this).prop('checked') == false ) {

                $(this).addClass('invalid');

                $invalid = true;

            }

            if ( $(this).hasClass('invalid') )

                $invalid = true;

        });


        if ( $invalid == true ) {

            alert("При заполнение формы возникли ошибки, вернитесь на предыдущий шаг и устраните их.");

        } else {

            $("#org_site").inputmask('remove');

            document.forms[0].submit();

        }
  });


  /*
  **  Validate Elements
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


  $("#org_site").inputmask({
    mask: '\\http://nwe.ru/a{4,20}',
    definitions: {
      'a': {
        validator: "[a-z0-9-]",
      }
    },
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true,
    oncomplete: function(){
      var $this = $(this);
      var website = $("#org_site").inputmask('unmaskedvalue');

      $.when(
        /*
        **  Checking organization website in DB
        */
        $.ajax({
            url: url + '/organization/checkwebsite/' + website,
            type: "POST",
            data: {
                website: website
            }
        })
      ).then(function( data) {
        if ( data == "false") {
            $this.parent().children('.help-block').css('display', 'block');
            $this.parent().children('.error-input').remove();
            checking_el_valid($this, "valid");
        }
        else {
          $this.parent().children('.help-block').css('display', 'none');
          if ( ! $this.parent().children('span').hasClass('error-input')) {
              $this.parent().append('<span class="error-input">К сожалению, такой адрес занят. Пожалуйста, придумайте другой адрес.</span>');
          }
          checking_el_valid($this, "invalid");
        }
      });

    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });
  $("#org_site").blur(function(){
    var str = $(this).inputmask('unmaskedvalue').replace(/-{2,}/gim, '-').replace('-','');

    if ( str.substr(str.length-1, str.length) == '-')
      str = str.substr(0, str.length-1);

    if (str.length >= 4){
      $(this).val(str);
    } else {
      $(this).val('');
      $(this).addClass('invalid');
    }

    var $counter = $(this).closest('.input-field').find('.counter').text();
    $(this).closest('.input-field').find('.counter').text(str.length + '/' + $counter.substr($counter.length - 2, $counter.length));
  });


  $("#org_user").inputmask({
    mask: '*{1,} *{1,} *{1,}',
    showMaskOnHover: false,
    showMaskOnFocus: false,
    oncomplete: function(){
      checking_el_valid($(this), "valid");
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });

  $("#org_phone").inputmask({
    mask: '+7 (999) 999-9999',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    oncomplete: function(){
      checking_el_valid($(this), "valid");
    },
    onincomplete: function(){
      checking_el_valid($(this), "invalid");
    }
  });

  $("#email").inputmask({
      alias: "email",
      showMaskOnHover: false,
      showMaskOnFocus: true,
      oncomplete: function(){
        var $this = $(this);
        var email = $("#email").val();

        $.when(
          /*
          **  Checking user email in DB
          */
          $.ajax({
              url: url + '/organization/checkemail/' + email,
              type: "POST",
              data: {
                  email: email
              }
          })
        ).then(function( data) {
          if ( data == "false") {
              $this.parent().children('.help-block').css('display', 'block');
              $this.parent().children('.error-input').remove();
              checking_el_valid($this, "valid");
          }
          else {
            $this.parent().children('.help-block').css('display', 'none');
            if ( ! $this.parent().children('span').hasClass('error-input')) {
                $this.parent().append('<span class="error-input">Пользователь с таким E-mail существует. Пожалуйста, пройдете авторизацию.</span>');
            }
            checking_el_valid($this, "invalid");
          }
        });
      },
      onincomplete: function(){
        checking_el_valid($(this), "invalid");
      }
  });

  $("#password").inputmask({
      mask: "*{6,25}",
      definitions: {
        '*': {
          validator: "[0-9A-Za-z#$%&*+/=?^_{|}~\-]",
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
