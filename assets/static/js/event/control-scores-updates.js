var updates = function () {

    var ws;

    var updatesHandler = function (message) {

        var data = JSON.parse(message.data);
        console.log(data);

        var updateContest = function(data) {
            var contest = document.getElementById('stage_'+data.contest+'_sum');
            if (!contest) return;

            var member = contest.querySelector('#member-'+data.member);
            if (!member) return;

            var judge = member.querySelector('#judge-score-'+data.judge);
            if (!judge) return;
            judge.textContent = data.scores.contest;

            var contestScore = member.querySelector('#contest-total-'+data.contest);
            if (!contestScore) return;
            contestScore.textContent = data.total.contest;

        };

        var updateTotal = function (data) {

            var total = document.getElementById('total-results');
            if (!total) return;

            var member = total.querySelector('#member-'+data.member);
            if (!member) return;

            var contest = member.querySelector('#contest-'+data.contest);
            if (!contest) return;

            contest.textContent = data.total.contest;

            var final = member.querySelector('#final-result');
            if (!final) return;

            final.textContent = data.total.result;

        };

        var updateStage = function (data) {

            var stage = document.getElementById('stage-'+data.stage);
            if (!stage) return;
            var member = stage.querySelector('#member-'+data.member);
            if (!member) return;
            var judge = member.querySelector('#judge-score-'+data.judge);
            if (!judge) return;

            judge.textContent = data.scores.stage;

            var criterions = $(judge).data('scores') || {};
            criterions[data.criterion.split('-')[2]] = data.scores.criterion;
            $(judge).data('scores', criterions);

            var stageTotal = member.querySelector('#stage-total-'+data.stage.split('-')[1]);
            if (!stageTotal) return;
            stageTotal.textContent = data.total.stage;

        };

        switch (data.type) {
            case 'event':
                updateContest(data.data);
                updateTotal(data.data);
                updateStage(data.data);
                break;
        }

    };


    var init = function (host) {

        ws = new vp.websocket({
            host: host,
            port: 8001,
            path: 'management',
            secure: true,
            message: updatesHandler,
            open: function(){console.log('online')},
            error: console.log,
            close: function(){console.log('off')},
        })


    };


    return {
        init: init
    };

}();