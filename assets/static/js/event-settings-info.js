var eventInfo = function (eventInfo) {

    var form       = null,
        corePrefix = "VP event settings";

    eventInfo.changeType = function (element) {

        var block    = element.closest('.block'),
            formData = new FormData();

        formData.append('id', element.dataset.id);
        formData.append('type', element.dataset.type);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/event/publish',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                block.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                block.classList.remove('loading');

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 54) {
                    document.getElementById('notPublishBlock').classList.toggle('hide');
                    document.getElementById('publishBlock').classList.toggle('hide')
                }

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on publishing event','error',corePrefix,callbacks);
                block.classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };

    var submitForm_ = function (event) {

        event.preventDefault();

        if (!vp.form.validate(form)) return;

        var ajaxData = {
            url: '/event/update',
            type: 'POST',
            data: new FormData(form),
            beforeSend: function(){
                form.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.classList.remove('loading');

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                if (parseInt(response.code) === 52)
                    window.location.reload();

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on updating event info','error',corePrefix,callbacks);
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

        form = document.getElementById('eventInfo');
        if (form) form.addEventListener('submit', submitForm_)
    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventInfo;

}({});