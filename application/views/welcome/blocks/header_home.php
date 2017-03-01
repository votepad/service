
<?php

    $isLogged = Dispatch::isLogged();
    $hadLogged = Dispatch::hadLogged();
    $canLogin = false;

    if ($isLogged || (!$isLogged && $hadLogged))
        $canLogin = true;

?>

<header class="header header-home">
    <div class="header-wrapper clear_fix">
        <div class="header_menu-btn-icon left">
            <button id="OpenMobileHeader" class="header_button">
                <i></i><i></i><i></i>
            </button>
        </div>
        <a href="/" class="header_text header_text-logo" tabindex="1">VotePad</a>
        <ul class="header-menu">
            <!--<li class="header-list">
                <a href="/features" class="btn btn_hollow">
                    О продукте
                </a>
            </li>-->
            <li class="header-list">
                <a href="/#events" class="btn btn_hollow toEvents" tabindex="2">
                    Мероприятия
                </a>
            </li>
        </ul>
        <div class="pull-right header-list header-btn">
            <a href="#auth_modal" class="btn btn_hollow" data-toggle="modal" data-target="#auth_modal" tabindex="4">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                Вход
            </a>
        </div>
        <? if (! $canLogin) : ?>
        <div class="pull-right header-list header-btn">
            <a href="#registr_modal" class="btn_empty" data-toggle="modal" data-target="#registr_modal" tabindex="3">
                Регистрация
            </a>
        </div>
    <? endif; ?>
    </div>
</header>
<div id="HeaderMobile" class="header-mobile">
    <ul class="header-menu-mobile header-menu-mobile-home clear_fix">
        <!--<li class="header-list">
            <a href="/features" class="btn btn_hollow">
                Возможности
            </a>
        </li>-->
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
    <? if (! $canLogin) : ?>
    <div class="header-btn-mobile">
        <a class="btn btn_primary" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
    </div>
<? endif; ?>
</div>
