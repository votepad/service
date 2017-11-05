var update = function (update) {

    var ws          = null,
        corePrefix  = "VP scores - update";


    /**
     * Update Scores On Page
     * @private
     */
    var updatesHandler_ = function (message) {

        var data = JSON.parse(message.data);
console.log(data);
        /**
         * Update Final result - total scores of all contests and result
         * @param data
         * @private
         */
        var updateFinalResult_ = function (data) {

            var area = document.getElementById('final-' + data.mode + '-results');
            if (!area) return;

            var member = area.querySelector('[data-member="' + data.member +'"]');
            if (!member) return;

            var contest = member.querySelector('[data-contest="' + data.contest + '"]');
            if (!contest) return;

            contest.textContent = data.total.contest;

            var total = member.querySelector('[data-contest="total"]');
            if (!total) return;

            total.textContent = data.total.result;

        };


        /**
         * Update Contest - total scores of content
         * @param data
         */
        var updateContestResult_ = function(data) {
            var contest = document.getElementById('content-' + data.mode + '-' + data.contest);
            if (!contest) return;

            var total = contest.querySelector('[data-contest="total"]');
            if (!total) return;

            var member = total.querySelector('[data-member="' + data.member + '"]');
            if (!member) return;

            var judge = member.querySelector('[data-judge="' + data.judge + '"]');
            if (!judge) return;

            judge.textContent = data.scores.contest;

            var judgeTotal = member.querySelector('[data-judge="total"]');
            if (!judgeTotal) return;

            judgeTotal.textContent = data.total.contest;

        };

        /**
         * Update Stage - scores on tab `stage` + update `data-scores` for editing criterions
         * @param data
         */
        var updateStageResult_  = function (data) {
            var stage = document.querySelector('[data-stage="' + data.stage + '"]');
            if (!stage) return;

            var member = stage.querySelector('[data-member="' + data.member + '"]');
            if (!member) return;

            var judge = member.querySelector('[data-judge="' + data.judge + '"]');
            if (!judge) return;

            judge.textContent = data.scores.stage;

            var criterions = judge.dataset.scores,
                ind        = null;

            if (criterions) {
                ind = data.criterion.split('-')[2];
                criterions = JSON.parse(criterions);
                criterions[ind] = data.scores.criterion;
                criterions = JSON.stringify(criterions);
                judge.dataset.scores = criterions;
            }

            var judgeTotal = member.querySelector('[data-judge="total"]');
            if (!judgeTotal) return;

            judgeTotal.textContent = data.total.stage;

        };

        /**
         * Update Judge Status
         * @param data
         */
        var updateJudgeStatus_  = function (data) {
            var judge = document.querySelector('#judgeStatus' + data.id);
            if (!judge) return;

            switch (data.status) {
                case 0:
                    judge.textContent = "offline";
                    judge.classList.remove('label--success');
                    judge.classList.add('label--danger');
                    break;
                case 1:
                    judge.textContent = "online";
                    judge.classList.add('label--success');
                    judge.classList.remove('label--danger');
                    break;
            }
        };


        switch (data.type) {
            case 'event':
                updateFinalResult_(data.data);
                updateContestResult_(data.data);
                updateStageResult_(data.data);
                break;
            case 'judge':
                updateJudgeStatus_(data.data);
                break;
        }

    };


    update.init = function (host) {
        ws = new vp.websocket({
            host: host,
            port: 8001,
            path: 'management',
            message: updatesHandler_,
            open: function(){
                vp.core.log('You are online!', 'info', corePrefix);
                eventScores.status('online');
            },
            error: console.log,
            close: function(){
                vp.core.log('You are offline :(', 'info', corePrefix);
                eventScores.status('offline');
            },
        })
    };

    return update;

}({});