<div class="entry__wrapper">
    <div class="block mb-0 ui-tabs">
        <div class="ui-tabs__wrapper">
            <a role="button" data-toggle="tabs" data-area="resultParticipantsArea" class="ui-tabs__tab ui-tabs__tab--active">
                Индивидуальный результат
            </a>
            <a role="button" data-toggle="tabs" data-area="resultTeamsArea" class="ui-tabs__tab">
                Командный результат
            </a>
        </div>
    </div>
</div>

<div id="resultParticipantsArea">

    <div class="block">

        <div class="block__heading t-lh-50px p-0 bb-1 text-center">
            Финальный результат
        </div>

        <div class="block__wrapper">

            <table class="js-table-participant">
                <thead>
                    <tr>
                        <th>Участники</th>
                        <? foreach ($event->results['participants']->contests as $contest): ?>
                            <th class="text-center">
                                <?= $contest->name ?>
                            </th>
                        <? endforeach; ?>
                        <th class="text-center">Итого</th>
                    </tr>
                </thead>
                <tbody>
                <? foreach ($event->members['participants'] as $member): ?>

                    <tr>

                        <td><?= $member->name; ?></td>

                        <? foreach ($event->results['participants']->contests as $contest): ?>

                            <td class="text-center">
                                0
                            </td>

                        <? endforeach; ?>

                        <td class="text-center">
                            0
                        </td>

                    </tr>

                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

    <? foreach ($event->results['participants']->contests as $contestKey => $contest): ?>

        <div class="block">

            <div class="block__heading t-lh-50px p-0 text-center">
                <?= $contest->name; ?>
            </div>

            <div class="entry__wrapper">
                <div class="block mb-0 ui-tabs">
                    <div class="ui-tabs__wrapper">
                        <? foreach ($event->results['participants']->contests[$contestKey]->stages as $stageKey => $stage): ?>
                            <a role="button" data-toggle="tabs" data-area="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="ui-tabs__tab <?= $stageKey == 0 ? 'ui-tabs__tab--active' : ''; ?>">
                                <?= $stage->name; ?>
                            </a>
                        <? endforeach; ?>
                        <a role="button" data-toggle="tabs" data-area="resultContest<?= $contest->id; ?>StageTotal" class="ui-tabs__tab">
                            Итого
                        </a>
                    </div>
                </div>
            </div>

            <? foreach ($event->results['participants']->contests[$contestKey]->stages as $stageKey => $stage): ?>
                <div id="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="block__wrapper <?= $stageKey == 0 ? '' : 'hide'; ?>">

                    <table class="js-table-participant" data-contest="<?= $contest->id; ?>" data-stage="<?= $stage->id; ?>" data-publish="<?= $stage->publish == FALSE ? 'false' : 'true'; ?>">
                        <thead>
                            <tr>
                                <th>Участники</th>
                                <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>
                                    <th class="text-center">
                                        <?= $judge->name ?>
                                    </th>
                                <? endforeach; ?>
                                <th class="text-center">Итого</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach ($event->members['participants'] as $member): ?>

                            <tr>

                                <td><?= $member->name; ?></td>

                                <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>

                                    <td class="text-center">
                                        <?
                                            $data = array(
                                                'event'   => $event->id,
                                                'mode'    => 'participants',
                                                'member'  => $member->id,
                                                'judge'   => $judge->id,
                                                'contest' => array(
                                                    'id'      => $contest->id,
                                                    'formula' => json_decode($contest->formula),
                                                ),
                                                'stage' => array(
                                                    'id'      => $stage->id,
                                                    'formula' => json_decode($stage->formula),
                                                ),
                                                'criterions' => $stage->criterions
                                            );

                                            $criterionsScores = array();
                                            $stageScore = $event->scores[$member->id]['judges'][$judge->id][$contest->id][$stage->id];

                                            foreach ($stage->criterions as $criterion) {
                                                if (!$stageScore || empty($stageScore[$criterion->id])) {
                                                    $criterionsScores[$criterion->id] = 0;
                                                } else {
                                                    $criterionsScores[$criterion->id] = $stageScore[$criterion->id];
                                                }
                                            }

                                        ?>

                                        <!-- data-scores="{id_criteria:score, ...}" -->
                                        <a role="button" class="link" onclick="eventScores.editStageScore(this)" data-info='<?= json_encode($data); ?>' data-scores='<?= json_encode($criterionsScores)?>'>
                                            <?= empty($stageScore) ? 0 : $stageScore; ?>
                                        </a>

                                    </td>

                                <? endforeach; ?>

                                <td class="text-center">
                                    <?
                                        $stageScoreTotal = $event->scores[$member->id]['overall'][$contest->id][$stage->id];
                                        echo empty($stageScoreTotal) ? '0' : $stageScoreTotal;
                                    ?>
                                </td>

                            </tr>

                        <? endforeach; ?>
                        </tbody>
                    </table>

                </div>
            <? endforeach; ?>

            <div id="resultContest<?= $contest->id; ?>StageTotal" class="block__wrapper hide">

                <table class="js-table-participant" data-contest="<?= $contest->id; ?>" data-stage="all" data-publish="<?= $contest->publish == FALSE ? 'false' : 'true'; ?>">
                    <thead>
                        <tr>
                            <th>Участники</th>
                            <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>
                                <th class="text-center">
                                    <?= $judge->name ?>
                                </th>
                            <? endforeach; ?>
                            <th class="text-center">Итого</th>
                        </tr>
                        </thead>
                    <tbody>
                    <? foreach ($event->members['participants'] as $member): ?>

                        <tr>

                            <td><?= $member->name; ?></td>

                            <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>

                                <td class="text-center">
                                    0
                                </td>

                            <? endforeach; ?>

                            <td class="text-center">
                                0
                            </td>

                        </tr>

                    <? endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>

    <? endforeach; ?>

