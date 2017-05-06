global.config    = require('./config');
global.WebSocket = require('ws');
global.Mongo     = require('mongodb');
Redis            = require('redis');
global.redis     = Redis.createClient(config.Redis);
global.Cookie    = require('./modules/wscookies');
global.Crypto    = require('crypto');
/*mysql          = require('mysql');
global.MySQL     = mysql.createConnection(config.MySQL);
MySQL.connect();
var voting = require('./modules/voting')();
var scores = require('./modules/scores')();*/
var auth   = require('./modules/auth');

console.log('Ready');

var wss = new WebSocket.Server({
    port: 8000,
    path: '/voting'
});

wss.on('connection', function (ws) {

    auth.check(new Cookie(ws));

});