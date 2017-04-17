<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title><?=$event->name; ?> | Votepad</title>

    <meta name="description" content="<?=$event->description; ?>" />
    <meta name="keywords" content="<? $arr = array('"','[',']'); echo str_replace($arr, '', $event->tags); ?>,votepad" />
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

    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/plugins/moment-timer.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/locale/ru.js"></script>

    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/landing.js"></script>


    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js?v=<?= filemtime("assets/frontend/bundles/votepad.bundle.js") ?>"></script>

</head>

<body>

<header class="header-landing clear_fix">

    <div class="container">
        <div class="header-landing__menu-icon fl_l">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="header-landing__menu animated fl_l">
            <a href="<?=URL::site('event/' . $event->id); ?>" class="header-landing__link">
                Главная
            </a>
            <!--<a role="button" class="header-landing__link toDescription">
                О мероприятие
            </a>
            <a href="" class="header-landing__link">
                Новости
            </a>-->
            <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="header-landing__link">
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

    <?=$mainSection; ?>

</section>

<footer class="footer">
    <div class="container">
        <div class="p-t-30 m-b-20 clear_fix">
            <div class="footer__block fl_l">
                <span class="footer__brand-icon icon-leadership">
                    <span class="footer__text path1 fl_l"></span>
                    <span class="path2 fl_l"></span>
                    <span class="path3 fl_l"></span>
                    <span class="path4 fl_l"></span>
                    <span class="footer__text path5 fl_l"></span>
                </span>

                <a href="<?=URL::base(); ?>" class="footer__text footer__brand">Votepad</a>
                <span class="footer__text displayblock">Автоматизированный подсчёт</span>
                <span class="footer__text displayblock">результатов голосования</span>
            </div>
            <div class="footer__block fl_r">
                <div class="footer__social">
                    <a href="//vk.com/votepad" class="footer__social-link vk"><i class="footer__social-icon fa fa-vk" aria-hidden="true"></i></a>
                    <a href="//twitter.com/votepadevent" class="footer__social-link tw"><i class="footer__social-icon fa fa-twitter" aria-hidden="true"></i></a>
                    <br><a href="mailto:team@votepad.ru" class="footer__email footer__text footer__link">votepad@ya.ru</a>
                </div>
            </div>
        </div>
    </div>
</footer>


<? if ( !$isLogged ): ?>
    <?= View::factory('globalblocks/auth_modal'); ?>
<? endif; ?>

<body>

</html>
