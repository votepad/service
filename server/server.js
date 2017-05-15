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

var wss = new WebSocket.Server({
    port: 8000,
    path: '/voting'
});

wss.on('connection', function (ws) {

    var user = auth.check(new Cookie(ws));
    var permissions = auth.permissions(user.id, user.mode);

    console.log(user);
    permissions.then(console.log);

});

scores.get({event: 1, member: 1, stages: true}).then(function(result){console.log(result.members[1])}).catch(console.log);

console.log('Ready');
