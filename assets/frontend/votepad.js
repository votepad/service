/**
 * Entry point of Votepad scripts
 *
 * @description Contains of separate modules
 *
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 * @copyright Votepad Team 2017
 */

var votepad = ( function (votepad) {

    return votepad;

})({});

votepad.transport   = require('./modules/transport');
votepad.draw        = require('./modules/draw');
votepad.ajax        = require('./modules/js/ajax');
votepad.header      = require('./modules/js/header');
votepad.collapse    = require('./modules/js/collapse');
votepad.cookies     = require('./modules/js/cookies');
votepad.tabs        = require('./modules/js/tabs');
votepad.websocket   = require('./modules/js/websocket');
votepad.storage     = require('./modules/js/localstorage');

module.exports = votepad;