$(function ()
{
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
                var radio = $('input[type=radio][name="score-'+index+'-'+i+'"]:checked').val();
                if (radio == 0) {
                    k=1;
                    $("#errorMsg").click();
                    break;
                }
            }
            if ( k == 0 ){ return true; }
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
            var s = currentIndex+1;
            for (var i = 1; i <= s; i++) {
                var ids = []; // тут массив айди блоков
                $('#stage-'+i+' div').each(function(index) {
                    ids[index] = $(this).attr('id');
                });
                alert(ids.join(' ')); /*отправка ID участников в таблицу для вывода*/
            }
        },
    });

    $('.buttons button:first-child').addClass('active');
    
});