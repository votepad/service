<div class="entry__wrapper">
    <div class="block mb-0 ui-tabs">
        <div class="ui-tabs__wrapper">
            <a role="button" data-toggle="tabs" data-area="serverStatusArea" class="ui-tabs__tab ui-tabs__tab--active">
                Голосование
            </a>
            <a role="button" data-toggle="tabs" data-area="resultParticipantsArea" class="ui-tabs__tab">
                Индивидуальный результат
            </a>
            <a role="button" data-toggle="tabs" data-area="resultTeamsArea" class="ui-tabs__tab">
                Командный результат
            </a>
        </div>
    </div>
</div>

<div id="serverStatusArea">

    <div class="block">
        <div class="block__wrapper p-20">
            <div id="serverStatus">Подключение <i class="fa fa-spinner fa-fw fa-pulse text-brand" aria-hidden="true"></i></div>
        </div>
    </div>


    <div class="block">

        <div class="block__heading t-lh-50px p-0 bb-1 text-center">
            Представители жюри
        </div>

        <div class="block__wrapper pt-10 pb-20">
            <table>
                <thead>
                    <tr>
                        <th width="20%" class="text-center">Статус</th>
                        <th width="80%">Имя</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($event->judges as $judge): ?>
                        <tr>
                            <td class="text-center">
                                <span id="judgeStatus<?= $judge->id; ?>" class="label label--danger">offline</span>
                            </td>
                            <td><?= $judge->name; ?></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>


