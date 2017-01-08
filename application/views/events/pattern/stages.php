<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/stages.js"></script>


<h3 class="page-header">
    Список этапов
    <br>
    <small>Придумайте этапы. В каждом этапе необходимо составить формулу из критериев, по которой будет формироваться балл за этап.</small>
</h3>

<form method="POST" action="" class="form form_collapse" id="new_stage" enctype="multipart/form-data">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="name-0" type="text" name="name" autocomplete="off">
                    <label for="name-0">Введите название этапа</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="description-0" name="description"></textarea>
                    <label for="description-0">Расскажите </label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
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
                        <label for="team">группы</label>
                    </div>
                </div>
            </div>
            <div class="row hidden">
                <div id="show_participants" class="input-field">
                    <select name="participants[]" id="participants-0" multiple="" class="elements_in_stage">

                            <option value="0" data-logo="">Участник 1</option>
                            <option value="1" data-logo="">Участник 2</option>

                    </select>
                    <label for="participants-0">Выберите участников</label>
                </div>
                <div id="show_teams" class="input-field displaynone">
                    <select name="teams[]" id="team-0" multiple="" class="elements_in_stage">

                            <option value="0">Команда 1</option>
                            <option value="1">Команда 2</option>

                    </select>
                    <label for="team-0">Выберите команды</label>
                </div>
                <div id="show_groups" class="input-field displaynone">
                    <select name="groups[]" id="group-0" multiple="" class="elements_in_stage">

                            <option value="0">Команда 1</option>
                            <option value="1">Команда 2</option>

                    </select>
                    <label for="team-0">Выберите команды</label>
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

<div class="row row-col">
    <div class="col-xs-12">
        <div class="card clear_fix" action="" id="stage-1">
            <div class="card_image" id="logo_stage-1">
                <img src="/uploads/stages/" alt="">
            </div>
            <div class="card_title">
                <div class="card_title-text" id="name_stage-1">
                    Название Группы 1
                </div>
                <div class="card_title-dropdown">
                    <div id="create_stage" role="button" class="card_title-dropdown-icon">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </div>
                    <div class="card_title-dropdown-menu">
                        <a class="card_title-dropdown-item edit">
                            Изменить информацию
                        </a>
                        <a class="card_title-dropdown-item delete" data-pk="">
                            Удалить группу
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_content">
                <div class="card_content-text">
                    <i><u>О группе:</u></i>
                <span id="description_stage-1">описание группы №1</span>
                </div>
                <p class="card_content-text">
                    <i><u>Состав группы:</u></i>
                    <span id="participants_stage-1">
                        <option value="0" data-logo="">Участник 1</option>
                        <option value="1" data-logo="">Участник 2</option>
                    </span>
                    <span id="teams_stage-1">

                    </span>
                </p>
            </div>
        </div>

        <div class="card clear_fix" action="" id="stage-2">
            <div class="card_image" id="logo_stage-2">
                <img src="/uploads/stages/" alt="">
            </div>
            <div class="card_title">
                <div class="card_title-text" id="name_stage-2">
                    Название Группы 2
                </div>
                <div class="card_title-dropdown">
                    <div id="create_stage" role="button" class="card_title-dropdown-icon">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </div>
                    <div class="card_title-dropdown-menu">
                        <a class="card_title-dropdown-item edit">
                            Изменить информацию
                        </a>
                        <a class="card_title-dropdown-item delete" data-pk="">
                            Удалить группу
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_content">
                <div class="card_content-text">
                    <i><u>О группе:</u></i>
                <span id="description_stage-2">описание группы №2</span>
                </div>
                <p class="card_content-text">
                    <i><u>Состав группы:</u></i>
                    <span id="participants_stage-2">

                    </span>
                    <span id="teams_stage-2">
                        <option value="0" data-logo="">Команда 1</option>
                        <option value="1" data-logo="">Команда 2</option>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="event_id" value="5">

<!-- Modal - Update stage Info -->
<form class="modal fade" id="editstage_modal" tabindex="-1" role="dialog" aria-labelledby="" method="post" action="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title" id="">Редактирование информации о группе</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="input-field">
                        <input type="text" id="editstage_name" name="name" value="">
                        <label for="editstage_name" class="active">Название группы</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <textarea id="editstage_about" name="description"></textarea>
                        <label for="editstage_about" class="active">Описание группы</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <select multiple id="editstage_members" name="members">
                            <!-- options -->
                        </select>
                        <label for="editstage_members">Состав группы</label>
                    </div>
                </div>
                <label class="btn btn_default btn_labeled" for="editstage_logo">
                    <span class="btn_label">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <span class="btn_text">Выбрать логотип</span>
                    <input type="file" id="editstage_logo" name="logo" accept="image/*">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                <button id="update-info" type="button" class="btn btn_primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</form>
