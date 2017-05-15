$(document).ready(function () {
    /**
     * Keyup Submit
     */
    $('body').on('keyup','#user_form_notlogged', function(event){
        if (event.keyCode == 13)
            $('#userSignIn').click();
    });
    $('body').on('keyup','#judge_form', function(event){
        if (event.keyCode == 13)
            $('#judgeSignIn').click();
    });
    $('body').on('keyup','#registr_form', function(event){
        if (event.keyCode == 13)
            $('#registr').click();
    });


    /**
     * UserName in Regestr Form
     */
    $("#registr_name").inputmask({
        mask: 'a{1,20}',
        definitions: {
          'a': {
            validator: "[a-zA-Zа-яА-Я]",
          }
        },
        showMaskOnHover: false,
        showMaskOnFocus: true,
    });


    /**
     * EventNumver inputmask
     */
    // $("#auth_eventnumber").inputmask({
    //     mask: "9 9 9   9 9 9",
    //     onincomplete: function(){
    //         $("#auth_eventnumber").addClass('invalid');
    //     },
    //     oncomplete: function() {
    //         $("#auth_eventnumber").removeClass('invalid');
    //     }
    // });


    /**
     * Validate Email Field
     */
    $('input[type="email"]').blur(function(){
        if ( ! /\S+@\S+\.\S+/.test($(this).val()) ) {
            if ($(this).val() != '') {
                notify('Вы неправильно ввели email. Попробуйте ввести снова!','danger');
                $(this).addClass('invalid');
            }
        } else {
            $(this).removeClass('invalid');
        }
    });


    /**
     * Change User, Jusge SignIn, Reset forms
     */
    $('#toJudgeForm').click(function(){
        $('.auth-modal .modal-wrapper').addClass('up');
    });
    $('#toUserForm').click(function(){
        $('.auth-modal .modal-wrapper').removeClass('up');
    });
    $('#resetPasword').click(function () {
        $('#user_form_notlogged').addClass('displaynone');
        $('#user_form_forgot').removeClass('displaynone');
    });
    $('#toUserSignIn').click(function () {
        $('#user_form_notlogged').removeClass('displaynone');
        $('#user_form_forgot').addClass('displaynone');
    });



    /**
     * Sumbit NOT Logged User SignIn Form
     */
    $('#userSignIn').click(function(){
        if ($('#auth_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#auth_email').val()) ) {
            notify('Вы неправильно ввели email. Попробуйте ввести снова!','danger');
            $('#auth_email').addClass('invalid');
        } else if ( $("#auth_password").val() == '' ) {
            $('#auth_password').addClass('invalid');
        } else {

            var ajaxData = {
                url: '/sign/organizer',
                type: 'POST',
                data: new FormData($('#user_form_notlogged')[0]),
                beforeSend: function() {
                    $('#user_form_notlogged').parent('.modal-wrapper').addClass('whirl');
                },
                success: authResponse,
                error: function() {
                    removePreLoader();
                }
            };

            vp.ajax.send(ajaxData);
        }
    });

    /**
     * Submit Logged User SignIn form
     */
    $('#userRecover').click(function(){

        var ajaxData = {
            url: '/sign/organizer',
            type: 'POST',
            data: new FormData($('#user_form_logged')[0]),
            beforeSend: function() {
                $('#user_form_logged').parent('.modal-wrapper').addClass('whirl');
            },
            success: authResponse,
            error: function() {
                removePreLoader()
            }
        };

        vp.ajax.send(ajaxData);

    });


    /**
    * Submit Forgot Password Form
    */
    $('#resetPassword').click(function(){
        if ($('#forget_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#forget_email').val()) ) {
            notify('Вы неправильно ввели email. Попробуйте ввести снова!','danger');
            $('#forget_email').addClass('invalid');
        } else {
            $('#toUserSignIn').click();
            var ajaxData = {
                url: '/sign/organizer/reset',
                type: 'POST',
                data: new FormData($('#user_form_forgot')[0]),
                beforeSend: function() {
                    $('#user_form_forgot').parent('.modal-wrapper').addClass('whirl');
                },
                success: resetResponse,
                error: function() {
                    removePreLoader()
                }
            };

            vp.ajax.send(ajaxData);
        }
    });


    /**
    * Logout Logged User
    * - clear cookie
    * - remove Logged User SignIn Form
    */
    $('#logout').click(function(){
        $('#user_form_logged').remove();
        $('#user_form_notlogged').removeClass('displaynone');
        $('#registr_btn').removeClass('displaynone');
        vp.cookies.remove('sid');
        vp.cookies.remove('uid');
        vp.cookies.remove('secret');
    });


    /**
    * Sumbit Judges SignIn Form
    */
    $('#judge_form').submit(function(){
        if ( $("#auth_eventnumber").inputmask('unmaskedvalue').length != 6 ) {
            notify('Вы ввели неправильный номер мероприятия. Попробуйте ввести снова','danger');
            return false;
        } else if ( $("#auth_judgesecret").val() == '' ) {
            $("#auth_judgesecret").addClass('invalid');
            return false;
        }
        $("#auth_eventnumber").inputmask('remove');
    });


    /**
    * Submit Registration Form
    */
    var allowedSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№#%&*()!?,.;:@ ]");
    var allowedPassSymbols = new RegExp("[^a-zA-Z0-9№#%&*()/!?,.;:@]");

    $('#registr').click(function(){
        var form = $('#registr_form'),
            isvalid = true;


        // checking name
        if ( isvalid && ! allowedSymbols.test($('#registr_name').val()) && $('#registr_name').val() != "") {
            $('#registr_name').removeClass('invalid');
        } else {
            $('#registr_name').addClass('invalid');
            notify('Вы не указали имя','danger');
            isvalid = false;
        }


        // checking email
        if ( isvalid && $('#registr_email').val() != '' && /\S+@\S+\.\S+/.test($('#registr_email').val()) ) {
            $('#registr_email').removeClass('invalid');
        } else {
            isvalid = false;
            notify('Вы неправильно ввели email. Попробуйте ввести снова!','danger');
            $('#registr_email').addClass('invalid');
        }


        // checking type = password
        if (isvalid && ! allowedPassSymbols.test($('#registr_password').val()) && $('#registr_password').val() != "" ) {
            $('#registr_password').removeClass('invalid');
        } else {
            isvalid = false;
            $('#registr_password').addClass('invalid');

            if ($('#registr_password').val() == "") {
                notify('Вы не указали парлоль', 'danger');
            } else {
                notify('Вы используете запрещенные символы для пароля','danger');
            }
        }


        if ( isvalid == true ) {

            var ajaxData = {
                url: '/signup',
                type: 'POST',
                data: new FormData(form[0]),
                beforeSend: function(){
                    $('#registr_form').parent('.modal-wrapper').addClass('whirl');
                },
                success: signupResponse,
                error: function() {
                    removePreLoader();
                }
            };

            vp.ajax.send(ajaxData);

        }

    });


    function signupResponse(response) {

        response = JSON.parse(response);

        if (response.status == 'success') {

            var host        = window.location.host,
                protocol    = window.location.protocol,
                id          = parseInt(response.id);

            if (id) {
                
                window.location.replace(protocol + '//' + host + '/user/' + id);
                
            } else {

                vp.notification.notify({
                    type: 'alert',
                    status: 'danger',
                    message: 'Произошла ошибка, попробуйте снова',
                    time: 3
                });
                
            }

            return;

        }
        
        switch (parseInt(response.code)) {
            case 30:
                notify('Пожалуйста, заполните все поля','danger');
                break;
            case 20:
                notify('Пользователь с таким email уже зарегистрирован','danger');
                break;
        }

        removePreLoader();
    }



    function authResponse(response) {

        response = JSON.parse(response);

        if (response.status == 'success') {

            var host        = window.location.host,
                protocol    = window.location.protocol,
                id          = parseInt(response.id);

            if (id) {
                
                window.location.replace(protocol + '//' + host + '/user/' + id);
                
            } else {
                
                vp.notification.notify({
                    type: 'alert',
                    status: 'danger',
                    message: 'Произошла ошибка, попробуйте снова',
                    time: 3
                });
                
            }

            return;

        }

        switch (parseInt(response.code)) {
            case 30:
                notify('Пожалуйста, заполните все поля','danger');
                break;
            case 13:
                notify('Неверно введен email или пароль','danger');
                break;
        }

        removePreLoader();
    }


    var resetResponse = function (response) {

        removePreLoader();

        response = JSON.parse(response);

        if (response.status == 'success') {
            $.notify({
                    message: 'Мы отправили письмо с инструкциями на вашу почту'
                },
                {
                    type: 'success'
                });

            return;
        }

        switch (parseInt(response.code)) {
            case 30:
                notify('Пожалуйста, заполните все поля','danger');
                break;
            case 60:
                notify('Мы не смогли отправить письмо с инструкциями на вашу почту :(','danger');
                break;
            case 15:
                notify('Пользователь с таким email не найден','danger');
                break;
        }

    };


    /**
    * Notify Frontend Fields
    */
    function notify(message, status) {

        vp.notification.notify({
            type: 'alert',
            status: status,
            message: message,
            time: 3
        });
        
    }

    function removePreLoader() {
        $('body').find('.whirl').removeClass('whirl');
    }

});
