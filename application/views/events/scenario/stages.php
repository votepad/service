<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/formula.css?v=<?= filemtime("assets/frontend/modules/css/formula.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css" />


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">
            Список этапов
            <br>
            <small>Придумайте этапы. В каждом этапе необходимо составить формулу из критериев, по которой будет формироваться балл.</small>
        </h3>


        <span class="hide" id="allCriterias" data-items='[{"id": 1, "name":"Критерий 1"}, {"id": 2, "name":"Критерий 2"}, {"id": 3, "name":"Критерий 3"}, {"id": 4, "name":"Критерий 4"}]'></span>


        <!-- Create New Stage -->
        <form method="POST" action="" class="form form_collapse" id="newstage" enctype="multipart/form-data">
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
                                <input type="radio" id="part" name="partORteamORgroup" checked="">
                                <label for="part">участников</label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="team" name="partORteamORgroup">
                                <label for="team">команды</label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="group" name="partORteamORgroup">
                                <label for="group">этапы</label>
                            </div>
                            <div class="">
                                <input type="checkbox" id="allParts">
                                <label for="allParts">Все участники</label>
                            </div>
                            <div class="displaynone">
                                <input type="checkbox" id="allTeams">
                                <label for="allTeams">Все команды</label>
                            </div>
                            <div class="displaynone">
                                <input type="checkbox" id="allGroups">
                                <label for="allGroups">Все группы</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden">
                        <div id="show_participants" class="input-field">
                            <!-- Participants which are not distributed -->
                            <select name="participants[]" id="newstage_participants" multiple="" class="elements_in_stage">
                                <option value="5" data-logo="">Участник 5</option>
                                <option value="6" data-logo="">Участник 6</option>
                            </select>
                            <label for="newstage_participants">Выберите участников</label>
                        </div>
                        <div id="show_teams" class="input-field displaynone">
                            <!-- Teams which are not distributed -->
                            <select name="teams[]" id="newstage_teams" multiple="" class="elements_in_stage">
                                <option value="1" data-logo="">Команда 1</option>
                                <option value="2" data-logo="">Команда 2</option>
                            </select>
                            <label for="newstage_teams">Выберите команды</label>
                        </div>
                        <div id="show_groups" class="input-field displaynone">
                            <!-- Groups which are not distributed -->
                            <select name="groups[]" id="newstage_groups" multiple="" class="elements_in_stage">
                                <option value="1">этапа 1</option>
                                <option value="2">этапа 2</option>
                            </select>
                            <label for="newstage_groups">Выберите этапы</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row hidden">
                        <div class="formula" id="formula_newstage"> </div>
                    </div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Создать этап
                </button>
            </div>
        </form>


        <!-- Existed Stages -->
        <div class="row row-col">
            <div class="col-sm-12">

                <!-- Stage 1 -->
                <div class="card clear_fix" action="" id="stage_1">
                    <div class="card_title">
                        <div class="card_title-text" id="name_stage_1">
                            Название этапа №1
                        </div>
                        <div class="card_title-dropdown">
                            <div role="button" class="card_title-dropdown-icon">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                            <div class="card_title-dropdown-menu">
                                <a class="card_title-dropdown-item edit">
                                    Изменить информацию
                                </a>
                                <a class="card_title-dropdown-item delete" data-pk="1">
                                    Удалить этап
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card_content">
                        <div class="card_content-text">
                            <i><u>Об этапе:</u></i>
                            <span id="description_stage_1">описание этапа №1</span>
                        </div>
                        <div class="card_content-text">
                            <i><u>Жюри оценивает:</u></i>

                            <!-- Participants in stage, if they existed -->
                            <span id="participants_stage_1">
                                <option value="0" data-logo="01.jpeg" selected="">Участник 1</option>
                                <option value="1" data-logo="02.jpeg" selected="">Участник 2</option>
                            </span>

                            <!-- Teams in stage, if they existed -->
                            <span id="teams_stage_1">

                            </span>

                            <!-- Groups in stage, if they existed -->
                            <span id="groups_stage_1">

                            </span>
                        </div>
                        <div class="card_content-text">
                            <i><u>Формула:</u></i>
                            <span class="hide" id="Criterias_Stage1" data-items='[{"id": 1, "name":"Критерий 1", "coeff":0.5}, {"id": 2, "name":"Критерий 2", "coeff":0.4}]'></span>
                            <div class="formula inlineblock" id="formula_stage_1"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" id="event_id" value="5">

        <!-- Modal - Update stage Info -->
        <form class="modal fade" id="editstage_modal" role="dialog" aria-labelledby="" method="post" action="">
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
                                <select multiple id="editstage_members" name="members">

                                </select>
                                <label for="editstage_members">Жюри будут оценивать</label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="input-field">
                                <input id="editstage_formula" type="hidden" name="formula" value="">

                                <label for="editstage_formula_area" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, расположеные ниже">Задайте формулу</label>
                            </div>

                            <div role="separator" class="divider"></div>

                            <div id="">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn_primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
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