<div id="resultParticipantsArea" class="hide">

    <!-- FINAL PARTICIPANTS RESULT START -->
    <div class="block" id="final-participants-results">

        <div class="block__heading t-lh-50px p-0 bb-1 text-center">
            Финальный результат
        </div>

        <div class="block__wrapper">

            <table class="js-table-participant" data-result="<?= $event->results['participants']->id; ?>" data-publish="<?= $event->results['participants']->publish == FALSE ? 'false' : 'true'; ?>">
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

                    <tr data-member="<?= $member->id; ?>">

                        <td><?= $member->name; ?></td>

                        <? foreach ($event->results['participants']->contests as $contest): ?>

                            <td class="text-center" data-contest="<?= $contest->id; ?>">
                                <? // вывод: балл, полученый участником за КОНКУРС всеми жюри
                                    if (empty($event->scores['participants'][$member->id]['overall'][$contest->id]['total'])) {

                                        echo 0;

                                    } else {

                                        echo $event->scores['participants'][$member->id]['overall'][$contest->id]['total'];

                                    }
                                ?>
                            </td>

                        <? endforeach; ?>

                        <td class="text-center" data-contest="total">
                            <? // вывод: балл, полученый участником за все КОНКУРСЫ всеми жюри
                                if (empty($event->scores['participants'][$member->id]['overall']['total'])) {

                                    echo 0;

                                } else {

                                    echo $event->scores['participants'][$member->id]['overall']['total'];

                                }
                            ?>
                        </td>

                    </tr>

                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>
    <!-- FINAL PARTICIPANTS RESULT END -->

    <? foreach ($event->results['participants']->contests as $contestKey => $contest): ?>

        <!-- PARTICIPANTS CONTEST START -->
        <div class="block" id="content-participants-<?= $contest->id; ?>">

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

                <!-- PARTICIPANTS STAGE RESULT START -->
                <div data-stage="<?= $contest->id . '-' . $stage->id; ?>" id="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="block__wrapper <?= $stageKey == 0 ? '' : 'hide'; ?>">

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

                            <tr data-member="<?= $member->id; ?>">

                                <td><?= $member->name; ?></td>

                                <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>

                                    <td class="text-center">
                                        <?
                                            $data = array(
                                                'event'   => $event->id,
                                                'mode'    => 'participants',
                                                'member'  => $member->id,
                                                'judge'   => $judge->id,
                                                'result'  => array(
                                                    'formula' => json_decode($event->results['participants']->formula),
                                                ),
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

                                            if (empty($event->scores['participants'][$member->id]['judges'][$judge->id][$contest->id][$stage->id])) {

                                                $stageScore['total'] = 0;

                                            } else {

                                                $stageScore = $event->scores['participants'][$member->id]['judges'][$judge->id][$contest->id][$stage->id];

                                            }

                                            foreach ($stage->criterions as $criterion) {
                                                if ($stageScore['total'] == 0 || empty($stageScore[$criterion->id])) {
                                                    $criterionsScores[$criterion->id] = 0;
                                                } else {
                                                    $criterionsScores[$criterion->id] = $stageScore[$criterion->id];
                                                }
                                            }


                                        ?>
                                        <!-- data-scores="{id_criteria:score, ...}" -->
                                        <a data-judge="<?= $judge->id; ?>" role="button" class="link" onclick="eventScores.editStageScore(this)" data-info='<?= json_encode($data); ?>' data-scores='<?= json_encode($criterionsScores)?>'>
                                            <? // вывод: балл, полученый участником за ЭТАП конкретным жюри
                                                echo $stageScore['total'];
                                            ?>
                                        </a>

                                    </td>

                                <? endforeach; ?>

                                <td class="text-center" data-judge="total">
                                    <? // вывод: балл, полученый участником за ЭТАП всеми жюри
                                        if (empty($event->scores['participants'][$member->id]['overall'][$contest->id][$stage->id]['total'])) {

                                            echo 0;

                                        } else {

                                            echo $event->scores['participants'][$member->id]['overall'][$contest->id][$stage->id]['total'];

                                        }
                                    ?>
                                </td>

                            </tr>

                        <? endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- PARTICIPANTS STAGE RESULT END -->

            <? endforeach; ?>

            <!-- PARTICIPANTS CONTEST TOTAL RESULT START -->
            <div data-contest="total" id="resultContest<?= $contest->id; ?>StageTotal" class="block__wrapper hide">

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

                        <tr data-member="<?= $member->id; ?>">

                            <td><?= $member->name; ?></td>

                            <? foreach ($event->results['participants']->contests[$contestKey]->judges as $judge): ?>

                                <td class="text-center" data-judge="<?= $judge->id; ?>">
                                    <? // вывод: балл, полученый участником за КОНКУРС конкретным жюри
                                        if (empty($event->scores['participants'][$member->id]['judges'][$judge->id][$contest->id]['total']))  {

                                            echo 0;

                                        } else {

                                            echo $event->scores['participants'][$member->id]['judges'][$judge->id][$contest->id]['total'];

                                        }
                                    ?>
                                </td>

                            <? endforeach; ?>

                            <td class="text-center" data-judge="total">
                                <? // вывод: балл, полученый участником за КОНКУРС всеми жюри
                                    if (empty($event->scores['participants'][$member->id]['overall'][$contest->id]['total']))  {

                                        echo 0;

                                    } else {

                                        echo $event->scores['participants'][$member->id]['overall'][$contest->id]['total'];

                                    }
                                ?>
                            </td>

                        </tr>

                    <? endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- PARTICIPANTS CONTEST TOTAL RESULT END -->

        </div>
        <!-- PARTICIPANTS CONTEST END -->

    <? endforeach; ?>

</div>

<div id="resultTeamsArea" class="hide">

    <!-- FINAL TEAMS RESULT START -->
    <div class="block" id="final-teams-results">

        <div class="block__heading t-lh-50px p-0 bb-1 text-center text-bold">
            Финальный результат
        </div>

        <div class="block__wrapper">

            <table class="js-table-team" data-result="<?= $event->results['teams']->id; ?>" data-publish="<?= $event->results['teams']->publish == FALSE ? 'false' : 'true'; ?>">
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

                    <tr data-member="<?= $member->id; ?>">

                        <td><?= $member->name; ?></td>

                        <? foreach ($event->results['teams']->contests as $contest): ?>

                            <td class="text-center" data-contest="<?= $contest->id; ?>">
                                <? // вывод: балл, полученый командой за КОНКУРС всеми жюри
                                    if (empty($event->scores['teams'][$member->id]['overall'][$contest->id]['total'])) {

                                        echo 0;

                                    } else {

                                        echo $event->scores['teams'][$member->id]['overall'][$contest->id]['total'];

                                    }
                                ?>
                            </td>

                        <? endforeach; ?>

                        <td class="text-center" data-contest="total">
                            <? // вывод: балл, полученый командой за все КОНКУРСЫ всеми жюри
                                if (empty($event->scores['teams'][$member->id]['overall']['total'])) {

                                    echo 0;

                                } else {

                                    echo $event->scores['teams'][$member->id]['overall']['total'];

                                }
                            ?>
                        </td>

                    </tr>

                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>
    <!-- FINAL TEAMS RESULT END -->


    <? foreach ($event->results['teams']->contests as $contestKey => $contest): ?>

        <!-- TEAMS CONTEST START -->
        <div class="block" id="content-teams-<?= $contest->id; ?>">

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

                <!-- TEAMS STAGE RESULT START -->
                <div data-stage="<?= $contest->id . '-' . $stage->id; ?>" id="resultContest<?= $contest->id; ?>Stage<?= $stage->id; ?>" class="block__wrapper <?= $stageKey == 0 ? '' : 'hide'; ?>">

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

                            <tr data-member="<?= $member->id; ?>">

                                <td><?= $member->name; ?></td>

                                <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>

                                    <td class="text-center">
                                        <?
                                            $data = array(
                                                'event'   => $event->id,
                                                'mode'    => 'teams',
                                                'member'  => $member->id,
                                                'judge'   => $judge->id,
                                                'result'  => array(
                                                    'formula' => json_decode($event->results['teams']->formula),
                                                ),
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

                                            if (empty($event->scores['teams'][$member->id]['judges'][$judge->id][$contest->id][$stage->id])) {

                                                $stageScore['total'] = 0;

                                            } else {

                                                $stageScore = $event->scores['teams'][$member->id]['judges'][$judge->id][$contest->id][$stage->id];

                                            }

                                            foreach ($stage->criterions as $criterion) {
                                                if ($stageScore['total'] == 0 || empty($stageScore[$criterion->id])) {
                                                    $criterionsScores[$criterion->id] = 0;
                                                } else {
                                                    $criterionsScores[$criterion->id] = $stageScore[$criterion->id];
                                                }
                                            }
                                        ?>

                                        <!-- data-scores="{id_criteria:score, ...}" -->
                                        <a data-judge="<?= $judge->id; ?>" role="button" class="link" onclick="eventScores.editStageScore(this)" data-info='<?= json_encode($data); ?>' data-scores='<?= json_encode($criterionsScores)?>'>
                                            <? // вывод: балл, полученый командой за ЭТАП конкретным жюри
                                                echo $stageScore['total']; ?>
                                        </a>
                                    </td>

                                <? endforeach; ?>

                                <td class="text-center" data-judge="total">
                                    <? // вывод: балл, полученый командой за ЭТАП всеми жюри
                                        if (empty($event->scores['teams'][$member->id]['overall'][$contest->id][$stage->id]['total'])) {

                                            echo 0;

                                        } else {

                                            echo $event->scores['teams'][$member->id]['overall'][$contest->id][$stage->id]['total'];

                                        }
                                    ?>
                                </td>

                            </tr>

                        <? endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- TEAMS STAGE RESULT END -->

            <? endforeach; ?>

            <!-- TEAMS CONTEST TOTAL RESULT START -->
            <div data-contest="total" id="resultContest<?= $contest->id; ?>StageTotal" class="block__wrapper hide">

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

                        <tr data-member="<?= $member->id; ?>">

                            <td><?= $member->name; ?></td>

                            <? foreach ($event->results['teams']->contests[$contestKey]->judges as $judge): ?>

                                <td class="text-center" data-judge="<?= $judge->id; ?>">
                                    <? // вывод: балл, полученый командой за КОНКУРС конкретным жюри
                                        if (empty($event->scores['teams'][$member->id]['judges'][$judge->id][$contest->id]['total']))  {

                                            echo 0;

                                        } else {

                                            echo $event->scores['teams'][$member->id]['judges'][$judge->id][$contest->id]['total'];

                                        }
                                    ?>
                                </td>

                            <? endforeach; ?>

                            <td class="text-center" data-judge="total">

                                <? // вывод: балл, полученый командой за КОНКУРС всеми жюри
                                    if (empty($event->scores['teams'][$member->id]['overall'][$contest->id]['total']))  {

                                        echo 0;

                                    } else {

                                        echo $event->scores['teams'][$member->id]['overall'][$contest->id]['total'];

                                    }
                                ?>
                            </td>

                        </tr>

                    <? endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- TEAMS CONTEST TOTAL RESULT END -->

        </div>
        <!-- TEAMS CONTEST END -->

    <? endforeach; ?>

</div>


<input type="hidden" id="eventID" value="<?=$event->id;?>">

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-control-scores-update.js?v=<?= filemtime("assets/static/js/event-control-scores-update.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-control-scores-voting.js?v=<?= filemtime("assets/static/js/event-control-scores-voting.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-control-scores.js?v=<?= filemtime("assets/static/js/event-control-scores.js") ?>"></script>

<script>
    eventScores.update.init('<?= $_SERVER['HTTP_HOST']; ?>');
    eventScores.voting.init(0, '<?= $_SERVER['HTTP_HOST']; ?>')
</script>

