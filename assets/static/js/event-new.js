var newEvent = function (newEvent) {

    var form       = null,
        corePrefix = "VP new event",
        host       = window.location.host,
        protocol   = window.location.protocol;


    var submitForm_ = function (event) {

        event.preventDefault();

        if (!vp.form.validate(form)) return;

        var ajaxData = {
            url: '/event/create',
            type: 'POST',
            data: new FormData(form),
            beforeSend: function(){
                form.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.classList.remove('loading');

                if (parseInt(response.code) === 50) {
                    window.location.replace(protocol + '//' + host + '/event/' + response.id + '/settings/info');
                    return;
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on creating new event','error',corePrefix,callbacks);
                form.classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };


    var prepare_ = function() {

        new Choices(document.getElementById('tags'), {
            delimiter: ',',
            editItems: true,
            duplicateItems: false,
            removeItemButton: true,
            regexFilter: /^[а-яА-Яa-zA-Z0-9 _]*$/,
            uniqueItemText: "Только уникальные значения могут быть добавлены.",
            addItemText: (value) => {
                return `Нажмите Enter чтобы добавить <b>"${value}"</b>`;
            },
        });

        form = document.getElementById('newEvent');
        if (form) form.addEventListener('submit', submitForm_)
    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return newEvent;

}({});