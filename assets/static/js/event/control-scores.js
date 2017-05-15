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

    });


    $('.stage__table').DataTable({
        'paging': false,
        'searching': true,
        'info': false,
        'scrollX': true,
        columnDefs: [
            { 'targets' : 'no-sort', 'orderable': false },
        ]
    });


    var contests = JSON.parse($('#contests').val());


    $('#addScoreContest').select2({
        language: 'ru'
    });

    $('#addScoreContest').parent().removeClass('hide');

    var data = [], temp_contest, data1 = [], temp_stage;

    for(var i = 0; i < contests.length; i++) {
        temp_contest = {
            contestID: contests[i]['id'],
            stages: getStagesJson(contests[i]['stages'], contests[i]['id'])
        };
        data.push(temp_contest);
    }


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
     * Edit Sxores Table Template
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
        var contest     = $(this).data('contest'),
            stage       = $(this).data('stage'),
            member      = $(this).data('member'),
            judge       = $(this).data('judge'),
            criterions  = $(this).data('criterions'),
            tablesData  = [], tempCrit;

        /**
         * TODO вывести балл, полученный membor конкретным жюри по всем критериям за этап
         *
         * вывеси в цикле ниже, где `score`: 5
         */


        for (var i = 0; i < criterions.length; i++) {
            tempCrit = {
                name: criterions[i]['name'],
                score: 5,
                edit: "<a role='button' class='openEditScoreArea edtScoreCell__btn' data-criterion='" + JSON.stringify(criterions[i]) + "' data-stage='" + stage + "' data-contest='" + contest + "' data-member='" + member + "' data-judge='" + judge + "'><i class='fa fa-edit'></i></a>" +
                      "<a role='button' class='submitScore edtScoreCell__btn hide' data-criterion='" + JSON.stringify(criterions[i]) + "' data-stage='" + stage + "' data-contest='" + contest + "' data-member='" + member + "' data-judge='" + judge + "'><i class='fa fa-save'></i></a>"
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
            oldScore    = scoreArea.html();

        scoreArea.html('<input class="inputScore" type="number" min="' + criterion['min_score'] + '" max="' + criterion['max_score'] + '" value="' + oldScore + '">');

        console.log('oldScore', oldScore);

        tr.children('.editScoreCell').children('.openEditScoreArea').addClass('hide');
        tr.children('.editScoreCell').children('.submitScore').removeClass('hide');
    } );


    /**
     * Submit Update New Score
      */
    $('#editScoresTable tbody').on( 'click', '.submitScore', function () {
        var contest     = $(this).data('contest'),
            stage       = $(this).data('stage'),
            criterion   = $(this).data('criterion')['id'],
            member      = $(this).data('member'),
            judge       = $(this).data('judge'),
            tr          = $(this).parent().parent(),
            scoreArea   = tr.children('.score'),
            newScore    = scoreArea.children().val();

        console.log('newScore: ' + newScore, contest, stage, criterion, member, judge);


        /**
         * TODO Update Score data
         */


        tr.children('.editScoreCell').children('.openEditScoreArea').removeClass('hide');
        tr.children('.editScoreCell').children('.submitScore').addClass('hide');

    });



    $('.dataTables_scrollHeadInner').css('width','100%');
    $('.dataTable').css('width','100%');

});