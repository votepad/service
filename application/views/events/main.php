<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>

        <!-- =============== VENDOR STYLES ===============-->
        <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css">
        <link rel="stylesheet" href="<?=$assets; ?>css/event.css">
        <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css">


        <!-- =============== VENDOR SCRIPTS ===============-->
        <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
        <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
    </head>
<body>
<header class="header">
    <div class="header_wrapper">

        <div class="header_menu-btn-icon left">
            <button id="open_header_menu" class="header_button">
                <i class="fa fa-bars header_icon" aria-hidden="true"></i>
            </button>
        </div>

        <div class="header_text header_text-logo">Votepad</div>

        <div class="header_menu">
            <?=$top; ?>
        </div>

        <div class="header_menu-dropdown dropdown">
            <a id="open_usermenu" class="header_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="header_text">Nikolay</span>
                <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu pull-right" aria-labelledby="open_usermenu">
                <a href="#" class="header_button dropdown-button">
                    <i class="fa fa-cubes nav_icon dropdown-icon header_icon" aria-hidden="true"></i>
                    <span class="dropdown-text">Мои мероприятия</span>
                </a>
                <a href="#" class="header_button dropdown-button">
                    <i class="fa fa-user dropdown-icon header_icon" aria-hidden="true"></i>
                    <span class="dropdown-text">Профиль</span>
                </a>
                <div role="separator" class="divider"></div>
                <a href="#" class="header_button dropdown-button">
                    <i class="fa fa-sign-out dropdown-icon header_icon" aria-hidden="true"></i>
                    <span class="dropdown-text">Выйти</span>
                </a>
            </div>
        </div>

        <div class="header_menu-btn-icon right">
            <button id="open_jumbotron_nav" class="header_button">
                <i class="fa fa-ellipsis-v header_icon" aria-hidden="true"></i>
            </button>
        </div>

    </div>
</header>

<div class="jumbotron block">
    <div class="jumbotron_wrapper parallax-container">
        <div class="parallax">
            <img id="" src="/uploads/organizations/o_7bbd328ec4d3858a4024e66e6714da8d.jpg">
        </div>
        <div class="jumbotron_wrapper-background"></div>
        <div class="jumbotron_wrapper_edit">
            <a id="" href="#" role="button" class="jumbotron_wrapper_edit-btn">
                <i class="fa fa-camera jumbotron_wrapper_edit-icon" aria-hidden="true"></i>
                <span class="jumbotron_wrapper_edit-text">Обновить фото обложки</span>
            </a>
        </div>
        <div class="jumbotron_wrapper_text valign">
            <div class="center">
                <span class="jumbotron_wrapper_text-eventname">
                    Лига КВН POINT
                </span>
                <a href class="jumbotron_wrapper_text-orgname">
                    Университет ИТМО
                </a>
            </div>
        </div>
    </div>
    <div class="jumbotron_nav">
        <?=$jumbotron_navigation; ?>
    </div>
</div>

<section>
    <?=$main_section; ?>
</section>

<footer class="footer">
    <div class="footer_wrapper">
        <div class="footer_block clearfix">
            <div class="nav-addition pull-right">
                <a href="#" class="footer_btn footer_btn-light">О проекте</a>
                <a href="#" class="footer_btn footer_btn-light">Связь с командой</a>
                <a href="#" class="footer_btn footer_btn-light">Вопросы</a>
            </div>
            <div class="logo">
                <span class="logo-icon icon-leadership"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                <span class="logo-name">Votepad</span>
                <span class="logo-text">Автоматизированный подсчёт</span>
                <span class="logo-text">результатов голосования</span>
            </div>
            <div class="nav-main">
                <a href="#" class="footer_btn">Мероприятия</a>
                <a href="#" class="footer_btn">Организации</a>
            </div>
        </div>
        <div role="separator" class="divider"></div>
        <div class="footer_block">
            <div class="footer_icons">
                <a href="#" class="vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="#" class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <span>— подписывайтесь!</span>
            </div>
            <span class="copyright pull-right">© 2016-2017  "Votepad.RU"</span>
            <a href="mailto:team@votepad.ru" class="email footer_btn footer_btn-light pull-right">team@votepad.ru</a>
        </div>
    </div>
</footer>


  </body>
</html>
