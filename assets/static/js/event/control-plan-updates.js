var updates = function () {

    var ws;

    var updatesHandler = function (message) {

        console.log(message.data);

        var data = JSON.parse(message.data);

        switch (data.type) {
            case 'judge':
                var judge = document.getElementById('judge-' + data.data.id);

                if (data.data.status) {
                    judge.classList.remove('label-status--offline');
                    judge.classList.add('label-status--online');
                    judge.dataset.status = 'Online'
                } else {
                    judge.classList.remove('label-status--online');
                    judge.classList.add('label-status--offline');
                    judge.dataset.status = 'Offline'
                }
                break;
        }

    };


    var init = function () {

        ws = new vp.websocket({
            host: 'votepad.my',
            port: 8001,
            path: 'management',
            message: updatesHandler,
            open: function(){console.log('online')},
            error: console.log,
            close: function(){console.log('off')},
        })


    };


    init();

}();