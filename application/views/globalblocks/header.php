<div class="header__wrapper">

    <? if ($isLogged) : ?>
        <a href="<?=URL::site('/user/' . $user->id); ?>" class="header__brand">Votepad</a>
    <? else : ?>
        <a href="<?=URL::site('/'); ?>" class="header__brand">Votepad</a>
    <? endif; ?>


    <div class="dropdown fl_r" data-toggle="dropdown">
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

</div>

