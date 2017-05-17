<!doctype html>
<head>
    <title>Мистер ИТМО 2017 | Votepad.ru</title>

    <meta charset="utf-8">
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/welcome/TEMP_EVENTS/mister17_imgs/favicon.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css" media="screen">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/temp_events.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css">
    
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>

</head>

<body>
    <section>
        <div class="row landing_head" style="background-image:linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.1)),url(https://cs7053.vk.me/c837437/v837437330/1010b/oh41_NC-nZs.jpg)">
            <div class="col-xs-12 col-md-12">
                <h1 class="event-title">Мистер ИТМО</h1>
            </div>
        </div>
        <div class="row landing-main_info grey_bg">
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-clock-o info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description">9 дeкабря 2016</span>
                    <span class="info-elem_description">17:30 - 20:00</span>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-map-marker info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description" style="display:block;">Санкт-Петербург</span>
                    <span class="info-elem_description" style="display:block;">Александровский парк, 4</span>
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
        <div class="row event-description_form" style="padding:5%;">
            <div class="event-description">
                <p>«Мистер ИТМО» - самое ожидаемое и громкое событие каждой зимы, ежегодно зажигающее одну из центральных сцен Санкт-Петербурга.</p>
                <p>Юбилейное, десятое по счету грандиозное шоу соберет выдающихся, ярких и уникальных парней нашего Университета, которые сойдутся в борьбе за признание зрителей, почетного жюри и, конечно же, за почетный титул «Мистера ИТМО 2017».</p>
                <p>Аналогичного по масштабам конкурса вы не найдете в других ВУЗах. Его организация - результат кропотливой и скоординированной работы не только самих участников, но и большой команды организаторов.</p>
                <p>Совершенствуясь с каждым годом, за десять лет мероприятие вышло на высочайший уровень и приобрело по-настоящему огромный размах.</p>
            </div>
            <div class="event-description_social">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

                <!-- VK Widget -->
                <div id="vk_groups"></div>
                <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 4, wide: 2, width: "300", height: "500", color1: '292D35', color2: '0097A7', color3: 'EEEEEE'}, 131124425);
                </script>
            </div>
        </div>
        <div class="row event-rating grey_bg">
            <ul class="top_nav clearfix">
                <a id="total_rating" class="valign col-xs-12 col-sm-6 col-md-3 active">
                    <span class="center">Итоговый рейтинг</span>
                </a>
                <a id="stage1_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Образ мистера</span>
                </a>
                <a id="stage2_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Спортивный конкурс</span>
                </a>
                <a id="stage3_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Творческий номер</span>
                </a>
            </ul>
            <div class="loading">
                <i class="fa fa-spinner fa-pulse fa-fw"></i>
                Загрузка данных
            </div>
            <ul class="rating-list" id="total_rating_list" style="display:block"></ul>
            <ul class="rating-list" id="stage1_rating_list" style="display:none"></ul>
            <ul class="rating-list" id="stage2_rating_list" style="display:none"></ul>
            <ul class="rating-list" id="stage3_rating_list" style="display:none"></ul>
        </div>
