<div class="header__wrapper">

    <div class="header__menu">

        <? if ($isLogged) : ?>
            <a href="<?=URL::site('/user/' . $user->id); ?>" class="header__brand-name">
                Votepad
            </a>
        <? else : ?>
            <a href="<?=URL::site('/'); ?>" class="header__brand-name">Votepad</a>
        <? endif; ?>

    </div>

    <div class="header__menu header__menu--right">

        <? if ($isLogged) : ?>
            <a class="header__button fl_r">
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