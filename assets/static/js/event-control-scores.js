var eventScores= function (eventScores) {

    var ws          = null,
        form        = null,
        eventID     = null,
        csrf        = null,
        modalEdit   = null,
        status      = null,
        corePrefix  = "VP scores";

    /**
     * Create criterions table for editing
     * @param info - {
     *          'event':    event ID,
     *          'member':   member ID
     *          'judge':    judge ID
     *          'result':   {
     *              'formula': {id_contest:coeff, ...}
     *           }
     *          'contest':  {
     *              'id':       contest ID
     *              'formula':  {id_stage:coeff, ...}
     *          }
     *          'stage':    {
     *              'id':       stage ID
     *              'formula':  {criterion_id:coeff, ...}
     *          }
     *          'criterions':   array[Model_Criterion]
     *      }
     *
     * @param scores - {id_criteria:score, ...}
     * @returns {String}
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
                            '<div class="display-inline-block">' +
                                '<a role="button" class="link" onclick="eventScores.toggleEditScore(this)">' +
                                    '<i class="fa fa-pencil" aria-hidden="true"></i>' +
                                '</a>' +
                            '</div>' +
                        '</div>' +
                        '<div class="score hide">' +
                            '<input type="number" class="text-center" min="' + info.criterions[i]['minScore'] + '" max="' + info.criterions[i]['maxScore'] + '" value="' + scores[info.criterions[i]['id']] + '" data-criterion="' + info.criterions[i]['id'] + '">' +
                            '<div class="display-inline-block pt-5">' +
                                '<a role="button" class="ml-10 text-danger" onclick="eventScores.toggleEditScore(this)">' +
                                    '<i class="fa fa-times" aria-hidden="true"></i>' +
                                '</a>' +
                                '<a role="button" class="ml-10 text-brand" onclick="eventScores.updateScore(this)" data-criterion="' + info.criterions[i]['id'] + '" data-info=\'' + JSON.stringify(info) + '\'>' +
                                    '<i class="fa fa-check" aria-hidden="true"></i>' +
                                '</a>' +
                            '</div>'+
                        '</div>' +
                    '</td>' +
                '</tr>';
        }
        return str;
    };


    var getFormulaByStage_ = function (formula, criterions) {
        var items = [];
        for (var i = 0; i < criterions.length; i++) {
            items.push({
                id: criterions[i]['id'],
                name: criterions[i]['name'],
                coeff: formula[criterions[i]['id']]
            })
        }
        return JSON.stringify(items);
    };


    eventScores.toggleEditScore = function (element) {
        var td = element.closest('td');
        td.querySelector('.score:nth-child(1)').classList.toggle('hide');
        td.querySelector('.score:nth-child(2)').classList.toggle('hide');
    };


    eventScores.editStageScore = function (element) {
        var data    = JSON.parse(element.dataset.info),
            scores  = JSON.parse(element.dataset.scores);

        modalEdit = vp.modal.create({
            'node': 'FORM',
            'id': 'reset',
            'header': 'Балл за этап',
            'body':
                '<div class="mb-15 mt-5">' +
                    '<div class="pb-10 text-bold fs-0_9">Формула подсчета</div>' +
                    '<div id="formulaPrint" class="fs-0_8"></div>' +
                '</div>' +
                '<table>' +
                    '<thead>' +
                        '<tr>' +
                            '<th width="70%">Критерии</th>' +
                            '<th width="30%" class="text-center">Балл</th>' +
                        '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                        getCriterions_(data, scores) +
                    '</tbody>' +
                '</table>',
            onclose: 'remove'
        });

        vp.formula.create(document.getElementById('formulaPrint'), {
            mode: "print",
            curItems: getFormulaByStage_(data.stage.formula, data.criterions)
        })


    };


    eventScores.updateScore = function (element) {
        var data      = JSON.parse(element.dataset.info),
            input     = element.closest('.score').querySelector('input'),
            newScore  = input.value,
            criterion = input.dataset.criterion;

        var score = {
            'event': data.event,
            'member': data.member,
            'mode': data.mode,
            'judge': data.judge,
            'contest': data.contest.id,
            'stage': data.stage.id,
            'criterion': criterion,
            'score' : {
                'criterion': parseInt(newScore),
                'stage': parseFloat(data.stage.formula[criterion]),
                'contest': parseFloat(data.contest.formula[data.stage.id] * data.stage.formula[criterion]),
                'result': parseFloat(data.result.formula[data.contest.id] * data.contest.formula[data.stage.id] * data.stage.formula[criterion])
            }
        };

        eventScores.voting.sendScore(score);

        vp.modal.remove(modalEdit);
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

        if (!(options.uri === "contest" || options.uri === "stage" || options.uri === "result")) {
            return false;
        }

        var formData = new FormData();

        formData.append('event', eventID);
        formData.append('publish', options.publish);
        formData.append('result', options.result);
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

                if (code === 125 || code === 126 || code === 135 || code === 136 || code === 144 || code === 145) {
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
            uri:     (element.dataset.result !== "undefined") ? 'result' : ((element.dataset.stage === "all") ? 'contest' : 'stage'),
            result:  element.dataset.result,
            contest: element.dataset.contest,
            stage:   element.dataset.stage,
            publish: element.dataset.publish
        });
    };




    var prepare_ = function() {

        eventID = document.getElementById('eventID');
        csrf    = document.getElementById('csrf');
        status  = document.getElementById('serverStatus');

        if (!eventID || !csrf || !status) {
            vp.core.log('Could not catch `#eventID`, `#csrf`, `#serverStatus`', 'error', corePrefix);
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

            table.wrapper.querySelector('.dataTable-dropdown').innerHTML =
                "<a role='button' " +
                    "class='ui-btn " + ((tablesParts[i].dataset.publish === "true") ? "ui-btn--2" : "ui-btn--1") + "' " +
                    "data-result='" + tablesParts[i].dataset.result + "' " +
                    "data-contest='" + tablesParts[i].dataset.contest + "' " +
                    "data-stage='" + tablesParts[i].dataset.stage + "' " +
                    "data-publish='" + (tablesParts[i].dataset.publish === "true") + "' " +
                    "onclick='eventScores.publish(this)'>" +
                        ((tablesParts[i].dataset.publish === "true") ? "снять с публикации" : "опубликовать") +
                "</a>";
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


            table.wrapper.querySelector('.dataTable-dropdown').innerHTML =
                "<a role='button' " +
                    "class='ui-btn " + ((tablesTeams[i].dataset.publish === "true") ? "ui-btn--2" : "ui-btn--1") +  "' " +
                    "data-result='" + tablesTeams[i].dataset.result + "' " +
                    "data-contest='" + tablesTeams[i].dataset.contest + "' " +
                    "data-stage='" + tablesTeams[i].dataset.stage + "' " +
                    "data-publish='" + (tablesTeams[i].dataset.publish === "true") + "' " +
                    "onclick='eventScores.publish(this)'>" +
                        ((tablesTeams[i].dataset.publish === "true") ? "снять с публикации" : "опубликовать") +
                "</a>";
        }

    };

    document.addEventListener('DOMContentLoaded', prepare_);


    eventScores.status = function (stat) {
        switch (stat) {
            case 'online':
                status.innerHTML = '<p class="text-brand m-0">Голосование доступно!</p>';
                break;
            case 'offline':
                status.innerHTML =
                    '<p class="fs-1_5 text-danger"><span class="text-bold">Ошибка 500.</span> Сервер не отвечает</p>' +
                    '<p>Голосование не доступно, пожалуйста, перезагрузите страницу.</p>' +
                    '<p class="m-0">Если ошибка не устранилась, <span class="text-bold text-danger">срочно</span> обратитесь к сотрудникам <span class="text-brand">Votepad</span>.</p>';
                break;
        }
    };



    /**
     * WS function for update scores on page
     */
    eventScores.update = update;


    /**
     * WS function for send edited scores
     */
    eventScores.voting = voting;


    return eventScores;

}({});