<style type="text/css">
    .footer{
        margin-top: 0;
        background: initial;
    }
    .footer .logo-icon .path1, .footer .logo-icon .path5, .footer .logo-name, .footer .logo-text, .footer_btn, .footer_icons > span, .footer .copyright{
        color: #413a41;
        text-shadow: 0 0 1px rgba(0,0,0,0.5);
    }
    .footer .logo-name{
        margin-left: 0;
    }
    .footer_btn:hover, .footer_btn:focus{
        color: #413a41;
        border-bottom: 1px solid #413a41;
    }
    .footer_btn-light, .copyright{
        opacity: 1
    }
    .footer .divider{
        background-color: rgba(224, 224, 224, 1);
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
    if ($(".event-description").height() > 500) {
        $(".event-description").addClass('card_height-500px').append('<div class="card_content-text-hidden"  title="Показать полностью"></div>');
    }

    $('body').on('click', '.card_content-text-hidden', function(){
         $(this).parent().removeClass().addClass('event-description');
         $(this).remove();
     });

    $('#total_rating').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#total_rating_list').css('display','block');
    });
    $('#stage1_rating').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#stage1_rating_list').css('display','block');
    });
    $('#stage2_rating').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#stage2_rating_list').css('display','block');
    });
    $('#stage3_rating').click(function(){
        $('.top_nav a').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('.rating-list').each(function(){
            $(this).css('display','none');
        });
        $('#stage3_rating_list').css('display','block');
    });




    var names = ["Хасанбакиев Раиль","Ершов Евгений","Зырин Денис","Гудз Никита","Кудрявцев Дмитрий","Мельчаков Роман","Морачев Даниил","Новиков Алексей","Гожальский Даниил","Котов Семён","Тарасенко Тарас","Шехтман Патрик"];
    var total_rating = [58,57,52.5,51.5,47.5,47,47,46,46,41.5,41.5,41.5];
    var images = ["1-fhktk.jpg","11-fibikt.jpg","4-imbip.jpg","8-flisi.jpg","2-fpiikt.jpg","7-fpbii.jpg","9-fikt.jpg","6-fsuir.jpg","10-ffioi.jpg","3-enf.jpg","5-fitip.jpg","12-ftmi.jpg"];


    var names_stage1 = ["Хасанбакиев Раиль","Ершов Евгений","Зырин Денис","Новиков Алексей","Мельчаков Роман","Гудз Никита","Гожальский Даниил","Морачев Даниил","Шехтман Патрик","Тарасенко Тарас","Котов Семён","Кудрявцев Дмитрий"];
    var stage1_rating = [25,25,22,22,22,21,20,19,18,17,17,16];
    var images_stage1 = ["1-fhktk.jpg","11-fibikt.jpg","4-imbip.jpg","6-fsuir.jpg","7-fpbii.jpg","8-flisi.jpg","10-ffioi.jpg","9-fikt.jpg","12-ftmi.jpg","5-fitip.jpg","3-enf.jpg","2-fpiikt.jpg"];

    var names_stage2 = ["Хасанбакиев Раиль","Морачев Даниил","Кудрявцев Дмитрий","Гудз Никита","Новиков Алексей","Мельчаков Роман","Гожальский Даниил","Ершов Евгений","Котов Семён","Зырин Денис","Тарасенко Тарас","Шехтман Патрик"];
    var stage2_rating = [3,3,2.5,2.5,2,2,2,2,1.5,1.5,1.5,1.5];
    var images_stage2 = ["1-fhktk.jpg","9-fikt.jpg","2-fpiikt.jpg","8-flisi.jpg","6-fsuir.jpg","7-fpbii.jpg","10-ffioi.jpg","11-fibikt.jpg","3-enf.jpg","4-imbip.jpg","5-fitip.jpg","12-ftmi.jpg"];

    var names_stage3 = ["Хасанбакиев Раиль","Ершов Евгений","Кудрявцев Дмитрий","Зырин Денис","Гудз Никита","Морачев Даниил","Гожальский Даниил","Котов Семён","Тарасенко Тарас","Мельчаков Роман","Новиков Алексей","Шехтман Патрик"];
    var stage3_rating = [30,30,29,29,28,25,24,23,23,23,22,22];
    var images_stage3 = ["1-fhktk.jpg","11-fibikt.jpg","2-fpiikt.jpg","4-imbip.jpg","8-flisi.jpg","9-fikt.jpg","10-ffioi.jpg","3-enf.jpg","5-fitip.jpg","7-fpbii.jpg","6-fsuir.jpg","12-ftmi.jpg"];

        var id = [];

        var judges = 5;
    
    var t = 0;

$('.loading').css('display','none');

        var total_maxrating = 14;
        var stage1_maxrating = 5;
        var stage2_maxrating = 3;
        var stage3_maxrating = 6;

        var template = ["<li><div class=\"name\">", //name
                "</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/mister17_imgs/site/", //image
                ");\"><div class=\"place-icon button-right\">", // position
                "</div></div><div class=\"rating-bar\"><div class=\"results\" style=\"width:", //current rating %
                "%;\"><span class=\"animate\">", // rating/total_maxrating
                "</span></div></div></li>"];
                
        var n = names.length;

        for (var i = 0; i < n; i++)
        {
            $('#total_rating_list').append(
                template[0] + names[i] +
                template[1] + images[i] +
                template[2] + (i+1) +
                template[3] + ((total_rating[i]/total_maxrating/judges)*100) +
                template[4] + total_rating[i]/judges + "/" + total_maxrating +
                template[5]
            );
            $('#stage1_rating_list').append(
                template[0] + names_stage1[i] +
                template[1] + images_stage1[i] +
                template[2] + (i+1) +
                template[3] + ((stage1_rating[i]/stage1_maxrating/judges)*100) +
                template[4] + stage1_rating[i]/judges + "/" + stage1_maxrating +
                template[5]
            );
            $('#stage2_rating_list').append(
                template[0] + names_stage2[i] +
                template[1] + images_stage2[i] +
                template[2] + (i+1) +
                template[3] + ((stage2_rating[i]/stage2_maxrating)*100) +
                template[4] + stage2_rating[i]+ "/" + stage2_maxrating +
                template[5]
            );
            $('#stage3_rating_list').append(
                template[0] + names_stage3[i] +
                template[1] + images_stage3[i] +
                template[2] + (i+1) +
                template[3] + ((stage3_rating[i]/stage3_maxrating/judges)*100) +
                template[4] + stage3_rating[i]/judges + "/" + stage3_maxrating +
                template[5]
            );
        }
        
});

</script>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter41483579 = new Ya.Metrika({ id:41483579, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/41483579" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->