var profile = (function (profile) {

    var corePrefix      = "VP profile",
        profileWrap     = null,
        changePassword  = null;

    profile.updateCover = function () {

        var profileBranding = document.getElementById('profileBranding'),
            oldBrandingScr  = profileBranding.src;

        var callbacks_ = {

            beforeSend : function() {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    profileBranding.classList.add('image--loading');
                    profileBranding.src = event.target.result;

                }
            },

            success : function(response) {

                response = JSON.parse(response);

                if (parseInt(response.code) !== 48) {
                    profileBranding.src = oldBrandingScr;
                    vp.notification.notify({
                        type: response.status,
                        message: response.message
                    });
                } else {
                    profileBranding.src = response.url;
                }

                profileBranding.classList.remove('image--loading');
            },

            error : function(response) {

                profileBranding.src = oldBrandingScr;
                vp.core.log('error occur on updating profile branding', response.status, corePrefix);

            }

        };

        vp.transport.init({
            url : '/transport/2',
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend,
            success : callbacks_.success,
            error : callbacks_.error
        });
    };

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

                response = JSON.parse(response);

                if (parseInt(response.code) !== 48) {
                    profileAvatar.src = oldAvatarScr;
                    vp.notification.notify({
                        type: response.status,
                        message: response.message
                    });
                } else {
                    profileAvatar.src = response.url;
                }

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
                vp.form.addLoadingClass(profileWrap);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(profileWrap);

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on sending confirm email','error',corePrefix,callbacks);
                vp.form.removeLoadingClass(profileWrap);
            }
        };

        vp.ajax.send(ajaxData);

    };

    var submitProfile_ = function() {
        event.preventDefault();

        var ajaxData = {
            url: '/user/update',
            type: 'POST',
            data: new FormData(profileWrap),
            beforeSend: function(){
                vp.form.addLoadingClass(profileWrap);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(profileWrap);

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on sending profile form','error',corePrefix,callbacks);
                vp.form.removeLoadingClass(profileWrap);
            }
        };

        vp.ajax.send(ajaxData);

    };

    var submitChangePassword_ = function() {
        event.preventDefault();

        var ajaxData = {
            url: '/user/changepassword',
            type: 'POST',
            data: new FormData(changePassword),
            beforeSend: function(){
                vp.form.addLoadingClass(changePassword);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(changePassword);

                vp.core.log(response.message, response.status, corePrefix);
                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
                if (parseInt(response.code) === 33) {
                    changePassword.reset();
                }
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on change password form','error',corePrefix,callbacks);
                vp.form.removeLoadingClass(changePassword);
            }
        };

        vp.ajax.send(ajaxData);
    };

    var init_ = function () {
        profileWrap    = document.getElementById('profile');

        if (profileWrap)
            profileWrap.addEventListener('submit', submitProfile_);

        changePassword = document.getElementById('changePassword');

        if (changePassword)
            changePassword.addEventListener('submit', submitChangePassword_);
    };

    document.addEventListener('DOMContentLoaded', init_);

    return profile;

})({});