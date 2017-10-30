var eventScores= function (eventScores) {

    var form        = null,
        eventID     = null,
        csrf        = null,
        corePrefix  = "VP event control";

    /**
     * Create criterions table for editing
     * @param info - {
     *          'event':    event ID,
     *          'member':   member ID
     *          'judge':    judge ID
     *          'contest':  {
     *              'id':       contest ID
     *              'formula':  {id_stage:coeff, ....)
     *          }
     *          'stage':    {
     *              'id':       stage ID
     *              'formula':  {criterion_id:coeff, ...}
     *          }
     *          'criterions':   array[Model_Criterion]
     *      }
     *
     * @param scores - {id_criteria:score, ...}
     */
    var getCriterions_ = function (info, scores) {
        var str = "";
        for (var i = 0; i < info.criterions.length; i++) {
            str +=
                '<tr>' +
                    '<td>' + info.criterions[i]['name'] + '</td>' +
                    '<td class="text-center">' +
                        '<div class="score">' +
                            '<span class="mr-10">' + scores[info.criterions[i]['id']] + '</span>' +
                            '<a role="button" class="link" onclick="eventScores.toggleEditScore(this)">' +
                                '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                            '</a>' +
                        '</div>' +
                        '<div class="score hide">' +
                            '<input type="number" class="text-center" min="' + info.criterions[i]['minScore'] + '" max="' + info.criterions[i]['maxScore'] + '" value="' + scores[info.criterions[i]['id']] + '">' +
                            '<a role="button" class="ml-10 text-danger" onclick="eventScores.toggleEditScore(this)">' +
                                '<i class="fa fa-times" aria-hidden="true"></i>' +
                            '</a>' +
                            '<a role="button" class="ml-10 text-brand" onclick="eventScores.updateScore(this)" data-criterion="' + info.criterions[i]['id'] + '" data-info=\'' + JSON.stringify(info) + '\'>' +
                                '<i class="fa fa-check" aria-hidden="true"></i>' +
                            '</a>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
        }
        return str;
    };

    eventScores.updateScore = function () {

    };

    eventScores.toggleEditScore = function (element) {
        var td = element.parentNode.parentNode;
        td.querySelector('.score:nth-child(1)').classList.toggle('hide');
        td.querySelector('.score:nth-child(2)').classList.toggle('hide');
    };

    eventScores.editStageScore = function (element) {
        // element
        vp.modal.create({
            'node': 'FORM',
            'id': 'reset',
            'header': 'Оценки по критериям',
            'body':
                '<table>' +
                    '<thead>' +
                        '<tr>' +
                            '<th>Критерии</th>' +
                            '<th class="text-center">Балл</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        getCriterions_(JSON.parse(element.dataset.info), JSON.parse(element.dataset.scores)) +
                    '</tbody>' +
                '</table>',
            onclose: 'remove'
        })


    };

    /**
     * Submit Publishing Status
     * @param options - {
     *      btn:     HTML element - clicked button
     *      form:    HTML element - closest `.block`
     *      uri:     STRING - 'contest'||'stage'
     *      contest: STRING - contest ID
     *      stage:   STRING - stage ID || 'all'
     *      publish: STRING - 'true'||'false'
     *   }
     * @returns {boolean}
     * @private
     */
    var publishSubmit_ = function (options) {

        if (!(options.uri === "contest" || options.uri === "stage")) {
            return false;
        }

        var formData = new FormData();

        formData.append('event', eventID);
        formData.append('publish', options.publish);
        formData.append('contest', options.contest);
        formData.append('stage', options.stage);
        formData.append('csrf', csrf);

        var ajaxData = {
            url: '/' + options.uri + '/publish',
            type: 'POST',
            data: formData,
            beforeSend: function(){
                vp.form.addLoadingClass(options.form)
            },
            success: function(response) {
                vp.form.removeLoadingClass(options.form);
                response = JSON.parse(response);

                var code = parseInt(response.code);

                if (code === 125 || code === 126 || code === 135 || code === 136) {
                    changePublishBtn_(options.btn, options.publish);
                }
                vp.notification.notify({
                    type: response.status,
                    message: response.message
                });
                vp.core.log(response.message, response.status, corePrefix);
            },
            error: function(response) {
                vp.core.log('ajax error occur on publishing contest|stage','error',corePrefix, response);
                vp.form.removeLoadingClass(options.form);
                return false;
            }
        };
        vp.ajax.send(ajaxData);
    };


    /**
     * Change `class`, `data-publish`, `innerHTML` on clicked button
     * @param btn - HTML element - clicked button
     * @param is_publish - 'true'||'false'
     * @private
     */
    var changePublishBtn_ = function (btn, is_publish) {
        switch (is_publish) {
            case "true":
                btn.dataset.publish = "false";
                btn.classList.add('ui-btn--1');
                btn.classList.remove('ui-btn--2');
                btn.innerHTML = "опубликовать";
                break;
            case "false":
                btn.dataset.publish = "true";
                btn.classList.add('ui-btn--2');
                btn.classList.remove('ui-btn--1');
                btn.innerHTML = "снять с публикации";
                break;
        }
    };


    eventScores.publish = function(element) {
        publishSubmit_({
            btn:     element,
            form:    element.closest('.block'),
            uri:     (element.dataset.stage === "all") ? 'contest' : 'stage',
            contest: element.dataset.contest,
            stage:   element.dataset.stage,
            publish: element.dataset.publish
        });
    };


    var prepare_ = function() {

        eventID = document.getElementById('eventID');
        csrf = document.getElementById('csrf');

        if (!eventID || !csrf) {
            vp.core.log('Could not catch `#eventID`, `#csrf`', 'error', corePrefix);
            return;
        }

        eventID = eventID.value;
        csrf    = csrf.value;

        var tablesParts = document.getElementsByClassName('js-table-participant'),
            tablesTeams = document.getElementsByClassName('js-table-team'),
            table       = null;

        for (var i = 0; i < tablesParts.length; i++) {
            table = new DataTable(tablesParts[i], {
                sortable: true,
                labels: {
                    placeholder: "Поиск...",
                    perPage: "{select} участников на странице",
                    noRows: "Участники не найдены",
                    info: "Показано {start} - {end} из {rows}",
                }
            });

            if (i !== 0) {
                table.wrapper.querySelector('.dataTable-dropdown').innerHTML =
                    "<a role='button' " +
                    "class='ui-btn " + ((tablesParts[i].dataset.publish === "true") ? "ui-btn--2" : "ui-btn--1") + "' " +
                    "data-contest='" + tablesParts[i].dataset.contest + "' " +
                    "data-stage='" + tablesParts[i].dataset.stage + "' " +
                    "data-publish='" + (tablesParts[i].dataset.publish === "true") + "' " +
                    "onclick='" + ((tablesParts[i].dataset.publish === "true") ? "eventScores.publish(this)" : "eventScores.publish(this)") + "'>" +
                        ((tablesParts[i].dataset.publish === "true") ? "снять с публикации" : "опубликовать") +
                    "</a>";
            } else {
                table.wrapper.querySelector('.dataTable-dropdown').innerHTML = "";
            }
        }

        for (var i = 0; i < tablesTeams.length; i++) {
            table = new DataTable(tablesTeams[i], {
                sortable: true,
                labels: {
                    placeholder: "Поиск...",
                    perPage: "{select} команд на странице",
                    noRows: "Команды не найдены",
                    info: "Показано {start} - {end} из {rows}",
                }
            });

            if (i !== 0) {
                table.wrapper.querySelector('.dataTable-dropdown').innerHTML =
                    "<a role='button' " +
                    "class='ui-btn " + ((tablesTeams[i].dataset.publish === "true") ? "ui-btn--2" : "ui-btn--1") +  "' " +
                    "data-contest='" + tablesTeams[i].dataset.contest + "' " +
                    "data-stage='" + tablesTeams[i].dataset.stage + "' " +
                    "data-publish='" + (tablesTeams[i].dataset.publish === "true") + "' " +
                    "onclick='" + ((tablesTeams[i].dataset.publish === "true") ? "eventScores.publish(this)" : "eventScores.publish(this)") + "'>" +
                        ((tablesTeams[i].dataset.publish === "true") ? "снять с публикации" : "опубликовать") +
                    "</a>";
            } else {
                table.wrapper.querySelector('.dataTable-dropdown').innerHTML = "";
            }
        }


    };

    document.addEventListener('DOMContentLoaded', prepare_);

    return eventScores;

}({});