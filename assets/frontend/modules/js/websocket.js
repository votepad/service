module.exports = function (properties) {

    var ws = null;

    var setWS = function (props) {

        return new Promise(function (resolve, reject) {

            var protocol = 'ws' + (props.secure ? 's' : '') + '://',
                host = props.host || 'localhost',
                path = props.path ? '/' + props.path : '',
                port = props.port ? ':' + props.port : '',
                url = protocol + host + port + path;


            ws = new WebSocket(url);

            var handlers = {

                opened: function (e) {


                    if (typeof properties.open == 'function') {
                        properties.open();
                    }

                    resolve();

                },

                closed: function (e) {

                    if (typeof properties.close == 'function') {
                        properties.close();
                    }

                    reject();

                },

                message: function (msg) {

                    if (typeof properties.message == 'function') {
                        properties.message(msg);
                    }

                },

                error: function (e) {

                    if (typeof properties.error == 'function') {
                        properties.error(e);
                    }

                }

            };

            ws.onopen = handlers.opened;
            ws.onmessage = handlers.message;
            ws.onerror = handlers.error;
            ws.onclose = handlers.closed;

        });
    };

    var send = function (message) {

        ws.send(JSON.stringify(message));

    };

    var close = function () {

        ws.close();

    };

    var status = function() {

        return ws.readyState;

    };

    var reconnect = function (attempts) {

        if (ws == null) {
            return;
        }

        return new Promise( function (resolve, reject) {

            setWS(properties)
                .then(function () {
                        resolve();
                    },
                    function () {

                        if (attempts > 1) {

                            return reconnect(attempts - 1)

                        } else {

                            reject();

                        }

                    });


        })



    };



    setWS(properties).catch(function(){});

    return {
        send: send,
        close: close,
        reconnect: reconnect,
        status: status
    };

};