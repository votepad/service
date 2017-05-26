module.exports = function () {

    var scores = require('./scores');

    var queue = {},
        processing = {};

    var process = function (event) {

        if (processing[event]) {
            return;
        }
        processing[event] = true;

        var update = function () {

            scores.update(queue[event].shift()).then(function() {
                if (queue[event].length){
                    update();
                } else {
                    processing[event] = false;
                }
            })

        };

        update();

    };

    var push = function (data) {

        if (!queue[data.event]) {
            queue[data.event] = [];
        }

        queue[data.event].push(data);

        process(data.event)

    };

    return {
        push: push
    }

}();