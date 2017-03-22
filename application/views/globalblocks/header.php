<link rel="stylesheet" href="<?=$assets; ?>modules/css/header.css?"> <!--v=<?= filemtime("assets/modules/css/header.css") ?>-->

<div class="header-wrapper">

    <div class="header-wrapper_menu-icon">
        <button id="openMobileMenu" class="header-wrapper_btn">
            <i></i><i></i><i></i>
        </button>
    </div>

    <? if ($isLogged) : ?>
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header-wrapper_brand">Votepad</a>
    <? else : ?>
        <a href="<?=URL::site('/'); ?>" class="header-wrapper_brand">Votepad</a>
    <? endif; ?>

    <div class="header-wrapper_menu">
        <?=$header_menu; ?>
    </div>


    <div class="header-wrapper_menu-right">
    <? if ($isLogged) : ?>

        <a class="header-wrapper_menu_btn" data-toggle="dropdown" data-position="right">
            <?=$user->name; ?>
            <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
        </a>

        <div class="dropdown-menu">
            <a href="<?= URL::site('user/'.$user->id) ?>" class="header_button dropdown-button">
                <i class="fa fa-user dropdown-icon header_icon" aria-hidden="true"></i>
                <span class="dropdown-text">Профиль</span>
            </a>
            <div role="separator" class="divider"></div>
            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="header_button dropdown-button">
                <i class="fa fa-sign-out dropdown-icon header_icon" aria-hidden="true"></i>
                <span class="dropdown-text">Выйти</span>
            </a>
        </div>

    <? else : ?>
        <a class="header-wrapper_menu_btn" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
        <a class="header-wrapper_menu_btn " data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
    <? endif; ?>

    </div>

</div>


<div class="header-mobile">
    <div class="header-mobile_menu">

    </div>
</div>

<!--    </ul>


<div id="HeaderMobile" class="header-mobile">
    <ul class="header-menu-mobile header-menu-mobile-home clear_fix">
        <!--<li class="header-list">
            <a href="/features" class="btn btn_hollow">
                Возможности
            </a>
        </li>--
        <li class="header-list">
            <a class="btn btn_hollow askquestion">
                Связь с командой
            </a>
        </li>
        <li class="header-list">
            <a href="/#events" class="btn btn_hollow" onclick="$('.mobile-close').click();$('.toEvents').click();">
                Мероприятия
            </a>
        </li>
    </ul>
    <div class="header-btn-mobile">
        <a class="btn btn_hollow" data-toggle="modal" data-target="#auth_modal">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
            Вход
        </a>
    </div>

    <div class="header-btn-mobile">
        <a class="btn btn_primary" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
    </div>

</div>
-->

<script type="text/javascript" src="<?=$assets; ?>modules/js/header.js"></script>
<? if ( !$isLogged): ?>
    <?=$auth_modal; ?>
<? endif; ?>

