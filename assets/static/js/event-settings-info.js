var eventInfo = function (eventInfo) {

    var form       = null,
        csrf       = null,
        corePrefix = "VP event settings";

    eventInfo.changeType = function (element) {

        var block    = element.closest('.block'),
            formData = new FormData();

        formData.append('id', element.dataset.id);
        formData.append('type', element.dataset.type);
        formData.append('csrf', csrf);

        var ajaxData = {
            url: '/event/publish',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(block);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(block);

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
            error: function(response) {
                vp.core.log('ajax error occur on publishing event','error',corePrefix,response);
                vp.form.removeLoadingClass(block);
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
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating event info','error',corePrefix,response);
                vp.form.removeLoadingClass(form);
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

        if (form) {
            form.addEventListener('submit', submitForm_);
        }

        csrf = document.getElementById('csrf');

        if (csrf) {
            csrf = csrf.value;
        }

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventInfo;

}({});