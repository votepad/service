/**
 * @copyright Khaydarov Murod
 */

module.exports = (function (transport) {

    /** transport settings */
    var settings_ = null;

    /** input */
    var input_  = null;

    /**
     * @protected
     *
     * Makes UI elements
     */
    var prepare_ = function () {

        input_ = vp.draw.node('INPUT', '', {
            type : 'file'
        });

        if (settings_.multiple) {

            input_.multiple = true;

        }

        if (settings_.accept) {

            input_.accept = settings_.accept;

        }

        input_.click();

        /**
         * When file is selected
         */
        input_.addEventListener('change', fileSelected_, false);

    };

    var fileSelected_ = function () {

        var files = input_.files,
            // filesLength = files.length,
            formdData = new FormData();

        formdData.append('files', files[0], files[0].name);
        formdData.append('params', JSON.stringify(settings_.params));

        vp.ajax.send({
            url: settings_.url,
            type: 'POST',
            data: formdData,
            beforeSend: settings_.beforeSend,
            success: settings_.success,
            error: settings_.error
        });

    };

    transport.init = function (settings) {

        settings_ = settings;

        prepare_();

    };

    transport.getInput = function () {

        return input_;

    };

    return transport;

})({});