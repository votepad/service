var judgeStatus = (function (judgeStatus) {

    var status  = null,
        element = null;

    var prepare_ = function (id) {
        element = document.getElementById(id)
    };

    judgeStatus.init = function (id) {
        prepare_(id);
        // judgeStatus.offline();
    };

    judgeStatus.online = function () {
        status = "online";
        element.classList.add('status--online');
        element.classList.remove('status--offline');
        element.classList.remove('status--reconnect');
    };

    judgeStatus.offline = function () {
        status = "offline";
        element.classList.remove('status--online');
        element.classList.add('status--offline');
        element.classList.remove('status--reconnect');
        vp.notification.notify({
            type: 'error',
            message: 'Вы оффлайн. Для повторного подключения нажмите свое имя'
        })
    };

    judgeStatus.reconnect = function () {
        status = "reconnect";
        element.classList.remove('status--online');
        element.classList.remove('status--offline');
        element.classList.add('status--reconnect');
    };

    judgeStatus.status = function () {
        return status;
    };

    return judgeStatus;

})({});