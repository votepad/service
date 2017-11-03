var voting = function (voting) {

    var ws          = null,
        STORAGE_KEY = 'votepad.scores.',
        judge       = null,
        corePrefix  = "VP scores - voting";


    var sendSavedScores = function () {

        var keys    = vp.storage.get(STORAGE_KEY + judge),
            newKeys;

        if (!keys) {
            return;
        }

        newKeys = keys.filter(function (key) {

            var data = vp.storage.get(STORAGE_KEY + key);

            if (data && ws.status() === 1) {

                ws.send(data);
                vp.storage.remove(STORAGE_KEY + key);
                return false;

            }

            return true;

        });

        vp.storage.set(STORAGE_KEY + judge, newKeys);

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
            vp.core.log('You are online!', 'info', corePrefix);
            eventScores.status('online');
            sendSavedScores(judge);
        },

        closed: function () {
            vp.core.log('You are offline :(', 'info', corePrefix);
            eventScores.status('offline');
        },

        message: function (message) {
            vp.core.log('You have a message: ' + message.data, 'info', corePrefix);
        }

    };

    var saveScore = function (data) {

        var fields = data,
            key = fields.contest + '.' + fields.stage + '.' + fields.criterion + '.' + fields.judge + '.' + fields.member;

        vp.storage.append(STORAGE_KEY + fields.judge, key);
        vp.storage.set(STORAGE_KEY + key, data);

    };


    voting.init = function (j_id, host, port) {

        judge = j_id;
        openWS(port, host);

    };


    voting.sendScore = function (data) {

        if (ws.status() == 1) {

            ws.send(data);

            return true;
        }

        ws.reconnect(5)
            .then(
                function (){
                    sendScore(event);
                },
                function () {
                    saveScore(data);
                })

    };


    return voting;

}({});