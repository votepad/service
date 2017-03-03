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
        if ($(this).val() == '' || ! /\S+@\S+\.\S+/.test($(this).val()) ) {
            notifyErrorEmail();
            $(this).addClass('invalid');
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
            notifyErrorEmail();
            $('#auth_email').addClass('invalid');
        } else if ( $("#auth_password").val() == '' ) {
            $('#auth_password').addClass('invalid');
        } else {
            $('#user_form_notlogged')[0].submit();
        }
    });


    /**
    * Sumbit Judges SignIn Form
    */
    $('#judgeSignIn').click(function(){
        if ( $("#auth_eventnumber").inputmask('unmaskedvalue').length != 6 ) {
            $.notify({
                message: 'Вы ввели неправильный номер мероприятия. Попробуйте ввести снова!'
            },{
                type: 'danger'
            });
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
            notifyErrorEmail();
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
        document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
    });



    /**
    * Submit Registration Form
    */
    var allowedSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№#%&*()!?,.;:@ ]");
    var allowedPassSymbols = new RegExp("[^a-zA-Z0-9~-№#%&*()[]/!?,.;:@]");

    $('#registr').click(function(){
        var form = $('#registr_form'),
            isvalid = true;


        // checking name
        if ( isvalid && ! allowedSymbols.test($('#registr_name').val()) && $('#registr_name').val() != "") {
            $('#registr_name').removeClass('invalid');
        } else {
            $('#registr_name').addClass('invalid');
            $.notify({
                message: 'Вы не ввели имя!',
            },{
                type: 'danger'
            });
            isvalid = false;

        }


        // checking email
        if ($('#registr_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#registr_email').val()) ) {
            notifyErrorEmail();
            isvalid = false;
            $('#registr_email').addClass('invalid');
        }


        // checking type = password
        if (isvalid) {

            $('#registr_password').removeClass('invalid');
            $('#registr_password2').removeClass('invalid');

            if (!allowedPassSymbols.test($('#registr_password').val()) || !allowedPassSymbols.test($('#registr_password2').val())) {

                isvalid = false;
                $('#registr_password').addClass('invalid');
                $('#registr_password2').addClass('invalid');
                $.notify({
                    message: 'Вы используете запрещенные символы для пароля!',
                },{
                    type: 'danger'
                });

            } else if ($('#registr_password').val() == "") {

                isvalid = false;
                $('#registr_password').addClass('invalid');
                $('#registr_password2').addClass('invalid');
                $.notify({
                    message: 'Пожалуйста, введите пароль!'
                },{
                    type: 'danger'
                });

            } else if ($('#registr_password').val() != $('#registr_password2').val()) {

                isvalid = false;
                $('#registr_password').addClass('invalid');
                $('#registr_password2').addClass('invalid');
                $.notify({
                    message: 'Пароли не совпадают!'
                },{
                    type: 'danger'
                });

            }
        }


        if ( isvalid == true ) {
            form[0].submit();
        }

    });





    function notifyErrorEmail() {
        $.notify({
            message: 'Вы ввели неправильно email. Попробуйте ввести снова!'
        },{
            type: 'danger'
        });
    }
});
