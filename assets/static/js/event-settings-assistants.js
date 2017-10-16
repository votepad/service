var eventAssistants = function (eventAssistants) {

    var form            = null,
        assistantsTable = null,
        requestsTable   = null,
        eventID         = null,
        corePrefix      = "VP event settings";

    var submitAssistant_ = function (assistant) {

        var formData = new FormData();

        formData.append('id', assistant.id);
        formData.append('method', assistant.method);
        formData.append('event', eventID);
        formData.append('csrf', document.getElementById('csrf').value);

        var ajaxData = {
            url: '/event/assistant',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(assistant.area);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(assistant.area);

                // ADD_ASSISTANT_SUCCESS    = 56
                // REJECT_ASSISTANT_SUCCESS = 58
                if (parseInt(response.code) === 56 || parseInt(response.code) === 58) {
                    requestsTable.rows().remove(parseInt(assistant.row));
                }

                // REMOVE_ASSISTANT_SUCCESS = 57
                if (parseInt(response.code) === 57) {
                    assistantsTable.rows().remove(parseInt(assistant.row));
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on assistants request','error',corePrefix, callbacks);
                vp.form.removeLoadingClass(assistant.area);
            }
        };

        vp.ajax.send(ajaxData);
    };


    eventAssistants.acceptRequest = function (element) {
        var row = requestsTable.activeRows.findIndex(function(row) {
            return row.id === 'request_' + element.dataset.id;
        });
        submitAssistant_({
            area:   document.getElementById('requestsArea'),
            row:    row,
            method: 'add',
            id:     element.dataset.id
        });
    };


    eventAssistants.rejectRequest = function (element) {
        var row = requestsTable.activeRows.findIndex(function(row) {
            return row.id === 'request_' + element.dataset.id;
        });
        submitAssistant_({
            area:   document.getElementById('requestsArea'),
            row:    row,
            method: 'reject',
            id:     element.dataset.id
        });
    };


    eventAssistants.excludeAssistant = function (element) {
        var row = requestsTable.activeRows.findIndex(function(row) {
            return row.id === 'assistant_' + element.dataset.id;
        });
        submitAssistant_({
            area:   document.getElementById('assistantsArea'),
            row:    row,
            method: 'remove',
            id:     element.dataset.id
        });
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID').value;

        assistantsTable = new DataTable('#assistantsTable', {
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
            requestsTable = new DataTable('#requestsTable', {
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