<ul class="nav">

    <? foreach ($contests as $contest) : ?>

        <li class="nav__item-group <?= $cur_contest_id == $contest->id ? 'nav__item-group--active' : ''; ?>">

            <a role="button" data-toggle="collapse" data-area="navContest_<?= $contest->id; ?>" data-opened="<?= $cur_contest_id == $contest->id ? 'true' : 'false'; ?>" class="nav__item collapse__btn">
                <?=$contest->name; ?>
                <i class="fa fa-angle-down collapse__icon-right nav__item-icon nav__item-icon--right" aria-hidden="true"></i>
            </a>

            <div id="navContest_<?= $contest->id; ?>" class="collapse nav__collapse">

                <? foreach ($contest->stages as $stageKey => $stage) : ?>

                    <a href="<?= URL::site('/voting?contest=' . $contest->id . '#' . Methods_Methods::getUriByTitle($stage->name)); ?>" data-area="<?= 'contest_' . $contest->id . '_' . Methods_Methods::getUriByTitle($stage->name); ?>" class="js-nav-large-stage nav__item <?= $cur_contest_id == $contest->id && $stageKey == 0 ? 'nav__item--active' : ''; ?>">
                        <?=$stage->name; ?>
                    </a>

                <? endforeach; ?>

            </div>

        </li>

    <? endforeach; ?>

</ul>