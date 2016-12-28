<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>

        <!-- =============== VENDOR STYLES ===============-->
        <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
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

        <div class="header_text header_text-logo">VotePad</div>

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



  </body>
</html>
