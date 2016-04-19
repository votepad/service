$( function ()
{
    var url = location.protocol+'//'+location.hostname+'/pronwe/';

    var id_stage;
    var kh = new Array();
    var pos = new Array();
    var m = 0;

    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds){
                break;
            }
        }
    }

    function stageStatus(id) {
        var result;
        $.ajax({
            url: url + 'block/getBlocked',
            type: "POST",
            data: {
                stage: id,
            },
            success: function(data, config) {
                result = parseInt(data);
                console.log(result);
            },
            async: false,
        });
        return result;
    }

    function hideParticipant(stage) {
        var result = 'none';
        $.ajax({
            url: url + 'hide/',
            dataType: "json",
            type: "POST",
            data: {
                stage: stage,
            },
            success: function(data, config) {
                result = data;
            },
            async: false,
        });

        return result;
    }

    $('.buttons button:first-child').addClass('active');

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
        onStepChanging: function (event, currentIndex, newIndex) {
            var id_event = $("input[name='id_event']").val();
            var id_judge = $("input[name='id_judge']").val();
            var counter = 0;

            var index = currentIndex;
            var area = $('#stage-' + index + ' .buttons').length;
            var k = 0;

            for (var i = 0; i < area; i++) {
                var radio = $('input[type=radio][name="score-' + (index + 1) + '-' + pos[i] + '"]:checked');
                var score = radio.val();

                if (score == 0 || score == null) {
                    k = 1;
                    $("#errorMsg").click();
                }

                if (k == 1) {
                    return false;
                }
                else {
                    var id_participant = kh[i];
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
                           console.log(data);
                        }
                    });
                }
            }

            kh = [];
            pos = [];
            m = 0;

            /** RM PARTS FROM NEW STAGE **/
            index = newIndex;
            var id_participant ;
            var adminBlocked = new Array();
            counter = 0;

            var id = $('#stage-'+index+' input[type=hidden]').attr('id');
            id_stage = parseInt(id);

            var bbg = hideParticipant(id_stage);
            for(var i = 0; i < bbg.length; i++)
            adminBlocked[i] = bbg[i].id_participant;

            $('#stage-'+index).children('div').each( function() {
                var parts = $(this).children('div').attr('id');
                id_participant = parts;
                m ++;
                var rm = $.inArray(id_participant, adminBlocked);

                if (rm != -1)
                    $(this).remove();
                else {
                    pos[counter] = m;
                    kh[counter] = id_participant;
                    counter ++ ;
                }
            });
            /** END **/

            if ( k == 0 ) {
                return true;
            }
        },
        onInit: function(event, currentIndex) {

            var index = currentIndex;
            var id_participant ;
            var adminBlocked = new Array();
            var counter = 0;

            var id = $('#stage-'+index+' input[type=hidden]').attr('id');
            id_stage = parseInt(id);

            var bbg = hideParticipant(id_stage);
            for(var i = 0; i < bbg.length; i++)
                adminBlocked[i] = bbg[i].id_participant;

            $('#stage-'+index).children('div').each( function() {
                var parts = $(this).children('div').attr('id');
                id_participant = parts;

                m ++;
                var rm = $.inArray(id_participant, adminBlocked);

                if (rm != -1)
                    $(this).remove();
                else {
                    pos[counter] = m;
                    kh[counter] = id_participant;
                    counter ++;
                }
            });
        },
        onStepChanged: function(event, currentIndex, priorIndex) {

            var blocked;
            var id_stage = $('#stage-' + currentIndex).find('input[type=hidden]').attr('id');
            id_stage = parseInt(id_stage);
            
            blocked = stageStatus(id_stage);
            
            if ( blocked == 1 )
            {
                $('.thanks-'+currentIndex).css("display","block");
                $('#stage-'+currentIndex).css("display","none");
                $('.show-part-'+currentIndex).on('click', function(){
                    $(".thanks-"+currentIndex).css("display","none");
                    $('#stage-'+currentIndex).css("display","block");
                    $('#confirm-step-'+currentIndex).val("2");
                });                
            }
            check(id_stage, currentIndex);
        },
        onFinishing: function (event, currentIndex)
        {
            var id_event = $("input[name='id_event']").val();
            var id_judge = $("input[name='id_judge']").val();
            var counter = 0;

            var index = currentIndex;
            var area = $('#stage-' + index + ' .buttons').length;
            var k = 0;

            for (var i = 0; i < area; i++) {
                var radio = $('input[type=radio][name="score-' + (index + 1) + '-' + pos[i] + '"]:checked');
                var score = radio.val();
                console.log(score);

                if (score == 0 || score == null) {
                    k = 1;
                    $("#errorMsg").click();
                }

                if (k == 1) {
                    return false;
                }
                else {
                    var id_participant = kh[i];
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
                           console.log(data);
                        }
                    });
                }
            }

            kh = [];
            pos = [];
            m = 0;

            if ( k == 0 ) {
                return true;
            }
        },
        onFinished: function (event, currentIndex)
        {
            swal({
                title: "Голосование закончилось",
                text: "<p>Спасибо, что воспользовались нашей платформой</p><a href='#linktoeventpage' class='pronwe_Link-small pronwe_color'>Выйти и просмотреть рейтинг участников</a>",
                html: true,
                showCancelButton: false,
                showConfirmButton: false,
              });
        },
    });
    

    function check(id_stage, id){
        var counter = 0;

        var timerId = setInterval(function() {
            var blocked = stageStatus(id_stage);
                
                kh = [];
                pos = [];
                m = 0;
                alert(id );
                /** RM PARTS FROM NEW STAGE **/
                var index = id;
                var id_participant;
                var adminBlocked = new Array();
                counter = 0;

                var bbg = hideParticipant(id_stage);
                for(var i = 0; i < bbg.length; i++)
                adminBlocked[i] = bbg[i].id_participant;

                $('#stage-'+index).children('div').each( function() {
                    var parts = $(this).children('div').attr('id');
                    id_participant = parts;
                    m ++;
                    var rm = $.inArray(id_participant, adminBlocked);

                    if (rm != -1)
                        $(this).remove();
                    else {
                        pos[counter] = m;
                        kh[counter] = id_participant;
                        counter ++ ;
                    }
                });
                /** END **/

            if (blocked == 0){
                $('.show-part-'+id).css("display","block");
                clearInterval(timerId);
            }
        }, 1000);
    }
    
        
        
    /* SETTINGS PANEL */                
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

});