</div>

<div id="resultTeamsArea" class="hide">

    <div class="block">

        <div class="block__heading t-lh-50px p-0 bb-1 text-center text-bold">
            Финальный результат
        </div>

        <div class="block__wrapper">

            <table class="js-table-team">
                <thead>
                    <tr>
                        <th>Команды</th>
                        <? foreach ($event->results['teams']->contests as $contest): ?>
                            <th class="text-center">
                                <?= $contest->name ?>
                            </th>
                        <? endforeach; ?>
                        <th class="text-center">Итого</th>
                    </tr>
                </thead>
                <tbody>
                <? foreach ($event->members['teams'] as $member): ?>

                    <tr>

                        <td><?= $member->name; ?></td>

                        <? foreach ($event->results['teams']->contests as $contest): ?>

                            <td class="text-center">
                                0
                            </td>

                        <? endforeach; ?>

                        <td class="text-center">
                            0
                        </td>

                    </tr>

                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>


    <? foreach ($event->results['teams']->contests as $contestKey => $contest): ?>

        <div class="block">

            <div class="block__heading t-lh-50px p-0 bb-1 text-center">
                <?= $contest->name; ?>
            </div>

            <div class="entry__wrapper">
                <div class="block mb-0 ui-tabs">
                    <div class="ui-tabs__wrapper">
                        <? foreach ($event->results['teams']->contests[$contestKey]->stages as $stageKey => $stage): ?>
                            <a role="button" data-toggle="tabs" data-area="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="ui-tabs__tab <?= $stageKey == 0 ? 'ui-tabs__tab--active' : ''; ?>">
                                <?= $stage->name; ?>
                            </a>
                        <? endforeach; ?>
                        <a role="button" data-toggle="tabs" data-area="resultContest<?= $contest->id; ?>StageTotal" class="ui-tabs__tab">
                            Итого
                        </a>
                    </div>
                </div>
            </div>

            <? foreach ($event->results['teams']->contests[$contestKey]->stages as $stageKey => $stage): ?>
                <div id="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="block__wrapper <?= $stageKey == 0 ? '' : 'hide'; ?>">

                    <table class="js-table-team" data-contest="<?= $contest->id; ?>" data-stage="<?= $stage->id; ?>" data-publish="<?= $stage->publish == FALSE ? 'false' : 'true'; ?>">
                        <thead>
                            <tr>
                                <th>Команды</th>
                                <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>
                                    <th class="text-center">
                                        <?= $judge->name ?>
                                    </th>
                                <? endforeach; ?>
                                <th class="text-center">Итого</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach ($event->members['teams'] as $member): ?>

                            <tr>

                                <td><?= $member->name; ?></td>

                                <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>

                                    <td class="text-center">
                                        <?
                                            $data = array(
                                                'event'   => $event->id,
                                                'mode'    => 'teams',
                                                'member'  => $member->id,
                                                'judge'   => $judge->id,
                                                'contest' => array(
                                                    'id'      => $contest->id,
                                                    'formula' => json_decode($contest->formula),
                                                ),
                                                'stage' => array(
                                                    'id'      => $stage->id,
                                                    'formula' => json_decode($stage->formula),
                                                ),
                                                'criterions' => $stage->criterions
                                            );

                                            $criterionsScores = array();
                                            $stageScore = $event->scores[$member->id]['judges'][$judge->id][$contest->id][$stage->id];

                                            foreach ($stage->criterions as $criterion) {
                                                if (!$stageScore || empty($stageScore[$criterion->id])) {
                                                    $criterionsScores[$criterion->id] = 0;
                                                } else {
                                                    $criterionsScores[$criterion->id] = $stageScore[$criterion->id];
                                                }
                                            }
                                        ?>

                                        <!-- data-scores="{id_criteria:score, ...}" -->
                                        <a role="button" class="link" onclick="eventScores.editStageScore(this)" data-info='<?= json_encode($data); ?>' data-scores='<?= json_encode($criterionsScores)?>'>
                                            <?= empty($stageScore) ? 0 : $stageScore; ?>
                                        </a>
                                    </td>

                                <? endforeach; ?>

                                <td class="text-center">
                                    <?
                                        $stageScoreTotal = $event->scores[$member->id]['overall'][$contest->id][$stage->id];
                                        echo empty($stageScoreTotal) ? '0' : $stageScoreTotal;
                                    ?>
                                </td>

                            </tr>

                        <? endforeach; ?>
                        </tbody>
                    </table>

                </div>
            <? endforeach; ?>

            <div id="resultContest<?= $contest->id; ?>StageTotal" class="block__wrapper hide">

                <table class="js-table-team" data-contest="<?= $contest->id; ?>" data-stage="all" data-publish="<?= $contest->publish == FALSE ? 'false' : 'true'; ?>">
                    <thead>
                        <tr>
                            <th>Команды</th>
                            <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>
                                <th class="text-center">
                                    <?= $judge->name ?>
                                </th>
                            <? endforeach; ?>
                            <th class="text-center">Итого</th>
                        </tr>
                    </thead>
                    <tbody>
                    <? foreach ($event->members['teams'] as $member): ?>

                        <tr>

                            <td><?= $member->name; ?></td>

                            <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>

                                <td class="text-center">
                                    0
                                </td>

                            <? endforeach; ?>

                            <td class="text-center">
                                0
                            </td>

                        </tr>

                    <? endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>

    <? endforeach; ?>

