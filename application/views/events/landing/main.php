<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title>?=$title ?> | Votepad</title>

    <meta name="description" content="?=$description; ?>" />
    <meta name="keywords" content="?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/event-landing.css?v=<?= filemtime("assets/static/css/event-landing.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/landing.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/footer.css?v=<?= filemtime("assets/frontend/modules/css/footer.css") ?>">
    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js?v=<?= filemtime("assets/frontend/bundles/votepad.bundle.js") ?>"></script>

</head>

<body>

<header class="header-landing clear_fix">

    <div class="container">
        <div class="header-landing__menu-icon fl_l">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="header-landing__menu animated fl_l">
            <a href="" class="header-landing__link">
                Главная
            </a>
            <!--<a role="button" class="header-landing__link toDescription">
                О мероприятие
            </a>
            <a href="" class="header-landing__link">
                Новости
            </a>-->
            <a role="button" class="header-landing__link toResults">
                Результаты
            </a>
        </div>

        <? if ( !$isLogged ): ?>
        <a role="button" class="header-landing__link fl_r" data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
        <? else: ?>
        <a href="<?=URL::site('user/' . $user->id); ?>" class="header-landing__link fl_r">
            Профиль
        </a>
        <? endif; ?>

    </div>

</header>


<section>

    <div class="section__wrapper">

        <div class="jumbotron-landing valign">
            <div class="container" style="z-index: 2">
                <a href="" class="jumbotron-landing__title">Event name</a>
            </div>
            <div class="jumbotron-filter"></div>

            <div class="parallax">
                <img id="" src="<?=$assets; ?>static/img/welcome/bg1.jpg">
            </div>

        </div>


        <div class="event-info clear_fix">
            <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">

                <i class="fa fa-clock-o event-info__icon text-brand" aria-hidden="true"></i>
                <span id="time-counter" class="event-info__h1">Xthtp 5 lytq </span>
                <span class="event-info__h2">17 декабря 19:00-21:00</span>
            </div>
            <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">
                <i class="fa fa-map-marker event-info__icon text-brand" aria-hidden="true"></i>
                <span class="event-info__h1">Санкт-Петербург</span>
                <span class="event-info__h2">ул. Ломоносова, 9</span>
            </div>
            <div class="col-xs-12 col-md-4 event-info__block">
                <i class="fa fa-flag event-info__icon text-brand" aria-hidden="true"></i>
                <a href="" class="event-info__h1">Университет ИТМО</a>
                <span class="event-info__h2"></span>
            </div>
        </div>



        <!--<section id="eventDescription" class="container">

        </section>-->


        <section id="eventResult" class="container">
            <h1 class="text-brand m-t-50">Результаты мероприятия</h1>
        </section>

    </div>

</section>

<footer class="footer">
    <div class="container">
        <div class="p-t-30 m-b-20 clear_fix">
            <div class="footer__nav fl_r">
                <div class="footer__social">
                    <a href="//vk.com/votepad" class="footer__social-link vk"><i class="footer__social-icon fa fa-vk" aria-hidden="true"></i></a>
                    <a href="//twitter.com/votepadevent" class="footer__social-link tw"><i class="footer__social-icon fa fa-twitter" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer__logo fl_l">
                <span class="footer__brand-icon icon-leadership">
                    <span class="footer__text path1 fl_l"></span>
                    <span class="path2 fl_l"></span>
                    <span class="path3 fl_l"></span>
                    <span class="path4 fl_l"></span>
                    <span class="footer__text path5 fl_l"></span>
                </span>

                <span class="footer__text footer__brand">Votepad</span>
                <span class="footer__text displayblock">Автоматизированный подсчёт</span>
                <span class="footer__text displayblock">результатов голосования</span>
            </div>
        </div>
    </div>
</footer>


<? if ( !$isLogged ): ?>
    <?= View::factory('globalblocks/auth_modal'); ?>
<? endif; ?>



        <!--<div class="row event-rating" style="margin-top: 0;">
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

            <!--  People rating
            <div id="reset" class="reset" style="display: none;">
                reset
            </div>
            <ul class="rating-list" id="rating_list_people" style="display:block; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_total" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_1" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_2" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_3" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_4" style="display:none; position: relative;"></ul>
            <ul class="rating-list" id="rating_list_contest_5" style="display:none; position: relative;"></ul>


        </div>
        -->

<body>
</html>
