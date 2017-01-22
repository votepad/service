<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>


<link href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sortable/Sortable.js"></script>



<script type="text/javascript" src="<?=$assets; ?>js/event/contests.js"></script>


<h3 class="page-header">
    Список конкурсов
    <br>
    <small>Создайте конкурсы. Конкурс это некое объединение этапов, на которых присутствуют выбранные представители жюри.</small>
</h3>

<!-- Create New contest -->
<form method="POST" action="" class="form form_collapse" id="newcontest" enctype="multipart/form-data">
    <div class="form_body">
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
            </div>

            <div class="row hidden">
                <div class="input-field">
                    <input id="newcontest_formula" type="hidden" name="formula" value="">
                    <ul id="newcontest_formula_area" class="dragable-inputarea">

                    </ul>
                    <label for="newcontest_formula" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, расположеные ниже">Задайте формулу</label>
                </div>
            </div>

            <div role="separator" class="divider"></div>

            <div id="newcontest_drop" class="drop">

                <!-- Droparea remove area -->
                <div id="newcontest_droparea" class="drop-area">
                    <i class="fa fa-4x fa-trash-o valign" aria-hidden="true"></i>
                </div>

                <!-- Coefficients -->
                <div class="row hidden">
                    <span class="dragable-label">Весовые коэффициенты:</span>
                    <ul id="newcontest_coeff" class="dragable-area">
                        <li class="item dark" data-val="coeff_0.5">0.5</li>
                        <li class="item dark" data-val="coeff_0.7">0.7</li>
                        <li class="item dark" data-val="coeff_0.9">0.9</li>
                    </ul>
                    <button type="button" class="coeff-add" onclick="addcoeff(newcontest_coeff)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>

                <!-- Math Symbols -->
                <div class="row hidden">
                    <span class="dragable-label">Алгебраические операции:</span>
                    <ul id="newcontest_math" class="dragable-area">
                        <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                        <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                        <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                        <li class="item dark" data-val="math3"><span class="icon-minus"></span></li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                    </ul>
                </div>

                <!-- Criterias -->
                <div class="row hidden">
                    <span class="dragable-label">Спосик этапов:</span>
                    <ul id="newcontest_criterias" class="dragable-area">
                        <li class="item" data-val="id_1">Балл за "Этап №1"</li>
                        <li class="item" data-val="id_2">Балл за "Этап №2"</li>
                        <li class="item" data-val="id_3">Балл за "Этап №3"</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <button id="create_contest" type="button" class="btn btn_primary col-sm-12 col-md-auto pull-right">
        	Создать конкурс
        </button>
    </div>
</form>

<!-- Existed contests -->
<div class="row row-col">
    <div class="col-sm-12">

        <!-- contest 1 -->
        <div class="card clear_fix" action="" id="contest_1">
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
                <p class="card_content-text">
                    <i><u>О конкурсе:</u></i>
                    <span id="description_contest_1">описание конкурса №1</span>
                </p>
                <p class="card_content-text">
                    <i><u>Жюри, которые будут оценивать этот конкурс:</u></i>
                    <!-- Judges in contest -->
                    <span id="judges_contest_1">
                        <option value="1">Жюри 1</option>
                        <option value="2">Жюри 2</option>
                    </span>
                </p>
                <div class="card_content-text" style="font-size:.9em;margin: 0 0 10px;">
                    <i><u>Формула подсчета баллов:</u></i>
                    <input id="formula_input_contest_1" type="hidden" data-val="[coeff_0.5, math4, id_1, math2, coeff_0.9, math4, id_2, math2, id_3]">
                    <ul id="formula_area_contest_1" class="formula">
                        <li class="item dark" data-val="coeff_0.5">0.5</li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item" data-val="id_1">Балл за "этап №1"</li>
                        <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                        <li class="item dark" data-val="coeff_0.9">0.9</li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item" data-val="id_2">Балл за "этап №2"</li>
                        <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                        <li class="item" data-val="id3">Балл за "этап №3"</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<input type="hidden" id="event_id" value="5">

<!-- Modal - Update contest Info -->
<form class="modal fade" id="editcontest_modal" role="dialog" aria-labelledby="" method="post" action="">
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
                        <select multiple id="editcontest_judges" name="members">

                        </select>
                        <label for="editcontest_judges">Жюри, которые будут оценивать этот конкурс</label>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field">
                        <input id="editcontest_formula" type="hidden" name="formula" value="">
                        <ul id="editcontest_formula_area" class="dragable-inputarea">

                        </ul>
                        <label for="editcontest_formula_area" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, расположеные ниже">Задайте формулу</label>
                    </div>

                    <div role="separator" class="divider"></div>

                    <div id="editcontest_drop" class="drop">

                        <!-- Droparea remove area -->
                        <div id="editcontest_droparea" class="drop-area">
                            <i class="fa fa-4x fa-trash-o valign" aria-hidden="true"></i>
                        </div>

                        <!-- Coefficients -->
                        <div class="row">
                            <span class="dragable-label">Весовые коэффициенты:</span>
                            <ul id="editcontest_coeff" class="dragable-area">
                                <li class="item dark" data-val="coeff_0.5">0.5</li>
                                <li class="item dark" data-val="coeff_0.7">0.7</li>
                                <li class="item dark" data-val="coeff_0.9">0.9</li>
                            </ul>
                            <button type="button" class="coeff-add" onclick="addcoeff(editcontest_coeff)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>

                        <!-- Math Symbols -->
                        <div class="row hidden">
                            <span class="dragable-label">Алгебраические операции:</span>
                            <ul id="editcontest_math" class="dragable-area">
                                <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                                <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                                <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                                <li class="item dark" data-val="math3"><span class="icon-minus"></span></li>
                                <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                                <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                            </ul>
                        </div>

                        <!-- Criterias -->
                        <div class="row">
                            <span class="dragable-label">Спосик этапов:</span>
                            <ul id="editcontest_criterias" class="dragable-area">
                                <li class="item" data-val="id_1">Балл за "этап №1"</li>
                                <li class="item" data-val="id_2">Балл за "этап №2"</li>
                                <li class="item" data-val="id_3">Балл за "этап №3"</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                <button id="update_info" type="button" class="btn btn_primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</form>
