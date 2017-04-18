module.exports = function (properties) {

    var ws = null;

    var setWS = function (props) {

        var protocol = 'ws' + (props.secure ? 's' : '') + '://',
            host     = props.host || 'localhost',
            path     = props.path ? '/' + props.path : '',
            port     = props.port ? ':' + props.port : '',
            url = protocol + host + port + path;

        console.log(url);

        ws = new WebSocket(url);

        if (typeof props.open == 'function') {

            ws.onopen = props.open;

        }

        if (typeof props.message == 'function') {

            ws.onmessage = props.message;

        }

        if (typeof props.error == 'function') {

            ws.onerror = props.error;

        }

        if (typeof props.close == 'function') {

            ws.onclose = props.close;

        }

    };

    var send = function (message) {

        ws.send(message);

    };

    var close = function () {

        ws.close();

    };

    var status = function() {
        return ws.readyState;
    };

    setWS(properties);

    return {
        send: send,
        close: close,
        status: status
    };

};