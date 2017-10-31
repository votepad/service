<div class="header__wrapper">

    <button role="button" class="header__open-btn" onclick="eventLanding.toggleMenu(this)">
        <i></i><i></i><i></i>
    </button>

    <div id="headerMenu" class="header__menu">

        <a href="<?=URL::site('event/' . $event->id); ?>" class="header__button">
            Главная
        </a>
        <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="header__button">
            Результаты
        </a>

    </div>

    <div class="header__menu header__menu--right">

        <? if ($isLogged) : ?>
            <a href="<?=URL::site('/user/' . $user->id); ?>" class="header__button fl_r">
                <i class="fa fa-user mr-5" aria-hidden="true"></i>
                <?=$user->name; ?>
            </a>
        <? else: ?>
            <a class="header__button header__button--hollow fl_r" data-toggle="modal" data-area="auth_modal">
                Войти
            </a>
            <a class="header__button fl_r" data-toggle="modal" data-area="registr_modal">
                Регистрация
            </a>
        <? endif; ?>

    </div>

</div>