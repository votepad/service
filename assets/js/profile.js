$(document).ready(function () {

    /**
    * Open Modal Form for edit User Info
    */
    $('#profile_info-edit').click(function(){
        $("#edituser_modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });


    /**
    * Phone inputmask
    */
    $(".profile_info-description-phone").inputmask({ "mask": "+7 (999) 999-99-99" });

    $("#edituser_phone").inputmask({
        "mask": "+7 (999) 999-99-99",
        onincomplete: function(){
            $("#edituser_phone").addClass('invalid');
        },
        oncomplete: function() {
            $("#edituser_phone").removeClass('invalid');
        }
    });



    /**
    * Update Info about User in Modal Form
    */
     var allowedSymbols = new RegExp("[^a-zA-Zа-яА-Я0-9-№#%&*()!?,.;:@ ]"),
        allowedPassSymbols = new RegExp("[^a-zA-Z0-9~-№#%&*()[]/!?,.;:@]"),
        allowedPhoneSymbols = new RegExp("[^0-9+]");

    $('#update_info').click(function(){
        var form = $(this).closest('.modal'),
            isvalid = true;

        // checking type = text || email
        $('.input-field > input[type="text"], .input-field > input[type="email"]', form).each(function(){

            if ( isvalid && ! allowedSymbols.test($(this).val()) && $(this).val() != "") {
                $(this).removeClass('invalid');
            } else if ( isvalid ){
                $(this).addClass('invalid');
                $.notify({
                    message: 'Возможно Вы забыли что-то указать или используете запрещенные символы.'
                },{
                    type: 'danger'
                });
                isvalid = false;
            }

        });


        // checking phone
        if ( isvalid && ! allowedPhoneSymbols.test($('#edituser_phone').val().replace(" (","").replace(") ","").replace("-","").replace("-","")) ) {
            $('#edituser_phone').removeClass('invalid');
        } else if ( isvalid ){
            $('#edituser_phone').addClass('invalid');
            $.notify({
                message: 'Вы не правильно указали телефон!'
            },{
                type: 'danger'
            });
            isvalid = false;
        }



        // checking type = password
        if ( isvalid && $('#edituser_oldpassword').val() != "" ) {
            $('#edituser_oldpassword').removeClass('invalid');
            $('#edituser_newpassword').removeClass('invalid');
            $('#edituser_newpassword2').removeClass('invalid');

            if (allowedPassSymbols.test($('#edituser_oldpassword').val()) ||
                allowedPassSymbols.test($('#edituser_newpassword').val()) ||
                allowedPassSymbols.test($('#edituser_newpassword2').val())) {
                    isvalid = false;
                    $('#edituser_oldpassword').addClass('invalid');
                    $('#edituser_newpassword').addClass('invalid');
                    $('#edituser_newpassword2').addClass('invalid')
                    $.notify({
                        message: 'Вы используете запрещенные символы!'
                    },{
                        type: 'danger'
                    });
            } else if ($('#edituser_newpassword').val() == "") {
                isvalid = false;
                $('#edituser_newpassword').addClass('invalid');
                $('#edituser_newpassword2').addClass('invalid')
                $.notify({
                    message: 'Вы не ввели новый пароль!'
                },{
                    type: 'danger'
                });
            } else if ($('#edituser_newpassword').val() != $('#edituser_newpassword2').val()) {
                isvalid = false;
                $('#edituser_newpassword').addClass('invalid');
                $('#edituser_newpassword2').addClass('invalid')
                $.notify({
                    message: 'Пароли не совпадают!'
                },{
                    type: 'danger'
                });
            }

        } else if ( $('#edituser_newpassword').val() != "" || $('#edituser_newpassword2').val() != "" ) {
            isvalid = false;
            $('#edituser_oldpassword').addClass('invalid');
            $('#edituser_newpassword').addClass('invalid');
            $('#edituser_newpassword2').addClass('invalid')
            $.notify({
                message: 'Вы не указали старый пароль!'
            },{
                type: 'danger'
            });
        }


        if ( isvalid == true ) {
            $('#edituser_phone').inputmask('unmaskedvalue');
            form[0].submit();
        }
    });



});
