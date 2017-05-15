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
            <a href="<?=URL::site('sign/judge/logout'); ?>" class="dropdown__link">
                <i class="fa fa-sign-out dropdown__icon" aria-hidden="true"></i>
                Выйти
            </a>
        </div>
    </div>

    <!--
        TODO: вывод конкурсов и этапов + выделить текуший + показать те, который запрещены
        классы:
        mobile-aside__menu-item--current
        mobile-aside__menu-item--opened
        mobile-aside__menu-item--closed

        mobile-aside__collapse-item--opened
        mobile-aside__collapse-item--closed
        mobile-aside__collapse-link--disabled

    -->
    <div class="mobile-aside">

        <ul class="mobile-aside__menu">

            <? foreach ($contests as $contestKey => $contest) : ?>

                <li class="mobile-aside__menu-item mobile-aside__menu-item--current">

                    <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="asideContest_<?=$contestKey; ?>" data-opened="false">
                        <?=$contest->name; ?>
                        <i class="fa fa-angle-down fl_r" aria-hidden="true"></i>
                    </a>

                    <ul id="asideContest_<?=$contestKey; ?>" class="mobile-aside__collapse collapse">

                        <? foreach ($contest->stages as $stageKey => $stage) : ?>

                            <li class="mobile-aside__collapse-item">
                                <a href="<?=URL::site('/voting/?contest=' . $contest->id . '#' . Methods_Methods::getUriByTitle($stage->name)); ?>" class="mobile-aside__collapse-link">
                                    <?=$stage->name; ?>
                                </a>
                            </li>

                        <? endforeach; ?>

                    </ul>

                </li>

            <? endforeach; ?>

        </ul>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/judgeStatus.js"></script>

<script type="text/javascript">
    judgeStatus.init('judgeStatus');
</script>
