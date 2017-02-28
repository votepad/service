<header class="header">
    <div class="header_wrapper">
        <div class="header_menu-btn-icon left">
            <button id="open_header_menu" class="header_button">
                <i class="fa fa-bars header_icon" aria-hidden="true"></i>
            </button>
        </div>


        <!-- Votepad Brand + link to Welcome Votepad Page -->
        <a href="<?=URL::site('/'); ?>" class="header_text header_text-logo">Votepad</a>


        <!-- Header Menu -->
        <div class="header_menu">

            <a class="header_button" href="<?=URL::site('/'); ?>">
                <span class="header_text">Создать мероприятие</span>
            </a>

            <a class="header_button" href="<?=URL::site(''); ?>">
                <span class="header_text">Настройки</span>
            </a>

        </div>

        <!-- Header Menu Dropdown (Enter or user Name) -->
        <div class="header_menu-dropdown dropdown">

            <a id="open_usermenu" class="header_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="header_text">UserName</span>
                <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu pull-right" aria-labelledby="open_usermenu">
                <a href="#" class="header_button dropdown-button">
                    <i class="fa fa-user dropdown-icon header_icon" aria-hidden="true"></i>
                    <span class="dropdown-text">Профиль</span>
                </a>
                <div role="separator" class="divider"></div>
                <a href="<?=URL::site(''); ?>" class="header_button dropdown-button">
                    <i class="fa fa-sign-out dropdown-icon header_icon" aria-hidden="true"></i>
                    <span class="dropdown-text">Выйти</span>
                </a>
            </div>

            <!--

            <a class="header_button header_auth" data-toggle="modal" data-target="#auth_modal">
                <span class="header_text">Войти</span>
            </a>
-->

        </div>

        <div class="header_menu-btn-icon right">
            <button id="open_jumbotron_nav" class="header_button">
                <i class="fa fa-ellipsis-v header_icon" aria-hidden="true"></i>
            </button>
        </div>

    </div>
</header>

<?=$auth_modal; ?>
