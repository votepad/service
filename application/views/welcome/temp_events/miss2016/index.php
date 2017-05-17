<!doctype html>
<html lang="ru">
<head>
	<title>Мисс ИТМО 2016 | Votepad.ru</title>
	
	<meta charset="utf-8">
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/welcome/TEMP_EVENTS/miss_imgs/favicon.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css" media="screen">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/temp_events.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css">
    
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>

</head>
<body>
	    <section>
        <div class="row landing_head" style="background-image:linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.1)),url(<?=$assets; ?>img/welcome/TEMP_EVENTS/miss_imgs/header.jpg)">
            <div class="col-xs-12 col-md-12">
                <h1 class="event-title">Мисс ИТМО 2016</h1>
            </div>
        </div>
        <div class="row landing-main_info grey_bg">
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-clock-o info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description">29 апреля 2016</span>
                    <span class="info-elem_description">17:30-20:00</span>
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
	            <p>Студенческий конкурс красоты, грации, таланта и ума "Мисс ИТМО" - одно из самых грандиозных и запоминающихся мероприятий в университете ИТМО!</p>

				<p>Весна демонстрирует нам не только пробуждение природы, любви, солнца и цветов, но и замечательных конкурсанток проекта "Мисс ИТМО"</p>

				<p>Начало истоков этого конкурса лежит в 2007 году. Давняя традиция порождает удивительное и увлекательное шоу, волнующее всех студентов, болеющих за представительниц своего факультета. С неподражаемым упорством, вот уже который год, девушки Университета ИТМО доказывают, что в крупнейшем техническом ВУЗе учатся не только самые умные, но и самые талантливые студентки. Конкурс проходит в несколько этапов, где девушки восхищают зрителя своими творческими номерами, очаровывают образами и удивляют импровизацией.</p>

				<p> За долгие годы Университетский конкурс "Мисс ИТМО" стал трамплином для реализации амбициозных планов участниц, местом встречи культурной и политической элиты, ярким и захватывающим шоу для молодежи города Санкт-Петербурга.</p>
            </div>
            <div class="event-description_social">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

                <!-- VK Widget -->
                <div id="vk_groups"></div>
                <script type="text/javascript">
                VK.Widgets.Group("vk_groups", {mode: 4, wide: 2, width: "300", height: "500", color1: '292D35', color2: '0097A7', color3: 'EEEEEE'}, 89441196);
                </script>
            </div>
        </div>
        <div class="row event-rating grey_bg">
            <ul class="top_nav clearfix">
                <a id="total_rating" class="valign col-xs-12 col-sm-6 col-md-3 active">
                    <span class="center">Итоговый рейтинг</span>
                </a>
                <a id="stage1_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Первый этап</span>
                </a>
                <a id="stage2_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Второй этап</span>
                </a>
                <a id="stage3_rating" class="valign col-xs-12 col-sm-6 col-md-3 ">
                    <span class="center">Третий этап</span>
                </a>
            </ul>
            
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
</body>
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


    var template = ["<li><div class=\"name\">", //name
                "</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/miss_imgs/site/", //image
                ");\"><div class=\"place-icon button-right\">", // position
                "</div></div><div class=\"rating-bar\"><div class=\"results\" style=\"width:", //current rating %
                "%;\"><span class=\"animate\">", // rating/total_maxrating
                "</span></div></div></li>"];


    var images = ["enf.png","tmi.png","itip.png","kty.png","pbi.png","ikt.png","lisi.png","idu.png","fioi.png","imbip.png"],
		names = ["Черепович Дарья","Смолькина Юлия","Дунаева Карина","Малахова Валерия","Валуева Мария","Пивоварова Елена","Башарова Катерина","Маслобойникова Ольга","Крюкова Анастасия","Рябова Эллина "],
		total_rating = [53,50,48.2,44,44,42,41,41,40.6,39.2],
		total_maxrating = 70;

	var names_stage1 = ["Черепович Дарья","Дунаева Карина","Малахова Валерия","Маслобойникова Ольга","Башарова Катерина","Крюкова Анастасия","Смолькина Юлия","Рябова Эллина","Пивоварова Елена","Валуева Мария"],
			images_stage1 = ["enf.png","itip.png","kty.png","idu.png","lisi.png","fioi.png","tmi.png","imbip.png","ikt.png","pbi.png"],
			stage1_rating = [25,23,23,22,20,20,20,19,19,18],
			stage1_maxrating = 30;

	var names_stage2 = ["Крюкова Анастасия","Дунаева Карина","Рябова Эллина","Смолькина Юлия","Валуева Мария","Башарова Катерина","Пивоварова Елена","Малахова Валерия","Черепович Дарья","Маслобойникова Ольга"],
		images_stage2 = ["fioi.png","itip.png","imbip.png","tmi.png","pbi.png","lisi.png","ikt.png","kty.png","enf.png","idu.png"],
		stage2_rating = [3.6,3.2,3.2,3,1,1,1,1,1,1],
		stage2_maxrating = 4;
	
	var names_stage3 = ["Смолькина Юлия","Черепович Дарья","Валуева Мария","Пивоварова Елена","Дунаева Карина","Малахова Валерия","Башарова Катерина","Маслобойникова Ольга","Крюкова Анастасия","Рябова Эллина"],
		images_stage3 = ["tmi.png","enf.png","pbi.png","ikt.png","itip.png","kty.png","lisi.png","idu.png","fioi.png","imbip.png"],
		stage3_rating = [27,27,25,22,22,20,19,18,17,17],
		stage3_maxrating = 36;



	var n = names.length;

    for (var i = 0; i < n; i++)
    {
        $('#total_rating_list').append(
            template[0] + names[i] +
            template[1] + images[i] +
            template[2] + (i+1) +
            template[3] + ((total_rating[i]/total_maxrating)*100) +
            template[4] + total_rating[i] + "/" + total_maxrating +
            template[5]
        );
        $('#stage1_rating_list').append(
            template[0] + names_stage1[i] +
            template[1] + images_stage1[i] +
            template[2] + (i+1) +
            template[3] + ((stage1_rating[i]/stage1_maxrating)*100) +
            template[4] + stage1_rating[i] + "/" + stage1_maxrating +
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
            template[3] + ((stage3_rating[i]/stage3_maxrating)*100) +
            template[4] + stage3_rating[i] + "/" + stage3_maxrating +
            template[5]
        );
    }



});
</script>
</html>