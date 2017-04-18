<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event-control.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=View::factory('events/control/jumbotron_navigation', array('id' => $event->id)); ?>
        </div>

    </div>


    <section class="section__content">

        <form id="addScore" class="block m-t-30">
            <div class="block_heading block_default">
                <h4>Поставить дополнительный балл</h4>
            </div>
            <div class="block_body clear_fix">

                <div class="col-xs-12 col-md-6">
                    <div class="input-field hide">

                        <select name="contest" id="addScoreContest">
                                <option></option>

                            <? foreach ($event->contests as $contestKey => $contest): ?>

                                <option value="<?= $contest->id; ?>"><?= $contest->name; ?></option>

                            <? endforeach; ?>

                        </select>
                        <label for="addScoreContest">Выберите конкурс</label>

                        <input type="hidden" id="contests" value='<?=json_encode($event->contests) ?>'>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="input-field hide">
                        <select name="stage" id="addScoreStage">
                            <option></option>

                        </select>
                        <label for="addScoreContest">Выберите этап</label>
                    </div>
                </div>


                <div id="addScoreMember" class="col-xs-12 col-md-6 hide">

                </div>

                <div class="col-xs-12 col-md-6 hide">
                    <div class="input-field">
                        <input type="number" id="addScoreInput" name="score">
                        <label for="addScoreInput">Введите дополнительный балл</label>
                    </div>
                    <div class="input-field">
                        <buton role="button" class="btn btn_primary fl_r">Поставить</buton>
                    </div>
                </div>

            </div>
        </form>

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
                                case 3:
                                    echo "Группы";
                                    break;
                            }
                            ?>
                        </th>

                        <? //foreach ($contest->judges as $stageKeyudge): ?>
                            <th class="no-sort">
                             Конкурс
                            </th>
                        <? //endforeach; ?>

                        <th>Балл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? //foreach ($stage->member as $member): ?>
                        <tr>

                            <td class="text-center">Участник 1<?//= $member->name; ?></td>

                            <? //foreach ($contest->judges as $stageKeyudge): ?>
                                <td class="text-center">
                                    <!--
                                        TODO вывести балл, полученный membor за КОНКРЕТНЫЙ конкурс, ВСЕМИ жюри
                                        -->
                                    <? echo rand(0,15) ?>
                                </td>
                            <? //endforeach; ?>

                            <td class="text-center">
                                <!--
                                        TODO вывести балл, полученный membor за ВСЕ конкурсы, ВСЕМИ жюри - то есть финальный результат
                                        -->
                                <? echo rand(10,15) ?>
                            </td>
                        </tr>
                    <? //endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


        <? foreach ($event->contests as $contestKey => $contest): ?>
            <!-- CONTEST START -->
            <div class="block m-t-30">
                <div class="block_heading text-center">
                    <h4><?= $contest->name; ?></h4>
                </div>


                <ul class="stage-header clear_fix text-center">

                        <li class="stage-header__item active" data-toggle="tabs" data-btnGroup="stage_<?= $contestKey; ?>" data-block="stage_<?= $contestKey . '_sum'; ?>">Итого</li>
                    <? foreach ($event->contests[$contestKey]->stages as $stageKey => $stage): ?>

                        <li class="stage-header__item" data-toggle="tabs" data-btnGroup="stage_<?= $contestKey; ?>" data-block="stage_<?= $contestKey . '_' . $stageKey; ?>"><?= $stage->name; ?></li>

                    <? endforeach; ?>

                </ul>

                <!-- STAGE SUM BLOCK START -->
                <div id="stage_<?= $contestKey . '_sum'; ?>" data-blockGroup="stage_<?= $contestKey; ?>" class="block_body">

                    <table class="stage__table table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>
                                <? switch ($event->contests[$contestKey]->stages[0]->mode) {
                                    case 1:
                                        echo "Участники";
                                        break;
                                    case 2:
                                        echo "Команды";
                                        break;
                                    case 3:
                                        echo "Группы";
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
                        <? foreach ($event->contests[$contestKey]->stages[0]->member as $member): ?>
                            <tr>

                                <td class="text-center"><?= $member->name; ?></td>

                                <? foreach ($contest->judges as $judge): ?>
                                    <td class="text-center">
                                        <!--
                                            TODO вывести балл, полученный membor КОНКРЕТНЫМ жюри по всем критериям за ВСЕ этпы
                                            -->
                                        <? echo rand(10,25) ?>
                                    </td>
                                <? endforeach; ?>

                                <td class="text-center">
                                    <!--
                                        TODO вывести балл, полученный membor ВСЕМИ жюри по всем критериям за ВСЕ этпы
                                        -->

                                    <? echo rand(50,55) ?>
                                </td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- STAGE SUM BLOCK END -->

                <? foreach ($event->contests[$contestKey]->stages as $stageKey => $stage): ?>
                    <!-- STAGE START -->
                    <div id="stage_<?= $contestKey . '_' . $stageKey; ?>" data-blockGroup="stage_<?= $contestKey; ?>" class="block_body hide">

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
                                            case 3:
                                                echo "Группы";
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
                            <? foreach ($stage->member as $member): ?>
                            <tr>

                                <td class="text-center"><?= $member->name; ?></td>

                                <? foreach ($contest->judges as $judge): ?>
                                    <td class="text-center">
                                        <a role="button" class="editScore" data-contest="<?= $contest->id; ?>" data-stage="<?= $stage->id; ?>" data-member="<?= $member->id; ?>" data-judge="<?= $judge->id; ?>" data-criterions='<?= json_encode($stage->criterions); ?>'>
                                            <!--
                                            TODO вывести балл, полученный membor КОНКРЕТНЫМ жюри по всем критериям за этап
                                            -->

                                            8
                                        </a>
                                    </td>
                                <? endforeach; ?>

                                <td class="text-center">
                                    <!--
                                        TODO вывести балл, полученный membor ВСЕМИ жюри по всем критериям за этап
                                        -->
                                    <? echo rand(10,15) ?>
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

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control-scores.js"></script>

</div>