</div>

<!--<div class="modal" id="editScoresForm" tabindex="-1" role="dialog">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <i class="fa fa-close" aria-hidden="true"></i>-->
<!--                </button>-->
<!--                <h4 class="modal-title" id="myModalLabel">Оценки по критериям</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <table id="editScoresTable" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">-->
<!--                    <thead>-->
<!--                        <tr>-->
<!--                            <th class="text-center no-sort">Критерии</th>-->
<!--                            <th class="text-center no-sort">Балл</th>-->
<!--                            <th class="text-center no-sort"></th>-->
<!--                        </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td class="text-center"></td>-->
<!--                            <td class="text-center"></td>-->
<!--                        </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<input type="hidden" id="eventID" value="<?=$event->id;?>">

<!-- =============== PAGE SCRIPTS ===============-->
<!--<script src="--><?//=$assets; ?><!--static/js/event/control-scores-updates.js"></script>-->
<script src="<?=$assets; ?>static/js/event/control-wsvoting.js"></script>
<!--<script type="text/javascript" src="--><?//= $assets; ?><!--static/js/event/control-scores.js"></script>-->

<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-control-scores.js?v=<?= filemtime("assets/static/js/event-control-scores.js") ?>"></script>

<script>
    wsvoting.init(0, '<?= $_SERVER['HTTP_HOST'] ?>');
    updates.init('<?= $_SERVER['HTTP_HOST'] ?>');
</script>

