<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event-control.css">

    <link rel="stylesheet" href="<?=$assets; ?>vendor/datatables/css/dataTables.bootstrap.min.css">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/control/jumbotron_navigation', array('id' => $event->id)); ?>
        </div>

    </div>


    <section class="section__content">

<!--        <form id="addScore" class="block m-t-30">-->
<!--            <div class="block_heading block_default">-->
<!--                <h4>Поставить дополнительный балл</h4>-->
<!--            </div>-->
<!--            <div class="block_body clear_fix">-->
<!---->
<!--                <div class="col-xs-12 col-md-6">-->
<!--                    <div class="input-field hide">-->
<!---->
<!--                        <select name="contest" id="addScoreContest">-->
<!--                                <option></option>-->
<!---->
<!--                            --><?// foreach ($event->contests as $contestKey => $contest): ?>
<!---->
<!--                                <option value="--><?//= $contest->id; ?><!--">--><?//= $contest->name; ?><!--</option>-->
<!---->
<!--                            --><?// endforeach; ?>
<!---->
<!--                        </select>-->
<!--                        <label for="addScoreContest">Выберите конкурс</label>-->
<!---->
<!--                        <input type="hidden" id="contests" value='--><?//=json_encode($event->contests) ?><!--'>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-xs-12 col-md-6">-->
<!--                    <div class="input-field hide">-->
<!--                        <select name="stage" id="addScoreStage">-->
<!--                            <option></option>-->
<!---->
<!--                        </select>-->
<!--                        <label for="addScoreContest">Выберите этап</label>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!---->
<!--                <div id="addScoreMember" class="col-xs-12 col-md-6 hide">-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="col-xs-12 col-md-6 hide">-->
<!--                    <div class="input-field">-->
<!--                        <input type="number" id="addScoreInput" name="score">-->
<!--                        <label for="addScoreInput">Введите дополнительный балл</label>-->
<!--                    </div>-->
<!--                    <div class="input-field">-->
<!--                        <buton role="button" class="btn btn_primary fl_r" id="addScoreButton">Поставить</buton>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </form>-->


        <div class="block m-t-30">

            <div class="block_heading block_default text-center">
                <h4>Финальный результат</h4>
            </div>

            <div class="block_body">

                <table class="stage__table table table-striped table-hover table-bordered" cellspacing="0" width="100%">

                    <thead>
                        <tr>
                            <th>
                                <? switch (1) {
                                    case 1:
                                        echo "Участники";
                                        break;
                                    case 2:
                                        echo "Команды";
                                        break;
                                }
                                ?>
                            </th>

                            <? foreach ($event->contests as $contest): ?>

                            <th class="no-sort">
                                <?= $contest->name ?>
                            </th>

                            <? endforeach; ?>

                            <th>Балл</th>
                        </tr>
                    </thead>

                    <tbody id="total-results">
                        <? foreach ($event->members['participants'] as $member): ?>
                            <tr id="member-<?= $member->id ?>">

                                <td class="text-center"><?= $member->name; ?></td>

                                <? foreach ($event->contests as $contest): ?>
                                    <td class="text-center" id="contest-<?= $contest->id ?>">
                                        <!--
                                            TODO вывести балл, полученный membor за КОНКРЕТНЫЙ конкурс, ВСЕМИ жюри
                                            -->
                                        <? echo 0?>
                                    </td>
                                <? endforeach; ?>

                                <td class="text-center" id="final-result">
                                    <!--
                                            TODO вывести балл, полученный membor за ВСЕ конкурсы, ВСЕМИ жюри - то есть финальный результат
                                            -->
                                    <? echo 0 ?>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


        <? foreach ($event->contests as $contestKey => $contest): ?>

            <div class="block m-t-30">

                <div class="block_heading text-center">

                    <h4><?= $contest->name; ?></h4>

                </div>

                <ul class="stage-header clear_fix text-center">

                        <li class="stage-header__item active" data-toggle="tabs" data-btnGroup="stage_<?= $contest->id; ?>" data-block="stage_<?= $contest->id . '_sum'; ?>">Итого</li>

                    <? foreach ($event->contests[$contestKey]->stages as $stageKey => $stage): ?>

                        <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_<?= $contest->id; ?>" data-block="stage-<?= $contest->id . '-' . $stage->id; ?>"><?= $stage->name; ?></li>

                    <? endforeach; ?>

                </ul>

                <!-- STAGE SUM BLOCK START -->
                <div id="stage_<?= $contest->id . '_sum'; ?>" data-blockGroup="stage_<?= $contest->id; ?>" class="block_body">

                    <span class="label <?= $contest->is_publish ? 'label--brand': 'label--warning '; ?> js-check-publish" data-contest="<?=$contest->id; ?>" data-isallpublish="<?= $contest->is_publish ? 'true' : 'false'; ?>">
                        <? if ($contest->is_publish) : ?>
                            <i class="fa fa-check" aria-hidden="true"></i> все баллы опубликованы
                        <? else: ?>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> не все баллы опубликованы
                        <? endif; ?>
                    </span>

                    <table class="stage__table table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    <? switch ($contest->stages[0]->mode) {
                                        case 1:
                                            echo "Участники";
                                            break;
                                        case 2:
                                            echo "Команды";
                                            break;
                                    }
                                    ?>
                                </th>

                                <? foreach ($contest->judges as $judge): ?>
                                    <th class="no-sort">
                                        <?= $judge->name; ?>
                                    </th>
                                <? endforeach; ?>

                                <th>Балл</th>
                            </tr>

                        </thead>

                        <tbody>
                            <? foreach ($event->contests[$contestKey]->stages[0]->members as $member): ?>

                                <tr id="member-<?= $member->id ?>">

                                    <td class="text-center"><?= $member->name; ?></td>

                                    <? foreach ($contest->judges as $judge): ?>

                                    <td class="text-center" id="judge-score-<?= $judge->id ?>">
                                        <!--
                                            TODO вывести балл, полученный membor КОНКРЕТНЫМ жюри по всем критериям за ВСЕ этпы
                                            -->
                                        <? echo 0 ?>
                                    </td>

                                    <? endforeach; ?>

                                    <td class="text-center" id="contest-total-<?= $contest->id ?>">
                                        <!--
                                            TODO вывести балл, полученный membor ВСЕМИ жюри по всем критериям за ВСЕ этпы
                                            -->

                                        <? echo 0 ?>
                                    </td>

                                </tr>
                            <? endforeach; ?>

                        </tbody>

                    </table>

                </div>
                <!-- STAGE SUM BLOCK END -->

                <? foreach ($contest->stages as $stageKey => $stage): ?>

                    <!-- STAGE START -->
                    <div id="stage-<?= $contest->id . '-' . $stage->id; ?>" data-blockGroup="stage_<?= $contest->id; ?>" class="block_body hide">

                        <a role="button" class="btn <?= $stage->is_publish  ? 'btn_primary' : 'btn_default' ?> js-publish-scores" data-stage="<?=$stage->id; ?>" data-contest="<?=$contest->id; ?>" data-publish="<?= $stage->is_publish ? 'true' : 'false'; ?>">
                            <? if ($stage->is_publish): ?>
                                Опубиковано
                            <? else: ?>
                                Опубликовать
                            <? endif; ?>
                        </a>

                        <table class="stage__table table table-striped table-hover table-bordered" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>
                                        <? switch ($stage->mode) {
                                            case 1:
                                                echo "Участники";
                                                break;
                                            case 2:
                                                echo "Команды";
                                                break;
                                        } ?>
                                    </th>

                                    <? foreach ($contest->judges as $judge): ?>

                                        <th class="no-sort">

                                            <?= $judge->name; ?>

                                        </th>

                                    <? endforeach; ?>

                                    <th>Балл</th>

                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($stage->members as $member): ?>

                                    <tr id="member-<?= $member->id ?>">

                                        <td class="text-center"><?= $member->name; ?></td>

                                        <? foreach ($contest->judges as $judge): ?>

                                            <td class="text-center">

                                                <?
                                                    $data = array(
                                                        'member' => $member->id,
                                                        'judge' => $judge->id,
                                                        'contest' => array(
                                                            'id' => $contest->id,
                                                            'formula' => json_decode($contest->origin_formula),
                                                        ),
                                                        'stage' => array(
                                                            'id' => $stage->id,
                                                            'formula' => json_decode($stage->formula),
                                                        ),
                                                        'criterions' => $stage->criterions
                                                    );
                                                ?>

                                                <a role="button" class="editScore" data-info='<?= json_encode($data); ?>' data-scores='<?= json_encode(array('1'=>3, '3'=>4))?>'>
                                                    <!--
                                                    TODO вывести балл, полученный membor КОНКРЕТНЫМ жюри по всем критериям за этап
                                                    data-scores="{1:5, 3:3, id_criteria:score}"
                                                    -->

                                                    0
                                                </a>
                                            </td>

                                        <? endforeach; ?>

                                        <td class="text-center" id="stage-total-<?= $stage->id ?>">
                                            <!--
                                                TODO вывести балл, полученный membor ВСЕМИ жюри по всем критериям за этап
                                                -->
                                            <? echo 0 ?>

                                        </td>

                                    </tr>

                                <? endforeach; ?>

                            </tbody>

                        </table>

                    </div>
                    <!-- STAGE END -->
                <? endforeach; ?>

            </div>
            <!-- CONTEST END -->
        <? endforeach;?>

        <div class="modal fade" id="editScoresForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Оценки по критериям</h4>
                    </div>
                    <div class="modal-body">
                        <table id="editScoresTable" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center no-sort">Критерии</th>
                                    <th class="text-center no-sort">Балл</th>
                                    <th class="text-center no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <input type="hidden" id="eventID" value="<?=$event->id;?>">
        <input type="hidden" id="organizationID" value="<?=$event->organization; ?>">
    </section>
    <script>
        wsvoting.init(0, '<?= $_SERVER['HTTP_HOST'] ?>');
    </script>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?= $assets; ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/datatables/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script src="<?=$assets; ?>static/js/event/control-scores-updates.js"></script>
    <script src="<?=$assets; ?>static/js/event/control-wsvoting.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control-scores.js"></script>

</div>