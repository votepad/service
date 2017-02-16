<!doctype html>
<html lang="ru">
<head>
	<title>Фестиваль "Я - Первокурсник!" | Votepad.ru</title>
	
	<meta charset="utf-8">
	
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/welcome/TEMP_EVENTS/pervokursnik_imgs/favicon.png" />

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
	    <section>
        <div class="row landing_head" style="background-image:linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.1)),url(//pp.vk.me/c637727/v637727330/13519/b0QaUMVWPsI.jpg); ">
            <div class="col-xs-12 col-md-12">
                <h1 class="event-title">Фестиваль "Я - Первокурсник!"</h1>
            </div>
        </div>
        <div class="row landing-main_info grey_bg">
            <div class="col-xs-12 col-md-4 info-elem">
                <div class="info-elem_border">
                    <i class="fa fa-clock-o info-elem_title" aria-hidden="true"></i>
                    <span class="info-elem_description">21 октября 2016</span>
                    <span class="info-elem_description">17:30-20:00</span>
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
	            <a id="total_rating" class="valign col-xs-12 col-sm-6 col-md-3 active" style="color: #0097A7; text-shadow: none">
	            	<span class="center">Итоговый</span>
	            </a>
                <a id="stage1_rating" class="valign col-xs-12 col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">«Визитка» факультета</span>
                </a>
                <a id="stage2_rating" class="valign col-xs-12 col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">«Идеальная модель первокурсника»</span>
                </a>
                <a id="stage3_rating" class="valign col-xs-12  col-sm-6 col-md-3" style="color: #0097A7; text-shadow: none">
                    <span class="center">«Клип» с тематикой евровидения</span>
                </a>
            </ul>
            
           <!--  People rating   -->
            <ul class="rating-list" id="total_rating_list" style="display:block;position: relative;">
            	<h4 style="text-align:center; margin-bottom: 40px;">В скобках указаны баллы, выставленные ответственными по факультетам своим коллегам.</h4>
            </ul>
			<ul class="rating-list" id="stage1_rating_list" style="display:none;position: relative;"></ul>
			<ul class="rating-list" id="stage2_rating_list" style="display:none;position: relative;"></ul>
			<ul class="rating-list" id="stage3_rating_list" style="display:none;position: relative;"></ul>

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

<script type="text/javascript">
$(document).ready(function(){
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



	var names = ["ИМБиП","МФКТиУ","ФТМиИ","ФПБиИ","ФФиОИ","ФИКТ","ФЛИСИ","ФИТиП","ФХКТиК","ЕНФ"];
	var images = ["IMBIP.jpg","MFKTU.jpg","FTMI.jpg", "FPBI.jpg", "FFOI.jpg", "FIKT.jpg", "FLISI.jpg", "FITIP.jpg", "FHKTK.jpg", "ENF.jpg"];
	var names_stage1 = ["МФКТиУ","ИМБиП","ФТМиИ","ФЛИСИ","ФИКТ","ФХКТиК","ФФиОИ","ФПБиИ","ЕНФ","ФИТиП"];
	var images_stage1 = ["MFKTU.jpg","IMBIP.jpg","FTMI.jpg","FLISI.jpg","FIKT.jpg","FHKTK.jpg","FFOI.jpg","FPBI.jpg","ENF.jpg","FITIP.jpg"];
	var names_stage2 = ["ФИКТ","ЕНФ","ФХКТиК","ФИТиП","МФКТиУ","ФЛИСИ","ФФиОИ","ФПБиИ","ИМБиП","ФТМиИ"];
	var images_stage2 = ["FIKT.jpg","ENF.jpg","FHKTK.jpg","FITIP.jpg","MFKTU.jpg","FLISI.jpg","FFOI.jpg","FPBI.jpg","IMBIP.jpg","FTMI.jpg"];
	var names_stage3 = ["ФЛИСИ","МФКТиУ","ИМБиП","ФИТиП","ФТМиИ","ФИКТ","ФПБиИ","ФХКТиК","ЕНФ","ФФиОИ"];
	var images_stage3 = ["FLISI.jpg","MFKTU.jpg","IMBIP.jpg","FITIP.jpg","FTMI.jpg","FIKT.jpg","FPBI.jpg","FHKTK.jpg","ENF.jpg","FFOI.jpg"];

	
	var stage1_rating = [4.8,4.6,4.6,4.2,4.2,4.2,4.2,4.2,4,4];
	var stage2_rating = [5,4.6,4.6,4.6,4.6,4.4,4.4,4.4,4,3.2];
	var stage3_rating = [5,5,5,4.6,4.6,4.4,4.2,4,3.8,3.4];
	var additional = [17,15,13,5,5,3,0,0,0,0]; //[0,0,0,0,0,0,0,0,0,0];//
	var total_rating = [30.6,29.4,25.4,17.8,17.0,16.6,13.6,13.2,12.8,12.4];
	var judges = 5;
	var n = names.length;

	$('.loading').css('display','none');

	var total_maxrating = 32;
	var stage1_maxrating = 5;
	var stage2_maxrating = 5;
	var stage3_maxrating = 5;

	var template = ["<li><div class=\"name\">", //team
				"</div><div class=\"photo\" style=\"background-image:url(<?=$assets; ?>img/welcome/TEMP_EVENTS/pervokursnik_imgs/site/", //image
				");\"><div class=\"place-icon button-right\">", //position
				"</div></div><div class=\"rating-bar\"><div class=\"results\" style=\"width:", //procent width
                "%;\"><span class=\"animate\">", // rating - ex: 10/20
                "</span></div></div></li>"];
			

	for (var i = 0; i < n; i++)
	{
		$('#total_rating_list').append(
			template[0] + names[i] + 
			template[1] + images[i] + 
			template[2] + (i+1) + 
			template[3] + ((total_rating[i]/total_maxrating)*100) +
			template[4] + total_rating[i] + "(+" + additional[i] + ")/" + total_maxrating +
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
			template[4] + stage2_rating[i] + "/" + stage2_maxrating +
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

<!-- Yandex.Metrika counter -->
<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter40323810 = new Ya.Metrika({ id:40323810, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); 
</script> <noscript><div><img src="https://mc.yandex.ru/watch/40323810" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

</html>