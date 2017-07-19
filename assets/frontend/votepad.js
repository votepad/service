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
    votepad.header       = require('./modules/js/header');
    votepad.collapse     = require('./modules/js/collapse');
    votepad.cookies      = require('./modules/js/cookies');
    votepad.parallax     = require('./modules/js/parallax');
    votepad.tabs         = require('./modules/js/tabs');
    votepad.websocket    = require('./modules/js/websocket');
    votepad.storage      = require('./modules/js/localstorage');
    votepad.notification = require('./modules/js/notification');
    votepad.modal        = require('./modules/js/modal');

    return votepad;

})({});