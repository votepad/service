<<<<<<< Updated upstream:application/views/profile/blocks/header.php
<div class="header_wrapper">
    <div class="header_menu-btn-icon left">
        <button id="open_header_menu" class="header_button">
            <i class="fa fa-bars header_icon" aria-hidden="true"></i>
=======
<link rel="stylesheet" href="<?=$assets; ?>static/css/header.css?"> <!--v=<?= filemtime("assets/static/css/header.css") ?>-->
<script type="text/javascript" src="<?=$assets; ?>static/js/header.js"></script>

<div class="header-wrapper">

    <div class="header-wrapper_menu-icon">
        <button id="openMobileMenu" class="header-wrapper_btn">
            <i></i><i></i><i></i>
>>>>>>> Stashed changes:application/views/globalblocks/header.php
        </button>
    </div>

    <? if ($isLogged) : ?>
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header-wrapper_brand">Votepad</a>
    <? else : ?>
        <a href="<?=URL::site('/'); ?>" class="header-wrapper_brand">Votepad</a>
    <? endif; ?>

    <!-- Header Menu -->
    <div class="header-wrapper_menu">

        <? if ($isLogged) : ?>
        <a class="header_button" href="<?=URL::site('organization/new'); ?>">
            <span class="header_text">Создать организацию</span>
        </a>
        <? endif; ?>

    </div>

    <!-- Header Menu Dropdown (Enter or user Name) -->
    <div class="header_menu-dropdown dropdown">
    <? if ($isLogged) : ?>
<<<<<<< Updated upstream:application/views/profile/blocks/header.php
=======
    <div class="header-wrapper_menu-right dropdown" data-toggle="dropdown" data-position="right">
>>>>>>> Stashed changes:application/views/globalblocks/header.php

        <a id="open_usermenu" class="header_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="header_text"><?=$user->name; ?></span>
            <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu pull-right" aria-labelledby="open_usermenu">
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

        <a class="header_button " data-toggle="modal" data-target="#auth_modal">
            <span class="header_text">Войти</span>
        </a>
<<<<<<< Updated upstream:application/views/profile/blocks/header.php

    <? endif; ?>

=======
    </div>
    <? endif; ?>


    <div class="header-wrapper_menu-mobile">

>>>>>>> Stashed changes:application/views/globalblocks/header.php
    </div>



</div>


<? if ( !$isLogged): ?>
    <?=$auth_modal; ?>
<? endif; ?>
