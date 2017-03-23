<div class="header-wrapper">

    <div class="header-menu_icon">
        <button id="openMobileMenu" class="header-wrapper_btn">
            <i></i><i></i><i></i>
        </button>
    </div>

    <? if ($isLogged) : ?>
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header-brand">Votepad</a>
    <? else : ?>
        <a href="<?=URL::site('/'); ?>" class="header-brand">Votepad</a>
    <? endif; ?>

    <div class="header-menu">
        <?=$header_menu; ?>
    </div>


    <div class="header-menu-right dropdown-block" data-toggle="dropdown">
        <? if ($isLogged) : ?>
        <a class="header-menu_btn dropdown-btn">
            <?=$user->name; ?>
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu--right">
            <a href="<?= URL::site('user/'.$user->id) ?>" class="dropdown-menu_link">
                <i class="fa fa-user" aria-hidden="true"></i>
                Профиль
            </a>
            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="dropdown-menu_link">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
        <? else : ?>
        <a class="header-menu_btn" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
        <a class="header-menu_btn header-menu_btn--hollow" data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
        <? endif; ?>

    </div>

    <div class="header-mobile">
        <ul class="mobile-menu">

            <? if ($isLogged) : ?>

            <li class="mobile-menu_item show-only-mobile">
                <a role="button" class="mobile-menu_item-link" data-toggle="collapse" data-area="userAction">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?=$user->name; ?>
                </a>
                <ul id="userAction" class="mobile-menu_collapse collapse">
                    <li class="mobile-menu_collapse-item">
                        <a href="<?= URL::site('user/'.$user->id) ?>" class="mobile-menu_collapse-link">
                            Профиль
                        </a>
                    </li>
                    <li class="mobile-menu_collapse-item">
                        <a href="<?=URL::site('sign/organizer/logout'); ?>" class="mobile-menu_collapse-link ">
                            Выйти
                        </a>
                    </li>
                </ul>
            </li>

            <? else : ?>

            <li class="mobile-menu_item show-only-mobile">
                <a class="mobile-menu_item-link" data-toggle="modal" data-target="#auth_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
                    Войти
                </a>
            </li>

            <li class="mobile-menu_item show-only-mobile">
                <a class="mobile-menu_item-link" data-toggle="modal" data-target="#registr_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
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

