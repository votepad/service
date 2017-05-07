module.exports = (function (notification) {

    var queue   = [],
        holder  = null;


    var addToQueue = function (settings) {

        queue.push(settings);

        var index = 0;

        while ( index < queue.length && queue.length > 5) {

            if (queue[index].type === 'confirm' || queue[index].type === 'prompt') {

                index++;
                continue;

            }

            queue[index].close();
            queue.splice(index, 5);

        }

    };


    notification.createHolder = function () {

        var tempHolder = vp.draw.node('DIV', 'notifications-block');

        holder = document.body.appendChild(tempHolder);

        return tempHolder;

    };


    /**
     *
     * Notify Function
     *
     *  settings = {
     *      type        - notification type (reserved types: alert, confirm, prompt). Just add class 'cdx-notification-'+type
     *      size        - width of notification block (small || large)
     *      message     - notification message
     *      confirmBtn  - show Confirm button (true/false)
     *      cancelBtn   - show Cancel button (true/false)
     *      confirmText - confirm button text (default - 'Ok')
     *      cancelText  - cancel button text (default - 'Cancel'). Only for confirm and prompt types
     *      confirm     - function-handler for ok button click
     *      cancel      - function-handler for cancel button click. Only for confirm and prompt types
     *      time        - time (in seconds) after which notification will close (default - 5s)
     *  }
     *
     * @param constructorSettings
     */
    notification.notify = function (constructorSettings) {

        /** Private vars and methods */
        var notification = null,
            cancel       = null,
            type         = null,
            confirm      = null,
            inputField   = null,
            backdrop     = null;


        var confirmHandler = function () {

            close();

            if (typeof confirm !== 'function' ) {

                return;

            }

            if (type === 'prompt') {

                confirm(inputField.value);
                return;

            }

            confirm();

        };


        var cancelHandler = function () {

            close();

            if (typeof cancel !== 'function' ) {

                return;

            }

            cancel();

        };


        /** Public methods */
        function create(settings) {

            if (!(settings && settings.message)) {

                console.log('Can\'t create notification. Message is missed');
                // vp.core.log('Can\'t create notification. Message is missed');
                return;

            }

            settings.type = settings.type || 'alert';
            settings.time = settings.time*1000 || 10000;

            var wrapper     = vp.draw.node('DIV', 'notification'),
                message     = vp.draw.node('DIV', 'notification__message'),
                input       = vp.draw.node('INPUT', 'notification__input'),
                confirmBtn  = vp.draw.node('SPAN', 'notification__confirm-btn'),
                cancelBtn   = vp.draw.node('SPAN', 'notification__cancel-btn'),
                backdropBl  = vp.draw.node('DIV', 'notification__backdrop');

            message.innerHTML       = settings.message;
            confirmBtn.textContent  = settings.confirmText || 'ОК';
            cancelBtn.textContent   = settings.cancelText || 'Отмена';

            confirmBtn.addEventListener('click', confirmHandler);
            cancelBtn.addEventListener('click', cancelHandler);

            if (settings.size) {

                wrapper.classList.add('notification--' + settings.size);

            }

            if (settings.status) {

                wrapper.classList.add('notification--' + settings.status);

            }

            wrapper.appendChild(message);

            if (settings.type === 'prompt') {

                wrapper.appendChild(input);

            }

            if (settings.type === 'prompt' || settings.type === 'confirm') {

                backdrop = document.body.appendChild(backdropBl);
                backdrop.addEventListener('click', cancelHandler);

                wrapper.appendChild(confirmBtn);
                wrapper.appendChild(cancelBtn);

            }

            wrapper.classList.add('notification--' + settings.type);

            notification = wrapper;
            type         = settings.type;
            confirm      = settings.confirm;
            cancel       = settings.cancel;
            inputField   = input;

            if (settings.type !== 'prompt' && settings.type !== 'confirm') {

                window.setTimeout(close, settings.time);

            }

        }


        function send() {

            holder.appendChild(notification);
            inputField.focus();

            if (type === 'prompt' || type === 'confirm') {

                notification.classList.add('notification--animation-in');

                window.setTimeout(function () {

                    notification.classList.remove('notification--animation-in');

                }, 400);

            } else {

                notification.classList.add('notification--animation-in-down');

                window.setTimeout(function () {

                    notification.classList.remove('notification--animation-in-down');

                }, 400);
            }

            addToQueue({type: type, close: close});

        }


        function close() {

            if (type === 'prompt' || type === 'confirm') {

                notification.classList.add('notification--animation-out');

            } else {

                notification.classList.add('notification--animation-in-up');

            }

            window.setTimeout(function () {

                notification.remove();

                if (backdrop) {
                    backdrop.remove();
                }

            }, 400);

        }


        if (constructorSettings) {

            create(constructorSettings);
            send();

        }

        return {
            create: create,
            send: send,
            close: close
        };

    };

    
    notification.clear = function () {

        holder  = null;
        queue   = [];

    };


    return notification;

})({});