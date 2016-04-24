<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>NoteWorthyEvent - События, заслуживающие внимания</title>
    <meta charset="UTF-8">
    <meta name="description" content="Проект, с множеством возможностей для организации и проведения мероприятий.">
    <meta name="author" content="NoteWortyEvent" />
    <meta name="keywords"  content="noteworthy,event,мероприятие,конкурс,организатор,жюри,судья,рейтинг" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Стили -->
    <link rel="stylesheet" type="text/css" href="../pronwe/assets/css/pronwe.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate.css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/jquery.cycle2/jquery.fullPage.css">
    <link rel="stylesheet" type="text/css" href="../pronwe/assets/css/welcome.css">

    <!-- Подключаем скрипты -->
	<script src="assets/vendor/jquery/dist/jquery.js"></script>    
    <script src="../pronwe/assets/vendor/jquery.cycle2/jquery.fullPage.js"></script>
    <script src="../pronwe/assets/js/welcome.js"></script>
	<script src="assets/vendor/jquery.cycle2/jquery.cycle2.js"></script>
	<script src="assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>


	</head>
 	<body>
	<div class="pl">
		<div class="round1"></div>
		<div class="pl_r"></div>
		<div class="pl_l"></div>
	</div>
    
	<ul id="menu">
		<li class="menu__li" data-menuanchor="Welcome"><a class="menu__a" href="#Welcome">Приветствие</a></li>
		<li class="menu__li" data-menuanchor="About"><a class="menu__a" href="#About">О нас</a></li>
		<li class="menu__li" data-menuanchor="Organizator"><a class="menu__a" href="#Organizator">Организаторам</a></li>
		<li class="menu__li" data-menuanchor="Feedback"><a class="menu__a" href="#Feedback">Обратная связь</a></li> 
	</ul>  
    
	<div id="fullpage">
		<div class="p1 section" id="section0" data-anchor="Welcome">
			<div id="login">
				<img src="assets/img/ProNWE_logo.svg" class="mobile_logo">
				<div class="button1"> <a href="">Авторизация</a></div>
				<div class="button1"> <a href="http://misteritmo.pronwe.ru">Мероприятия</a></div>
			</div>
			<div class="p_left">
				<div class="p1_logo">
					<img src="assets/img/ProNWE_logo.svg" width="70%">
				</div>
				<div class="p1_slogan">
					<h1>Новый формат оцениания мероприятий!</h1>
				</div>
				<div class="p1_down">
					<a class="tooltips" href="#About">
						<span>Подробнее</span>
						<i class="p1_center fa fa-angle-double-down fa-5x"></i>
					</a>
				</div>
			</div>
		</div>
      
		<div class="p2 section" id="section1" data-anchor="About">
			<div class="p2_title lightbox">
				<h2>Что такое <a href="http://pronwe.ru" class="pronwe_Link-small pronwe_color">ProNWE</a>?</h2>
			</div>
			<ul class="side-container">
				<li class="lightbox"><span>Информационное сопровождение мероприятия в интернет</span></li>
				<li class="lightbox"><span>Индивидуальная страница для каждого мероприятия</span></li>
				<li class="lightbox"><span>Автоматизация голосования для жюри</span></li>
				<li class="lightbox"><span>Иными словами, переход на новый формат оценки мероприятий!</span></li>
			</ul>
		</div>
      
		<div class="p3 section" id="section2" data-anchor="Organizator">
			<div class="container">
				<div id="slide_0">
					<div class="col-6 text-center">
						<img class="p3_img" src="assets/img/p3_0.jpg">  
					</div>
					<div class="col-6 text-center">
						<h2>Домен третьего уровня</h2>
						<p class="p3_text">Каждое Ваше мероприятие получит страницу на домене третьего уровня в зоне pronwe.ru оформленную по Вашим нуждам в стиле мероприятия.</p><br><br>
					</div>
  				</div>
				<div style="display:none;" id="slide_1">
					<div class="col-6 text-center">
						<img class="p3_img" src="assets/img/p3_1.png">
					</div>
					<div class="col-6 text-center">
						<h2>Панель управления мероприятием</h2>
						<p class="p3_text">Мы предоставим Вам удобную панель настройки и управления мероприятием, из которой вы сможете заполнить интересующую ваших гостей информацию, а также следить за мероприятием, за рейтингом, за выставлением баллов.</p><br>
					</div>
				</div>
				<div style="display:none;" id="slide_2">
					<div class="col-6 text-center">
						<img class="p3_img" src="assets/img/p3_2.png">
					</div>
					<div class="col-6 text-center">
						<h2>Онлайн статистика для Ваших гостей</h2>
						<p class="p3_text">С нашим сервисом Вы можете сделать публичный доступ к текущиму рейтингу конкурсантов, доступный на персональной странице Вашего мероприятия.</p><br><br>
					</div>
				</div>
				<div style="display:none;" id="slide_3">
					<div class="col-6 text-center">
						<img class="p3_img" src="assets/img/p3_3.png">
					</div>
					<div class="col-6 text-center">
						<h2>О Вас узнают!</h2>
						<p class="p3_text">С нами вы не пройдете мимо популярных социальных сетей. Гости Вашего мероприятия, а также другие пользователи ProNWE смогут рассказывать всем о мероприятиях, поделившись ими в социальных сетях.</p><br>
					</div>
				</div>
				<div style="display:none;" id="slide_4">
					<div class="col-6 text-center">
						<img class="p3_img" src="assets/img/p3_4.png">
					</div>
					<div class="col-6 text-center">
						<h2>Оффлайн поддержка мероприятия</h2>
						<p class="p3_text">Если Вам не удастся обеспечить мероприятие необходимым оборудованием (например, интернет для судей и гостей, или отсутствие гаджетов для судей), вы можете получить оффлайн поддержку, наши мастера настроят Ваше, или предоставят свое оборудование.</p><br>
					</div>
				</div>
			</div>
			<div class="selector text-center">
				<input type="radio" name="sliderSelector" id="selector_0" checked></input>
				<input type="radio" name="sliderSelector" id="selector_1"></input>
				<input type="radio" name="sliderSelector" id="selector_2"></input>
				<input type="radio" name="sliderSelector" id="selector_3"></input>
				<input type="radio" name="sliderSelector" id="selector_4"></input>
			</div>
		</div>
	
		<div class="p4 section" id="section3" data-anchor="Feedback">
			<div class="getready text-center">
				<h2 class="quote">Мы уже во всю готовимся к открытию!</h2>
				<p>Проект <a class="pronwe_Link-small pronwe_color" href="http://pronwe.ru">ProNWE</a> уже готов и находится на стадии тестирования. Уже скоро каждый организатор сможет оценить возможности данного проекта! Если у Вас появились какие-нибудь вопросы, то можете связаться с нами</p>

				<ul class="connection">
					<li>
						<a data-toggle="tooltip" data-placement="bottom" title="Почта" href="mailto:support@pronwe.ru">
							<em class="fa fa-2x fa-envelope-o"></em>
						</a>
					</li>
					<li>
						<a data-toggle="tooltip" data-placement="bottom" title="Facebook" href="//www.facebook.com/groups/ProNWE/">
							<em class="fa fa-2x fa-facebook"></em>
						</a> 
					</li>
					<li>
						<a data-toggle="tooltip" data-placement="bottom" title="Twitter" href="//twitter.com/ProNWERU">
							<em class="fa fa-2x fa-twitter"></em>
						</a>
					</li>
					<li>
						<a data-toggle="tooltip" data-placement="bottom" title="Вконтакте" href="//vk.com/pronwe">
							<em class="fa fa-2x fa-vk"></em>
						</a>
					</li>
				</ul>
			</div>
			<div class="alert animated" data-allow-outside-click="false" style="display:none">
				<div class="alert-header">
					<button type="button" class="alert-close">Закрыть</button>
					<h4 class="alert-title">Обратная связь</h4>
				</div>
				<div class="alert-body">
					<form>
						<div class="form-group">
							<label class="control-label">Ваш емайл</label>
							<input name="email" class="form-control" type="email" required="">
						</div>
						<div class="form-group">
							<label class="control-label">Ваше сообщение</label>
							<textarea name="messadge" class="form-control" name="email" required="" rows="7" style="resize: none;" required=""></textarea>
						</div>
						<div class="g-recaptcha" data-sitekey="6LdR4BgTAAAAAIuvZ3UsCQ_xpLkQFC79B8bVVs9C"></div>
						<div style="text-align: right;">
							<button class="btn-primary" type="submit">Отправить</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
