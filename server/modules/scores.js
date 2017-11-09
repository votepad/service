module.exports = function () {

    var manager = require('./manager');

    /**
     *
     * @param data:
     *  - event         - event ID
     *  - mode          - 'participants || teams'
     *  - member        - member ID
     *  - countJudges   - number of judges on contest
     *  - judge         - judge ID
     *  - contest       - contest ID
     *  - stage         - stage ID
     *  - criterion     - criterion ID
     *  - score:
     *      - criterion - member score for criterion
     *      - stage     - stage coefficient
     *      - contest   - contest coefficient
     *      - result    - result coefficient
     */
    var update = function (data) {

        console.log('Received data:');
        console.log(data);

        var getFixedNumber = function(number) {
            return Number.isInteger(number) ? number : number.toFixed(1)
        };

        data.stage     = data.contest + '-' + data.stage;
        data.criterion = data.stage + '-' + data.criterion;

        return Mongo.connect(config.Mongo.url).then(function (db) {

            var collection = db.collection('event' + data.event);

            data.member = parseInt(data.member);
            data.judge = parseInt(data.judge);

            return collection.findOne({
                member: data.member,
                mode: data.mode,
                'scores.judge': data.judge
                },
                {'scores.judge.$': 1, 'total': 1})
                    .then(function (result) {

                        if (!result) {

                            return collection.findOne({
                                member: data.member,
                                mode: data.mode
                            }).then(

                                function(result) {

                                    var payload = {
                                        judge: data.judge,
                                        criterions: {[data.criterion]: parseFloat(data.score.criterion)},
                                        stages: {[data.stage]: data.score.stage * data.score.criterion},
                                        contests: {[data.contest]: data.score.contest * data.score.criterion},
                                        result: data.score.result * data.score.criterion
                                    };

                                    var total = {
                                        criterions: {[data.criterion]: parseFloat(data.score.criterion)},
                                        stages: {[data.stage]: data.score.stage * data.score.criterion / data.countJudges},
                                        contests: {[data.contest]: data.score.contest * data.score.criterion / data.countJudges},
                                        result: data.score.result * data.score.criterion / data.countJudges
                                    };

                                    var update = {
                                        member: data.member,
                                        mode: data.mode,
                                        judge: data.judge,
                                        contest: data.contest,
                                        result: data.result,
                                        stage: data.stage,
                                        criterion: data.criterion,
                                        scores: {
                                            criterion: getFixedNumber(payload.criterions[data.criterion]),
                                            stage: getFixedNumber(payload.stages[data.stage]),
                                            contest: getFixedNumber(payload.contests[data.contest]),
                                            result: getFixedNumber(payload.result)
                                        },
                                        total: {
                                            criterion: getFixedNumber(total.criterions[data.criterion]),
                                            stage: getFixedNumber(total.stages[data.stage]),
                                            contest: getFixedNumber(total.contests[data.contest]),
                                            result: getFixedNumber(total.result),
                                        }
                                    };

                                    if (result) {

                                        result.total.criterions[data.criterion] = result.total.criterions[data.criterion] || 0;
                                        result.total.stages[data.stage] = result.total.stages[data.stage] || 0;
                                        result.total.contests[data.contest] = result.total.contests[data.contest] || 0;
                                        result.total.result = result.total.result || 0;

                                        result.total.criterions[data.criterion] += total.criterions[data.criterion];
                                        result.total.stages[data.stage] += total.stages[data.stage];
                                        result.total.contests[data.contest] += total.contests[data.contest];
                                        result.total.result += total.result;

                                        update.total =  {
                                            criterion: result.total.criterions[data.criterion],
                                            stage: result.total.stages[data.stage],
                                            contest: result.total.contests[data.contest],
                                            result: result.total.result,
                                        };

                                        manager.update('event', 'orgs', [data.event], update);

                                        return collection.updateOne({
                                            member: data.member,
                                            mode: data.mode
                                        }, {
                                            $push: {
                                                scores: payload
                                            },
                                            $set: {
                                                total: result.total
                                            }
                                        }).then(function (result) {
                                            db.close();
                                        });


                                    } else {


                                        manager.update('event', 'orgs', [data.event], update);

                                        return collection.insertOne({
                                            member: data.member,
                                            mode: data.mode,
                                            scores: [payload],
                                            total: total
                                        }).then(function(){
                                            db.close()
                                        });
                                    }

                                });

                        } else {

                            var scores = result.scores[0],
                                old = scores.criterions[data.criterion] || 0;
                                scores.stages[data.stage] = scores.stages[data.stage] || 0;
                                scores.contests[data.contest] = scores.contests[data.contest] || 0;
                                scores.result = scores.result || 0;

                            result.total.criterions[data.criterion] = result.total.criterions[data.criterion] || 0;
                            result.total.stages[data.stage] = result.total.stages[data.stage] || 0;
                            result.total.contests[data.contest] = result.total.contests[data.contest] || 0;
                            result.total.result  = result.total.result || 0;

                            scores.criterions[data.criterion] = parseFloat(data.score.criterion);
                            scores.stages[data.stage]        += (data.score.criterion - old) * data.score.stage;
                            scores.contests[data.contest]    += (data.score.criterion - old) * data.score.contest;
                            scores.result                    += (data.score.criterion - old) * data.score.result;

                            result.total.criterions[data.criterion] += data.score.criterion - old;
                            result.total.stages[data.stage] += (data.score.criterion - old) * data.score.stage / data.countJudges;
                            result.total.contests[data.contest] += (data.score.criterion - old) * data.score.contest / data.countJudges;
                            result.total.result += (data.score.criterion - old) * data.score.result / data.countJudges;

                            manager.update('event', 'orgs', [data.event], {
                                member: data.member,
                                mode: data.mode,
                                judge: data.judge,
                                contest: data.contest,
                                result: data.result,
                                stage: data.stage,
                                criterion: data.criterion,
                                scores: {
                                    criterion: getFixedNumber(scores.criterions[data.criterion]),
                                    stage: getFixedNumber(scores.stages[data.stage]),
                                    contest: getFixedNumber(scores.contests[data.contest]),
                                    result: getFixedNumber(scores.result),
                                },
                                total: {
                                    criterion: getFixedNumber(result.total.criterions[data.criterion]),
                                    stage: getFixedNumber(result.total.stages[data.stage]),
                                    contest: getFixedNumber(result.total.contests[data.contest]),
                                    result: getFixedNumber(result.total.result),
                                }
                            });



                            var payload = {
                                $set: {
                                    'scores.$': scores,
                                    total: result.total
                                }
                            };

                            return collection.updateOne({
                                member: data.member,
                                mode: data.mode,
                                'scores.judge': data.judge
                            }, payload).then(function (result) {
                                db.close();
                            })

                        }

            });

        });

    };



    return {
        update: update
    };

}();