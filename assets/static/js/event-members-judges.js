var eventJudges = function (eventJudges) {

    var form            = null,
        judgesTable     = null,
        judgeModal      = null,
        eventID         = null,
        eventCode       = null,
        passwordSymbols = 'abcdefghijklmnopqrstuvwxyz1234567890',
        corePrefix      = "VP event members";

    /**
     * Submit Creating Judge
     * @private
     */
    var createJudge_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('judgeModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/judge/create',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 70) {
                    vp.modal.remove(judgeModal);
                    var btns =
                        '<a role="button" class="text-brand text-center m-5" onclick="eventJudges.edit(this)" data-id="' + response.judge.id + '">' +
                            '<i class="fa fa-edit" aria-hidden="true"></i>' +
                        '</a>' +
                        '<a role="button" class="text-danger text-center m-5" onclick="eventJudges.delete(this)" data-id="' + response.judge.id + '">' +
                            '<i class="fa fa-trash" aria-hidden="true"></i>' +
                        '</a>';
                    judgesTable.rows().add([response.judge.name,eventCode,response.judge.password, btns ]);
                    judgesTable.data[judgesTable.data.length - 1].id = "judge_" + response.judge.id;
                    judgesTable.data[judgesTable.data.length - 1].querySelector("td:last-child").classList.add('text-center');
                    judgesTable.body.querySelector("tr:last-child").id = "judge_" + response.judge.id;
                    judgesTable.body.querySelector("tr:last-child").querySelector("td:last-child").classList.add('text-center');
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on creating judge','error',corePrefix, callbacks);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Updating Judge
     * @private
     */
    var updateJudge_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('judgeModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/judge/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 74) {
                    judgesTable.data[form.dataset.row].querySelector("td:nth-child(1)").textContent = response.judge.name;
                    judgesTable.data[form.dataset.row].querySelector("td:nth-child(2)").textContent = response.judge.password;
                    judgesTable.body.querySelector('#judge_' + response.judge.id).getElementsByTagName('td')[0].textContent = response.judge.name;
                    judgesTable.body.querySelector('#judge_' + response.judge.id).getElementsByTagName('td')[1].textContent = response.judge.password;
                    vp.modal.remove(judgeModal);
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on updating judge','error',corePrefix, callbacks);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Judge
     * @private
     */
    var deleteJudge_ = function () {

        var form     = document.getElementsByClassName('notification--confirm')[0],
            deleteEl = document.getElementById('deleteJudgeID'),
            formData = new FormData();

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);
        formData.append('id', deleteEl.value);

        var ajaxData = {
            url: '/judge/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 75) {
                    judgesTable.rows().remove(parseInt(deleteEl.dataset.row));
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(callbacks) {
                vp.core.log('ajax error occur on deleting judge','error',corePrefix, callbacks);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create Modal Form For Create || Update Judge Info
     * @param element - if update: [Object] with info, if create - null
     * @private
     */
    var createModalForJudge_ = function (element) {

        judgeModal = vp.modal.create({
            node: 'FORM',
            id: 'judgeModal',
            header: element.id ? 'Редактировать представителя жюри' : 'Создание представителя жюри',
            body:
                '<div class="form-group">' +
                    '<input id="judgeModalName" type="text" name="name" maxlength="65" value="' + (element.id ? element.name : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="judgeModalName" class="form-group__label">Имя</label>' +
                '</div>'+
                '<div class="form-group">' +
                    '<input id="judgeModalPassword" type="text" name="password" maxlength="20" value="' + (element.id ? element.password : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="judgeModalPassword" class="form-group__label">Пароль</label>' +
                    '<a role="button" class="link fs-0_8" onclick="eventJudges.randomPassword(\'judgeModalPassword\')">' +
                        'сгенерировать пароль' +
                    '</a>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + (element.id ? element.id : '') + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">' + (element.id ? 'Изменить' : 'Создать') + '</button>',
            onclose: 'remove'
        });

        vp.form.initInput('judgeModalName');
        vp.form.initInput('judgeModalPassword');

        if (element.id) {
            document.getElementById('judgeModal').addEventListener('submit', updateJudge_);
            document.getElementById('judgeModal').dataset.row = element.row;
        } else {
            document.getElementById('judgeModal').addEventListener('submit', createJudge_);
        }

    };



    eventJudges.edit = function (element) {
        var row = judgesTable.activeRows.findIndex(function(row) {
            return row.id === 'judge_' + element.dataset.id;
        });
        createModalForJudge_({
            id:       element.dataset.id,
            row:      row,
            name:     element.closest('tr').getElementsByTagName('td')[0].textContent,
            password: element.closest('tr').getElementsByTagName('td')[1].textContent
        });
    };


    eventJudges.delete = function (element) {
        var row = judgesTable.activeRows.findIndex(function(row) {
            return row.id === 'judge_' + element.dataset.id;
        });
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление представителя жюри</h3>' +
                '<input type="hidden" id="deleteJudgeID" value="' + element.dataset.id + '" data-row="' + row + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteJudge_
        });
    };


    /**
     * Generate Random Password
     * @param element_id - id of input element
     */
    eventJudges.randomPassword = function (element_id) {

        var element  = document.getElementById(element_id),
            password = '',
            rand;

        if (!element) {
            vp.core.log('Could not catch element by ID', 'error', corePrefix);
            return;
        }

        for (var i = 0; i < 6; i++) {
            rand = Math.floor(Math.random()*passwordSymbols.length);
            password += passwordSymbols.substring(rand, rand+1);
        }

        element.value = password;
    };



    var print_ = function () {
        judgesTable.columns().show([ 1 ]);
        judgesTable.print();
        judgesTable.columns().hide([ 1 ]);
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID').value;
        eventCode = document.getElementById('eventCode').textContent;

        judgesTable = new DataTable('#judgesTable', {
            perPage: 100,
            searchable: false,
            sortable: false
        });

        var printBtn = vp.draw.node('A','ui-btn ui-btn--2 fl_r', {role: 'button'});
        printBtn.innerHTML = '<i class="fa fa-print" aria-hidden="true"></i><span class="ml-10">Печать</span>';
        printBtn.addEventListener('click', print_);

        var addBtn = vp.draw.node('A','ui-btn ui-btn--2', {role: 'button'});
        addBtn.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i><span class="ml-10">Добавить жюри</span>';
        addBtn.addEventListener('click', createModalForJudge_);

        judgesTable.columns().hide([ 1 ]);

        judgesTable.wrapper.getElementsByClassName('dataTable-top')[0].innerHTML = "";
        judgesTable.wrapper.getElementsByClassName('dataTable-top')[0].appendChild(addBtn);
        judgesTable.wrapper.getElementsByClassName('dataTable-top')[0].appendChild(printBtn);

        judgesTable.wrapper.getElementsByClassName('dataTable-bottom')[0].remove();

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventJudges;

}({});