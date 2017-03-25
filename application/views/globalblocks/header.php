<div class="header__wrapper">

    <div class="header__menu-icon">
        <button id="openMobileMenu" class="header__button">
            <i></i><i></i><i></i>
        </button>
    </div>

    <? if ($isLogged) : ?>
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header__brand">Votepad</a>
    <? else : ?>
        <a href="<?=URL::site('/'); ?>" class="header__brand">Votepad</a>
    <? endif; ?>

    <div class="header__menu fl_l">
        <?=$header_menu; ?>
    </div>


    <div class="header__menu fl_r dropdown" data-toggle="dropdown">
        <? if ($isLogged) : ?>
        <a class="header__button header__button--hover dropdown__btn fl_r">
            <?=$user->name; ?>
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </a>
        <div class="dropdown__menu dropdown__menu--right">
            <a href="<?= URL::site('user/'.$user->id) ?>" class="dropdown__link">
                <i class="fa fa-user dropdown__icon" aria-hidden="true"></i>
                Профиль
            </a>
            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="dropdown__link">
                <i class="fa fa-sign-out dropdown__icon" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
        <? else : ?>
        <a class="header__button header__button--hover" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
        <a class="header__button header__button--hover header__button--hollow" data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
        <? endif; ?>
    </div>
    
    <div class="mobile-aside">
        <ul class="mobile-aside__menu">

            <? if ($isLogged) : ?>

            <li class="mobile-aside__menu__item mobile-aside--show">
                <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="userAction" data-opened="false">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?=$user->name; ?>
                </a>
                <ul id="userAction" class="mobile-aside__collapse collapse">
                    <li class="mobile-aside__collapse__item">
                        <a href="<?= URL::site('user/'.$user->id) ?>" class="mobile-aside__collapse-link">
                            Профиль
                        </a>
                    </li>
                    <li class="mobile-aside__collapse__item">
                        <a href="<?=URL::site('sign/organizer/logout'); ?>" class="mobile-aside__collapse-link">
                            Выйти
                        </a>
                    </li>
                </ul>
            </li>

            <? else : ?>

            <li class="mobile-aside__menu__item mobile-aside--show">
                <a class="mobile-aside__menu-link" data-toggle="modal" data-target="#auth_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
                    Войти
                </a>
            </li>

            <li class="mobile-aside__menu__item mobile-aside--show">
                <a class="mobile-aside__menu-link" data-toggle="modal" data-target="#registr_modal" onclick="document.getElementsByClassName('modal-backdrop')[0].click()">
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

