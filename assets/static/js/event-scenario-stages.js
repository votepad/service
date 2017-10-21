var eventStages = function (eventStages) {

    var eventID         = null,
        allCriterions   = null,
        stagesArea      = null,
        newStage        = null,
        newPartsArea    = null,
        newTeamsArea    = null,
        newStageFormula = null,
        editStageFormula= null,
        allPartsOptions = null,
        allTeamsOptions = null,
        stageModal      = null,
        corePrefix      = "VP event scenario";

    /**
     * Submit Creating Stage
     * @private
     */
    var createStage_ = function (event) {

        event.preventDefault();

        if (newStageFormula.toJSON() === false) {
            vp.notification.notify({
                type: "error",
                message: "Не задана формула"
            });
            return;
        }

        var formData = new FormData(newStage);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/stage/create',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(newStage);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(newStage);

                if (parseInt(response.code) === 120) {
                    window.location.reload();
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on creating stage','error',corePrefix, response);
                vp.form.removeLoadingClass(newStage);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Updating Stage
     * @private
     */
    var updateStage_ = function (event) {

        event.preventDefault();

        if (editStageFormula.toJSON() === false) {
            vp.notification.notify({
                type: "error",
                message: "Не задана формула"
            });
            return;
        }

        var formData = new FormData(stageModal);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/stage/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(stageModal);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(stageModal);

                if (parseInt(response.code) === 123) {
                    var stage = document.getElementById('stage_' + stageModal.dataset.id),
                        responseStage = vp.core.parseHTML(response.stage);
                    vp.core.insertAfter(stage,responseStage);

                    var formula = responseStage.querySelector('.js-stageFormula');
                    vp.formula.create(formula , {
                        mode: "print",
                        curItems: formula.dataset.items
                    });

                    vp.modal.remove(stageModal);
                    stage.remove();
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating stage','error',corePrefix, response);
                vp.form.removeLoadingClass(stageModal);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Stage
     * @private
     */
    var deleteStage_ = function () {

        var form     = document.querySelector('.notification--confirm'),
            deleteEl = document.getElementById('deleteStageID'),
            formData = new FormData();

        if (!form || !deleteEl) {
            vp.core.log('Could nor catch element', 'error', corePrefix);
            return;
        }

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);
        formData.append('id', deleteEl.value);

        var ajaxData = {
            url: '/stage/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 124) {
                    var stage = document.getElementById('stage_' + deleteEl.value);
                    if (stage) {
                        stage.remove();
                    } else {
                        window.location.reload();
                    }
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on deleting stage','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create String for select with `options` of members
     * @param members - HTML element
     * @returns {string}
     * @private
     */
    var getOptionsOfMembers_ = function(members) {
        var membersID = [],
            str = "";

        for (var i = 0; i < members.childElementCount; i++) {

            membersID.push(members.children[i].dataset.id);

        }

        if (members.dataset.mode === "participants") {

            for (var i = 0; i < allPartsOptions.length; i++) {
                if (membersID.indexOf(allPartsOptions[i].id) !== -1) {
                    str += '<option value="' + allPartsOptions[i].id + '" selected>' + allPartsOptions[i].name + '</option>'
                } else {
                    str += '<option value="' + allPartsOptions[i].id + '">' + allPartsOptions[i].name + '</option>'
                }
            }

        } else if (members.dataset.mode === "teams") {

            for (var i = 0; i < allTeamsOptions.length; i++) {
                if (membersID.indexOf(allTeamsOptions[i].id) !== -1) {
                    str += '<option value="' + allTeamsOptions[i].id + '" selected>' + allTeamsOptions[i].name + '</option>'
                } else {
                    str += '<option value="' + allTeamsOptions[i].id + '">' + allTeamsOptions[i].name + '</option>'
                }
            }

        }

        return str;
    };


    /**
     * Create Modal For Editing Stage
     * @param element [Object]
     * @private
     */
    var createEditStageModal_ = function (element) {
        stageModal = vp.modal.create({
            node: 'FORM',
            id: 'editStageModal',
            header: 'Редактирование информации об этапе',
            body:
                '<div class="form-group">' +
                    '<input id="editStageModalName" type="text" name="name" maxlength="60" value="' + element.name + '" class="form-group__input" autocomplete="off">' +
                    '<label for="editStageModalName" class="form-group__label">Название этапа</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<textarea id="editStageModalDescription" name="description" maxlength="500" class="form-group__textarea" autocomplete="off">' +
                        element.description +
                    '</textarea>' +
                    '<label for="editStageModalDescription" class="form-group__label">Описание этапа</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label for="editStageMembers" class="fs-0_8 pb-5 text-bold text-brand-2">Жюри будут оценивать</label>' +
                    '<select id="editStageMembers" name="members[]" class="form-group__input" multiple>' +
                        element.members +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<div class="formula" id="editStageFormula"></div>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + element.id + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">Изменить</button>',
            onclose: 'remove'
        });

        stageModal.dataset.id = element.id;
        vp.form.initInput('editStageModalName');
        vp.form.initTextarea('editStageModalDescription');

        new Choices(document.getElementById('editStageMembers'), {
            removeItemButton: true,
            noResultsText: 'Ничего не найдено',
            noChoicesText: 'Нет элементов для выбора',
            itemSelectText: 'выбрать',
        });

        editStageFormula = vp.formula.create(document.getElementById('editStageFormula'), {
            mode: "edit",
            curItems: element.formula,
            allItems: allCriterions
        });

        document.getElementById('editStageModal').addEventListener('submit', updateStage_);

    };



    /**
     * Open Modal for Editing Stage
     * @param id - stage ID
     */
    eventStages.edit = function (id) {
        var stage = document.getElementById('stage_' + id);

        if (!stage) {
            vp.notification.notify({
                type: 'error',
                message: 'Что-то пошло не так... Перезагрузите страницу'
            });
            return;
        }

        var name        = stage.querySelector('.js-stageName'),
            description = stage.querySelector('.js-stageDescription'),
            members     = stage.querySelector('.js-stageMembers'),
            formula     = stage.querySelector('.js-stageFormula');

        if (!name || !description || !members || !formula) {
            vp.notification.notify({
                type: 'error',
                message: 'Что-то пошло не так... Перезагрузите страницу'
            });
            return;
        }

        createEditStageModal_({
            id:          id,
            name:        name.textContent,
            description: description.textContent,
            members:     getOptionsOfMembers_(members),
            formula:     formula.dataset.items
        });
    };


    /**
     * Create notification for Deleting Stage
     * @param id - stage ID
     */
    eventStages.delete = function (id) {
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление этапа</h3>' +
                '<input type="hidden" id="deleteStageID" value="' + id + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteStage_
        });
    };


    /**
     * Toggle Class for Members on Creating New Stage
     * - changing class on `newStageParticipantsArea` && `newStageTeamsArea`
     */
    eventStages.selectPart = function () {
        newPartsArea.classList.remove('hide');
        newTeamsArea.classList.add('hide');
    };

    eventStages.selectTeams = function () {
        newPartsArea.classList.add('hide');
        newTeamsArea.classList.remove('hide');
    };


    var prepareNewStage_ = function () {
        newStage     = document.getElementById('newStage');
        newPartsArea = document.getElementById('newStageParticipantsArea');
        newTeamsArea = document.getElementById('newStageTeamsArea');

        if (!newPartsArea || !newTeamsArea || !newStage) {
            vp.core.log('Could not catch `#newStageParticipantsArea`, `#newStageTeamsArea`, `#newStage`', 'error', corePrefix);
            return;
        }

        newStage = newStage.querySelector('.block');
        newStage.addEventListener('submit', createStage_);

        newStageFormula = vp.formula.create(document.getElementById('newStageFormula'), {
            mode: "create",
            allItems: allCriterions
        });

        allPartsOptions = [];
        allTeamsOptions = [];

        var parts = newPartsArea.getElementsByTagName('option');
        var teams = newTeamsArea.getElementsByTagName('option');

        for (var i = 0; i < parts.length; i++) {
            allPartsOptions.push({
                id: parts[i].value,
                name: parts[i].textContent
            })
        }

        for (var i = 0; i < teams.length; i++) {
            allTeamsOptions.push({
                id: teams[i].value,
                name: teams[i].textContent
            })
        }

        new Choices(document.getElementById('newStageParticipants'), {
            removeItemButton: true,
            noResultsText: 'Ничего не найдено',
            noChoicesText: 'Нет элементов для выбора',
            itemSelectText: 'выбрать',
        });

        new Choices(document.getElementById('newStageTeams'), {
            removeItemButton: true,
            noResultsText: 'Ничего не найдено',
            noChoicesText: 'Нет элементов для выбора',
            itemSelectText: 'выбрать',
        });
    };

    var prepare_ = function() {

        stagesArea = document.getElementById('stagesArea');
        eventID = document.getElementById('eventID');
        allCriterions = document.getElementById('allCriterions');

        if (!eventID || !allCriterions) {
            newStage.remove();
        }

        allCriterions = allCriterions.value;
        eventID = eventID.value;

        prepareNewStage_();

        var formulasPrint = document.getElementsByClassName('formula-print');

        if (formulasPrint.length) {

            for (var i = 0; i < formulasPrint.length; i++) {
                vp.formula.create(formulasPrint[i], {
                    mode: "print",
                    curItems: formulasPrint[i].dataset.items
                });
            }

        }


    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventStages;

}({});