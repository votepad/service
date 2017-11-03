<div class="header__wrapper">

    <div class="header__menu">
        <a href="<?= URL::site('voting'); ?>" class="header__brand-name">Votepad</a>
    </div>

    <div class="header__menu header__menu--right">
        <a class="header__button dropdown__btn fl_r" onclick="wsvoting.reconnect()" >
            <span id="judgeStatus" class="status status--online"></span>
            <?= $judge->name; ?>
        </a>
    </div>

</div>