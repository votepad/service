<!doctype html>
<html lang="ru">
<head>
    
    <title>Лига КВН POINT | Votepad.ru</title>
    <meta charset="utf-8">
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/welcome/TEMP_EVENTS/point_imgs/favicon.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css" media="screen">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/temp_events.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css">
    
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>

</head>

<body>
    <section>
        <div class="row landing_head" style="background-image:linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.1)),url(https://cs7052.vk.me/c836625/v836625787/146e2/Yz_hHtEg-Rg.jpg)">
            <div class="col-xs-12 col-md-12">
                <h1 class="event-title">Лига КВН POINT</h1>
            </div>
        </div>
        <div class="row landing-main_info grey_bg">
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-clock-o info-elem_title" aria-hidden="true"></i>
                    <!--<span id="time-counter" class="info-elem_description"></span>-->
                    <span class="info-elem_description">17 декабря 2016</span>
                    <span class="info-elem_description">19:00-21:00</span>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-map-marker info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description" style="display:block;">Санкт-Петербург</span>
                    <span class="info-elem_description" style="display:block;">ул. Ломоносова, 9</span>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-flag info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description" style="display:block;">Университет ИТМО</span>
                    <span class="info-elem_description" style="display:block;"></span>
                </div>
            </div>
        </div>
        
        <div class="row event-rating" style="margin-top: 0;">
            <ul class="top_nav clearfix">
                <a id="rating_people" class="valign col-xs-12 col-sm-6 active col-md-4" style="color: #0097A7; text-shadow: none">
                    <span class="center">Приз зрительских симпатий</span>
                </a>
                <a id="rating_total" class="valign col-xs-12 col-sm-6 col-md-4" style="color: #0097A7; text-shadow: none">
                    <span class="center">Итоговый</span>
                </a>
                <a id="rating_contest_1" class="valign col-xs-12 col-sm-6 col-md-4" style="color: #0097A7; text-shadow: none">
                    <span class="center">Фристайл</span>
                </a>
                <a id="rating_contest_2" class="valign col-xs-12  col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">Разминка</span>
                </a>
                <a id="rating_contest_3" class="valign col-xs-12 col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">Капитанский конкурс</span>
                </a>
                <a id="rating_contest_4" class="valign col-xs-12 col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">Видео(Блог команды)</span>
                </a>
                <a id="rating_contest_5" class="valign col-xs-12 col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">СТЭМ</span>
                </a>
                
                
                
            </ul>
            
           <!--  People rating   -->
            
            <ul class="rating-list" id="rating_list_people" style="display:block; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_total" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_1" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_2" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_3" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_4" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_5" style="display:none; position: relative;"></ul>


        </div>
        
<style type="text/css">
    .footer{
        margin-top: 0;
        background: #292d35;
    }
    .footer .logo-name{
        margin-left: 0;
    }
    .name{
        color: initial;
    }
</style>

<footer class="footer">
    <div class="footer_wrapper">
        <div class="footer_block clearfix">
            <div class="nav-addition pull-right">
                <div class="footer_icons">
                    <a href="//vk.com/votepad" class="vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <a href="//twitter.com/votepadevent" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <span>— подписывайтесь!</span>
                </div>
                <br>
                <span class="copyright pull-right">© 2016-2017  "Votepad.ru"</span>
            </div>
            <div class="logo">
                <a href="/" class="logo-name">Votepad</a>
                <span class="logo-text">Автоматизированный подсчёт</span>
                <span class="logo-text">результатов голосования</span>
            </div>
            <div class="nav-main">
                <a href="/#events" class="footer_btn toEvents">Мероприятия</a>
                <a href="#" class="footer_btn ">О продукте</a>
            </div>
        </div>
    </div>
</footer>


    </section>
<body>

