<div class="header__wrapper">

    <div class="header__menu">
        <a href="<?= URL::site('voting'); ?>" class="header__brand-name">Votepad</a>
    </div>

    <div class="header__menu header__menu--right dropdown" data-toggle="dropdown">

        <a class="header__button dropdown__btn fl_r">
            <span id="judgeStatus" class="status status--online"></span>
            <?= $judge->name; ?>
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </a>
        <div class="dropdown__menu dropdown__menu--right">
            <a onclick="wsvoting.reconnect()" class="dropdown__link">
                <i class="fa fa-refresh dropdown__icon" aria-hidden="true"></i>
                Обновить страницу
            </a>
            <a href="<?=URL::site('sign/judge/logout'); ?>" class="dropdown__link">
                <i class="fa fa-sign-out dropdown__icon" aria-hidden="true"></i>
                Выйти
            </a>
        </div>

    </div>

</div>