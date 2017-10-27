var eventResults = function (eventResults) {

    var eventID           = null,
        allContests       = null,
        resultFormulaPart = null,
        resultFormulaTeam = null,
        resultModal       = null,
        corePrefix        = "VP event scenario";

    /**
     * Submit Updating Contest
     * @private
     */
    var updateContest_ = function (event) {

        event.preventDefault();

        if (!editContestFormula.validate()) {
            return;
        }

        if (editContestFormula.toJSON() === false) {
            vp.notification.notify({
                type: "error",
                message: "Не задана формула"
            });
            return;
        }

        var formData = new FormData(contestModal);

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/contest/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(contestModal);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(contestModal);

                if (parseInt(response.code) === 133) {
                    var contest = document.getElementById('contest_' + contestModal.dataset.id),
                        responseContest = vp.core.parseHTML(response.contest);
                    vp.core.insertAfter(contest,responseContest);

                    var formula = responseContest.querySelector('.js-contestFormula');
                    vp.formula.create(formula , {
                        mode: "print",
                        curItems: formula.dataset.items
                    });

                    vp.modal.remove(contestModal);
                    contest.remove();
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating contest','error',corePrefix, response);
                vp.form.removeLoadingClass(contestModal);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Contest
     * @private
     */
    var deleteContest_ = function () {

        var form     = document.querySelector('.notification--confirm'),
            deleteEl = document.getElementById('deleteContestID'),
            formData = new FormData();

        if (!form || !deleteEl) {
            vp.core.log('Could nor catch element', 'error', corePrefix);
            return;
        }

        formData.append('csrf', document.getElementById('csrf').value);
        formData.append('event', eventID);
        formData.append('id', deleteEl.value);

        var ajaxData = {
            url: '/contest/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 134) {
                    var contest = document.getElementById('contest_' + deleteEl.value);
                    if (contest) {
                        contest.remove();
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
                vp.core.log('ajax error occur on deleting contest','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create String for select with `options` of judges
     * @param judges - HTML element
     * @returns {string}
     * @private
     */
    var getOptionsOfJudge = function(judges) {
        var judgesID = [],
            str = "";

        for (var i = 0; i < judges.childElementCount; i++) {

            judgesID.push(judges.children[i].dataset.id);

        }

        for (var i = 0; i < allJudgesOptions.length; i++) {
            if (judgesID.indexOf(allJudgesOptions[i].id) !== -1) {
                str += '<option value="' + allJudgesOptions[i].id + '" selected>' + allJudgesOptions[i].name + '</option>'
            } else {
                str += '<option value="' + allJudgesOptions[i].id + '">' + allJudgesOptions[i].name + '</option>'
            }
        }

        return str;
    };


    /**
     * Create Modal For Editing Contest
     * @param element [Object]
     * @private
     */
    var createEditContestModal_ = function (element) {
        var formula = JSON.parse(element.formula);
        formula = parseInt(formula[0].type);

        contestModal = vp.modal.create({
            node: 'FORM',
            id: 'editContestModal',
            header: 'Редактирование информации о конкурсе',
            body:
                '<div class="form-group">' +
                    '<input id="editContestModalName" type="text" name="name" maxlength="60" value="' + element.name + '" class="form-group__input" autocomplete="off">' +
                    '<label for="editContestModalName" class="form-group__label">Название конкурса</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<textarea id="editContestModalDescription" name="description" maxlength="500" class="form-group__textarea" autocomplete="off">' +
                        element.description +
                    '</textarea>' +
                    '<label for="editContestModalDescription" class="form-group__label">Описание конкурса</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<div class="fs-0_8 pb-5 text-brand-2">Жюри будут оценивать</div>' +
                    '<span>' +
                        '<input type="radio" id="editContestModalMode1" name="editContestModalMode" class="radio" ' + (formula === 1 ? 'checked' : '') + ' value="1">' +
                        '<label for="editContestModalMode1" class="radio-label">участников</label>' +
                    '</span>\n' +
                    '<span class="ml-15">\n' +
                        '<input type="radio" id="editContestModalMode2" name="editContestModalMode" class="radio" ' + (formula === 2 ? 'checked' : '') + ' value="2">' +
                        '<label for="editContestModalMode2" class="radio-label">команды</label>' +
                    '</span>' +
                '</div>'+
                '<div class="form-group">' +
                    '<label for="editContestJudges" class="fs-0_8 pb-5 text-bold text-brand-2">Представители жюри</label>' +
                    '<select id="editContestJudges" name="judges[]" class="form-group__input" multiple>' +
                        element.judges +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<div class="formula" id="editContestFormula"></div>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + element.id + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">Изменить</button>',
            onclose: 'remove'
        });

        contestModal.dataset.id = element.id;
        vp.form.initInput('editContestModalName');
        vp.form.initTextarea('editContestModalDescription');

        new Choices(document.getElementById('editContestJudges'), {
            removeItemButton: true,
            noResultsText: 'Ничего не найдено',
            noChoicesText: 'Нет элементов для выбора',
            itemSelectText: 'выбрать',
        });

        editContestFormula = vp.formula.create(document.getElementById('editContestFormula'), {
            mode: "edit",
            curItems: element.formula,
            allItems: allStages,
            itemsType: 'editContestModalMode'
        });

        document.getElementById('editContestModal').addEventListener('submit', updateContest_);

    };



    /**
     * Open Modal for Editing Contest
     * @param id - contest ID
     */
    eventResults.edit = function (id) {
        var contest = document.getElementById('contest_' + id);

        if (!contest) {
            vp.notification.notify({
                type: 'error',
                message: 'Что-то пошло не так... Перезагрузите страницу'
            });
            return;
        }

        var name        = contest.querySelector('.js-contestName'),
            description = contest.querySelector('.js-contestDescription'),
            judges      = contest.querySelector('.js-contestJudges'),
            formula     = contest.querySelector('.js-contestFormula');

        if (!name || !description || !judges || !formula) {
            vp.notification.notify({
                type: 'error',
                message: 'Что-то пошло не так... Перезагрузите страницу'
            });
            return;
        }

        createEditContestModal_({
            id:          id,
            name:        name.textContent,
            description: description.textContent,
            judges:      getOptionsOfJudge(judges),
            formula:     formula.dataset.items
        });
    };


    /**
     * Create notification for Deleting Contest
     * @param id - contest ID
     */
    eventResults.delete = function (id) {
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление конкурса</h3>' +
                '<input type="hidden" id="deleteContestID" value="' + id + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteContest_
        });
    };


    var prepare_ = function() {

        eventID     = document.getElementById('eventID');
        allContests = document.getElementById('allContests');

        if (!eventID || !allContests) {
            vp.core.log('Could not catch `#eventID`, `#allContests`', 'error', corePrefix);
            return;
        }

        allContests = allContests.value;
        eventID = eventID.value;

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

    return eventResults;

}({});