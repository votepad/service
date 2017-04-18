$(document).ready(function () {


    $('.blockMemberStages').select2({
        language: 'ru'
    });

    $('.blockMemberStages').parent().removeClass('hide');


    var stages = [], temp_stage, jsonStage;


    $('.blockMemberStagesInput').each(function () {

        jsonStage = JSON.parse($(this).val());

        for(var i = 0; i < jsonStage.length; i++) {
            temp_stage = {
                contestID: $(this).parent().parent().children('.blockMemberContest').val(),
                stageID: jsonStage[i]['id'],
                members: jsonStage[i]['members']
            };
            stages.push(temp_stage);
        }

    });

    /**
     * On change Stage (select)
     */
    $('.blockMemberStages').on('change', function () {
        var stage   = $(this).val(),
            contest = $(this).parent().parent().children('.blockMemberContest').val();

        if (stage != 0) {
            $(this).parent().parent().children('.blockMembers').html(getMember(contest, stage));
            $(this).parent().parent().children('.blockMembers').removeClass('hide');
            $(this).parent().parent().children('.blockMembersBtn').removeClass('hide');
        } else {
            $(this).parent().parent().children('.blockMembers').addClass('hide');
            $(this).parent().parent().children('.blockMembersBtn').addClass('hide');
        }

    });


    /**
     * Get Member By ContestID and StageID from array
     */
    function getMember(contest, stage) {

        for (var i = 0; i < stages.length; i++)
        {
            if ( stages[i]['contestID'] == contest && stages[i]['stageID'] == stage)
            {
                var out = "";

                for (var j = 0; j < stages[i]['members'].length; j++) {

                    out +=  '<p>' +
                            '<input type="checkbox" name="members[]" id="member_' + contest  +'_' + stage + '_' + stages[i]['members'][j]['id'] + '" value="' + stages[i]['members'][j]['id'] + '">' +
                            '<label for="member_' +contest  +'_' + stage + '_' + stages[i]['members'][j]['id'] + '">' + stages[i]['members'][j]['name'] + '</label>' +
                            '</p>';
                }

                return out;
            }
        }

    }

    /**
     * Submit Blocking Members
     */
    $('.blockMembersBtn').click(function () {
        var block = $(this).parent();

        console.log($('[name="members[]"]', block).val());
        console.log($('[name="stage"]', block).val());
        console.log($('[name="contest"]', block).val());

        /**
         * TODO block members
         */

    });




});