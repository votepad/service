$(function ()
{
    var form1 = $("#rating-area-2");
    form1.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
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
});