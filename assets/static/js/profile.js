$(document).ready(function () {

    var hash = vp.cookies.get('reset_link');
    hash = hash?hash.split('~')[1]:'';
    vp.cookies.remove('reset_link');


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

        vp.ajax.send({
            data: new FormData($('#reset_password_form')[0]),
            url: '/reset/' + hash,
            type: 'POST',
            beforeSend: function() {
                $('#reset_password_form .modal-content').addClass('whirl');
            },
            success: resetPasswordResponse,
            error: function() {
                //console.log('error ajax send');
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




    var orgID, eventID, name, orgBlock, eventBlock, i,
        userID = document.getElementById('userID').dataset.id;

    var deleteOrgBnt = document.getElementsByClassName('deleteOrganization');
    for (i = 0; i < deleteOrgBnt.length; i++) {
        deleteOrgBnt[i].addEventListener('click', deleteOrganization, false);
    }

    var deleteEventBnt = document.getElementsByClassName('deleteEvent');
    for (i = 0; i < deleteEventBnt.length; i++) {
        deleteEventBnt[i].addEventListener('click', deleteEvent, false);
    }

    /**
     * Delete organization
     */
    function deleteOrganization(event) {
        orgID = event.target.dataset.id;
        name = event.target.dataset.name;

        swal({
            text: "Вы уверены, что хотите выйти из " + name + " ?",
            showCancelButton: true,
            confirmButtonText: 'Выйти',
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            orgBlock = document.getElementById('organization_'+orgID);


            ajaxData = {
                url: '/organization/'+orgID+'/member/remove/'+userID,
                beforeSend: function(callback) {
                    orgBlock.classList.add('whirl');
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.code == '47') {
                        $.notify({ message: "Вы успешно вышли из организации "+ name}, { type: "success" });
                        orgBlock.remove();
                        document.getElementById('myOrganizationsCounter').innerHTML = parseInt(document.getElementById('myOrganizationsCounter').innerHTML) - 1;
                        checkNumberOfOrgs();
                    } else {
                        $.notify({ message: "Что-то пошло не так... Попробуйте ещё раз"}, { type: "warning" });
                        orgBlock.classList.remove('whirl');
                        return;
                    }
                },
                error: function(callback) {
                    //console.log(callback);
                    orgBlock.classList.remove('whirl');
                }
            };

            vp.ajax.send(ajaxData);

        });

    }






    /**
     * Delete Event
     */
    function deleteEvent(event) {
        eventID = event.target.dataset.id;
        name = event.target.dataset.name;

        swal({
            text: "Вы уверены, что хотите выйти из " + name + " ?",
            showCancelButton: true,
            confirmButtonText: 'Выйти',
            cancelButtonText: 'Отмена',
            confirmButtonClass: 'btn btn_primary',
            cancelButtonClass: 'btn btn_default',
            buttonsStyling: false
        }).then(function () {

            eventBlock = document.getElementById('event_'+eventID);


            ajaxData = {
                url: '/event/'+eventID+'/assistant/remove/'+userID,
                beforeSend: function(callback) {
                    eventBlock.classList.add('whirl');
                },
                success: function(response) {
                    response = JSON.parse(response);
                    //console.log(response);
                    if (response.code == '57') {
                        $.notify({ message: "Вы успешно вышли из мероприятия "+ name}, { type: "success" });
                        eventBlock.remove();
                        document.getElementById('myEventsCounter').innerHTML = parseInt(document.getElementById('myEventsCounter').innerHTML) - 1;
                        checkNumberOfEvent();
                    } else {
                        $.notify({ message: "Что-то пошло не так... Попробуйте ещё раз"}, { type: "warning" });
                        eventBlock.classList.remove('whirl');
                        return;
                    }
                },
                error: function(callback) {
                    //console.log(callback);
                    eventBlock.classList.remove('whirl');
                }
            };

            vp.ajax.send(ajaxData);

        });

    }


    /**
     * Checking number of organizations
     */
    var noorgs = document.createElement('div');
    noorgs.id = "noOrgs";
    noorgs.style = "padding: 20px;text-align: center;";
    noorgs.innerHTML = "Организации не созданы.";

    var checkNumberOfOrgs = function () {

        if (parseInt(document.getElementById('myOrganizationsCounter').innerHTML) == 0) {
            document.getElementById('myOrganizations').append(noorgs);
        } else if ( document.getElementById('noOrgs') ) {
            document.getElementById('noOrgs').remove();
        }
    };
    checkNumberOfOrgs();


    /**
     * Checking number of events
     */
    var noevent = document.createElement('div');
    noevent.id = "noEvent";
    noevent.style = "padding: 20px;text-align: center;";
    noevent.innerHTML = "У Вас нет мероприятий. Вы можете создать мероприятие внутри организации.";

    var checkNumberOfEvent = function () {

        if (parseInt(document.getElementById('myEventsCounter').innerHTML) == 0) {
            document.getElementById('myEvents').append(noevent);
        } else if ( document.getElementById('noEvent') ) {
            document.getElementById('noEvent').remove();
        }
    };

    checkNumberOfEvent();


    $('.edit-user-info__avatar').on('click', function() {

        var imgAvatar = document.getElementById('user-avatar'),
            inputAvar = document.getElementById('input-avatar');

        var callbacks_ = {

            beforeSend : function() {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    imgAvatar.classList.add('user-info__avatar--loading');
                    imgAvatar.src = event.target.result;

                }
            },

            success : function(response) {

                var file = JSON.parse(response);

                if (!file.success) {

                    imgAvatar.src = '';
                    return;

                }

                imgAvatar.src = file.data.url;
                imgAvatar.classList.remove('user-info__avatar--loading');

                inputAvar.value = file.data.name;

            },

            error : function(response) {

                imgAvatar.src = '';

            }

        };

        vp.transport.init({
            url : '/transport/1',
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend,
            success : callbacks_.success,
            error : callbacks_.error
        });


    });

    $('.js-user-jumbotron-cover').on('click', function() {

        var imgProfileBranding = document.getElementById('user-cover-uploaded');

        var callbacks_ = {

            beforeSend : function () {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    imgProfileBranding.classList.add('user-info__branding--loading');
                    imgProfileBranding.src = event.target.result;

                }

            },

            success : function (response) {

                var file = JSON.parse(response);

                if (!file.success) {

                    imgProfileBranding.src = '';
                    return;

                }

                imgProfileBranding.src = file.data.url;
                imgProfileBranding.classList.remove('user-info__branding--loading');

            }

        };

        vp.transport.init({
            url : '/transport/2',
            multiple : false,
            beforeSend : callbacks_.beforeSend,
            success : callbacks_.success,
            error : callbacks_.error
        });

    });


});
