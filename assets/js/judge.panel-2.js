$(function ()
{
    var url = location.protocol+'//'+location.hostname+'/pronwe/';

    var form = $("#rating-area");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "div",
        transitionEffect: "slideLeft",
        forceMoveForward: true,
        transitionEffect:3,
        transitionEffectSpeed:800,
        labels: {
            next:"Следующий этап",
            finish:"Посмотреть результаты",
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            /*var index= currentIndex+1;
            var area = $('#stage-'+index+' .buttons').length;
            var k = 0;
            for (var i = 1; i <= area; i++) {
                var radio = $('input[type=radio][name="score-'+index+'-'+i+'"]:checked').val();
                if (radio == 0) {
                    k=1;
                    $("#errorMsg").click();
                    break;
                }
            }
            if ( k == 0 ){ return true; }*/

        },
        onFinishing: function (event, currentIndex)
        {
            var index= currentIndex+1;
            var area = $('#stage-'+index+' .buttons').length;
            var k = 0;
            for (var i = 1; i <= area; i++) {
                var radio = $('input[type=radio][name="score-'+index+'-'+i+'"]:checked').val();
                if (radio == 0) {
                    k=1;
                    $("#errorMsg").click();
                    break;
                }
            }
            if ( k == 0 ){ return true; }
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        },
    });

    var form1 = $("#setting-rating-area");
    form1.children("div").steps({
        headerTag: "h3",
        bodyTag: "div",
        transitionEffect: "slideLeft",
        enableAllSteps: true,
        transitionEffect:3,
        transitionEffectSpeed:800,
        labels: {
            next:"Следующий этап",
            previous:"Предыдущий этап",
            finish:"Сохранить порядок выступления",
        },
        onFinished: function (event, currentIndex)
        {
            var el;
            var eventId = $("input[id='id_event']").val();
            var position = 0;

            $("div[id~='participant-id']").each(function () {
                el = $(this);

                var mainParent = el.parent("div[id~='stage']").attr('id');
                var list = mainParent.split(' ');
                var stage = list[1];
                var realId = list[2];

                if (stage == currentIndex)
                {
                    position++;

                    var caughtParticipantsFromStage = el.attr('id').split(' ');
                    var participantId = caughtParticipantsFromStage[1];

                    $.ajax({
                        url: url + '/updateEventsSubstance/participantposition/',
                        type: "POST",
                        data: {
                            id_event: eventId,
                            participant: participantId,
                            stage: realId,
                            position: position,
                        },
                        success: function(data, config) {
                        },
                        error: function(data, config) {
                        }
                    });
                }
            });

            alert("Порядок выступлений сохранен!");
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            var el;
            var eventId = $("input[id='id_event']").val();
            var position = 0;

            $("div[id~='participant-id']").each(function () {
                el = $(this);

                var mainParent = el.parent("div[id~='stage']").attr('id');
                var list = mainParent.split(' ');
                var stage = list[1];
                var realId = list[2];

                if (stage == currentIndex)
                {
                    position++;

                    var caughtParticipantsFromStage = el.attr('id').split(' ');
                    var participantId = caughtParticipantsFromStage[1];

                    $.ajax({
                        url: url + '/updateEventsSubstance/participantposition/',
                        type: "POST",
                        data: {
                            id_event: eventId,
                            participant: participantId,
                            stage: realId,
                            position: position,
                        },
                        success: function(data, config) {
                        },
                        error: function(data, config) {
                        }
                    });
                }
            });

            return true;
        },
    });

    $('.buttons button:first-child').addClass('active');

    
});