var eventCriterions = function (eventCriterions) {

    var form            = null,
        criterionsTable = null,
        criterionModal  = null,
        eventID         = null,
        csrf            = null,
        corePrefix      = "VP event scenario";

    /**
     * Submit Creating Criterion
     * @private
     */
    var createCriterion_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('criterionModal'),
            formData = new FormData(form);

        formData.append('csrf', csrf);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/criterion/create',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 110) {
                    vp.modal.remove(criterionModal);
                    var btns =
                        '<a role="button" class="text-brand text-center m-5" onclick="eventCriterions.edit(this)" data-id="' + response.criterion.id + '">' +
                            '<i class="fa fa-edit" aria-hidden="true"></i>' +
                        '</a>' +
                        '<a role="button" class="text-danger text-center m-5" onclick="eventCriterions.delete(this)" data-id="' + response.criterion.id + '">' +
                            '<i class="fa fa-trash" aria-hidden="true"></i>' +
                        '</a>';
                    criterionsTable.rows().add([response.criterion.name,response.criterion.description,response.criterion.minScore,response.criterion.maxScore, btns ]);
                    criterionsTable.data[criterionsTable.data.length - 1].id = "criterion_" + response.criterion.id;
                    criterionsTable.data[criterionsTable.data.length - 1].querySelector("td:nth-child(3)").classList.add('text-center');
                    criterionsTable.data[criterionsTable.data.length - 1].querySelector("td:nth-child(4)").classList.add('text-center');
                    criterionsTable.data[criterionsTable.data.length - 1].querySelector("td:last-child").classList.add('text-center');
                    criterionsTable.body.querySelector("tr:last-child").id = "criterion_" + response.criterion.id;
                    criterionsTable.body.querySelector("tr:last-child").querySelector("td:nth-child(3)").classList.add('text-center');
                    criterionsTable.body.querySelector("tr:last-child").querySelector("td:nth-child(4)").classList.add('text-center');
                    criterionsTable.body.querySelector("tr:last-child").querySelector("td:last-child").classList.add('text-center');
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on creating criterion','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Updating Criterion
     * @private
     */
    var updateCriterion_ = function (event) {

        event.preventDefault();

        var form     = document.getElementById('criterionModal'),
            formData = new FormData(form);

        formData.append('csrf', csrf);
        formData.append('event', eventID);

        var ajaxData = {
            url: '/criterion/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 113) {
                    criterionsTable.data[form.dataset.row].querySelector("td:nth-child(1)").textContent = response.criterion.name;
                    criterionsTable.data[form.dataset.row].querySelector("td:nth-child(2)").textContent = response.criterion.description;
                    criterionsTable.data[form.dataset.row].querySelector("td:nth-child(3)").textContent = response.criterion.minScore;
                    criterionsTable.data[form.dataset.row].querySelector("td:nth-child(4)").textContent = response.criterion.maxScore;
                    criterionsTable.body.querySelector('#criterion_' + response.criterion.id).getElementsByTagName('td')[0].textContent = response.criterion.name;
                    criterionsTable.body.querySelector('#criterion_' + response.criterion.id).getElementsByTagName('td')[1].textContent = response.criterion.description;
                    criterionsTable.body.querySelector('#criterion_' + response.criterion.id).getElementsByTagName('td')[2].textContent = response.criterion.minScore;
                    criterionsTable.body.querySelector('#criterion_' + response.criterion.id).getElementsByTagName('td')[3].textContent = response.criterion.maxScore;
                    vp.modal.remove(criterionModal);
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating criterion','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Submit Deleting Criterion
     * @private
     */
    var deleteCriterion_ = function () {

        var form     = document.querySelector('.notification--confirm'),
            deleteEl = document.getElementById('deleteCriterionID'),
            formData = new FormData();

        if (!form || !deleteEl) {
            vp.core.log('Could nor catch element', 'error', corePrefix);
            return;
        }

        formData.append('csrf', csrf);
        formData.append('event', eventID);
        formData.append('id', deleteEl.value);

        var ajaxData = {
            url: '/criterion/delete',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(form);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(form);

                if (parseInt(response.code) === 114) {
                    criterionsTable.rows().remove(parseInt(deleteEl.dataset.row));
                }

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on deleting criterion','error',corePrefix, response);
                vp.form.removeLoadingClass(form);
            }
        };

        vp.ajax.send(ajaxData);
    };


    /**
     * Create Modal Form For Create || Update Criterion Info
     * @param element - if update: [Object] with info, if create - null
     * @private
     */
    var createModalForCriterion_ = function (element) {

        criterionModal = vp.modal.create({
            node: 'FORM',
            id: 'criterionModal',
            header: element.id ? 'Редактирование критерия' : 'Создание критерия',
            body:
                '<div class="form-group">' +
                    '<input id="criterionModalName" type="text" name="name" maxlength="128" value="' + (element.id ? element.name : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="criterionModalName" class="form-group__label">Название</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<textarea id="criterionModalDescription" name="description" maxlength="256" class="form-group__textarea" autocomplete="off">' +
                        (element.id ? element.description: '') +
                    '</textarea>' +
                    '<label for="criterionModalDescription" class="form-group__label">Описание</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<input id="criterionModalMinScore" type="number" name="minScore" value="' + (element.id ? element.minScore : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="criterionModalMinScore" class="form-group__label">Минимальный балл</label>' +
                '</div>' +
                '<div class="form-group">' +
                    '<input id="criterionModalMaxScore" type="number" name="maxScore" value="' + (element.id ? element.maxScore : '') + '" class="form-group__input" autocomplete="off">' +
                    '<label for="criterionModalMaxScore" class="form-group__label">Максимальный балл</label>' +
                '</div>',
            footer:
                '<input type="hidden" name="id" value="' + (element.id ? element.id : '') + '">' +
                '<button type="button" data-close="modal" class="ui-btn ui-btn--2 mr-15">Отмена</button>' +
                '<button type="submit" class="ui-btn ui-btn--1 fl_r">' + (element.id ? 'Изменить' : 'Создать') + '</button>',
            onclose: 'remove'
        });

        vp.form.initInput('criterionModalName');
        vp.form.initTextarea('criterionModalDescription');
        vp.form.initInput('criterionModalMinScore');
        vp.form.initInput('criterionModalMaxScore');

        if (element.id) {
            document.getElementById('criterionModal').addEventListener('submit', updateCriterion_);
            document.getElementById('criterionModal').dataset.row = element.row;
        } else {
            document.getElementById('criterionModal').addEventListener('submit', createCriterion_);
        }

    };



    eventCriterions.edit = function (element) {
        var row = criterionsTable.activeRows.findIndex(function(row) {
            return row.id === 'criterion_' + element.dataset.id;
        });
        createModalForCriterion_({
            id:          element.dataset.id,
            row:         row,
            name:        element.closest('tr').getElementsByTagName('td')[0].textContent,
            description: element.closest('tr').getElementsByTagName('td')[1].textContent,
            minScore:    element.closest('tr').getElementsByTagName('td')[2].textContent,
            maxScore:    element.closest('tr').getElementsByTagName('td')[3].textContent
        });
    };


    eventCriterions.delete = function (element) {
        var row = criterionsTable.activeRows.findIndex(function(row) {
            return row.id === 'criterion_' + element.dataset.id;
        });
        vp.notification.notify({
            type: 'confirm',
            message:
                '<h3 class="text-brand">Подвердите удаление критерия</h3>' +
                '<input type="hidden" id="deleteCriterionID" value="' + element.dataset.id + '" data-row="' + row + '">',
            showCancelButton: true,
            confirmText: "Удалить",
            cancelText: "Отмена",
            confirm: deleteCriterion_
        });
    };



    var print_ = function () {
        criterionsTable.print();
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID').value;

        criterionsTable = new DataTable('#criterionsTable', {
            perPage: 100,
            searchable: false,
            sortable: false
        });

        var printBtn = vp.draw.node('A','ui-btn ui-btn--2 fl_r', {role: 'button'});
        printBtn.innerHTML = '<i class="fa fa-print" aria-hidden="true"></i><span class="ml-10">Печать</span>';
        printBtn.addEventListener('click', print_);

        var addBtn = vp.draw.node('A','ui-btn ui-btn--2', {role: 'button'});
        addBtn.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i><span class="ml-10">Добавить критерий</span>';
        addBtn.addEventListener('click', createModalForCriterion_);

        criterionsTable.wrapper.querySelector('.dataTable-top').innerHTML = "";
        criterionsTable.wrapper.querySelector('.dataTable-top').appendChild(addBtn);
        criterionsTable.wrapper.querySelector('.dataTable-top').appendChild(printBtn);

        criterionsTable.wrapper.querySelector('.dataTable-bottom').remove();

        csrf = document.getElementById('csrf');

        if (csrf) {
            csrf = csrf.value;
        }

    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventCriterions;

}({});