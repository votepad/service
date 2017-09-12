<div class="header__wrapper">

    <div class="header__menu-icon">
        <button id="openMobileMenu" class="header__button">
            <i></i><i></i><i></i>
        </button>
    </div>

    <a href="<?=URL::site('/'); ?>" class="header__brand">Votepad</a>

    <div class="header__menu fl_l">

        <a href="/#events" class="header__button header__button--hover header__button--hollow toEvents" tabindex="2">
            Мероприятия
        </a>

    </div>

    <div class="header__menu dropdown fl_r" data-toggle="dropdown">
        <? if ($isLogged) : ?>
            <a class="header__button dropdown__btn fl_r">
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
            <a class="header__button" data-toggle="modal" data-area="registr_modal">
                Регистрация
            </a>
            <a class="header__button header__button--hollow" data-toggle="modal" data-area="auth_modal">
                Войти
            </a>
        <? endif; ?>
    </div>

    <div class="aside">
        <ul class="aside__menu">

            <? if ($isLogged) : ?>

                <li class="aside__item aside--show">
                    <a role="button" class="aside__link" data-toggle="collapse" data-area="userAction" data-opened="false">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <?=$user->name; ?>
                    </a>
                    <ul id="userAction" class="aside__collapse collapse">
                        <li class="aside__collapse-item">
                            <a href="<?= URL::site('user/'.$user->id) ?>" class="aside__collapse-link">
                                Профиль
                            </a>
                        </li>
                        <li class="aside__collapse-item">
                            <a href="<?=URL::site('sign/organizer/logout'); ?>" class="aside__collapse-link">
                                Выйти
                            </a>
                        </li>
                    </ul>
                </li>

            <? else : ?>

                <li class="aside__item aside--show">
                    <a class="header__button header__button--hollow" data-toggle="modal" data-area="auth_modal">
                        Войти
                    </a>
                </li>

                <li class="aside__item aside--show">
                    <a class="header__button" data-toggle="modal" data-area="registr_modal">
                        Регистрация
                    </a>
                </li>

            <? endif; ?>


            <li class="aside__item">
                <a href="#events" class="aside__link toEvents">
                    Мероприятия
                </a>
            </li>
        </ul>
    </div>
</div>