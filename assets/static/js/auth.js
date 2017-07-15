var auth = (function (auth) {

    var corePrefix      = "VP auth",
        host            = window.location.host,
        protocol        = window.location.protocol,
        pathname        = window.location.pathname,
        signIn          = null,
        signInLogged    = null,
        forget          = null,
        judge           = null,
        reset           = null,
        registr         = null;

    function prepare_() {
        signIn        = document.getElementById('signin');
        signInLogged  = document.getElementById('signinLogged');
        judge         = document.getElementById('judge');
        forget        = document.getElementById('forget'); // TODO submit
        reset         = document.getElementById('reset');  // TODO submit
        registr       = document.getElementById('registr');

        if (!signIn || !forget || !judge) {
            vp.core.log('Missed SignIn OR Forget OR Jude forms', 'error', corePrefix);
            return;
        }

        if (reset) {
            openResetForm_();
            return;
        }

        if (signInLogged) signInLogged.addEventListener('submit', submitSignInLogged_);
        if (registr) registr.addEventListener('submit', submitRegistr_);

        signIn.addEventListener('submit', submitSignIn_);
        judge.addEventListener('submit', submitJudge_);
    }


    /**
     * Open Reset Password Form
     * @private
     */
    function openResetForm_() {
        var cancelReset = document.getElementById('cancelReset');
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
                    window.location.replace(protocol + '//' + host + '/user/' + response.id);
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

                if (parseInt(response.code) === 21) {
                    window.location.replace(protocol + '//' + host + '/user/' + response.id);
                    return;
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on registr form','error',corePrefix ,callbacks);
                registr.classList.add('loading');
            }
        };

        vp.ajax.send(ajaxData);
    }

    auth.logout = function() {

        var recover = document.getElementById('recover');
        if (!recover) window.location.reload();

        recover.value = 'logout';
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