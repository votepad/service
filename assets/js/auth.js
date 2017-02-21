$(document).ready(function(){
    
    /**
    * Authorization forms
    * user modal && judge modal
    */

    $('body').on('keyup','#user_modal', function(event){
        if (event.keyCode == 13)
            $('#userSignIn').click();
    });
    $('body').on('keyup','#judge_modal', function(event){
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
    * Change User & Jusge SignIn forms
    */
    $('#toJudgeModal').click(function(){
        $('.auth-modal .modal-wrapper').addClass('up');
    });
    $('#toUserModal').click(function(){
        $('.auth-modal .modal-wrapper').removeClass('up');
    });

    /**
    * Confirm Auth forms
    */
    $('#userSignIn').click(function(){
        if ($('#auth_email').val() == '' || ! /\S+@\S+\.\S+/.test($('#auth_email').val()) ) {
            $.notify({
                message: 'Вы ввели неправильно email. Попробуйте ввести снова!'
            },{
                type: 'danger'
            });
            $('#auth_email').addClass('invalid');
        } else if ( $("#auth_password").val() == '' ) {
            $('#auth_password').addClass('invalid');
        } else {
            $('#user_modal')[0].submit();
        }
    });
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
            $('#judge_modal')[0].submit();
        }
    });

});
