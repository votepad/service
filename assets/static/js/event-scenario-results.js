var eventResults = function (eventResults) {

    var eventID            = null,
        allItemsParts      = null,
        allItemsTeams      = null,
        resultPartBlock    = null,
        resultTeamBlock    = null,
        formulaTeamsPrint  = null,
        formulaTeams       = null,
        formulaPartsPrint  = null,
        formulaParts       = null,
        formulaPartsModule = null,
        formulaTeamsModule = null,
        csrf               = null,
        corePrefix         = "VP event scenario";


    var editParts_ = function () {
        formulaPartsModule = vp.formula.create(formulaParts, {
            mode: "edit",
            curItems: formulaParts.dataset.items,
            allItems: allItemsParts
        });
        formulaParts.classList.remove('hide');
        formulaParts.classList.add('pt-20');
        formulaPartsPrint.classList.add('hide');
    };


    var saveParts_ = function (btn) {

        var formData = new FormData(),
            formula  = resultPartBlock.querySelector('[name="formula"]');

        formulaPartsModule.toJSON();

        if (formula === null) {
            return;
        }

        formData.append('csrf', csrf);
        formData.append('event', eventID);
        formData.append('id', formulaParts.dataset.id);
        formData.append('type', 1);
        formData.append('formula', formula.value);

        var ajaxData = {
            url: '/result/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(resultPartBlock);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(resultPartBlock);

                var code = parseInt(response.code);

                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);

                if (code === 140) {
                    formulaParts.dataset.id = response.id;
                }

                if (code === 140 || code === 142) {
                    formulaPartsModule.destroy();
                    formulaParts.dataset.items = response.formula;
                    formulaPartsPrint.dataset.items = response.formula;
                    formulaPartsPrint.innerHTML = "";
                    vp.formula.create(formulaPartsPrint, {
                        mode: "print",
                        curItems: formulaPartsPrint.dataset.items
                    });
                    changeClickedButton_(btn, 'toEdit');
                    formulaParts.classList.add('hide');
                    formulaParts.classList.remove('pt-20');
                    formulaPartsPrint.classList.remove('hide');
                }
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating participant result', 'error', corePrefix, response);
                vp.form.removeLoadingClass(resultPartBlock);
            }
        };
        vp.ajax.send(ajaxData);
    };


    var editTeams_ = function () {
        formulaTeamsModule = vp.formula.create(formulaTeams, {
            mode: "edit",
            curItems: formulaTeams.dataset.items,
            allItems: allItemsTeams
        });
        formulaTeams.classList.remove('hide');
        formulaTeams.classList.add('pt-20');
        formulaTeamsPrint.classList.add('hide');
    };


    var saveTeams_ = function (btn) {

        var formData = new FormData(),
            formula  = resultTeamBlock.querySelector('[name="formula"]');

        formulaTeamsModule.toJSON();

        if (formula === null) {
            return;
        }

        formData.append('csrf', csrf);
        formData.append('event', eventID);
        formData.append('id', formulaTeams.dataset.id);
        formData.append('type', 2);
        formData.append('formula', formula.value);

        var ajaxData = {
            url: '/result/update',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(resultTeamBlock);
            },
            success: function(response) {
                response = JSON.parse(response);
                vp.form.removeLoadingClass(resultTeamBlock);

                var code = parseInt(response.code);
                
                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });

                vp.core.log(response.message, response.status, corePrefix);

                if (code === 140) {
                    formulaTeams.dataset.id = response.id;
                }

                if (code === 140 || code === 142) {
                    formulaTeamsModule.destroy();
                    formulaTeams.dataset.items = response.formula;
                    formulaTeamsPrint.dataset.items = response.formula;
                    formulaTeamsPrint.innerHTML = "";
                    vp.formula.create(formulaTeamsPrint, {
                        mode: "print",
                        curItems: formulaTeamsPrint.dataset.items
                    });
                    changeClickedButton_(btn, 'toEdit');
                    formulaTeams.classList.add('hide');
                    formulaTeams.classList.remove('pt-20');
                    formulaTeamsPrint.classList.remove('hide');
                }
            },
            error: function(response) {
                vp.core.log('ajax error occur on updating team result', 'error', corePrefix, response);
                vp.form.removeLoadingClass(resultTeamBlock);
            }
        };
        vp.ajax.send(ajaxData);
    };


    var changeClickedButton_ = function (btn, status) {
        switch (status) {
            case "toSave":
                btn.setAttribute('onclick', 'eventResults.save(this)');
                btn.classList.remove('link','ml-5');
                btn.classList.add('ui-btn','ui-btn--1','mt-10');
                btn.innerHTML = "Сохранить";
                break;
            case "toEdit":
                btn.setAttribute('onclick', 'eventResults.edit(this)');
                btn.classList.add('link','ml-5');
                btn.classList.remove('ui-btn','ui-btn--1','mt-10');
                btn.innerHTML = "<i class='fa fa-pencil' aria-hidden='true'></i>";
                break;
        }
    };


    eventResults.save = function (element) {

        var type = element.dataset.type;

        switch (type) {
            case "Parts":
                saveParts_(element);
                break;
            case "Teams":
                saveTeams_(element);
                break;
        }
    };


    /**
     * Open Modal for Editing Result
     * @param element - HTTP clicked element
     */
    eventResults.edit = function (element) {

        if (!formulaTeamsPrint || !formulaTeams || !formulaPartsPrint || !formulaParts || !element) {
            vp.notification.notify({
                type: 'error',
                message: 'Что-то пошло не так... Перезагрузите страницу'
            });
            return;
        }

        var type = element.dataset.type;

        switch (type) {
            case "Parts":
                editParts_();
                break;
            case "Teams":
                editTeams_();
                break;
            default:
                window.location.reload();
        }

        changeClickedButton_(element, 'toSave');
    };


    var prepare_ = function() {

        eventID         = document.getElementById('eventID');
        allItemsParts   = document.getElementById('allPartFormula');
        allItemsTeams   = document.getElementById('allTeamFormula');
        resultPartBlock = document.getElementById('participantsResult');
        resultTeamBlock = document.getElementById('teamsResult');

        if (!eventID || !allItemsTeams || !allItemsParts || !resultPartBlock || !resultTeamBlock) {
            vp.core.log('Could not catch `#eventID`, `#allPartFormula`, `#allTeamFormula`, `#participantsResult`, `#teamsResult`', 'error', corePrefix);
            return;
        }

        allItemsTeams = allItemsTeams.value;
        allItemsParts = allItemsParts.value;
        eventID = eventID.value;

        formulaTeamsPrint = document.getElementById('formulaTeamsPrint');
        formulaTeams      = document.getElementById('formulaTeams');
        formulaPartsPrint = document.getElementById('formulaPartsPrint');
        formulaParts      = document.getElementById('formulaParts');

        if (!formulaTeamsPrint || !formulaTeams || !formulaPartsPrint || !formulaParts) {
            vp.core.log('Could not catch `#formulaTeamsPrint`, `#formulaTeams`, `#formulaPartsPrint`, `#formulaParts`', 'error', corePrefix);
            return;
        }

        if (formulaPartsPrint.dataset.items !== "" && formulaPartsPrint.dataset.items !== "[]") {
            formulaPartsPrint.innerHTML = "";
            vp.formula.create(formulaPartsPrint, {
                mode: "print",
                curItems: formulaPartsPrint.dataset.items
            });
        }

        if (formulaTeamsPrint.dataset.items !== "" && formulaTeamsPrint.dataset.items !== "[]") {
            formulaTeamsPrint.innerHTML = "";
            vp.formula.create(formulaTeamsPrint, {
                mode: "print",
                curItems: formulaTeamsPrint.dataset.items
            });
        }

        csrf = document.getElementById('csrf');

        if (csrf) {
            csrf = csrf.value;
        }
    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventResults;

}({});