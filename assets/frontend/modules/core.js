/**
 * @author Khaydarov Murod
 */

module.exports = (function (core) {

    core.settings = {

        handler : null,
        server  : null,
        success : function () {},
        error   : function () {}
    };


    core.handle = function (settings) {

        this.settings.handler = settings.handler;
        this.settings.server  = settings.server;
        this.settings.success = settings.success;
        this.settings.error   = settings.error;

    };

    /**
     * Logging method
     * @param msg   - string
     * @param type  - ['log', 'info', 'warn']
     * @param prefix
     * @param arg
     */

    core.log = function (msg, type, prefix, arg) {

        var staticLength = 25;

        prefix = prefix === undefined ? '[votepad]:' : '[' + prefix + ']:';

        prefix = prefix.length < staticLength ? prefix : prefix.substr( 0, staticLength - 3 );

        while (prefix.length < staticLength - 1) {

            prefix += ' ';

        }

        type = type || 'log';

        if (!arg) {

            arg  = msg || 'undefined';
            msg = prefix + '%o';

        } else {

            msg = prefix + msg;

        }


        try{

            if ( 'console' in window && window.console[ type ] ) {

                if ( arg ) window.console[ type ]( msg, arg );
                else window.console[ type ]( msg );

            }

        }catch(e) {}

    };


    /**
     * Parse String To Node
     * @param string
     * @returns {Node}
     */
    core.parseHTML = function (string) {

        var parser = new DOMParser();

        return parser.parseFromString(string, 'text/html').body.firstChild;

    };

    /**
     * Helper for insert one element before another
     * @param target
     * @param element
     */
    core.insertBefore = function (target, element) {

        target.parentNode.insertBefore(element, target);

    };


    /**
     * Helper for insert one element after another
     * @param target
     * @param element
     */
    core.insertAfter = function (target, element) {

        target.parentNode.insertBefore(element, target.nextSibling);

    };

    return core;


})({});