<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>


<link href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sortable/Sortable.js"></script>



<script type="text/javascript" src="<?=$assets; ?>js/event/stages.js"></script>


<h3 class="page-header">
    Список этапов
    <br>
    <small>Придумайте этапы. В каждом этапе необходимо составить формулу из критериев, по которой будет формироваться балл.</small>
</h3>

<!-- Create New Stage -->
<form method="POST" action="" class="form form_collapse" id="newstage" enctype="multipart/form-data">
    <div class="form_body">
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
                <div class="input-field">
                    <input id="newstage_formula" type="hidden" name="formula" value="">
                    <ul id="newstage_formula_area" class="dragable-inputarea">

                    </ul>
                    <label for="newstage_formula" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, расположеные ниже">Задайте формулу</label>
                </div>
            </div>

            <div role="separator" class="divider"></div>

            <div id="newstage_drop" class="drop">

                <!-- Droparea remove area -->
                <div id="newstage_droparea" class="drop-area">
                    <i class="fa fa-4x fa-trash-o valign" aria-hidden="true"></i>
                </div>

                <!-- Coefficients -->
                <div class="row hidden">
                    <span class="dragable-label">Весовые коэффициенты:</span>
                    <ul id="newstage_coeff" class="dragable-area">
                        <li class="item" data-val="count_judges">Колисество жюри</li>
                        <li class="item dark" data-val="coeff_0.5">0.5</li>
                        <li class="item dark" data-val="coeff_0.7">0.7</li>
                        <li class="item dark" data-val="coeff_0.9">0.9</li>
                    </ul>
                    <button type="button" class="coeff-add" onclick="addcoeff(newstage_coeff)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>

                <!-- Math Symbols -->
                <div class="row hidden">
                    <span class="dragable-label">Алгебраические операции:</span>
                    <ul id="newstage_math" class="dragable-area">
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
                    <span class="dragable-label">Спосик критериев:</span>
                    <ul id="newstage_criterias" class="dragable-area">
                        <li class="item" data-val="id_1">Балл за "Креативность выступления"</li>
                        <li class="item" data-val="id_2">Балл за "Артистичность"</li>
                        <li class="item" data-val="id_3">Балл за "Выступление"</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <button id="create_stage" type="button" class="btn btn_primary col-sm-12 col-md-auto pull-right">
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
                <p class="card_content-text">
                    <i><u>Об этапе:</u></i>
                    <span id="description_stage_1">описание этапа №1</span>
                </p>
                <p class="card_content-text">
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
                </p>
                <div class="card_content-text" style="font-size: .9em;margin: 0 0 10px;">
                    <i><u>Формула подсчета баллов:</u></i>
                    <input id="formula_input_stage_1" type="hidden" data-val="[math0, coeff_0.5, math4, id_1, math2, coeff_0.9, math4, id_2, math2, coeff_1.5, math4, id_3, math1, math5, count_judges]">
                    <ul id="formula_area_stage_1" class="formula">
                        <li class="item dark" data-val="math0"><span class="icon-bracket-left"></span></li>
                        <li class="item dark" data-val="coeff_0.5">0.5</li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item" data-val="id_1">Балл за "Креативность выступления"</li>
                        <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                        <li class="item dark" data-val="coeff_0.9">0.9</li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item" data-val="id_2">Балл за "Артистичность"</li>
                        <li class="item dark" data-val="math2"><span class="icon-plus"></span></li>
                        <li class="item dark" data-val="coeff_1.5">1.5</li>
                        <li class="item dark" data-val="math4"><span class="icon-multiply"></span></li>
                        <li class="item" data-val="id3">Балл за "Профессионализм"</li>
                        <li class="item dark" data-val="math1"><span class="icon-bracket-right"></span></li>
                        <li class="item dark" data-val="math5"><span class="icon-divide"></span></li>
                        <li class="item" data-val="count_judges">Количество жюри</li>
                    </ul>
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
                        <ul id="editstage_formula_area" class="dragable-inputarea">

                        </ul>
                        <label for="editstage_formula_area" data-toggle="tooltip" data-placement="right" title="Перетащите требуемые элементы, расположеные ниже">Задайте формулу</label>
                    </div>

                    <div role="separator" class="divider"></div>

                    <div id="editstage_drop" class="drop">

                        <!-- Droparea remove area -->
                        <div id="editstage_droparea" class="drop-area">
                            <i class="fa fa-4x fa-trash-o valign" aria-hidden="true"></i>
                        </div>

                        <!-- Coefficients -->
                        <div class="row">
                            <span class="dragable-label">Весовые коэффициенты:</span>
                            <ul id="editstage_coeff" class="dragable-area">
                                <li class="item" data-val="count_judges">Колисество жюри</li>
                                <li class="item dark" data-val="coeff_0.5">0.5</li>
                                <li class="item dark" data-val="coeff_0.7">0.7</li>
                                <li class="item dark" data-val="coeff_0.9">0.9</li>
                            </ul>
                            <button type="button" class="coeff-add" onclick="addcoeff(editstage_coeff)" data-toggle="tooltip" data-placement="right" title="Добавить"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>

                        <!-- Math Symbols -->
                        <div class="row hidden">
                            <span class="dragable-label">Алгебраические операции:</span>
                            <ul id="editstage_math" class="dragable-area">
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
                            <span class="dragable-label">Спосик критериев:</span>
                            <ul id="editstage_criterias" class="dragable-area">
                                <li class="item" data-val="id_1">Балл за "Креативность выступления"</li>
                                <li class="item" data-val="id_2">Балл за "Артистичность"</li>
                                <li class="item" data-val="id_3">Балл за "Выступление"</li>
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
