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


    <div class="header-wrapper_menu-right dropdown" data-toggle="dropdown" data-position="right">
        <? if ($isLogged) : ?>
        <a class="header-wrapper_menu_btn dropdown_btn">
            <?=$user->name; ?>
            <i class="fa fa-caret-down header_icon" aria-hidden="true"></i>
        </a>
        <div class="dropdown_menu">
            <a href="<?= URL::site('user/'.$user->id) ?>" class="dropdown_menu_item">
                <i class="fa fa-user" aria-hidden="true"></i>
                Профиль
            </a>

            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="dropdown_menu_item">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
        <? else : ?>
        <a class="header-wrapper_menu_btn" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
        <a class="header-wrapper_menu_btn header-wrapper_menu_btn--hollow" data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
        <? endif; ?>

    </div>

    <div class="header-mobile">
        <ul class="header-mobile_menu">

            <? if ($isLogged) : ?>

            <li class="header-mobile_menu_item show-only-mobile">
                <a role="button" class="header-mobile_menu_item_btn" data-toggle="collapse" area-control="userAction">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?=$user->name; ?>
                </a>
                <ul id="userAction" class="header-mobile_menu_item_collapse-menu collapse">
                    <li class="header-mobile_menu_item_collapse-menu_item">
                        <a href="<?= URL::site('user/'.$user->id) ?>" class="header-mobile_menu_item_collapse-menu_item_btn">
                            Профиль
                        </a>
                    </li>
                    <li class="header-mobile_menu_item_collapse-menu_item">
                        <a href="<?=URL::site('sign/organizer/logout'); ?>" class="header-mobile_menu_item_collapse-menu_item_btn ">
                            Выйти
                        </a>
                    </li>
                </ul>
            </li>

            <? else : ?>

            <li class="header-mobile_menu_item show-only-mobile">
                <a class="header-mobile_menu_item_btn" data-toggle="modal" data-target="#auth_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
                    Войти
                </a>
            </li>

            <li class="header-mobile_menu_item show-only-mobile">
                <a class="header-mobile_menu_item_btn" data-toggle="modal" data-target="#registr_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
                    Регистрация
                </a>
            </li>

            <? endif; ?>

            <?=$header_menu_mobile; ?>
        </ul>
    </div>
</div>

<? if ( !$isLogged): ?>
    <?=$auth_modal; ?>
<? endif; ?>

