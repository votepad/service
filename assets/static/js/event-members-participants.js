var eventParticipants = function (eventParticipants) {

    var form             = null,
        participantTable = null,
        participantModal = null,
        eventID          = null,
        corePrefix       = "VP event members";

    /**
     * Submit Creating Participant
     * @private
     */
    var createParticipant_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('participantModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/participant/create',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                form.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 80) {
                    vp.modal.remove(participantModal);
                    var photo =
                            '<a role="button" onclick="eventParticipants.updatePhoto(this)" data-id="' + response.participant.id + '">' +
                                '<img class="thumb64 image--circle" alt="Participant logo" src="/uploads/participants/m_' + response.participant.logo + '">' +
                            '</a>',
                        btns =
                            '<a role="button" class="text-brand text-center m-5" onclick="eventParticipants.edit(this)" data-id="' + response.participant.id + '">' +
                                '<i class="fa fa-edit" aria-hidden="true"></i>' +
                            '</a>' +
                            '<a role="button" class="text-danger text-center m-5" onclick="eventParticipants.delete(this)" data-id="' + response.participant.id + '">' +
                                '<i class="fa fa-trash" aria-hidden="true"></i>' +
                            '</a>';
                    participantTable.rows().add([photo, response.participant.name,response.participant.about, btns ]);
                    participantTable.body.querySelector("tr:last-child").id = "participant_" + response.participant.id;
                    participantTable.body.querySelector("tr:last-child").querySelector("td:first-child").classList.add('text-center');
                    participantTable.body.querySelector("tr:last-child").querySelector("td:last-child").classList.add('text-center');
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on creating participant','error',corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Updating Participant
     * @private
     */
    var updateParticipant_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('participantModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/participant/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                form.getElementsByClassName('modal__wrapper')[0].classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');

                if (parseInt(response.code) === 84) {
                    participantTable.body.querySelector('#participant_' + response.participant.id).getElementsByTagName('td')[1].textContent = response.participant.name;
                    participantTable.body.querySelector('#participant_' + response.participant.id).getElementsByTagName('td')[2].textContent = response.participant.about;
                    vp.modal.remove(participantModal);
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on updating participant','error',corePrefix, callbacks);
                form.getElementsByClassName('modal__wrapper')[0].classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Participant
     * @private
     */
    var deleteParticipant_ = function () {

        var form     = document.getElementsByClassName('notification--confirm')[0],
            deleteID = document.getElementById('deleteParticipantID').value,
            formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);
        formData.append('id', deleteID);

        var ajaxData = {
            url: '/participant/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                form.classList.add('loading');
            },
            success: function(response) {
                response = JSON.parse(response);
                form.classList.remove('loading');

                if (parseInt(response.code) === 85) {
                    participantTable.body.querySelector('#participant_' + deleteID).remove();
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on deleting participant','error',corePrefix, callbacks);
                form.classList.remove('loading');
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create Modal Form For Create || Update Participant Info
     * @param element - if update: [Object] with info, if create - null
     * @private
     */
    var createModalForParticipant_ = function (element) {

        participantModal = vp.modal.create({
            node: 'FORM',
            id: 'participantModal',
            header: element.id ? 'Редактировать участника' : 'Создание участника',
            body:
                '<div class="form-group">' +
                    '<input id="participantModalName" type="text" name="name" maxlength="65" value="' + (element.id ? element.name : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="participantModalName" class="form-group__label">Имя</label>' +
                '</div>'+
                '<div class="form-group">' +
                    '<textarea id="participantModalAbout" name="about" maxlength="512" class="form-group__textarea" autocomplete="off">' +
                        (element.id ? element.about : '') +
                    '</textarea>' +
                    '<label for="participantModalAbout" class="form-group__label">Об участнике</label>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + (element.id ? element.id : '') + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">' + (element.id ? 'Изменить' : 'Создать') + '</button>',
            onclose: 'remove'
        });

        vp.form.initInput('participantModalName');
        vp.form.initTextarea('participantModalAbout');

        if (element.id)
            document.getElementById('participantModal').addEventListener('submit', updateParticipant_);
        else
            document.getElementById('participantModal').addEventListener('submit', createParticipant_);

    };


    /**
     * Update Participant Logo on Click
     * @param id - participant ID
     * @private
     */
    var updateParticipantLogo_ = function (id) {

    };


    eventParticipants.edit = function (element) {
        createModalForParticipant_({
            id:    element.dataset.id,
            name:  element.closest('tr').getElementsByTagName('td')[1].textContent,
            about: element.closest('tr').getElementsByTagName('td')[2].textContent
        });
    };


    eventParticipants.delete = function (element) {
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление учстника</h3>' +
                '<input type="hidden" id="deleteParticipantID" value="' + element.dataset.id + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteParticipant_
        });
    };


    eventParticipants.updatePhoto = function (element) {
        updateParticipantLogo_(element.dataset.id)
    };



    var print_ = function () {
        participantTable.columns().hide([ 0 ]);
        participantTable.print();
        participantTable.columns().show([ 0 ]);
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID').value;

        participantTable = new DataTable('#participantTable', {
            perPage: 100,
            searchable: false,
            sortable: false
        });

        var printBtn = vp.draw.node('A','ui-btn ui-btn--2 fl_r', {role: 'button'});
        printBtn.innerHTML = '<i class="fa fa-print" aria-hidden="true"></i><span class="ml-10">Печать</span>';
        printBtn.addEventListener('click', print_);

        var addBtn = vp.draw.node('A','ui-btn ui-btn--2', {role: 'button'});
        addBtn.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i><span class="ml-10">Добавить участника</span>';
        addBtn.addEventListener('click', createModalForParticipant_);

        participantTable.wrapper.getElementsByClassName('dataTable-top')[0].innerHTML = "";
        participantTable.wrapper.getElementsByClassName('dataTable-top')[0].appendChild(addBtn);
        participantTable.wrapper.getElementsByClassName('dataTable-top')[0].appendChild(printBtn);

        participantTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventParticipants;

}({});