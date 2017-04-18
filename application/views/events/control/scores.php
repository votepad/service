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

                <div class="col-xs-6">
                    <div class="input-field hide">

                        <select name="contest" id="addScoreContest">
                                <option></option>

                            <? foreach ($event->contests as $i => $contest): ?>

                                <option value="<?= $contest->id; ?>"><?= $contest->name; ?></option>

                            <? endforeach; ?>

                        </select>
                        <label for="addScoreContest">Выберите конкурс</label>

                        <input type="hidden" id="contests" value='<?=json_encode($event->contests) ?>'>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="input-field hide">
                        <select name="stage" id="addScoreStage">
                            <option></option>

                        </select>
                        <label for="addScoreContest">Выберите этап</label>
                    </div>
                </div>
                <div class="col-xs-6">
                </div>

                <div id="addScoreMember" class="col-xs-6 hide">

                </div>

                <div class="col-xs-6 hide">
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

                        <? //foreach ($contest->judges as $judge): ?>
                            <th class="no-sort">
                             Жюри <?//= $judge->name; ?>
                            </th>
                        <? //endforeach; ?>

                        <th>Балл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? //foreach ($stage->member as $member): ?>
                        <tr>

                            <td class="text-center">Участник 1<?//= $member->name; ?></td>

                            <? //foreach ($contest->judges as $judge): ?>
                                <td class="text-center"><? echo rand(0,15) ?></td>
                            <? //endforeach; ?>

                            <td class="text-center"><? echo rand(10,15) ?></td>
                        </tr>
                    <? //endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


        <? foreach ($event->contests as $contest): ?>
            <!-- CONTEST START -->
            <div class="block m-t-30">
                <div class="block_heading text-center">
                    <h4><?= $contest->name; ?></h4>
                </div>


                <ul class="stage-header clear_fix text-center">

                    <? foreach ($event->contests[$i]->stages as $j => $stage): ?>

                        <li class="stage-header__item <? echo $j == 0 ? 'active' : '' ?>" data-toggle="tabs" data-btnGroup="stage_<?= $i; ?>" data-block="stage_<?= $i . '_' . $j; ?>"><?= $stage->name; ?></li>

                    <? endforeach; ?>

                </ul>

                <? foreach ($event->contests[$i]->stages as $j => $stage): ?>
                    <!-- STAGE START -->
                    <div id="stage_<?= $i . '_' . $j; ?>" data-blockGroup="stage_<?= $i; ?>" class="block_body <? echo $j != 0 ? 'hide' : '' ?>">

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
                                    <td class="text-center"><? echo rand(0,15) ?></td>
                                <? endforeach; ?>

                                <td class="text-center"><? echo rand(10,15) ?></td>
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

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control.js"></script>

</div>