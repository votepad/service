module.exports = function () {

    /**
     *
     * @param data:
     *  - event
     *  - member
     *  - judge
     *  - result
     *  - contest
     *  - stage
     *  - criterion
     *  - score:
     *      - criterion - member score for criterion
     *      - stage - stage coefficient
     *      - contest - contest coefficient
     *      - result - result coefficient
     */
    var update = function (data) {

        Mongo.connect(config.Mongo.url, function (err, db) {

            var collection = db.collection('event' + data.event);

            var cursor = collection.findOne({
                member: data.member,
                'scores.judge': data.judge
            },{'scores.judge.$': 1});

            cursor.then(function (result) {

                if (!result) {

                    var payload = {
                        judge: data.judge,
                        criterions: {[data.criterion]: data.score.criterion},
                        stages: {[data.stage]: data.score.stage * data.score.criterion},
                        contests: {[data.contest]: data.score.contest * data.score.criterion},
                        results: {[data.result]: data.score.result * data.score.criterion}
                    };

                    collection.updateOne({member: data.member}, {$push: {scores: payload}}, function (err, result) {
                        db.close();
                    });

                } else {

                    var scores = result.scores[0],
                        old = scores.criterions[data.criterion] || 0;

                    scores.criterions[data.criterion] = data.score.criterion;
                    scores.stages[data.stage] += (data.score.criterion - old) * data.score.stage;
                    scores.contests[data.contest] += (data.score.criterion - old) * data.score.contest;
                    scores.results[data.result] += (data.score.criterion - old) * data.score.result;


                    var payload = {
                        $set: {'scores.$': scores}
                    };

                    collection.updateOne({
                        member: data.member,
                        'scores.judge': data.judge
                    }, payload, function (err, result) {db.close();})

                }

            });

        });

    };

    var get = function (query) {

        var result = {success: false},
            filter = {},
            references = [];

        if (!query.event) {
            result['error'] = 'Event id is required';
            return Promise.reject(result);
        }

        if (query.members instanceof Array && query.members.length) {
            filter.members = {$in: query.members}
        }

        return Mongo.connect(config.Mongo.url).then(function (db) {

            var collection = db.collection('event' + query.event);

            return collection.find(filter).toArray().then(function(members) {

                    result.members = {};

                    members.forEach(function(current){

                        var member = {
                            criterions: {},
                            stages: {},
                            contests: {},
                            results: {}
                        };

                        current.scores.forEach(function(scores) {
                            console.log(scores);
                            if (query.criterions) {

                                if (query.criterions instanceof Array) {
                                    query.criterions.forEach(function (id) {
                                        member.criterions[id] = member.criterions[id] || 0;
                                        member.criterions[id] += scores.criterions[id];
                                    })
                                } else {
                                    Object.keys(scores.criterions).forEach(function (id) {
                                        member.criterions[id] = member.criterions[id] || 0;
                                        member.criterions[id] += scores.criterions[id];
                                    })
                                }

                            }

                            if (query.stages) {

                                if (query.stages instanceof Array) {
                                    query.stages.forEach(function (id) {
                                        member.stages[id] = member.stages[id] || 0;
                                        member.stages[id] += scores.stages[id];
                                    })
                                } else {
                                    Object.keys(scores.stages).forEach(function (id) {
                                        member.stages[id] = member.stages[id] || 0;
                                        console.log(id);
                                        member.stages[id] += scores.stages[id];
                                    })
                                }

                            }

                            if (query.contests) {

                                if (query.contests instanceof Array) {
                                    query.contests.forEach(function (id) {
                                        member.contests[id] += scores.contests[id];
                                    })
                                } else {
                                    Object.keys(scores.contests).forEach(function (id) {
                                        member.contests[id] += scores.contests[id];
                                    })
                                }

                            }

                            if (query.results) {

                                if (query.results instanceof Array) {
                                    query.results.forEach(function (id) {
                                        member.results[id] += scores.results[id];
                                    })
                                } else {
                                    Object.keys(scores.results).forEach(function (id) {
                                        member.results[id] += scores.results[id];
                                    })
                                }

                            }

                            result.members[current.member] = member;
                        });
                    });

                    db.close();
                    return result;

                })
            });

    };

    var getItemsFromFormula = function (table, ids, prop) {

        return new Promise(function(resolve, reject) {

            var result = [];

            MySQL.query('SELECT `id`, `formula` FROM ? WHERE `id` IN (?)', [table, ids.join(',')], function (err, results) {

                Array.prototype.forEach.call(results, function (current) {

                    var formulas = JSON.parse(current['formula']),
                        ans = ({id: result.id, [prop]: []});

                    formulas.forEach(function(formula) {
                        ans[prop].push(formula.id);
                    });

                    result.push(ans);

                });

                resolve(result);

            })
        });

    };

    return {
        update: update,
        get: get
    };

}();
