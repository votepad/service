<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/formula.css?v=<?= filemtime("assets/frontend/modules/css/formula.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css" />


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/scenario/jumbotron_navigation', array('id' => $event->id));; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">
            Список этапов
            <br>
            <small>Придумайте этапы. В каждом этапе необходимо составить формулу из критериев, по которой будет формироваться балл.</small>
        </h3>


        <span class="hide" id="allCriterias" data-items='<?= $criterions ?>'></span>


        <!-- Create New Stage -->
        <form method="POST" action="<?= URL::site('stages/add/' . $event->id) ?>" class="form form_collapse" id="newstage" enctype="multipart/form-data">
            <div class="form_body clear_fix">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="input-field">
                            <input id="newstage_name" type="text" name="name" autocomplete="off">
                            <label for="newstage_name">Введите название нового этапа</label>
                        </div>
                    </div>
                    <div class="row hidden">
                        <div class="input-field">
                            <textarea id="newstage_description" name="description"></textarea>
                            <label for="newstage_description">Расскажите об этапе</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row hidden">
                        <div class="radio-field clear_fix">
                            <label class="radio-label" >Жюри будут оценивать</label>
                            <div class="radio-block">
                                <input type="radio" id="part" name="partORteamORgroup" checked="" value="participants">
                                <label for="part">участников</label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="team" name="partORteamORgroup" value="teams">
                                <label for="team">команды</label>
                            </div>
                            <!--<div class="radio-block">
                                <input type="radio" id="group" name="partORteamORgroup" value="groups">
                                <label for="group">группы</label>
                            </div>-->
                            <div class="">
                                <input type="checkbox" id="allParts">
                                <label for="allParts">Все участники</label>
                            </div>
                            <div class="displaynone">
                                <input type="checkbox" id="allTeams">
                                <label for="allTeams">Все команды</label>
                            </div>
                            <!--<div class="displaynone">
                                <input type="checkbox" id="allGroups">
                                <label for="allGroups">Все группы</label>
                            </div>-->
                        </div>
                    </div>
                    <div class="row hidden">

                        <div id="show_participants" class="input-field">
                            <!-- Participants which are not distributed -->
                            <select name="participants[]" id="newstage_participants" multiple="" class="elements_in_stage">
                                <? foreach ($members['participants'] as $participant): ?>
                                    <option value="<?= $participant->id ?>" data-logo="<?= $participant->photo ?>">
                                        <?= $participant->name ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                            <label for="newstage_participants">Выберите участников</label>
                        </div>

                        <div id="show_teams" class="input-field displaynone">
                            <!-- Teams which are not distributed -->
                            <select name="teams[]" id="newstage_teams" multiple="" class="elements_in_stage">
                                <? foreach ($members['teams'] as $team): ?>
                                    <option value="<?= $team->id ?>" data-logo="<?= $team->logo ?>">
                                        <?= $team->name ?>
                                    </option>
                                <? endforeach; ?>
                            </select>
                            <label for="newstage_teams">Выберите команды</label>
                        </div>

                        <div id="show_groups" class="input-field displaynone">
                            <!-- Groups which are not distributed -->
                            <select name="groups[]" id="newstage_groups" multiple="" class="elements_in_stage">
<!--                                --><?// foreach ($members['groups'] as $group): ?>
<!--                                    <option value="--><?//= $group->id ?><!--">-->
<!--                                        --><?//= $group->name ?>
<!--                                    </option>-->
<!--                                --><?// endforeach; ?>
                            </select>
                            <label for="newstage_groups">Выберите группы</label>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row hidden">
                        <div class="formula" id="formula_newstage"> </div>
                    </div>
                </div>
            </div>
            <?= Form::hidden('csrf', Security::token()) ?>
            <div class="form_submit hidden clear_fix">
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Создать этап
                </button>
            </div>
        </form>



        <!-- Existed Stages -->
        <div class="row row-col">
            <div class="col-sm-12">

                <? foreach ($stages as $stage): ?>

                    <div class="card clear_fix" data-id="<?= $stage->id ?>" id="stage_<?= $stage->id ?>">
                        <div class="card_title">
                            <div class="card_title-text" id="name_stage_<?= $stage->id ?>">
                                <?= $stage->name ?>
                            </div>
                            <div class="card_title-dropdown">
                                <div role="button" class="card_title-dropdown-icon">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </div>
                                <div class="card_title-dropdown-menu">
                                    <a class="card_title-dropdown-item edit">
                                        Изменить информацию
                                    </a>
                                    <a class="card_title-dropdown-item delete" data-pk="<?= $stage->id ?>">
                                        Удалить этап
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card_content">
                            <div class="card_content-text">
                                <i><u>Об этапе:</u></i>
                                <span id="description_stage_<?= $stage->id ?>"><?= $stage->description ?></span>
                            </div>
                            <div class="card_content-text">
                                <i><u>Жюри оценивает:</u></i>

                                <? if ($stage->mode == Methods_Stages::MEMBERS_PARTICIPANTS): ?>
                                    <!-- Participants in stage, if they existed -->
                                    <span id="participants_stage_<?= $stage->id ?>">
                                        <? foreach ($stage->members as $participant): ?>
                                            <option value="<?= $participant->id ?>" data-logo="<?= $participant->photo ?>" selected="">
                                                <?= $participant->name ?>
                                            </option>
                                        <? endforeach; ?>
                                    </span>
                                <? endif; ?>

                                <? if ($stage->mode == Methods_Stages::MEMBERS_TEAMS): ?>
                                    <!-- Teams in stage, if they existed -->
                                    <span id="teams_stage_<?= $stage->id ?>">
                                            <? foreach ($stage->members as $team): ?>
                                                <option value="<?= $team->id ?>" data-logo="<?= $team->logo ?>" selected="">
                                                    <?= $team->name ?>
                                                </option>
                                            <? endforeach; ?>
                                    </span>
                                <? endif; ?>

                                <!-- Groups in stage, if they existed -->
<!--                                --><?// if ($stage->mode == Methods_Stages::MEMBERS_GROUPS): ?>
<!--                                    <span id="groups_stage_--><?//= $stage->id ?><!--">-->
<!--                                        --><?// foreach ($stage->members as $team): ?>
<!--                                            <option value="--><?//= $team->id ?><!--" data-logo="--><?//= $team->photo ?><!--" selected="">-->
<!--                                                --><?//= $team->name ?>
<!--                                            </option>-->
<!--                                        --><?// endforeach; ?>
<!--                                    </span>-->
<!--                                --><?// endif; ?>
                                </div>
                            <div class="card_content-text">
                                <i><u>Формула:</u></i>
                                <div class="formula formula-print inlineblock" id="formula_stage_<?= $stage->id ?>" data-items='<?= $stage->formula ?>'></div>
                            </div>
                        </div>
                    </div>

                <? endforeach; ?>

            </div>
        </div>


        <!-- Modal - Update stage Info -->
        <form class="modal fade" id="editstage_modal" role="dialog" method="post" action="">
            <input type="hidden" id="editstage_id" name="stage_id">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                        <h4 class="modal-title">Редактирование информации об этапе</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="input-field">
                                <input type="text" id="editstage_name" name="name" value="">
                                <label for="editstage_name" class="active">Название этапа</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <textarea id="editstage_description" name="description"></textarea>
                                <label for="editstage_description" class="active">Описание этапа</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <!-- Members = [parts || teams || groups] + not_distributed [parts || teams || groups] -->
                                <select multiple id="editstage_members" name="members[]">

                                </select>
                                <label for="editstage_members">Жюри будут оценивать</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="formula" id="" data-items=""> </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn_primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
            <?= Form::hidden('csrf', Security::token()) ?>
        </form>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sortable/Sortable.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/stages.js"></script>

    <script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/formula.js"></script>

</div>