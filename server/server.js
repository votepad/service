global.config    = require('./config');

global.WebSocket = require('ws');
global.Mongo     = require('mongodb').MongoClient;

var Redis        = require('redis');
global.redis     = Redis.createClient(config.Redis);

global.Cookie    = require('./modules/wscookies');
global.Crypto    = require('crypto');

var mysql        = require('mysql');
global.MySQL     = mysql.createPool(config.MySQL);
global.MySQL.on('error', function (err) {

    if(err.code === 'PROTOCOL_CONNECTION_LOST') {
        console.log('connection lost');
        global.MySQL = mysql.createConnection(config.MySQL);
    } else {
        throw err;
    }

});


var auth = require('./modules/auth');
var scores = require('./modules/scores');
var manager = require('./modules/manager');

var voting = new WebSocket.Server({
    port: 8000,
    path: '/voting'
});

var management = new WebSocket.Server({
    port: 8001,
    path: '/management'
});

voting.on('connection', function (ws) {

    var user = auth.check(new Cookie(ws));
    if (user.success) {

        var permissions = auth.permissions(user.id, user.mode);


        permissions.then(function (perms) {

            if (user.mode == 'judge') {

                manager.update('judge', 'orgs', perms.events, {id: user.id, status: 1});

                ws.on('close', function () {
                    console.log(ws.readyState);
                    manager.update('judge', 'orgs', perms.events, {id: user.id, status: 0});
                })

            }

            return perms;

        });

            ws.on('message', function (data) {
                permissions.then(function (perms) {

                    try {
                        data = JSON.parse(data);
                    } catch (e) {console.log(e)}

                    if (!(perms.events.indexOf(parseInt(data.event)) + 1)) {
                        ws.send(JSON.stringify({status: 'error', message: 'Access to this event denied', code: 403}));
                        return;
                    }

                    if (perms.mode == 'judge' && !(perms.contests.indexOf(parseInt(data.contest)) + 1)) {
                        ws.send(JSON.stringify({status: 'error', message: 'Access to this contest denied', code: 403}));
                        return;
                    }

                    scores.update(data).catch(console.log);

            });
        });

    } else {
        ws.send(JSON.stringify({status: 'error', message: 'Access denied', code: 403}));
        ws.close()
    }


});

management.on('connection', function (ws) {

    var user = auth.check(new Cookie(ws));

    if (!user.success) {
        ws.send(JSON.stringify({status: 'error', message: 'Access denied', code: 403}));
        ws.close();
        return;
    }

    var permissions = auth.permissions(user.id, user.mode);

    permissions.then(function (perms) {

        manager.addUser(ws, user, perms.events);
        if (user.mode == 'organizer') {
            manager.getOnlineJudges(perms.events, user.id)
        }

    });


});

console.log('Ready');
