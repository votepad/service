var scores = function () {

    var ws = null;

    var init = function (url) {

        ws = new WebSocket(url);

        ws.onclose = closed;

    };

    var send = function (data) {

        ws.send(JSON.stringify(data));

    };

    var closed = function (e) {
        console.log(e);
    };

    return {
        init: init,
        send: send
    };

}();