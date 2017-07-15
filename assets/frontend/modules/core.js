/**
 * @author Khaydarov Murod
 */

module.exports = (function (core) {

    core.settings = {

        handler : null,
        server  : null,
        success : function() {},
        error   : function() {}
    };


    core.handle = function(settings) {

        this.settings.handler = settings.handler;
        this.settings.server  = settings.server;
        this.settings.success = settings.success;
        this.settings.error   = settings.error;
    };

    return core;


})({});