module.exports = function () {

    var salts = {};
        redis.get('votepad:salts:judge', function (err, salt){

        salts.judge = salt;

    });

    redis.get('votepad:salts:organizer', function (err, salt){

        salts.organizer = salt;

    });

    var check = function (cookies) {

        var id      = cookies.get('id'),
            sid      = cookies.get('sid'),
            authMode = cookies.get('a_mode');

        var secret = Crypto.createHash('sha256').update((salts[authMode] + sid + authMode + id).toString(), 'utf8').digest('hex');

        if (secret == cookies.get('secret'))        {

            console.log('User ' + id + ' had authorized as ' + authMode);

            return {
                success: true,
                id: id,
                mode: authMode
            };

        } else {

            console.log('Someone tried to login, but secret is not correct.\n'+
                        'id => ' + id + '\n'+
                        'mode => ' + authMode);

            return {
                success: false
            }

        }

    };

    var permissions = function (id, mode) {

        return permissions_[mode](id).then(function(answer) {answer.mode = mode; return answer});

    };

    var permissions_ = {

        judge: function (id) {

                return new Promise(function(resolve, reject) {

                    var answer = {};

                    MySQL.query('SELECT `event` FROM `Judges` WHERE `id` = ?', [id], function (err, results) {

                        answer.events = [];
                        answer.events.push(results[0].event);

                    }).on('end', function () {

                        MySQL.query('SELECT `c_id` FROM `Contests_Judges` WHERE `j_id` = ?', [id], function (err, results) {

                            answer.contests = [];

                            Array.prototype.forEach.call(results, function (current) {
                                answer.contests.push(current['c_id']);
                            });

                        }).on('end', function(){resolve(answer)});

                    });

                });

        },

        organizer: function (id) {

            return new Promise(function(resolve, reject) {

                var answer = {};

                MySQL.query('SELECT `e_id` FROM `Users_Events` WHERE `u_id` = ?', [id], function (err, results) {

                        answer.events = [];

                        Array.prototype.forEach.call(results, function (current) {
                            answer.events.push(current['e_id']);
                        });

                }).on('end', function(){resolve(answer)});

            });

        }


    };

    return {
        check: check,
        permissions: permissions
    };

}();
