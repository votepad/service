$(function ()
{
    var form1 = $("#rating-area-2");
    form1.children("div").steps({
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
            var s = currentIndex+1; /*количество этапов, выводим из бд*/
            for (var i = 1; i <= s; i++) {
                var ids = []; // тут массив айди блоков
                $('#stage-'+i+' ul li').each(function(index) {
                    ids[index] = $(this).attr('id');
                });
                alert(ids.join(' ')); /*отправка ID участников в таблицу для вывода*/
            }
        },
    });
    $('.nav-s').sortable();
});