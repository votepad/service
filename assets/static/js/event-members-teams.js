var eventTeams = function (eventTeams) {

    var form        = null,
        teamTable   = null,
        teamModal   = null,
        eventID     = null,
        corePrefix  = "VP event members";

    /**
     * Submit Creating Team
     * @private
     */
    var createTeam_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('teamModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/team/create',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form)
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 90) {
                    vp.modal.remove(teamModal);
                    var photo =
                            '<a role="button" onclick="eventTeams.updatePhoto(this)" data-id="' + response.team.id + '">' +
                                '<img id="teamLogo_' + response.team.id + '" class="thumb64 image--circle" alt="Team logo" src="/uploads/teams/m_' + response.team.logo + '">' +
                            '</a>',
                        btns =
                            '<a role="button" class="text-brand text-center m-5" onclick="eventTeams.edit(this)" data-id="' + response.team.id + '">' +
                                '<i class="fa fa-edit" aria-hidden="true"></i>' +
                            '</a>' +
                            '<a role="button" class="text-danger text-center m-5" onclick="eventTeams.delete(this)" data-id="' + response.team.id + '">' +
                                '<i class="fa fa-trash" aria-hidden="true"></i>' +
                            '</a>';

                    teamTable.rows().add([photo, response.team.name, response.team.description, btns ]);
                    teamTable.data[teamTable.data.length - 1].id = "team_" + response.team.id;
                    teamTable.data[teamTable.data.length - 1].querySelector("td:first-child").classList.add('text-center');
                    teamTable.data[teamTable.data.length - 1].querySelector("td:last-child").classList.add('text-center');
                    teamTable.body.querySelector("tr:last-child").id = "team_" + response.team.id;
                    teamTable.body.querySelector("tr:last-child").querySelector("td:first-child").classList.add('text-center');
                    teamTable.body.querySelector("tr:last-child").querySelector("td:last-child").classList.add('text-center');
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on creating team','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Updating Team
     * @private
     */
    var updateTeam_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('teamModal'),
            formData = new FormData(form);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/team/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 94) {
                    teamTable.data[form.dataset.row].querySelector("td:nth-child(2)").textContent = response.team.name;
                    teamTable.data[form.dataset.row].querySelector("td:nth-child(3)").textContent = response.team.description;
                    teamTable.body.querySelector('#team_' + response.team.id).getElementsByTagName('td')[1].textContent = response.team.name;
                    teamTable.body.querySelector('#team_' + response.team.id).getElementsByTagName('td')[2].textContent = response.team.description;
                    vp.modal.remove(teamModal);
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating team','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Team
     * @private
     */
    var deleteTeam_ = function () {

        var form     = document.querySelector('.notification--confirm'),
            deleteEl = document.getElementById('deleteTeamID'),
            formData = new FormData();

        if (!form || !deleteEl) {
            vp.core.log('Could nor catch element', 'error', corePrefix);
            return;
        }

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);
        formData.append('id', deleteEl.value);

        var ajaxData = {
            url: '/team/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 95) {
                    teamTable.rows().remove(parseInt(deleteEl.dataset.row));
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on deleting team','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create Modal Form For Create || Update Team Info
     * @param element - if update: [Object] with info, if create - null
     * @private
     */
    var createModalForTeam_ = function (element) {

        teamModal = vp.modal.create({
            node: 'FORM',
            id: 'teamModal',
            header: element.id ? 'Редактирование команды' : 'Создание команды',
            body:
                '<div class="form-group">' +
                    '<input id="teamModalName" type="text" name="name" maxlength="65" value="' + (element.id ? element.name : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="teamModalName" class="form-group__label">Название</label>' +
                '</div>'+
                '<div class="form-group">' +
                    '<textarea id="teamModalDescription" name="description" maxlength="512" class="form-group__textarea" autocomplete="off">' +
                        (element.id ? element.description : '') +
                    '</textarea>' +
                    '<label for="teamModalDescription" class="form-group__label">О команде</label>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + (element.id ? element.id : '') + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">' + (element.id ? 'Изменить' : 'Создать') + '</button>',
            onclose: 'remove'
        });

        vp.form.initInput('teamModalName');
        vp.form.initTextarea('teamModalDescription');

        if (element.id) {
            document.getElementById('teamModal').addEventListener('submit', updateTeam_);
            document.getElementById('teamModal').dataset.row = element.row;
        } else {
            document.getElementById('teamModal').addEventListener('submit', createTeam_);
        }

    };


    /**
     * Update Team Logo on Click
     * @param id - team ID
     * @param row - row in `teamTable`
     * @private
     */
    var updateTeamLogo_ = function (id, row) {

        var logo = document.getElementById('teamLogo_' + id),
            oldLogoScr = logo.src;

        var callbacks_ = {

            beforeSend : function() {

                var fileReader = new FileReader(),
                    input = vp.transport.getInput(),
                    file = input.files[0];

                fileReader.readAsDataURL(file);

                fileReader.onload = function(event) {

                    logo.classList.add('image--loading');
                    logo.src = event.target.result;

                }
            },

            success : function(response) {

                response = JSON.parse(response);

                if (parseInt(response.code) !== 48) {
                    logo.src = oldLogoScr;
                    vp.notification.notify({
                        type: response.status,
                        message: response.message
                    });
                } else {
                    logo.src = response.url;
                    teamTable.data[row].querySelector('#teamLogo_' + id).src = response.url;
                }

                logo.classList.remove('image--loading');
            },

            error : function(response) {

                logo.src = oldLogoScr;
                vp.core.log('error occur on updating team logo', response.status, corePrefix);

            }

        };

        vp.transport.init({
            url : '/transport/5',
            params : {
                id : + id
            },
            multiple : false,
            accept: '*',
            beforeSend : callbacks_.beforeSend,
            success : callbacks_.success,
            error : callbacks_.error
        });
    };


    eventTeams.edit = function (element) {
        var row = teamTable.activeRows.findIndex(function(row) {
            return row.id === 'team_' + element.dataset.id;
        });
        createModalForTeam_({
            id:          element.dataset.id,
            row:         row,
            name:        element.closest('tr').getElementsByTagName('td')[1].textContent,
            description: element.closest('tr').getElementsByTagName('td')[2].textContent
        });
    };


    eventTeams.delete = function (element) {
        var row = teamTable.activeRows.findIndex(function(row) {
            return row.id === 'team_' + element.dataset.id;
        });
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление команды</h3>' +
                '<input type="hidden" id="deleteTeamID" value="' + element.dataset.id + '" data-row="' + row + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteTeam_
        });
    };


    eventTeams.updatePhoto = function (element) {
        var row = teamTable.activeRows.findIndex(function(row) {
            return row.id === 'team_' + element.dataset.id;
        });
        updateTeamLogo_(element.dataset.id, row)
    };



    var print_ = function () {
        teamTable.columns().hide([ 0 ]);
        teamTable.print();
        teamTable.columns().show([ 0 ]);
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID').value;

        teamTable = new DataTable('#teamTable', {
            perPage: 100,
            searchable: false,
            sortable: false
        });

        var printBtn = vp.draw.node('A','ui-btn ui-btn--2 fl_r', {role: 'button'});
        printBtn.innerHTML = '<i class="fa fa-print" aria-hidden="true"></i><span class="ml-10">Печать</span>';
        printBtn.addEventListener('click', print_);

        var addBtn = vp.draw.node('A','ui-btn ui-btn--2', {role: 'button'});
        addBtn.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i><span class="ml-10">Добавить команду</span>';
        addBtn.addEventListener('click', createModalForTeam_);

        teamTable.wrapper.querySelector('.dataTable-top').innerHTML = "";
        teamTable.wrapper.querySelector('.dataTable-top').appendChild(addBtn);
        teamTable.wrapper.querySelector('.dataTable-top').appendChild(printBtn);

        teamTable.wrapper.querySelector('.dataTable-bottom').remove();

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventTeams;

}({});