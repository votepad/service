<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/formula.css" />
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
            Список конкурсов
            <br>
            <small>Создайте конкурсы. Конкурс - некое объединение этапов, на которых присутствуют выбранные представители жюри.</small>
        </h3>


        <!-- Create New contest -->
        <form method="POST" action="" class="form form_collapse" id="newcontest" enctype="multipart/form-data">
            <div class="form_body clear_fix">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="input-field">
                            <input id="newcontest_name" type="text" name="name" autocomplete="off">
                            <label for="newcontest_name">Введите название нового конкурса</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row hidden">
                        <div class="input-field">
                            <textarea id="newcontest_description" name="description"></textarea>
                            <label for="newcontest_description">Расскажите о конкурсе</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row hidden">
                        <div class="input-field">
                            <!-- ALl judges -->
                            <select name="judges[]" id="newcontest_judges" multiple="" class="elements_in_contest">
                                <option value="1">Жюри 1</option>
                                <option value="2">Жюри 2</option>
                                <option value="5">Жюри 5</option>
                                <option value="6">Жюри 6</option>
                            </select>
                            <label for="newcontest_judges">Выберите жюри, которые будут оценивать этот конкурс</label>
                        </div>
                        <p>
                            <input type="checkbox" id="allJudges">
                            <label for="allJudges">Все жюри</label>
                        </p>
                    </div>

                    <div class="row hidden">
                        <span class="hide" id="allStages" data-items='[{"id":5, "name":"Name1"},{"id":6, "name":"Name2"}]'></span>
                        <div id="newcontest_formula" class="formula"></div>
                    </div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <button type="submit" class="btn btn_primary col-sm-12 col-md-auto pull-right">
                    Создать конкурс
                </button>
            </div>
        </form>



        <!-- Existed contests -->
        <div class="row row-col">
            <div class="col-sm-12">

                <div class="card clear_fix" id="contest_1">
                    <div class="card_title">
                        <div class="card_title-text" id="name_contest_1">
                            Название конкурса №1
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
                                    Удалить конкурс
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card_content">
                        <div class="card_content-text">
                            <i><u>О конкурсе:</u></i>
                            <span id="description_contest_1">описание конкурса №1</span>
                        </div>
                        <div class="card_content-text">
                            <i><u>Жюри, которые будут оценивать этот конкурс:</u></i>
                            <!-- Judges in contest -->
                            <span id="judges_contest_1">
                                <option value="1">Жюри 1</option>
                                <option value="2">Жюри 2</option>
                            </span>
                        </div>
                        <div class="card_content-text">
                            <i><u>Формула:</u></i>
                            <div class="formula formula-print inlineblock" id="formula_contest_1" data-items='[{"id":5, "name":"Name1", "coeff":"0.5"},{"id":6, "name":"Name2", "coeff":"0.4"}]'></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <!-- Modal - Update contest Info -->
        <form class="modal fade" id="editcontest_modal" role="dialog" method="post" action="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                        <h4 class="modal-title">Редактирование информации о конкурсе</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="input-field">
                                <input type="text" id="editcontest_name" name="name" value="">
                                <label for="editcontest_name" class="active">Название конкурса</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <textarea id="editcontest_description" name="description"></textarea>
                                <label for="editcontest_description" class="active">Описание конкурса</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <select multiple id="editcontest_judges" name="judges[]">

                                </select>
                                <label for="editcontest_judges">Жюри, которые будут оценивать этот конкурс</label>
                            </div>
                        </div>
                        <div class="row">
                            <!-- formula -->
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
    <script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/formula.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/contests.js"></script>

</div>