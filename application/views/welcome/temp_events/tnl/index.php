<!doctype html>
<html lang="ru">
<head>
	<title>Финал конурса социальных проектов "Ты нужен людям" | Votepad.ru</title>
	<meta charset="utf-8">
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/welcome/TEMP_EVENTS/tnl_imgs/favicon.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css" media="screen">
    <link rel="stylesheet" href="<?=$assets; ?>css/temp_events.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/icons_fonts.css">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">
    
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
</head>
<body>
	<!--<img src="img/header.jpg" class="main_logo">
	<div class="main_container">
		<H1 class="page_title">TNL.PRONWE.RU</H1>
		<h1 class="page_title">Рейтинг участников</h1>
		<ul class="top_nav">
			<li class="active"><a href="index.html">Команды</a></li>
			<li><a href="part_rating.html">Участники</a></li>
		</ul>
		<ul class="rating-list all" id="rating-list">
			
		</ul>
	</div>
	<div class="footer">
		<p>информационное сопровождение мероприятия <a href="http://pronwe.ru" class="pronwe_link">ProNWE.ru</a></p>
	</div>-->
	<section>
        <div class="row landing_head" style="background-image:linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.1)),url(<?=$assets; ?>img/welcome/TEMP_EVENTS/tnl_imgs/tnl.jpg)">
            <div class="col-xs-12 col-md-12">
                <h1 class="event-title">Финал конурса социальных проектов "Ты нужен людям"</h1>
            </div>
        </div>
        <div class="row landing-main_info grey_bg">
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-clock-o info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description">12-14 мая 2016</span>
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
                <a id="teams_rating" class="valign col-xs-12 col-sm-6 active" style="color: #0097A7; text-shadow: none">
                    <span class="center">Рейтинг команд</span>
                </a>
                <a id="parts_rating" class="valign col-xs-12 col-sm-6" style="color: #0097A7; text-shadow: none">
                    <span class="center">Рейтинг участников</span>
                </a>
            </ul>
            
           <!--  People rating   -->
            
            <ul class="rating-list" id="teams_rating_list" style="display:block; position: relative;"></ul>
            <ul class="rating-list" id="parts_rating_list" style="display:none; position: relative;"></ul>

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
</body>
<script>
$(document).ready(function(){
	$('#teams_rating').click(function(){
		$('.top_nav a').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		$('.rating-list').each(function(){
			$(this).css('display','none');
		});
		$('#teams_rating_list').css('display','block');
	});
	$('#parts_rating').click(function(){
		$('.top_nav a').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		$('.rating-list').each(function(){
			$(this).css('display','none');
		});
		$('#parts_rating_list').css('display','block');
	});


	// teams

	var images = ["2.jpg","3.jpg","4.jpg","6.jpg","7.jpg","8.jpg","9.jpg","10.jpg","11.jpg","12.jpg","13.jpg","14.jpg","15.jpg","16.jpg","17.jpg","18.jpg"],
	teams = ["Доброе сердце","Универсальный жилой дом модульной структуры","Разноцветные дни","Клуб «Молоды душой»","Социальная акция «Урок жизни»","Карта профессий","Сделаем жизнь детей ярче!","IV Этнический фестиваль культур","Письмо для друга","Прилетай во двор","Школа добровольцев Университета ИТМО","Межрегиональный молодежный форум","Велодруг","Связь поколений","Школа вожатых-инструкторов «Горро»","Югра-территория ценностей"],
	rating = [30.20,32.83,21.75,29.50,33.86,37.71,30.71,27.39,26.32,37.88,35.70,17.63,23.96,25.55,29.95,23.11],
	maxrating = 52;
	

	var template = ["<li><div class=\"name\">", //team
				"</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/tnl_imgs/site/", //image
				");\"><div class=\"place-icon button-right\">", //position
				"</div></div><div class=\"rating-bar\"><div class=\"results\" style=\"width:", //procent width
                "%;\"><span class=\"animate\">", // rating - ex: 10/20
                "</span></div></div></li>"];

	var n = rating.length;
	for (var i = 0; i < n-1; i++)
	for (var j = 0; j < n-1-i; j++)
	{
		if (rating[j+1] > rating[j])
		{
			var tmp = rating[j+1]; rating[j+1] = rating[j]; rating[j] = tmp;
			tmp = teams[j+1]; teams[j+1] = teams[j]; teams[j] = tmp;
			tmp = images[j+1]; images[j+1] = images[j]; images[j] = tmp;
		}
	}

	for (var i = 0; i < n; i++)
	{

		$('#teams_rating_list').append(
			template[0] + teams[i] + 
			template[1] + images[i] + 
			template[2] + (i+1) + 
			template[3] + ((rating[i]/maxrating)*100) +
			template[4] + rating[i] + "/" + maxrating +
			template[5]
		);
	}



	// participants
	var names1 = ["Муратова Лилия", "Миннигалимова Алия", "Сергеева Анастасия", "Чепурная Татьяна", "Власов Вячеслав", "Лебедева Елена", "Ордина Юлия", "Юртаев Константин", "Абросимова Ксения", "Гайдукова Алина", "Калинина Кристина", "Шишкин Павел", "Кузнецова Анна", "Перепелица Надежда", "Войцех Мария", "Орлова Светлана", "Назаренко Дарья", 
			"Потёмкина Елена", "Пенькова Вера", "Милонова Анастасия", "Кудрина Валерия", "Бельгинина Елена", "Плотникова Александра", "Пурпурова Екатерина", "Альтбрегина Екатерина", 
			"Петрова Анастасия", "Охотникова Мария", "Ганиев Евгений", "Попова Анастасия", "Полякова Дарья", "Шлыков Георгий", "Негрова Ирина", "Нана Мхсвилидзе", "Гуленко Ирина", 
			"Боронихина Елена", "Шаблей Никита", "Титова Людмила", "Шостак Екатерина"]
		
	var teams1 = ["Доброе сердце","Доброе сердце","Универсальный жилой дом модульной структуры","Универсальный жилой дом модульной структуры", "Универсальный жилой дом модульной структуры", "Разноцветные дни", "Разноцветные дни", "Клуб «Молоды душой", "Клуб «Молоды душой", "Социальная акция «Урок жизни»", "Карта профессий", "Карта профессий", "Сделаем жизнь детей ярче!", "Сделаем жизнь детей ярче!", "IV Этнический фестиваль культур", "IV Этнический фестиваль культур", "Письмо для друга", "Письмо для друга", "Письмо для друга", "Письмо для друга", "Письмо для друга", "Прилетай во двор", "Прилетай во двор", "Прилетай во двор", "Школа добровольцев Университета ИТМО", "Школа добровольцев Университета ИТМО", "Межрегиональный молодежный форум", "Межрегиональный молодежный форум", "Межрегиональный молодежный форум", "Межрегиональный молодежный форум", "Межрегиональный молодежный форум", "Велодруг", "Связь поколений", "Связь поколений", "Школа вожатых-инструкторов «Горро»", "Школа вожатых-инструкторов «Горро»", "Югра-территория ценностей", "Югра-территория ценностей"]
		
	var rating1 = [29.32,31.07,33.75,32.25,32.50,21.75,21.75,28.50,30.50,33.86,32.46,28.96,37.50,36.50,26.64,28.14,26.32,26.57,24.82,26.82,27.07,37.21,38.21,38.21,35.57,35.82,23.96,18.43,17.18,16.93,18.43,17.18,23.43,27.68,31.07,28.82,23.36,22.86]
		
	var maxrating1 = 52;
	
	var template1 = ["<li><div class=\"name\">", //name
			"<small style=\"display:block\">", //team
			"</small></div><div class=\"rating-bar\"><div style=\"width:", //current rating %
			"%;\"><span class=\"animate\">", // rating/maxrating
			"</span></div></div></li>"];
		
	var n = rating1.length;
	for (var i = 0; i < n-1; i++)
	for (var j = 0; j < n-1-i; j++)
	{
		if (rating1[j+1] > rating1[j])
		{
			var tmp = rating1[j+1]; rating1[j+1] = rating1[j]; rating1[j] = tmp;
			tmp = teams1[j+1]; teams1[j+1] = teams1[j]; teams1[j] = tmp;
			tmp = names1[j+1]; names1[j+1] = names1[j]; names1[j] = tmp;
		}
	}

	for (var i = 0; i < n; i++)
	{
		$('#parts_rating_list').append(
			template1[0] + names1[i] +
			template1[1] + teams1[i] +
			template1[2] + ((rating1[i]/maxrating1)*100) +
			template1[3] + rating1[i] + "/" + maxrating1 +
			template1[4]
		);
	}


});
</script>
</html>