var eventAssistants = function (eventAssistants) {

    var form         = null,
        corePrefix   = "VP event settings";

    var submitAssistant_ = function (assistant) {

        var formData = new FormData(),
            block    = document.getElementById(assistant.area);
console.log(assistant);
        formData.append('id', assistant.id);
        formData.append('method', assistant.method);
        formData.append('event', assistant.event);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/event/assistant',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                block.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                block.classList.remove('loading');

                // ADD_ASSISTANT_SUCCESS    = 56
                // REMOVE_ASSISTANT_SUCCESS = 57
                // REJECT_ASSISTANT_SUCCESS = 58
                if (parseInt(response.code) === 56 || parseInt(response.code) === 57 || parseInt(response.code) === 58) {
                    assistant.block.remove()
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on assistants request','error',corePrefix, callbacks);
                block.classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };


    eventAssistants.acceptRequest = function (element) {
        var addAssistant = {
            area:  'requestsArea',
            block:  element.closest('tr'),
            method: 'add',
            event:  element.dataset.event,
            id:     element.dataset.id
        };
        submitAssistant_(addAssistant);
    };


    eventAssistants.rejectRequest = function (element) {
        var rejectAssistant = {
            area:  'requestsArea',
            block:  element.closest('tr'),
            method: 'reject',
            event:  element.dataset.event,
            id:     element.dataset.id
        };
        submitAssistant_(rejectAssistant);
    };


    eventAssistants.excludeAssistant = function (element) {
        var removedAssistant = {
            area:  'assistantsArea',
            block:  element.closest('tr'),
            method: 'remove',
            event:  element.dataset.event,
            id:     element.dataset.id
        };
        submitAssistant_(removedAssistant);
    };


    var prepare_ = function() {

        var assistantsTable = new DataTable('#assistantsTable', {
            perPage: 100,
            searchable: true,
            sortable: false,
            labels: {
                placeholder: 'Поиск...',
                noRows: 'Помощники не найдены',
            }
        });

        assistantsTable.wrapper.getElementsByClassName('dataTable-dropdown')[0].innerHTML =
            '<a role="button" class="ui-btn ui-btn--1" data-toggle="modal" data-area="inviteModal">' +
                'Пригласить помощника' +
            '</a>';
        assistantsTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

        if (document.getElementById('requestsTable')) {
            var requestsTable = new DataTable('#requestsTable', {
                perPage: 100,
                searchable: true,
                sortable: false,
                labels: {
                    placeholder: 'Поиск...',
                    noRows: 'Помощники не найдены',
                }
            });

            requestsTable.wrapper.getElementsByClassName('dataTable-top')[0].remove();
            requestsTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();
        }

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventAssistants;

}({});