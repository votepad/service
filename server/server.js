global.config    = require('./config');
global.WebSocket = require('ws');
global.Mongo     = require('mongodb');
Redis            = require('redis');
global.redis     = Redis.createClient(config.Redis);
global.Cookie    = require('./modules/wscookies');
global.sha      = require('sha.js');
mysql            = require('mysql');
global.MySQL     = mysql.createConnection(config.MySQL);
MySQL.connect();

var voting = require('./modules/voting')();
var scores = require('./modules/scores')();

console.log('Ready');