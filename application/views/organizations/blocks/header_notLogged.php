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

            <a class="header_button" href="<?=URL::site('organization/new'); ?>">
                <span class="header_text">Создать организацию</span>
            </a>

        </div>

        <!-- Header Menu Dropdown (Enter or user Name) -->
        <div class="header_menu-dropdown dropdown">

            <a class="header_button header_auth" data-toggle="modal" data-target="#auth_modal">
                <span class="header_text">Войти</span>
            </a>

        </div>

    </div>
</header>

<?=$auth_modal; ?>
