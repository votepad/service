module.exports = function () {

    var salts = {};
        redis.get('votepad:salts:judge', function (err, salt){

        salts.judge = salt;

    });

    redis.get('votepad:salts:organizer', function (err, salt){

        salts.organizer = salt;

    });

    var check = function (cookies) {

        var uid      = cookies.get('uid'),
            sid      = cookies.get('sid'),
            authMode = cookies.get('a_mode');

        var secret = Crypto.createHash('sha256').update(salts[authMode] + sid + authMode + uid, 'utf8').digest('hex');

        if (secret == cookies.get('secret'))        {

            console.log('User ' + uid + ' had authorized as ' + authMode);

            return {
                success: true,
                id: uid,
                access: authMode
            };

        } else {

            console.log('Someone tried to login, but secret is not correct.\n'+
                        'id => ' + uid + '\n'+
                        'mode => ' + authMode);

            return {
                success: false
            }

        }

    };

    return {
        check: check
    };

}();
