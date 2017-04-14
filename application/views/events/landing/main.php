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
                <a href="<?=URL::site('event/' . $event->id); ?>" class="jumbotron-landing__title"><?=$event->name; ?></a>
            </div>
            <div class="jumbotron-filter"></div>

            <div class="parallax">
                <img id="" src="/uploads/events/branding/<?=$event->branding; ?>">
            </div>

        </div>


        <div class="event-info clear_fix">
            <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">

                <i class="fa fa-clock-o event-info__icon text-brand" aria-hidden="true"></i>
                <input id="eventStartTime" type="hidden" value="<?=$event->dt_start; ?>">
                <input id="eventEndTime" type="hidden" value="<?=$event->dt_end; ?>">
                <span id="eventTimeCounter" class="event-info__h1"></span>
                <span id="eventTime" class="event-info__h2"></span>
            </div>
            <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">
                <i class="fa fa-map-marker event-info__icon text-brand" aria-hidden="true"></i>
                <span class="event-info__h1"><?=$event->address; ?></span>
            </div>
            <div class="col-xs-12 col-md-4 event-info__block">
                <i class="fa fa-flag event-info__icon text-brand" aria-hidden="true"></i>
                <a href="<?=URL::site('organization/' . $organization->id); ?>" class="event-info__h1"><?=$organization->name; ?></a>
                <span class="event-info__h2"></span>
            </div>
        </div>



        <!--<section id="eventDescription" class="container">

        </section>-->


        <section id="eventResult" class="container">
            <h1 class="text-brand text-center m-t-50 m-b-50">Результаты мероприятия</h1>

            <div class="result">
                <ul class="contest-header">
                    <li class="contest-header__item active" data-toggle="tabs" data-block="contest_1">Contest 1</li>
                    <li class="contest-header__item" data-toggle="tabs" data-block="contest_2">Contest 2</li>
                </ul>
                <div id="contest_1" class="contest-body">

                    <ul class="stage-header">
                        <li class="stage-header__item active" data-toggle="tabs" data-block="stage_1">Stage 1</li>
                        <li class="stage-header__item" data-toggle="tabs" data-block="stage_2">Stage 2</li>
                        <li class="stage-header__item" data-toggle="tabs" data-block="stage_3">Stage 3</li>
                    </ul>

                    <ul id="stage_1" class="stage-body">

                        <li class="member col-xs-12 col-md-4 col-lg-3">
                            <div class="member__area">
                                <span class="member__name">name</span>
                                <div class="member__logo">
                                    <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                    <div class="member__position">2</div>
                                </div>
                                <div class="member__rating-area">
                                    <div data-pk="2" class="member__rating-bar" style="width:50%">
                                        <span class="member__bar">10/20</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="member col-xs-12 col-md-4 col-lg-3">
                            <div class="member__area">
                                <span class="member__name">name</span>
                                <div class="member__logo">
                                    <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                    <div class="member__position">2</div>
                                </div>
                                <div class="member__rating-area">
                                    <div data-pk="2" class="member__rating-bar" style="width:50%">
                                        <span class="member__bar">10/20</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="member col-xs-12 col-md-4 col-lg-3">
                            <div class="member__area">
                                <span class="member__name">name</span>
                                <div class="member__logo">
                                    <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                    <div class="member__position">2</div>
                                </div>
                                <div class="member__rating-area">
                                    <div data-pk="2" class="member__rating-bar" style="width:50%">
                                        <span class="member__bar">10/20</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="member col-xs-12 col-md-4 col-lg-3">
                            <div class="member__area">
                                <span class="member__name"> namenamenamenamenamenamename</span>
                                <div class="member__logo">
                                    <img src="/uploads/profiles/avatar/no-avatar.png" alt="" class="member__img">
                                    <div class="member__position">2</div>
                                </div>
                                <div class="member__rating-area">
                                    <div data-pk="2" class="member__rating-bar" style="width:100%">
                                        <span class="member__bar">10/20</span>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <ul id="stage_2" class="stage-body hide">
                        stage 2 - users
                    </ul>
                    <ul id="stage_3" class="stage-body hide">
                        stage 3 - users
                    </ul>
                </div>
            </div>

        </section>

    </div>

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
