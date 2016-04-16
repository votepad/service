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
            var index= currentIndex+1;
            var area = $('#stage-'+index+' .buttons').length;
            var k = 0;

            for (var i = 1; i <= area; i++) {

                var radio = $('input[type=radio][name="score-'+index+'-'+i+'"]:checked');
                var score = radio.val();
                if (score == 0 || score == null) {
                    k=1;
                    $("#errorMsg").click();
                    break;
                }
                if (k == 1)
                    return false;

                var id_participant  = radio.parent().parent().parent().find('h2').attr('id');
                var id_stage        = radio.parent().parent().parent().attr('id');
                var id_event        = $("input[name='id_event']").val();
                var id_judge        = $("input[name='id_judge']").val();

                $.ajax({
                    url: url+'setScore/',
                    type: "POST",
                    data: {
                        id_participant: id_participant,
                        id_stage: id_stage,
                        id_event: id_event,
                        id_judge: id_judge,
                        score: score,
                    },
                    success: function(data, config) {
                        console.log(data);
                    },
                    error: function(data, config) {
                    }
                });
            }
            if ( k == 0 ) {
                return true;
            }

        },
        onFinishing: function (event, currentIndex)
        {
            var index= currentIndex+1;
            var area = $('#stage-'+index+' .buttons').length;
            var k = 0;
            for (var i = 1; i <= area; i++) {

                var radio = $('input[type=radio][name="score-'+index+'-'+i+'"]:checked');
                var score = radio.val();
                if (score == 0 || score == null) {
                    k=1;
                    $("#errorMsg").click();
                    break;
                }
                if (k == 1)
                    return false;

                var id_participant  = radio.parent().parent().parent().find('h2').attr('id');
                var id_stage        = radio.parent().parent().parent().attr('id');
                var id_event        = $("input[name='id_event']").val();
                var id_judge        = $("input[name='id_judge']").val();

                $.ajax({
                    url: url+'setScore/',
                    type: "POST",
                    data: {
                        id_participant: id_participant,
                        id_stage: id_stage,
                        id_event: id_event,
                        id_judge: id_judge,
                        score: score,
                    },
                    success: function(data, config) {
                    },
                    error: function(data, config) {
                    }
                });
            }
            if ( k == 0 ){ return true; }
        },
        onFinished: function (event, currentIndex)
        {
            alert("Спасибо за участние!!!");
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