/**
 * Entry point of Votepad scripts
 *
 * @description Contains of separate modules
 *
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 * @copyright Votepad Team 2017
 */

require('./modules/css/main');

module.exports = ( function (votepad) {

    votepad.core         = require('./modules/core');
    votepad.transport    = require('./modules/transport');
    votepad.draw         = require('./modules/draw');
    votepad.ajax         = require('./modules/js/ajax');
    votepad.footer       = require('./modules/js/footer');
    votepad.collapse     = require('./modules/js/collapse');
    votepad.cookies      = require('./modules/js/cookies');
    votepad.parallax     = require('./modules/js/parallax');
    votepad.tabs         = require('./modules/js/tabs');
    votepad.websocket    = require('./modules/js/websocket');
    votepad.storage      = require('./modules/js/localstorage');
    votepad.notification = require('./modules/js/notification');
    votepad.modal        = require('./modules/js/modal');
    votepad.form         = require('./modules/js/form');
    votepad.formula      = require('./modules/js/formula');


    var init_ = function () {
        votepad.footer.init();
        votepad.form.init();
        votepad.collapse.init();
        votepad.modal.init();
        votepad.tabs.init();
        votepad.parallax.init();
        votepad.notification.createHolder();
    };

    var initWelcome_ = function () {
        votepad.collapse.init();
        votepad.notification.createHolder();
        votepad.parallax.init();
        votepad.modal.init();
    };

    votepad.init = function () {
        document.addEventListener('DOMContentLoaded', init_);
    };

    votepad.initWelcome = function () {
        document.addEventListener('DOMContentLoaded', initWelcome_);
    };

    return votepad;

})({});