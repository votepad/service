var WebSocket = require('ws'),
    wss = new WebSocket.Server({
        port: '8000',
        path: '/voting'
    }),
    Mongo = require('mongodb'),
    Redis = require('redis'),
    redis = Redis.createClient(),
    Cookie = require('./wscookies.js'),
    sha = require('sha.js');

var connected = function (ws) {

    redis.get('votepad:salts:judge', function (err, salt) {

        var cookies = new Cookie(ws),
            sha256 = new sha('sha256'),
            secret = sha256.update(salt + cookies.get('sid') + 'judge' + cookies.get('j_id'),'utf8').digest('hex');

        if (secret == cookies.get('secret')) {

            console.log('Judge ' + cookies.get('j_id') + ' connected');
            ws.on('message', function (data) {

                data = JSON.parse(data);

                Mongo.connect('mongodb://localhost:27017/votepad', function (err, db) {

                    var collection = db.collection('scores');

                    collection.findOneAndUpdate({
                        result: data.result,
                        contest: data.contest,
                        stage: data.stage,
                        criterion: data.criterion,
                        judge: data.judge,
                        member: data.member
                    }, {$set: data}, {upsert: true}, function (err, result) {

                        if (result.ok) {
                            console.log('Member ' + data.member + ' got scores from judge ' + data.judge);
                            console.log('Data: ');
                            console.log(data);
                            ws.send('{"status": "Success voting", "success": 1}');
                        } else {
                            ws.send('{"status": "Error while voting", "success": 0}');
                        }


                        db.close();

                    });

                });
            });


        } else {

            console.log('Judge ' + cookies.get('j_id') + ' tried to connect, but cookies don`t correct');
            ws.send('{"status": "Access denied", "success": 0}');
            ws.close();

        }

    });


};


wss.on('connection', connected);

