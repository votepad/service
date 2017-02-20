<!--<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Авторизация | Votepad.ru</title>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />

    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <meta name="description" content="Страница авторизации для зарегистрированных пользователей" />
    <meta name="keywords" content="вход,регистрация,авторизация" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============--
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/welcome.css">

    <!-- =============== VENDOR SCRIPTS ===============--
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/welcome.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/auth.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>

</head>

<body>
	<header class="header header-default">
	    <div class="header-wrapper clear_fix">
	        <div class="header_menu-btn-icon left">
	            <button id="OpenMobileHeader" class="header_button">
	                <i></i><i></i><i></i>
	            </button>
	        </div>
	        <a href="/" class="header_text header_text-logo">VotePad</a>
	        <ul class="header-menu">
	            <li class="header-list">
	                <a href="/" class="btn btn_hollow">
	                    Главная
	                </a>
	            </li>
	            <li class="header-list">
	                <a id="events" href="/#events" class="btn btn_hollow">
	                    Мероприятия
	                </a>
	            </li>
	        </ul>
	    </div>
	</header>
	<div id="HeaderMobile" class="header-mobile">
	    <ul class="header-menu-mobile header-menu-mobile clear_fix">
	        <li class="header-list">
	            <a href="/" class="btn btn_hollow">
	                Главная
	            </a>
	        </li>
	        <li class="header-list">
	            <a href="/#events" class="btn btn_hollow">
	                Мероприятия
	            </a>
	        </li>
	    </ul>
	    <div class="header-btn-mobile">
	        <a href="#" class="btn btn_primary publish">Опубликовать мероприятие</a>
	    </div>
	</div>

	<section class="valign" style="min-height:354px">
		<form id="signinForm" action="<?=URL::site('auth/signin'); ?>" method="POST" class="form" style="width:350px; margin: auto">
			<div class="form_body">
				<div class="row">
					<div class="input-field label-with-icon col-xs-12">
						<input id="email" type="email" name="email" placeholder="Email" required>
						<label for="email" class="icon-label">
							<i class="fa fa-user" aria-hidden="true"></i>
						</label>
					</div>
					<div class="input-field label-with-icon col-xs-12">
						<input id="password" type="password" name="password" placeholder="Пароль" required>
						<label for="password" class="icon-label">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</label>
					</div>
					<button type="submit" id="sigin-button" class="btn btn_primary col-xs-12">Войти</button>
				</div>
			</div>
		</form>
	</section>

	<footer class="footer" style="margin-top:0">
         <div class="footer_wrapper">
             <div class="footer_block clearfix">
                 <div class="nav-addition pull-right">
                     <!--<a href="/features" class="footer_btn footer_btn-light">О продукте</a>--
                     <a class="footer_btn footer_btn-light askquestion">Связь с командой</a>
                     <!--<a href="#" class="footer_btn footer_btn-light">Вопросы</a>--
                 </div>
                <div class="logo">
                    <span class="logo-icon icon-leadership"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    <a href="/" class="logo-name">Votepad</a>
                    <span class="logo-text">Автоматизированный подсчёт</span>
                    <span class="logo-text">результатов голосования</span>
                </div>
                <div class="nav-main">
                    <a href="/#events" class="footer_btn toEvents">Мероприятия</a>
                    <!--<a href="#" class="footer_btn">Организации</a>--
                </div>
            </div>
            <div role="separator" class="divider"></div>
            <div class="footer_block">
                <div class="footer_icons">
                    <a href="//vk.com/votepad" class="vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                    <!--<a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>--
                    <a href="//twitter.com/votepadevent" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <span>— подписывайтесь!</span>
                </div>
                <span class="copyright pull-right">© 2016-2017 votepad.ru</span>
                <!--<a href="mailto:team@votepad.ru" class="email footer_btn footer_btn-light pull-right">team@votepad.ru</a>--
            </div>
        </div>
    </footer>
</body>

</html>
-->
Удалить страницу! <br>
Рефакторинг контролера <br>
Подкорректировать, чтобы выбрасывал не на эту страницу, а оставлял на той же, в случае не успешной авторизации, причём выводил notify.
