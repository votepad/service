var profile = (function (profile) {

    var corePrefix      = "VP profile",
        profileWrap     = document.getElementById('profile'),
        changePassword  = document.getElementById('changePasswordModal');

    if (!profileWrap || !changePassword) {
        vp.core.log('Missed profile or/and changePassword forms', 'error', corePrefix);
        return;
    }

    profileWrap.addEventListener('submit', submitProfile_);
    changePassword.addEventListener('submit', submitChangePassword_);

    function submitProfile_() {
        event.preventDefault();

        var ajaxData = {
            url: '/user/update',
            type: 'POST',
            data: new FormData(profileWrap),
            beforeSend: function(){
                profileWrap.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                profileWrap.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on sending profile form','error',corePrefix,callbacks);
                profileWrap.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);

    }

    function submitChangePassword_() {
        event.preventDefault();

        var ajaxData = {
            url: '/user/changepassword',
            type: 'POST',
            data: new FormData(changePassword),
            beforeSend: function(){
                changePassword.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                changePassword.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');
                vp.core.log(response.message, response.status, corePrefix);
                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
                if (parseInt(response.code) === 33) {
                    vp.modal.hide(changePassword);
                    return;
                }
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on change password form','error',corePrefix,callbacks);
                changePassword.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    profile.updateAvatar = function () {

        var profileAvatar = document.getElementsByClassName('profile__avatar-img')[0],
            oldAvatarScr  = profileAvatar.src;

        var callbacks_ = {

            beforeSend : function() {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    profileAvatar.classList.add('image--loading');
                    profileAvatar.src = event.target.result;

                }
            },

            success : function(response) {

                var file = JSON.parse(response);

                if (!file.success) {

                    imgProfileBranding.src = '';
                    return;

                }

                profileAvatar.src = file.data.url;
                profileAvatar.classList.remove('image--loading');
            },

            error : function(response) {

                profileAvatar.src = oldAvatarScr;
                vp.core.log('error occur on updating profile avatar', response.status, corePrefix);

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
    };

    profile.confirmEmail = function () {

        var ajaxData = {
            url: '/user/confirmemail',
            type: 'POST',
            beforeSend: function(){
                profileWrap.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                profileWrap.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on sending confirm email','error',corePrefix,callbacks);
                profileWrap.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);

    };

    return profile;

})({});