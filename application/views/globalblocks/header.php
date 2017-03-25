<div class="header_wrapper">
    <div class="header_menu_btnicon left">
        <button id="open_header_menu" class="header_button">
            <i class="fa fa-bars header_icon" aria-hidden="true"></i>
        </button>
    </div>


    <? if ($isLogged) : ?>
        <!-- Votepad Brand + link to User Profile -->
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header_text header_text-logo">Votepad</a>
    <? else : ?>
        <!-- Votepad Brand + link to Welcome Votepad Page -->
        <a href="<?=URL::site('/'); ?>" class="header_text header_text-logo">Votepad</a>
    <? endif; ?>

    <!-- Header Menu -->
    <div class="header_menu">

        <?=$header_menu; ?>

    </div>

    <!-- Header Menu Dropdown (Enter or user Name) -->
    <? if ($isLogged) : ?>
    <div class="header_menu-right dropdown" data-toggle="dropdown" data-position="right">

        <a id="open_usermenu" class="header_button dropdown_btn">
            <span class="header_text"><?=$user->name; ?></span>
            <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
        </a>
        <div class="dropdown_menu" aria-labelledby="open_usermenu">
            <a href="<?= URL::site('user/'.$user->id) ?>" class="header_button dropdown_item">
                <i class="fa fa-user dropdown-icon header_icon" aria-hidden="true"></i>
                <span class="dropdown-text">Профиль</span>
            </a>
            <div role="separator" class="divider"></div>
            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="header_button dropdown_item">
                <i class="fa fa-sign-out dropdown-icon header_icon" aria-hidden="true"></i>
                <span class="dropdown-text">Выйти</span>
            </a>
        </div>
    </div>
    <? else : ?>
    <div class="header_menu-right">
        <a class="header_button" data-toggle="modal" data-target="#registr_modal">
            <span class="header_text">Регистрация</span>
        </a>
        <a class="header_button " data-toggle="modal" data-target="#auth_modal">
            <span class="header_text">Войти</span>
        </a>
    </div>
    <? endif; ?>




    <div class="header_menu_btnicon right">
        <button id="open_jumbotron_nav" class="header_button">
            <i class="fa fa-ellipsis-v header_icon" aria-hidden="true"></i>
        </button>
    </div>

</div>


<? if ( !$isLogged): ?>
    <?=$auth_modal; ?>
<? endif; ?>
