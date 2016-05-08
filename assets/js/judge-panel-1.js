$(function ()
{

    var url = location.protocol + '//' + location.hostname;

    var check_func;
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
            url: url + '/block/getBlocked',
            type: "POST",
            data: {
                stage: id,
            },
            success: function(data, config) {
                result = parseInt(data);
            },
            async: false,
        });
        return result;
    }

    function hideParticipant(stage) {
        var result = 'none';
        $.ajax({
            url: url + '/hide/',
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
        onInit: function(event, currentIndex) {

            var blocked;
            var id_stage = $('#stage-' + currentIndex).find('input[type=hidden]').attr('id');
            id_stage = parseInt(id_stage);
            
            blocked = stageStatus(id_stage);
            
            if ( blocked == 1 )
            {
                $('.thanks-'+currentIndex).css("display","block").children('p').text('Добро пожаловать на мероприятие! Совсем скоро организаторы откроют доступ к голосованию.');
                $('#stage-'+currentIndex).css("display","none");
                $('.show-part-'+currentIndex).on('click', function(){
                    $(".thanks-"+currentIndex).css("display","none");
                    $('#stage-'+currentIndex).css("display","block");
                    $('#confirm-step-'+currentIndex).val("2");
                });
                check(id_stage, currentIndex);
            }
            else{
                var id_participant;
                var adminBlocked = new Array();
                var counter = 0;

                kh = [];
                pos = [];
                m = 0;
                
                var id = $('#stage-'+currentIndex+' input[type=hidden]').attr('id');
                id_stage = parseInt(id);

                var bbg = hideParticipant(id_stage);
                for(var i = 0; i < bbg.length; i++)
                    adminBlocked[i] = bbg[i].id_participant;

                $('#stage-'+currentIndex).find('li').each( function() {
                    var desc = $(this).attr('id').substr($(this).attr('id').lastIndexOf('-')+1,$(this).attr('id').length);
                    desc = 'partisipant-'+currentIndex+'-'+desc;
                    var parts = $(this).children('div').attr('id');
                    
                    id_participant = parts;
                    var rm = $.inArray(id_participant, adminBlocked);
                    
                    if (rm != -1){
                        $(this).remove();
                        $('#stage-'+currentIndex).find('#'+desc).remove();

                    }
                    else {
                        m = $('#stage-'+currentIndex).find('#'+desc).find('input[type=hidden][name=buttons]').val();
                        pos[counter] = m; //id участника
                        kh[counter] = id_participant;
                        counter ++;
                    }
                });
                $('.portlets-wrapper ul li:first-child').addClass('active');
                $('.tab-content div:first-child').addClass('active');
            }
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            var id_event = $("input[name='id_event']").val();
            var id_judge = $("input[name='id_judge']").val();
            var counter = 0;
            var k = 0;        
            var blocked;
            var score;
            var part = $('#stage-'+currentIndex+' ul li').length;
            var crit = parseInt($('#stage-'+currentIndex+' .buttons').length)/parseInt(part); 

            var id_stage = $('#stage-' + currentIndex).find('input[type=hidden]').attr('id');
            id_stage = parseInt(id_stage);

            var id_nextStage = $('#stage-' + newIndex).find('input[type=hidden]').attr('id');
            id_nextStage = parseInt(id_nextStage);
            
            blocked = stageStatus(id_nextStage);
            
            for (var i = 0; i < part; i++) {
                score = 0;
                for (var j = 0; j < crit; j++) {
                    $('#partisipant-id-'+currentIndex+'-'+i).removeClass('btn-danger').addClass('btn-default');
                    var radio = $('input[type=radio][name="score-'+currentIndex+'-'+pos[i]+'-'+j+'"]:checked').val();
                    if (radio == 0 || radio == null) {
                        k=1;
                        $('#partisipant-id-'+currentIndex+'-'+i).removeClass('btn-default').addClass('btn-danger');
                        break;
                    }
                    score = score + parseInt(radio);
                }
                if ( k == 0 ){
                    var id_participant = kh[i];
                    
                    $.ajax({
                        url: url+'/setScore/',
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
            if ( k == 0){
                if( blocked == 0 ){
                    kh = [];
                    pos = [];
                    m = 0;

                    /** RM PARTS FROM NEW STAGE **/
                    var id_participant;
                    var adminBlocked = new Array();

                    var bbg = hideParticipant(id_nextStage);
                    for(var i = 0; i < bbg.length; i++)
                        adminBlocked[i] = bbg[i].id_participant;

                    $('#stage-'+newIndex).find('li').each( function() {
                        var desc = $(this).attr('id').substr($(this).attr('id').lastIndexOf(newIndex+'-')+2,$(this).attr('id').length);
                        alert(desc);
                        desc = 'partisipant-'+newIndex+'-'+desc;
                        alert(desc);
                        var parts = $(this).children('div').attr('id');
                        
                        id_participant = parts;
                        var rm = $.inArray(id_participant, adminBlocked);
                        
                        if (rm != -1){
                            $(this).remove();
                            $('#stage-'+newIndex).find('#'+desc).remove();

                        }
                        else {
                            m = $('#stage-'+newIndex).find('#'+desc).find('input[type=hidden][name=buttons]').val();
                            pos[counter] = m; //id участника
                            kh[counter] = id_participant;
                            counter ++;
                        }
                    });
                } else
                {
                    $('.thanks-'+newIndex).css("display","block");
                    $('#stage-'+newIndex).css("display","none");
                    $('.show-part-'+newIndex).on('click', function(){
                        $(".thanks-"+newIndex).css("display","none");
                        $('#stage-'+newIndex).css("display","block");
                        $('#confirm-step-'+newIndex).val("2");
                    });
                    check(id_nextStage, newIndex);
                }
                return true; 
            } else
            {
                $("#errorMsg").click();
            }
        },
        onStepChanged: function (event,currentIndex,previous) {
            $('.portlets-wrapper ul li:first-child').addClass('active');
            $('.tab-content div:first-child').addClass('active');
        },
        onFinishing: function (event, currentIndex)
        {
            var id_event = $("input[name='id_event']").val();
            var id_judge = $("input[name='id_judge']").val();
            var score;
            var part = $('#stage-'+currentIndex+' ul li').length;
            var crit = parseInt($('#stage-'+currentIndex+' .buttons').length)/parseInt(part); 

            var id_stage = $('#stage-' + currentIndex).find('input[type=hidden]').attr('id');
            id_stage = parseInt(id_stage);

            var k = 0;
            for (var i = 0; i < part; i++) {
                score = 0;
                for (var j = 0; j < crit; j++) {
                    $('#partisipant-id-'+currentIndex+'-'+i).removeClass('btn-danger').addClass('btn-default');
                    var radio = $('input[type=radio][name="score-'+currentIndex+'-'+pos[i]+'-'+j+'"]:checked').val();
                    if (radio == 0 || radio == null) {
                        k=1;
                        $('#partisipant-id-'+currentIndex+'-'+i).removeClass('btn-default').addClass('btn-danger');
                        break;
                    }
                    score = score + parseInt(radio);
                }
                if ( k == 0 ){
                    var id_participant = kh[i];
                    $.ajax({
                        url: url+'/setScore/',
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
            if ( k == 0 ){ 
                return true; 
            } else
            {
                $("#errorMsg").click();
            }
        },
        onFinished: function (event, currentIndex)
        {
            swal({
                title: "Голосование закончилось",
                text: "<p>Спасибо, что воспользовались нашей платформой</p><br><a href='"+url+"auth/logout' class='pronwe_Link-small pronwe_color'>Выйти и просмотреть рейтинг участников</a>",
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
                
                /** RM PARTS FROM NEW STAGE **/
                var id_participant;
                var adminBlocked = new Array();

                var bbg = hideParticipant(id_stage);
                for(var i = 0; i < bbg.length; i++)
                    adminBlocked[i] = bbg[i].id_participant;

                $('#stage-'+id).find('li').each( function() {
                    var desc = $(this).attr('id').substr($(this).attr('id').lastIndexOf('-')+1,$(this).attr('id').length);
                    desc = 'partisipant-'+id+'-'+desc;
                    var parts = $(this).children('div').attr('id');
                    
                    id_participant = parts;
                    var rm = $.inArray(id_participant, adminBlocked);
                    
                    if (rm != -1){
                        $(this).remove();
                        $('#stage-'+id).find('#'+desc).remove();

                    }
                    else {
                        m = $('#stage-'+id).find('#'+desc).find('input[type=hidden][name=buttons]').val();
                        pos[counter] = m; //id участника
                        kh[counter] = id_participant;
                        counter ++;
                    }
                });
                
            if (blocked == 0){
                $('.show-part-'+id).css("display","block");
                $('.portlets-wrapper ul li:first-child').addClass('active');
                $('.tab-content div:first-child').addClass('active');
                clearInterval(timerId);
            }
        }, 1500);
    }
    


    /* SETTING PANEL   */
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

            swal("Порядок выступлений сохранен!","","success");
        },
    });

    $('.nav-s').sortable();
    $('.portlets-wrapper ul li:first-child').addClass('active');
    $('.tab-content div:first-child').addClass('active');

    $('.colorpicker-component').colorpicker();
    
    $("#panel-view").click(function(){
        $("#partposition").removeClass("in");
        $("#panel-view-save").prop("disabled",false);
    });
    
    $("#part-position").click(function(){
        $("#panelview").removeClass("in");
        $("#panel-view-save").prop("disabled",true);
    });

});