$(document).ready(function () {

    var hash = cookies.get('reset_link');
    hash = hash?hash.split('~')[1]:'';
    cookies.remove('reset_link');


    /**
    * Open Modal Form for edit User Info
    */
    $('#profile_info-edit').click(function(){
        $("#edit_user_modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });


    /**
    * Phone inputmask
    */
    $(".user-info__description-phone a").inputmask({ "mask": "+7 (999) 999-99-99" });

    $("#phone").inputmask({
        "mask": "+7 (999) 999-99-99",
        clearIncomplete: true
    });



    /**
    * Update Info about User in Modal Form
    */
     var allowedSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№#%&*()!?,.;:@ ]"),
        allowedPassSymbols = new RegExp("[^a-zA-Z0-9~-№#%&*()[]/!?,.;:@]"),
        allowedPhoneSymbols = new RegExp("[^0-9+]");

    $('#edit_user_modal').submit(function(){

        $('.input-field > input[type="text"], .input-field > input[type="email"]', $(this)).each(function(){

            if ( ! allowedSymbols.test($(this).val())) {
                $(this).removeClass('invalid');
            } else {
                $(this).addClass('invalid');
                return false;
            }

            if ( $(this).attr('required') != undefined ){
                if ( $(this).val() == "" ){
                    $(this).addClass('invalid');
                    return false;
                }
            }

        });


        // checking phone
        if ( allowedPhoneSymbols.test($('#edituser_phone').val().replace(" (","").replace(") ","").replace("-","").replace("-","")) ) {
            $('#edituser_phone').removeClass('invalid');
        } else if ( isvalid ){
            $('#edituser_phone').addClass('invalid');
            return false;
        }

        // checking type = password
        if ( $('#edituser_oldpassword').val() != "" ) {
            $('#edituser_oldpassword').removeClass('invalid');
            $('#edituser_newpassword').removeClass('invalid');
            $('#edituser_newpassword2').removeClass('invalid');

            if (allowedPassSymbols.test($('#edituser_oldpassword').val()) ||
                allowedPassSymbols.test($('#edituser_newpassword').val()) ||
                allowedPassSymbols.test($('#edituser_newpassword2').val()))
            {
                $('#edituser_oldpassword').addClass('invalid');
                $('#edituser_newpassword').addClass('invalid');
                $('#edituser_newpassword2').addClass('invalid')
                $.notify({
                    message: 'Вы используете запрещенные символы!'
                },{
                    type: 'danger'
                });
                return false;
            } else if ($('#edituser_newpassword').val() == "") {
                $('#edituser_newpassword').addClass('invalid');
                $('#edituser_newpassword2').addClass('invalid')
                $.notify({
                    message: 'Вы не ввели новый пароль!'
                },{
                    type: 'danger'
                });
                return false;
            } else if ($('#edituser_newpassword').val() != $('#edituser_newpassword2').val()) {
                $('#edituser_newpassword').addClass('invalid');
                $('#edituser_newpassword2').addClass('invalid')
                $.notify({
                    message: 'Пароли не совпадают!'
                },{
                    type: 'danger'
                });
                return false;
            }

        } else if ( $('#edituser_newpassword').val() != "" || $('#edituser_newpassword2').val() != "" ) {
            $('#edituser_oldpassword').addClass('invalid');
            $('#edituser_newpassword').addClass('invalid');
            $('#edituser_newpassword2').addClass('invalid');
            $.notify({
                message: 'Вы не указали старый пароль!'
            },{
                type: 'danger'
            });
            return false;
        }
    });



    /**
    * Reset Password
    */
    $("#reset_password, #reset_password1").focus(function(){
        $('#reset_password').removeClass('invalid');
        $('#reset_password1').removeClass('invalid')
    });

    // open modal if it is n the page
    $('#reset_password_form').modal({
        keyboard: false
    });
    $('#reset_password_form').modal('show');
    // submit on 'Enter'
    $('#reset_password_form').on('keyup', function (e) {
        if ( e.keycode == 13) {
            $('#reset_password_form').submit()
        }
    });
    $("#reset_password").focus();

    // cancel new password
    $('#cancelReset').click(function() {
        $('#reset_password_form').modal('hide');
        $('#reset_password_form').remove();
    });


    $('#reset_password_form').submit(function() {

        if (allowedPassSymbols.test($('#reset_password').val()) || allowedPassSymbols.test($('#reset_password1').val())) {

            $('#reset_password').addClass('invalid');
            $('#reset_password1').addClass('invalid');
            $.notify({
                message: 'Вы используете запрещенные символы!'
            },{
                type: 'danger'
            });
            return false;

        } else if ( $('#reset_password').val() == "" ) {

            $('#reset_password').addClass('invalid');
            $.notify({
                message: 'Вы не ввели новый пароль!'
            },{
                type: 'danger'
            });
            return false;

        } else if ($('#reset_password').val() != $('#reset_password1').val()) {
            $('#reset_password').addClass('invalid');
            $('#reset_password1').addClass('invalid');
            $.notify({
                message: 'Пароли не совпадают!'
            },{
                type: 'danger'
            });
            return false;
        }

        ajax.send({
            data: new FormData($('#reset_password_form')[0]),
            url: '/reset/' + hash,
            type: 'POST',
            beforeSend: function() {
                $('#reset_password_form .modal-content').addClass('whirl');
            },
            success: resetPasswordResponse,
            error: function() {
                console.log('error ajax send');
                $('#reset_password_form .modal-content').removeClass('whirl');
            }
        });

        return false;

    });

    var resetPasswordResponse = function (response) {

        response = JSON.parse(response);

        if (response.status == 'success') {

            $.notify({
                message: 'Пароль успешно изменен!'
            },
            {
                type: 'success'
            })

            $('#cancelReset').click();
            $('#auth_modal').modal('show');

        } else {

            $.notify({
                message: 'Ошибка при смене пароля. Попробуйте ещё раз!'
            },
            {
                type: 'danger'
            })


        }

        $('#reset_password_form .modal-content').removeClass('whirl');

    };


});