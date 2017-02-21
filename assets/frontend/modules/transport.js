/**
 * @copyright Khaydarov Murod
 */

var transport = (function(transport) {

    /**
     * @protected
     *
     * Native ajax method.
     * @param {Object} data - Callbacks and data
     */
    transport.ajax = function (data) {

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
    transport.prepare = function(input) {
        
        /**
         * For handler clicked
         */
        nwe.uploader.core.settings.handler.addEventListener('click', function() {

            input.click();

        }, false);

        /**
         * When file is selected
         */
        input.addEventListener('change', transport.fileSelected, false);

    };

    transport.fileSelected = function() {

        var input = this,
            files = input.files,
            filesLength = files.length,
            formdData = new FormData(),
            file,
            i;

        formdData.append('files', files[0], files[0].name);

        nwe.uploader.transport.ajax({

            url: nwe.uploader.core.settings.server,
            type: "POST",
            data: formdData,
            success: nwe.uploader.core.settings.success,
            error: nwe.uploader.core.settings.error

        });

    };


    return transport;

})({});

module.exports = transport;