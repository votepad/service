<div class="header__wrapper">

<!--    <div class="header__scroll-bar fl_l">-->
<!---->
<!--        <div class="header__scroll-letter fl_l">-->
<!--            <span id="letter" class="header__scroll-letter-text header_text">A</span>-->
<!--        </div>-->
<!---->
<!--        <div id="slider" class="header__scroll-slider fl_l">-->
<!--            <span id="band" class="header__scroll-band"> </span>-->
<!--            <span id="circle" class="header__scroll-circle"> </span>-->
<!--        </div>-->
<!---->
<!--    </div>-->

    <div class="header__menu fl_r dropdown" data-toggle="dropdown">
        <a class="header__button header__button--hover dropdown__btn fl_r"  style="max-width:100%;">
            <span class="user-name--hidden-xs-">
                <span id="judgeStatus" class="status status--online"></span>

                <?= $judge->name; ?>
                <i class="fa fa-caret-down" aria-hidden="true"></i>

            </span>
<!--            <span class="user-name--shown-xs">-->
<!--                <i class="fa fa-user" aria-hidden="true"></i>-->
<!--            </span>-->
        </a>
        <div class="dropdown__menu dropdown__menu--right">
            <a onclick="alert('TODO: reconnect to server')" class="dropdown__link">
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

<script type="text/javascript" src="<?=$assets; ?>static/js/judgepanel/judgeStatus.js"></script>
<script type="text/javascript">
    judgeStatus.init('judgeStatus');
</script>