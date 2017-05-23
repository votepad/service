module.exports = function () {

    var events = {};

    var addUser = function (ws, user, availableEvents) {

        availableEvents.forEach(function (event) {

            events[event] = events[event] || {orgs: {}, judges: {}};

            switch (user.mode) {
                case 'organizer':
                    events[event].orgs[user.id] = ws;
                    break;
                case 'judge':
                    events[event].judges[user.id] = ws;
                    break;
            }
        });

    };

    var update = function (type, receivers, eventsIds, data) {

        eventsIds.forEach(function (id) {

            if (!events[id]) return;

            for (var user in events[id][receivers]) {

                if (events[id][receivers][user].readyState > 1) {
                    delete events[id][receivers][user];
                    return;
                }

                events[id][receivers][user].send(JSON.stringify({
                    type: type,
                    data: data
                }));

            }
        })

    };

    var getOnlineJudges = function (eventsIds, orgId) {
        eventsIds.forEach(function (id) {

            if (!events[id]) return;

            for (var judge in events[id].judges) {

                if (events[id].judges[judge].status > 1) {
                    delete events[id].judges[user];
                    return;
                }

                events[id].orgs[orgId].send(JSON.stringify({
                    type: 'judge',
                    data: {id: judge, status: 1}
                }));

            }
        })
    };

    return {
        addUser: addUser,
        update: update,
        getOnlineJudges: getOnlineJudges
    }
}();