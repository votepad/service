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
    * EventNumver inputmask
    */
    $("#auth_eventnumber").inputmask({
        "mask": "9 9 9   9 9 9",
        onincomplete: function(){
            $("#auth_eventnumber").addClass('invalid');
        },
        oncomplete: function() {
            $("#auth_eventnumber").removeClass('invalid');
        }
    });


    /**
    * Validate Email Field
    */
    $('input[type="email"]').blur(function(){
        if ( ! /\S+@\S+\.\S+/.test($(this).val()) ) {
            if ($(this).val() != '') {
                notifyErrors('email');
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
            notifyErrors('email');
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
            }

            ajax.send(ajaxData);
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
            }

            ajax.send(ajaxData);

    });

    /**
    * Sumbit Judges SignIn Form
    */
    $('#judgeSignIn').click(function(){
        if ( $("#auth_eventnumber").inputmask('unmaskedvalue').length != 6 ) {
            notifyErrors('eventNumber');
        } else if ( $("#auth_judgesecret").val() == '' ) {
            $("#auth_judgesecret").addClass('invalid');
        } else {
            $('#judge_form')[0].submit();
        }
    });


    /**
    * Submit Forgot Password Form
    */
    $('#resetPassword').click(function(){
        if ($('#forget_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#forget_email').val()) ) {
            notifyErrors('email');
            $('#forget_email').addClass('invalid');
        } else {
            $('#user_form_forgot')[0].submit();
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
        document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
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
            notifyErrors('regName');
            isvalid = false;
        }


        // checking email
        if ( isvalid && $('#registr_email').val() != '' && /\S+@\S+\.\S+/.test($('#registr_email').val()) ) {
            $('#registr_email').removeClass('invalid');
        } else {
            isvalid = false;
            notifyErrors('email');
            $('#registr_email').addClass('invalid');
        }


        // checking type = password
        if (isvalid && ! allowedPassSymbols.test($('#registr_password').val()) && $('#registr_password').val() != "" ) {
            console.log(isvalid, allowedPassSymbols.test($('#registr_password').val()));
            $('#registr_password').removeClass('invalid');
        } else {
            isvalid = false;
            $('#registr_password').addClass('invalid');

            if ($('#registr_password').val() == "") {
                notifyErrors('emptyPassword');
            } else {
                notifyErrors('errorPassword');
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
            }

            ajax.send(ajaxData);

        }

    });


    function signupResponse(response) {

        response = JSON.parse(response);

        if (response.status == 'success') {

            var host        = window.location.host,
                protocol    = window.location.protocol,
                id          = parseInt(response.id);

            if (id) {
                window.location.replace(protocol+'//'+host+'/user/'+id);
            } else {
                $.notify({
                        message: 'Произошла ошибка'
                    },
                    {
                        type: 'danger'
                    });
            }

            return;

        }

        var message;

        switch (parseInt(response.code)) {
            case 30: message = 'Пожалуйста, заполните все поля';
            break;
            case 20: message = 'Пользователь с таким email уже зарегистрирован';
            break;
            default: message = 'Произошла ошибка. Попробуйте снова';
        }

        $.notify({
            message: message
        },
        {
            type: 'danger'
        });

        removePreLoader();
    }



    function authResponse(response) {

        response = JSON.parse(response);

        if (response.status == 'success') {

            var host        = window.location.host,
                protocol    = window.location.protocol,
                id          = parseInt(response.id);

            if (id) {
                window.location.replace(protocol+'//'+host+'/user/'+id);
            } else {
                $.notify({
                    message: 'Произошла ошибка'
                },
                {
                    type: 'danger'
                });
            }

            return;

        }

        var message;

        switch (parseInt(response.code)) {
            case 30: message = 'Пожалуйста, заполните все поля';
            break;
            case 13: message = 'Неверно введен email или пароль';
            break;
            default: message = 'Произошла ошибка. Попробуйте снова';
        }

        $.notify({
            message: message
        },
        {
            type: 'danger'
        });

        removePreLoader();
    }



    /**
    * Notify Frontend Fields
    */
    function notifyErrors(field) {

        var message;

        switch (field) {

            case 'email': message = 'Вы ввели неправильно email. Попробуйте ввести снова!'
            break;
            case 'emptyPassword': message = 'Вы не указали парлоль';
            break;
            case 'errorPassword': message = 'Вы используете запрещенные символы для пароля!';
            break;
            case 'regName': message = 'Вы не ввели имя!';
            break;
            case 'eventNumber': message = 'Вы ввели неправильный номер мероприятия. Попробуйте ввести снова!';
            break;
            default: message = 'Произошла ошибка. Попробуйте снова';
        }

        $.notify({
            message: message
        },
        {
            type: 'danger'
        });


    }

    function removePreLoader() {
        $('body').find('.whirl').removeClass('whirl');
    }

});
