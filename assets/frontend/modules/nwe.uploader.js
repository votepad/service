/**
 * Created by behzodqurbonov on 20.01.17.
 */

var uploader = (function(uploader) {


    uploader.node = null;

    uploader.callbacks = {};

    uploader.init = function(settings) {

        /**
         * Draw input
         */
        nwe.transport.init();

        uploader.node   = settings.node;
        uploader.server = settings.server;
        uploader.callbacks.success = settings.success;
        uploader.callbacks.error   = settings.error;
        uploader.callbacks.before  = settings.before;


        listenNode();
    };

    var listenNode = function() {

        uploader.node.addEventListener('click', clickInput, false);

    };

    var clickInput = function() {

        nwe.transport.input.click();

        nwe.transport.input.addEventListener('change', selectAndUpload, false);
    };

    var selectAndUpload = function() {

        var input = nwe.transport.input,
            files = input['files'],
            file  = files[0];

        var formData = new FormData();

        formData['files'] = file;
        // formData.append('files', file, file.name);
        console.log(formData);

        nwe.transport.ajax({
            url : uploader.server,
            type : "POST",
            data : formData,
            contentType : false,
            beforeSend : uploader.callbacks.beforeSend,
            success : uploader.callbacks.success,
            error : uploader.callbacks.error
        });

    };

    return uploader;

})({});

module.exports = uploader;
