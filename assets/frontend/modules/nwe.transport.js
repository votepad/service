/**
 * @copyright Khaydarov Murod
 */

var ui = require('./ui');

var transport = (function() {

    /**
     * @protected
     *
     * @type {DOMElement}
     */
    var input = null;

    /**
     * @protected
     *
     * Native ajax method.
     * @param {Object} data - Callbacks and data
     */
    var ajax = function (data) {

        if (!data || !data.url){
            return;
        }

        var XMLHTTP          = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP"),
            success_function = function(){};

        data.async           = true;
        data.type            = data.type || 'GET';
        data.data            = data.data || '';
        data['content-type'] = data['content-type'] || 'application/json; charset=utf-8';
        success_function     = data.success || success_function ;

        if (data.type == 'GET' && data.data) {
            data.url = /\?/.test(data.url) ? data.url + '&' + data.data : data.url + '?' + data.data;
        }

        if (data.withCredentials) {
            XMLHTTP.withCredentials = true;
        }

        if (data.beforeSend && typeof data.beforeSend == 'function') {
            data.beforeSend.call();
        }

        XMLHTTP.open( data.type, data.url, data.async );
        XMLHTTP.setRequestHeader("Content-type", data['content-type'] );
        XMLHTTP.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        XMLHTTP.onreadystatechange = function() {
            if (XMLHTTP.readyState == 4 && XMLHTTP.status == 200) {
                success_function(XMLHTTP.responseText);
            }
        };

        XMLHTTP.send(data.data);

    };

    /**
     * @protected
     *
     * Makes UI elements
     */
    var make = function() {

        var input = function() {

            var input = document.createElement('input');
            input.type = 'file';

            input.addEventListener('change', nwe.file.uploaded, false);

            nwe.ui.input = input;
        }
    };

})();
