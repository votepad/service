var mongo = {
        host: 'localhost',
        port: 27017,
        db: 'votepad'
    },
    mySQL = {
        host     : 'localhost',
        user     : 'root',
        password : '',
        database : 'pronwe'
    };
    Redis = {
        host: 'localhost',
        port: 6379,
        //password: '',
        db: 0
    };

    mongo.url = 'mongodb://' + mongo.host + ':' + mongo.port + '/' + mongo.db;

    module.exports = {
        Mongo: mongo,
        MySQL: mySQL,
        Redis: Redis
    };
