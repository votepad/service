module.exports = function (port) {

    var wss = new WebSocket.Server({
        port: port || 8002,
        path: '/scores'
    });

    var connected = function (ws) {

        redis.get('votepad:salts:organizer', function (err, salt) {

            var cookies = new Cookie(ws),
                sha256 = new sha('sha256'),
                secret = sha256.update(salt + cookies.get('sid') + 'organizer' + cookies.get('id'), 'utf8').digest('hex');

            if (secret == cookies.get('secret')) {

                console.log('User ' + cookies.get('id') + ' connected');

                ws.on('message', function (data) {

                    data = JSON.parse(data);
                    var action = data.action,
                        query = data.query,
                        event = query.event;


                    MySQL.query('SELECT * FROM `Users_Events` WHERE `u_id` = ' + cookies.get('id') + ' AND `e_id` = ' + event, function (err, results) {

                        if (!results.length) {

                            ws.send(JSON.stringify({status: "Access denied", success: 0}));
                            return;

                        }

                        Mongo.connect(config.Mongo.url, function (err, db) {

                            var collection = db.collection(event);

                            switch (action) {

                                case 'find':
                                    collection.find(query.fields, function (err, result) {

                                        result.toArray(function (err, docs) {

                                            ws.send(JSON.stringify({
                                                status: "Success search",
                                                success: 1,
                                                result: docs
                                            }));


                                            db.close();

                                        });

                                    });
                                    break;

                                case 'update':
                                    collection.findOneAndUpdate(query.fields, {$set: query.update}, function (err, result) {

                                        if (result.ok) {
                                            console.log('Data was updated');
                                            ws.send(JSON.stringify({status: "Success update", success: 1}));
                                        } else {
                                            ws.send(JSON.stringify({status: "Error while update", success: 0}));
                                        }

                                        db.close();

                                    });
                                    break;
                            }
                        });
                    });
                });


            } else {

                console.log('Someone tried to connect, but cookies aren`t correct');
                ws.send('{"status": "Access denied", "success": 0}');
                ws.close();

            }

        });


    };


    wss.on('connection', connected);

};

