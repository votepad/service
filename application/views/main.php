<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?=$description; ?>">
    <meta name="keywords" content="<?=$keywords; ?>!">

    <title><?=$title; ?></title>

    <!-- =============== VENDOR STYLES ===============-->
    <? foreach($css as $styles): ?>
        <link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
    <? endforeach;?>

    <!-- =============== VENDOR SCRIPTS ===============-->
    <? foreach ($js as $scripts): ?>
        <script src="<?=$assets.$scripts; ?>"></script>
    <? endforeach; ?>

</head>

<body>
<div class="wrapper">
    <header class="topnavbar-wrapper">
        <nav role="navigation" class="navbar topnavbar">
            <div class="navbar-header">
                <a href="<?=URL::base(); ?>" class="navbar-brand">
                    <div class="brand-logo">
                        <img src="<?=$assets; ?>img/ProNWE_logo.svg" alt="App Logo" class="img-responsive">
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="<?=$assets; ?>img/ProNWE_logo_small.svg" alt="Logo" class="img-responsive">
                    </div>
                </a>
            </div>
            <div class="nav-wrapper">
                <!-- LEFT NAVBAR -->
                <ul class="nav navbar-nav">
                    <!-- SHOW/HIDDEN ASIDE -->
                    <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"></em>
                        </a>
                        <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                            <em class="fa fa-navicon"></em>
                        </a>
                    </li>
                    <!-- USER PROFILE -->
                    <li>
                        <a href="<?=URL::site('profile'); ?>" title="Профиль">
                            <em class="icon-user"></em>
                        </a>
                    </li>
                    <!-- FAQ -->
                    <li>
                        <a href="#" title="FAQ">
                            <em class="icon-info"></em>
                        </a>
                    </li>
                </ul>
                <!-- RIGHT NAVBAR -->
                <ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
                    <!-- SEARCH ICON -->
                    <li>
                        <a href="#" data-search-open="" title="Поиск">
                            <em class="icon-magnifier"></em>
                        </a>
                    </li>

                    <!-- NOTIFICATION -->
                    <li class="dropdown dropdown-list">
                        <a href="#" data-toggle="dropdown" aria-expanded="true" title="Уведомления">
                            <em class="icon-bell"></em>
                            <div class="label label-danger">35</div>
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li>
                                <div class="list-group">

                                    <a href="#" class="list-group-item">
                                        <div class="media-box">
                                            <div class="pull-left">
                                                <em class="fa fa-thumbs-o-up fa-2x text-danger"></em>
                                            </div>
                                            <div class="media-box-body clearfix">
                                                <p class="m0">Лайки</p>
                                                <p class="m0 text-muted">
                                                    <small>20 новых лайков</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <div class="media-box">
                                            <div class="pull-left">
                                                <em class="fa fa-comments-o fa-2x text-warning"></em>
                                            </div>
                                            <div class="media-box-body clearfix">
                                                <p class="m0">Отзывы</p>
                                                <p class="m0 text-muted">
                                                    <small>У Вам 10 непрочитанных отзывов</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#" class="list-group-item">
                                        <div class="media-box">
                                            <div class="pull-left">
                                                <em class="fa fa-user-plus fa-2x text-info"></em>
                                            </div>
                                            <div class="media-box-body clearfix">
                                                <p class="m0">Подписчики</p>
                                                <p class="m0 text-muted">
                                                    <small>5 новых подписчиков</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <!-- TWITTER -->
                    <li class="dropdown dropdown-list">
                        <a href="#" data-toggle="dropdown" title="Твиттер">
                            <em class="icon-social-twitter"></em>
                        </a>
                        <div class="dropdown-menu twitter animated bounceInDown">
                            <a class="twitter-timeline list-group-item" height="300" width="100%" data-dnt="true" href="https://twitter.com/ProNWERU" data-widget-id="700100240783896577">Твиты от @ProNWERU</a>
                        </div>
                    </li>

                    <!-- LOGOUT -->
                    <li>
                        <a href="<?=URL::site('auth/logout'); ?>" title="Выход">
                            <em class="icon-logout"></em>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SEARCH FORM -->
            <form role="search" action="search.html" class="navbar-form">
                <div class="form-group has-feedback">
                    <input type="text" placeholder="Введите и нажмите Enter" class="form-control">
                    <div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>
                </div>
                <button type="submit" class="hidden btn btn-default">Поиск</button>
            </form>
        </nav>
    </header>

    <!-- ASIDE -->
    <?=$aside; ?>
    <!-- END ASIDE -->

    <!-- MAIN SECTION -->
    <?=$section; ?>
    <!-- END SECTION -->

    <!-- FOOTER -->
    <footer>
        <span>&copy; 2016 - ProNWE</span>
    </footer>
</div>

</body>

</html>