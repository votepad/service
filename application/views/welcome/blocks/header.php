<div class="header__wrapper container">

    <div class="header__menu">

        <a href="<?=URL::site('/'); ?>" class="header__brand-name">
            Votepad
        </a>

        <a role="button" class="header__button header__button--hollow toEvents hidden-xs" tabindex="2" onclick="welcome.scrollToEvents()">
            Мероприятия
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