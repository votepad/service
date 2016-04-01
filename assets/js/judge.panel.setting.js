
$(function ()
{
    var form = $("#setting-rating-area");
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        transitionEffect:3,
        transitionEffectSpeed:800,
        labels: {
            next:"Следующий этап",
            previous:"Предыдущий этап",
            finish:"Сохранить порядок выступления",
        },
        onFinished: function (event, currentIndex)
        {
            var s = 2; /*количество этапов, выводим из бд*/
            for (var i = 1; i <= s; i++) {
                var ids = []; // тут массив айди блоков
                $('#stage-'+i+' div').each(function(index) {
                    ids[index] = $(this).attr('id');
                });
                alert(ids.join(' ')); /*отправка ID участников в таблицу для вывода*/  
            }
        },
    });
});