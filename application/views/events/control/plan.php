<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v<?= filemtime("assets/static/css/event.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event-control.css">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/control/jumbotron_navigation', array('id' => $event->id)); ?>
        </div>

    </div>


    <section class="section__content">

        <? foreach ($event->contests as $i => $contest): ?>

            <div class="clear_fix m-t-30">
                <h3 class="page-header"><?= $contest->name; ?></h3>

                <div class="row">

                    <div class="m-t-20 col-xs-12 col-md-4">
                        <div class="block block_default">
                            <div class="block_heading">
                                <h4>Экспертное жюри</h4>
                            </div>
                            <div class="block_body clear_fix">

                                <? foreach ($contest->judges as $judge): ?>

                                <p style="line-height:1.5em">
                                    <?= $judge->name; ?>
                                    <span class="label-status label-status--online">Online</span>
<!--                                    <span class="label-status label-status--offline">Offline</span> -->
                                </p>

                                <? endforeach; ?>

                            </div>
                        </div>
                    </div>

                    <div class="m-t-20 col-xs-12 col-md-4">
                        <div class="block block_default">
                            <div class="block_heading">
                                <h4>Заблокировать <?
                                    switch ($contest->stages[0]->mode) {
                                        case 1:
                                            echo "участников"; break;
                                        case 2:
                                            echo "команды"; break;
                                    }
                                    ?></h4>
                            </div>
                            <div class="block_body clear_fix">

                                <div class="input-field hide">
                                    <select name="stage" class="blockMemberStages">
                                        <option value="0"></option>

                                        <? foreach ($contest->stages as $stage): ?>

                                            <option value="<?= $stage->id; ?>"><?= $stage->name; ?></option>

                                        <? endforeach; ?>

                                    </select>
                                    <label for="blockMemberStages">Выберите этап</label>

                                    <input class="blockMemberStagesInput" type="hidden" value='<?= json_encode($contest->stages); ?>'">
                                </div>

                                <div class="blockMembers hide">

                                </div>

                                <input class="blockMemberContest" name="contest" type="hidden" value="<?= $contest->id; ?>">

                                <button class="blockMembersBtn btn btn_primary hide">
                                    Заблокировать
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="m-t-20 col-xs-12 col-md-4">
                        <div class="block block_default">
                            <div class="block_heading">
                                <h4>Закрыть доступ</h4>
                            </div>
                            <div class="block_body clear_fix">
                                <p>
                                <div class="switch" style="line-height: 1.5em">
                                    <label><?=$contest->name;?> <input type="checkbox" name="blockContest" value="<?=$contest->id;?>"> <span></span> </label>
                                </div>
                                </p>
                                <? foreach ($contest->stages as $stage): ?>
                                    <p>
                                        <div class="switch" style="line-height: 1.5em">
                                            <label><?=$stage->name;?> <input type="checkbox" name="blockStage" data-contest="<?= $contest->id; ?>" value="<?= $stage->id; ?>"> <span></span> </label>
                                        </div>
                                    </p>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <? endforeach; ?>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>static/js/event/control-plan.js"></script>

</div>