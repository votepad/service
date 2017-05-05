<div class="header__wrapper">

    <div class="header__menu-icon">
        <button id="openMobileMenu" class="header__button">
            <i></i><i></i><i></i>
        </button>
    </div>

    <a href="<?=URL::site('voting'); ?>" class="header__brand">Votepad</a>

    <div class="header__menu fl_r dropdown" data-toggle="dropdown">
        <a class="header__button header__button--hover dropdown__btn fl_r">
            <span id="judgeStatus" class="status status--online"></span>
            <?= $judge->name; ?>
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </a>
        <div class="dropdown__menu dropdown__menu--right">
            <a onclick="scores.reconnect()" class="dropdown__link">
                <i class="fa fa-refresh dropdown__icon" aria-hidden="true"></i>
                Обновить страницу
            </a>
            <a href="<?=URL::site(''); ?>" class="dropdown__link">
                <i class="fa fa-sign-out dropdown__icon" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/judgeStatus.js"></script>
<script type="text/javascript">
    judgeStatus.init('judgeStatus');
</script>