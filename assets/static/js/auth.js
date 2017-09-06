var auth = (function (auth) {

    var corePrefix      = "VP auth",
        host            = window.location.host,
        protocol        = window.location.protocol,
        pathname        = window.location.pathname,
        signIn          = null,
        signInLogged    = null,
        forget          = null,
        judge           = null,
        hasReset        = null,
        reset           = null,
        registr         = null;

    function prepare_() {
        signIn        = document.getElementById('signin');
        signInLogged  = document.getElementById('signinLogged');
        judge         = document.getElementById('judge');
        forget        = document.getElementById('forget');
        hasReset      = pathname.split('/').indexOf('reset') !== -1;
        registr       = document.getElementById('registr');

        if (!signIn || !forget || !judge) {
            vp.core.log('Missed SignIn OR Forget OR Jude forms', 'error', corePrefix);
            return;
        }

        if (hasReset) {
            createResetForm_();
            reset.addEventListener('submit', submitReset_);
            return;
        }

        if (signInLogged) signInLogged.addEventListener('submit', submitSignInLogged_);
        if (registr) registr.addEventListener('submit', submitRegistr_);

        signIn.addEventListener('submit', submitSignIn_);
        forget.addEventListener('submit', submitForget_);
        judge.addEventListener('submit', submitJudge_);
    }


    /**
     * Open Reset Password Form
     * @private
     */
    function createResetForm_() {
        reset = vp.modal.create({
            'node': 'FORM',
            'id': 'reset',
            'size': 'small',
            'header': false,
            'body':
                '<div class="t-lh-1_5 text-bold text-center mb-10">Изменить пароль</div>' +
                '<div class="form-group form-group--with-icon">' +
                    '<input id="reset_password" type="password" name="password1" placeholder="Введите новый пароль" class="form-group__input" autocomplete="off" autofocus maxlength="18">' +
                    '<label for="reset_password" class="form-group__label-icon">' +
                        '<i class="fa fa-lock" aria-hidden="true"></i>' +
                    '</label>' +
                '</div>' +
                '<div class="form-group form-group--with-icon">' +
                    '<input id="reset_password1" type="password" name="password2" placeholder="Повторите новый пароль" class="form-group__input" autocomplete="off" maxlength="18">' +
                    '<label for="reset_password1" class="form-group__label-icon">' +
                        '<i class="fa fa-lock" aria-hidden="true"></i>' +
                    '</label>' +
                '</div>' +
                '<input type="hidden" name="hash" value="' + pathname.split('/')[pathname.split('/').indexOf('reset') + 1] + '">'+
                '<input type="hidden" name="reset" id="resetAction">'+
                '<button type="button" onclick="auth.cancelReset()" class="btn btn--default fl_l m-0">Отменить</button>' +
                '<button id="resetSubmit" type="submit" class="btn btn--brand fl_r m-0">Изменить</button>'
        });

    }


    /**
     * Submit Sign In Form
     * @private
     */
    function submitSignIn_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/sign/organizer',
            type: 'POST',
            data: new FormData(signIn),
            beforeSend: function(){
                signIn.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                signIn.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 14) {
                    window.location.replace(protocol + '//' + host + '/user/' + response.id);
                    return;
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on signIn form','error',corePrefix ,callbacks);
                signIn.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Submit Sign In Logged Form
     * @private
     */
    function submitSignInLogged_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/sign/organizer',
            type: 'POST',
            data: new FormData(signInLogged),
            beforeSend: function(){
                signInLogged.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                signInLogged.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 10) {
                    window.location.reload();
                    return;
                }

                if (parseInt(response.code) === 11) {
                    window.location = protocol + '//' + host + '/user/' + response.id;
                    return;
                }

                if (parseInt(response.code) === 12) {
                    window.location = protocol + '//' + host;
                    return;
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on SignInLogged form','error',corePrefix ,callbacks);
                signInLogged.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Submit Judge Form
     * @private
     */
    function submitJudge_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/sign/judge',
            type: 'POST',
            data: new FormData(judge),
            beforeSend: function(){
                judge.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                judge.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                if (parseInt(response.code) === 10) {
                    window.location.reload();
                    return;
                }

                if (parseInt(response.code) === 14) {
                    window.location.replace(protocol + '//' + host + '/voting');
                    return;
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on judge form','error',corePrefix ,callbacks);
                judge.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Submit Forget Form
     * @private
     */
    function submitForget_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/user/forgetpassword',
            type: 'POST',
            data: new FormData(forget),
            beforeSend: function(){
                forget.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                forget.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
                if (parseInt(response.code) === 61) {
                    vp.modal.hide(forget.closest('.modal'));
                }
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on forget form','error',corePrefix ,callbacks);
                forget.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Submit Reset Form
     * @private
     */
    function submitReset_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/user/resetpassword',
            type: 'POST',
            data: new FormData(reset),
            beforeSend: function(){
                reset.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                reset.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                window.setTimeout(function () {
                    if (parseInt(response.code) === 36) {
                        window.location.replace(protocol + '//' + host + '/user/' + response.id);
                    }

                    if (parseInt(response.code) === 37) {
                        window.location.pathname = '';
                    }
                }, 700);

            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on reset form','error',corePrefix ,callbacks);
                reset.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Submit Registr Form
     * @private
     */
    function submitRegistr_(event) {
        event.preventDefault();

        var ajaxData = {
            url: '/signup',
            type: 'POST',
            data: new FormData(registr),
            beforeSend: function(){
                registr.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                registr.classList.remove('loading');

                vp.core.log(response.message, response.status, corePrefix);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 35) {
                    window.location = protocol + '//' + host + '/user/' + response.id;
                }
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on registr form','error',corePrefix ,callbacks);
                registr.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    /**
     * Cancel Reset
     */
    auth.cancelReset = function () {
        document.getElementById('resetAction').name = 'resetCancel';
        document.getElementById('resetSubmit').click();
    };

    /**
     * User Logout
     */
    auth.logout = function() {

        var action = document.getElementById('recover');
        if (!action) window.location.reload();

        action.name = 'logout';
        document.getElementById('recoverSubmit').click();
    };

    /**
     * Open Sign In Form
     */
    auth.toSignIn = function () {
        signIn.classList.remove('hide');
        forget.classList.add('hide');
        judge.classList.add('hide');
    };

    /**
     * Open Forget Form
     */
    auth.toForget = function () {
        signIn.classList.add('hide');
        forget.classList.remove('hide');
    };

    /**
     * Open Judge Form
     */
    auth.toJudge = function () {
        signIn.classList.add('hide');
        forget.classList.add('hide');
        judge.classList.remove('hide');
    };


    auth.init = function () {
        prepare_();
    };

    return auth;

})({});