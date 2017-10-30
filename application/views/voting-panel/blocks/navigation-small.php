<div class="entry__wrapper hidden-md hidden-lg">

    <div class="block mb-0 bb-0 ui-tabs">
        <div class="ui-tabs__wrapper">
            <? foreach ($contests as $contest) : ?>
                <a role="button" data-toggle="tabs" data-area="navSmallContest_<?= $contest->id; ?>" class="ui-tabs__tab <?= $cur_contest_id == $contest->id ? 'ui-tabs__tab--active' : ''; ?>">
                    <?=$contest->name; ?>
                </a>
            <? endforeach; ?>
        </div>
    </div>

    <div class="block mb-0 bb-0 ui-tabs">

        <? foreach ($contests as $contest) : ?>

            <div id="navSmallContest_<?= $contest->id; ?>" class="ui-tabs__wrapper <?= $cur_contest_id == $contest->id ? '' : 'hide'; ?>">

                <? foreach ($contest->stages as $stageKey => $stage) : ?>

                    <a href="<?= URL::site('/voting?contest=' . $contest->id . '#' . Methods_Methods::getUriByTitle($stage->name)); ?>" data-area="<?= 'contest_' . $contest->id . '_' . Methods_Methods::getUriByTitle($stage->name); ?>" class="js-nav-small-stage ui-tabs__tab <?= $cur_contest_id == $contest->id && $stageKey == 0 ? 'ui-tabs__tab--active' : ''; ?>">
                        <?=$stage->name; ?>
                    </a>

                <? endforeach; ?>

            </div>

        <? endforeach; ?>

    </div>

</div>
