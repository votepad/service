var scores = function () {

    var ws = null,
        STORAGE_KEY = 'votepad.scores.';

    var init = function (host, port) {

        var elems = document.querySelectorAll('.js-scores');

        Array.prototype.forEach.call(elems, function (current) {

            current.addEventListener('toggle', sendScore);

        });

        openWS(port, host);

    };

    var openWS = function (port, host) {
        ws = new vp.websocket({
            host: host || 'localhost',
            path: 'voting',
            port: port || 8000,
            open: wsHandlers.opened,
            close: wsHandlers.closed,
            message: wsHandlers.message
        });
    };


    var wsHandlers = {

        opened: function () {
            console.log('You`re online!');
        },

        closed: function () {
            console.log('You`re offline :(');
        },

        message: function (message) {
            console.log('You have a message: ');
            console.log(message.data);
        }

    };

    var saveScore = function (data) {

        vp.storage.set(STORAGE_KEY + data.judge, data);

    };

    var sendScore = function (event) {

        if (ws.status() < 2) {
            ws.send(JSON.parse(event.value));
            return true;
        }

        ws.reconnect(10)
            .then(function(){sendScore(event)}, function() {saveScore(event.value)});

    };

    return {
        init: init
    };

}();