var WebSocket = require('ws'),
    wss = new WebSocket.Server({
        port: '8000'
    }),
    Mongo = require('mongodb'),
    Redis = require('redis'),
    redis = Redis.createClient(),
    Cookie = require('./wscookies.js'),
    sha = require('sha.js'),
    sha256 = sha('sha256');

var connected = function (ws) {

    console.log('Connected');

    var cookies = new Cookie(ws);

    redis.get('votepad:salts:judge', function (err, salt) {

        var secret = sha256.update(salt + cookies.get('sid') + 'judge' + cookies.get('j_id'),'utf8').digest('hex');

        if (secret == cookies.get('secret')) {

            ws.on('message', saveData)

        } else {

            ws.close();

        }

    });


};

var saveData = function (data) {

    data = JSON.parse(data);
    console.log(data);
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
                console.log('OK');
            }

            db.close();

        });

    });

};

wss.on('connection', connected);

