$(document).ready(function () {

    /**
     * Show/hide block and add/remove active class from btns
     */
    $('[data-toggle="tabs"]').click(function () {

        var areaGroup    = $(this).attr('data-btnGroup'),
            block        = $(this).attr('data-block');

        $('[data-btnGroup=' + areaGroup + ']').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');

        $('[data-blockGroup=' + areaGroup + ']').each(function () {
            $(this).addClass('hide');
        });

        $('#' + block).removeClass('hide');

        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();

    });


    var shareScore_ = function () {
        console.log(this)
    };

    $('.stage__table').DataTable({
        'paging': false,
        'searching': true,
        'info': false,
        'scrollX': true,
        columnDefs: [
            { 'targets' : 'no-sort', 'orderable': false },
        ]
    });

    $('.js-check-publish').click(function () {

    });


    var checkContestResultStatus = function (contest) {
        var stagesStatusBtn = $('.js-publish-scores[data-contest="' + contest + '"]'),
            contestStatusBtn = $('.js-check-publish[data-contest="' + contest + '"]'),
            isAllPublish = true;

        for (var i = 0; i < stagesStatusBtn.length; i++) {
            if (stagesStatusBtn[i].dataset.publish === 'false')
                isAllPublish = false;
        }

        if (isAllPublish) {
            contestStatusBtn[0].dataset.isallpublish = true;
            contestStatusBtn[0].classList.remove('label--warning');
            contestStatusBtn[0].classList.add('label--brand');
            contestStatusBtn[0].innerHTML = '<i class="fa fa-check" aria-hidden="true"></i> опубликовано';
        } else {
            contestStatusBtn[0].dataset.isallpublish = false;
            contestStatusBtn[0].classList.add('label--warning');
            contestStatusBtn[0].classList.remove('label--brand');
            contestStatusBtn[0].innerHTML = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> не все баллы опубликованы';
        }
    };



    $('.js-publish-scores').click(function () {
        var action = null,
            btnText = null,
            formData = new FormData(),
            button = $(this);

        button.addClass('whirl');

        formData.append('stage', button.attr('data-stage'));
        formData.append('contest', button.attr('data-contest'));

        if (button.attr('data-publish') === "true") {
            action = "unpublish";
            btnText = "Опубликовать";
            button.attr('data-publish', false);
        } else {
            action = "publish";
            btnText = "Опубиковано";
            button.attr('data-publish', true);
        }

        var ajaxData = {
            url: '/result/' + action,
            data: formData,
            method: 'POST',
            success: function (responce) {
                button.removeClass('whirl');
                button.html(btnText);
                button.toggleClass('btn_default btn_primary');
                checkContestResultStatus(button.attr('data-contest'));
            },
            error: function () {
                console.info('Ajax error on updating result publish');
                button.removeClass('whirl');
            }
        };


        //vp.ajax.send(ajaxData);

        /*
        * TODO опубликовать / снять с публикации "результат-контест-стедж"
        */

        setTimeout(function () {
            ajaxData.success();
        },500);
        

    });



    // var contests = JSON.parse($('#contests').val());


    $('#addScoreContest').select2({
        language: 'ru'
    });

    $('#addScoreContest').parent().removeClass('hide');

    // var data = [], temp_contest, data1 = [], temp_stage;

    // for(var i = 0; i < contests.length; i++) {
    //     temp_contest = {
    //         contestID: contests[i]['id'],
    //         stages: getStagesJson(contests[i]['stages'], contests[i]['id'])
    //     };
    //     data.push(temp_contest);
    // }


    function getStagesJson(obj, contestID) {
        var arr = [], temp_obj;
        for (var i = 0; i < obj.length; i++) {
            temp_obj = {
                id: parseInt(obj[i]['id']),
                text: obj[i]['name'],
            };
            arr.push(temp_obj);

            temp_obj = {
                contestID: contestID,
                stageID: parseInt(obj[i]['id']),
                members: JSON.stringify(obj[i]['members'], obj[i]['id'])
            };
            data1.push(temp_obj);
        }
        return arr;
    }


    function getStageByContestId(id) {
        for (var i = 0; i < data.length; i++) {
            if (data[i]['contestID'] == id) {
                return data[i]['stages'];
            }
        }
    }

    function getMembersByStageIDandContestID(stageID, contestID) {

        for (var i = 0; i < data1.length; i++) {

            if (data1[i]['contestID'] == contestID && data1[i]['stageID'] == stageID) {

                var members = JSON.parse(data1[i]['members']),
                    out = "";

                for (var j = 0; j < members.length; j++) {
                    out += '<p>' +
                        '<input name="member[]" type="checkbox" id="member' + members[j]['id'] + '" value="' + members[j]['id'] + '">' +
                        '<label for="member' + members[j]['id'] + '">' + members[j]['name'] + '</label>' +
                        '</p>';
                }

                return out;
            }

        }
    }


    $('#addScoreContest').on('change', function (e) {
        var contestID = $(this).val();

        $('#addScoreStage').parent().removeClass('hide');
        $('#addScoreMember').addClass('hide');
        $('#addScoreInput').parent().parent().addClass('hide');


        $('#addScoreStage').select2({
            language: 'ru',
            data: getStageByContestId(contestID)
        });
        $('#addScoreStage').select2('val', '0');
    });

    $('#addScoreStage').on('change', function (e) {
        var contestID   = $('#addScoreContest').val(),
            stageID     = $(this).val();

        if (stageID != 0 ) {

            $('#addScoreMember').removeClass('hide');
            $('#addScoreInput').val('');
            $('#addScoreInput').parent().parent().removeClass('hide');

            $('#addScoreMember').html(getMembersByStageIDandContestID(stageID, contestID));
        }

    });


    /**
     * Edit Scores Table Template
     */
    $('#editScoresTable').DataTable({
        paging: false,
        searching: false,
        sorting:false,
        info: false,
        scrollX: true,
        columnDefs: [
            {
                'targets' : 'no-sort',
                'orderable': false,
            },
            {
                "targets": [1],
                className: "text-center score",
            },
            {
                "targets": [2],
                className: "editScoreCell",
            }
        ],
        columns: [
            { data: 'name' },
            { data: 'score' },
            { data: 'edit' }
        ]

    });


    /**
     * Open Modal Form With Criterions
     * - create data dor editing score
     */
    $('.editScore').on('click', function () {

        var info        = $(this).data('info'),
            scores      = $(this).data('scores') || '{}',
            tablesData  = [], tempCrit;

        for (var i = 0; i < info.criterions.length; i++) {
            scores[info.criterions[i]['id']] = scores[info.criterions[i]['id']] || 0;
            tempCrit = {
                name: info.criterions[i]['name'],
                score: scores[info.criterions[i]['id']],
                edit: "<a role='button' class='openEditScoreArea edtScoreCell__btn' data-criterion='" + JSON.stringify(info.criterions[i]) + "'><i class='fa fa-edit'></i></a>" +
                      "<a role='button' class='submitScore edtScoreCell__btn hide' data-info='" + JSON.stringify(info) + "'><i class='fa fa-save'></i></a>"
            };
            tablesData.push(tempCrit)
        }

        $('#editScoresTable').dataTable().fnClearTable();
        $('#editScoresTable').dataTable().fnAddData(tablesData);

        $('#editScoresForm').modal('show');

        $('.dataTables_scrollHeadInner').css('width','100%');
        $('.dataTable').css('width','100%');
    });


    /**
     * Open New Score Edit Area
     */
    $('#editScoresTable tbody').on( 'click', '.openEditScoreArea', function () {
        var criterion   = $(this).data('criterion'),
            tr          = $(this).parent().parent(),
            scoreArea   = tr.children('.score'),
            score       = scoreArea.html();

        scoreArea.html('<input class="inputScore" type="number" min="' + criterion['min_score'] + '" max="' + criterion['max_score'] + '" value="' + score + '" data-criterion="' + criterion['id'] + '">');

        tr.children('.editScoreCell').children('.openEditScoreArea').addClass('hide');
        tr.children('.editScoreCell').children('.submitScore').removeClass('hide');
    } );


    /**
     * Submit Update New Score
      */
    $('#editScoresTable tbody').on( 'click', '.submitScore', function () {
        var info      = $(this).data('info'),
            tr        = $(this).parent().parent(),
            input     = tr.children('.score').children(),
            criterion = input.data('criterion'),
            newScore  = input.val();

        var score = {
            'member': info.member,
            'judge': info.judge,
            'contest': info.contest.id,
            'stage': info.stage.id,
            'criterion': criterion,
            'score' : {
                'criterion': newScore,
                'stage': parseFloat(info.stage.formula[criterion] * newScore),
                'contest': parseFloat(info.contest.formula[info.stage.id] * info.stage.formula[criterion] * newScore)
            }
        };

        console.info(score);



        /**
         * TODO Update Score data
         */

        tr.children('.score').html(newScore);
        tr.children('.editScoreCell').children('.openEditScoreArea').removeClass('hide');
        tr.children('.editScoreCell').children('.submitScore').addClass('hide');

    });



    $('.dataTables_scrollHeadInner').css('width','100%');
    $('.dataTable').css('width','100%');

});