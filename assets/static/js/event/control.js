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

        $('#' + block + ' .dataTables_scrollHeadInner').css('width','100%');
        $('#' + block + ' .dataTable').css('width','100%');

    });


    $(document).ready(function(){
        $('.stage__table').DataTable({
            'paging': false,
            'searching': true,
            'info': false,
            'scrollX': true,
            columnDefs: [
                { 'targets' : 'no-sort', 'orderable': false },
            ]
        });
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
                members: JSON.stringify(obj[i]['member'], obj[i]['id'])
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

});