<script>
$(document).ready(function(){

    var template = ["<li><div class=\"name\">", //name
                "</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/point_imgs/site/", //photo
                ");\"><div class=\"place-icon button-right\">", //position
                "</div></div><div class=\"rating-bar\"><div class=\"vote_me\" data-pk=\"", // id
                "\"><span>Проголосовать</span></div></div></li>"];

    var template1 = ["<li><div class=\"name\">", //name
                "</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/point_imgs/site/", //photo
                ");\"><div class=\"place-icon button-right\">", //position
                "</div></div><div class=\"rating-bar\"><div data-pk=\"", // id
                "\" class=\"results\" style=\"width:", //procent width
                "%;\"><span class=\"animate\">", // rating - ex: 10/20
                "</span></div></div></li>"];


    /*  Append hidden class for long description */

    if ($(".event-description").height() > 500) {
        $(".event-description").addClass('card_height-500px').append('<div class="card_content-text-hidden"  title="Show full description"></div>');
    }

    $('body').on('click', '.card_content-text-hidden', function(){
         $(this).parent().removeClass().addClass('event-description');
         $(this).remove();
     });


    // changing tabs with results

    $('#rating_people').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_people').css('display','block');
    });
    $('#rating_total').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_total').css('display','block');
    });
    $('#rating_contest_1').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_contest_1').css('display','block');
    });
    $('#rating_contest_2').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_contest_2').css('display','block');
    });
    $('#rating_contest_3').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_contest_3').css('display','block');
    });
    $('#rating_contest_4').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_contest_4').css('display','block');
    });
    $('#rating_contest_5').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#rating_list_contest_5').css('display','block');
    });



    get_results();

    function get_results() {    

        // set update class
        $('#rating_list_people').addClass('whirl');
        $('#rating_list_total').addClass('whirl');
        $('#rating_list_contest_1').addClass('whirl');
        $('#rating_list_contest_2').addClass('whirl');
        $('#rating_list_contest_3').addClass('whirl');
        $('#rating_list_contest_4').addClass('whirl');
        $('#rating_list_contest_5').addClass('whirl');




    /*   get people's choice award results */

            var results = [{"score":"267","participant":{"id":"139","id_event":"11","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png"}},{"score":"203","participant":{"id":"140","id_event":"11","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg"}},{"score":"142","participant":{"id":"137","id_event":"11","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg"}},{"score":"139","participant":{"id":"138","id_event":"11","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg"}}];
            var N = Object.keys(results).length, output = "", totalvotes = getTotalVotes(results, N);
            for (var i = 0; i < N; i++) {
                    output = output + template1[0] + results[i]['participant']['name'] + template1[1] + results[i]['participant']['photo'] +
                                      template1[2] + (i+1) + template1[3] + results[i]['participant']['id'] + template1[4] +
                                      ((parseInt(results[i]['score'])/totalvotes)*100) + template1[5] +
                                      results[i]['score'] + "/" + totalvotes + template1[6];
                }

            $('#rating_list_people').empty().append(output);

            $('#rating_list_people').removeClass('whirl');


    var judges = 5;


    /*  get  total  result */   
    
    var results1 =  [{"score":"103","id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg"},{"score":"100","id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg"},{"score":"88","id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg"},{"score":"87","id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png"}];
    var N = Object.keys(results1).length, output = "", maxscore = 23;

    for (var i = 0; i < N; i++) {
        results1[i].score = +results1[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results1[j+1].score > results1[j].score)
        {
            var tmp = results1[j+1];
            results1[j+1] = results1[j];
            results1[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results1[i]['name'] + template1[1] + results1[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results1[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results1[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_total').empty().append(output);
    $('#rating_list_total').removeClass('whirl');



    /*  get result on first stage */
    
    var results2 = [{"id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg","score":"25"},{"id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg","score":"23"},{"id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png","score":"20"},{"id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg","score":"16"}];
    var N = Object.keys(results2).length, output = "", maxscore = 5;

    for (var i = 0; i < N; i++) {
        results2[i].score = +results2[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results2[j+1].score > results2[j].score)
        {
            var tmp = results2[j+1];
            results2[j+1] = results2[j];
            results2[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results2[i]['name'] + template1[1] + results2[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results2[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results2[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_contest_1').empty().append(output);    
    $('#rating_list_contest_1').removeClass('whirl');
    



    /*  get result on second stage */

    var results = [
    {"id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg","score":"25"},{"id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg","score":"23"},{"id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg","score":"22"},{"id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png","score":"20"}];
    var N = Object.keys(results).length, output = "", maxscore = 5;

    for (var i = 0; i < N; i++) {
        results[i].score = +results[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results[j+1].score > results[j].score)
        {
            var tmp = results[j+1];
            results[j+1] = results[j];
            results[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results[i]['name'] + template1[1] + results[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_contest_2').empty().append(output);

    $('#rating_list_contest_2').removeClass('whirl');
    


    /*  get result on third stage */
    
    var results = [{"id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg","score":"19"},{"id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg","score":"16"},{"id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg","score":"15"},{"id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png","score":"12"}];
    var N = Object.keys(results).length, output = "", maxscore = 4;

    for (var i = 0; i < N; i++) {
        results[i].score = +results[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results[j+1].score > results[j].score)
        {
            var tmp = results[j+1];
            results[j+1] = results[j];
            results[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results[i]['name'] + template1[1] + results[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_contest_3').empty().append(output);


    $('#rating_list_contest_3').removeClass('whirl');




    /*  get result on 4th stage */
    
    var results = [{"id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg","score":"19"},{"id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png","score":"19"},{"id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg","score":"15"},{"id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg","score":"12"}];
    var N = Object.keys(results).length, output = "", maxscore = 4;

    for (var i = 0; i < N; i++) {
        results[i].score = +results[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results[j+1].score > results[j].score)
        {
            var tmp = results[j+1];
            results[j+1] = results[j];
            results[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results[i]['name'] + template1[1] + results[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_contest_4').empty().append(output);

    $('#rating_list_contest_4').removeClass('whirl');



    /*  get result on 5th stage */

    var results = [{"id":"137","name":"\u0422\u0422.\u0421\u0431\u043e\u0440\u043d\u0430\u044f \u0423\u043d\u0438\u0432\u0435\u0440\u0441\u0438\u0442\u0435\u0442\u0430 \u0418\u0422\u041c\u041e","description":"","photo":"sbornayaitmo.jpg","score":"22"},{"id":"140","name":"\u0428\u0430\u043a\u0438\u043b \u0414\u0430\u043d\u0438\u043b","description":"","photo":"shikal_daniil.jpg","score":"21"},{"id":"138","name":"12 \u043d\u043e\u044f\u0431\u0440\u044f","description":"","photo":"12november.jpg","score":"18"},{"id":"139","name":"\u041f\u043e\u0435\u0445\u0430\u043b\u0438","description":"","photo":"poehali.png","score":"16"}];
    var N = Object.keys(results).length, output = "", maxscore = 5;

    for (var i = 0; i < N; i++) {
        results[i].score = +results[i].score;
    }

    for (var i = 0; i < N-1; i++)
    for (var j = 0; j < N-1-i; j++)
    {
        if (results[j+1].score > results[j].score)
        {
            var tmp = results[j+1];
            results[j+1] = results[j];
            results[j] = tmp;
        }
    }

    for (var i = 0; i < N; i++) {

        output = output + template1[0] + results[i]['name'] + template1[1] + results[i]['photo'] +
                      template1[2] + (i+1) + template1[3] + "0" + template1[4] +
                      (((parseInt(results[i]['score'])/maxscore)/judges)*100) + template1[5] +
                      parseInt(results[i]['score'])/judges + "/" + maxscore + template1[6];
    }

    $('#rating_list_contest_5').empty().append(output);

    $('#rating_list_contest_5').removeClass('whirl');


    }


    function getTotalVotes(array, N){
        var votes = 0;
        for (var i = 0; i < N; i++) {
            votes = votes + parseInt(array[i]['score']);
        }
        if (votes == 0)
            return 1;

        return votes;
    }



});
</script>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter41650874 = new Ya.Metrika({ id:41650874, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/41650874" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

</html>

