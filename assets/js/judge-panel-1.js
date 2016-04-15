$(function ()
{

    var url = location.protocol+'//'+location.hostname+'/pronwe/';

    var form = $("#rating-area-2");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "div",
        transitionEffect: "slideLeft",
        forceMoveForward:true,
        transitionEffect:3,
        transitionEffectSpeed:800,
        labels: {
            next:"Следующий этап",
            finish:"Посмотреть результаты",
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            var index= currentIndex+1;
            var part = $('#stage-'+index+' ul li').length;
            var crit = $('#stage-'+index+' .buttons').length; 
            var k = 0;
            for (var i = 1; i <= part; i++) {
                for (var j = 1; j <= crit; j++) {
                    $('#stage-'+index+' ul li:nth-child('+i+')').removeClass('btn-danger').addClass('btn-default');
                    var radio = $('input[type=radio][name="score-'+index+'-'+i+'-'+j+'"]:checked').val();
                    if (radio == 0) {
                        k=1;
                        $('#stage-'+index+' ul li:nth-child('+i+')').removeClass('btn-default').addClass('btn-danger');
                        break;
                    }
                }
            
            }
            if ( k == 0 ){ return true; }
            else{$("#errorMsg").click();}
        },
        onFinishing: function (event, currentIndex)
        {
            var index= currentIndex+1;
            var part = $('#stage-'+index+' ul li').length;
            var crit = $('#stage-'+index+' .buttons').length; 
            var k = 0;
            for (var i = 1; i <= part; i++) {
                for (var j = 1; j <= crit; j++) {
                    $('#stage-'+index+' ul li:nth-child('+i+')').removeClass('btn-danger').addClass('btn-default');
                    var radio = $('input[type=radio][name="score-'+index+'-'+i+'-'+j+'"]:checked').val();
                    if (radio == 0) {
                        k=1;
                        $('#stage-'+index+' ul li:nth-child('+i+')').removeClass('btn-default').addClass('btn-danger');
                        break;
                    }
                }
            
            }
            if ( k == 0 ){ return true; }
            else{$("#errorMsg").click();}
        },
        onFinished: function (event, currentIndex)
        {
            alert("Submitted!");
        },
    });



    var form1 = $("#setting-rating-area-2");
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

            $("li[id~='part']").each(function () {
                el = $(this);

                var mainParent = el.parent().parent().parent("div[id~='stage']").attr('id');
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
            $("li[id~='part']").each(function () {
                el = $(this);

                var mainParent = el.parent().parent().parent("div[id~='stage']").attr('id');
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
    $('.nav-s').sortable();

    $('.portlets-wrapper ul li:first-child').addClass('active');
    $('.tab-content div:first-child').addClass('active');
    $('.buttons button:first-child').addClass('active');
    

});