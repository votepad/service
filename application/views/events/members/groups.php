<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/groups.js"></script>

<h3 class="page-header">Список групп</h3>

<form method="POST" action="" class="form form_collapse" id="new_group" enctype="multipart/form-data">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="name-0" type="text" name="name" autocomplete="off">
                    <label for="name-0">Введите название группы</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="description-0" name="description"></textarea>
                    <label for="description-0">Расскажите о группе</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row hidden">
                <div class="input-field">
                    <select name="participants[]" id="participants-0" multiple="" class="participants_in_group">

                            <option value="0">Участник 1</option>
                            <option value="1">Участник 2</option>

                    </select>
                    <label for="participants-0">Состав группы</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <label class="btn btn_default btn_labeled col-xs-12 col-sm-auto" for="logo-0">
            <span class="btn_label">
                <i class="fa fa-paperclip" aria-hidden="true"></i>
            </span>
        	<span class="btn_text">Выбрать логотип</span>
            <input id="logo-0" type="file" name="logo" accept="image/*">
        </label>
        <button id="create_group" type="button" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
        	Создать группу
        </button>
    </div>
</form>

<div class="row row-col">
    <div class="col-xs-12">
        <div class="card clear_fix" action="" id="group-1">
            <div class="card_image" id="logo_group-1">
                <img src="/uploads/groups/" alt="">
            </div>
            <div class="card_title">
                <div class="card_title-text" id="name_group-1">
                    Группа 1
                </div>
                <div class="card_title-dropdown">
                    <div id="create_group" role="button" class="card_title-dropdown-icon">
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
                <span id="description_group-1">вавыаывавыаы</span>
                </div>
                <p class="card_content-text">
                    <i><u>Состав группы:</u></i>
                    <span id="participants_group-1">

                        <option value="" data-logo="">участник 1</option>

                    </span>
                </p>
            </div>
        </div>

        <input type="hidden" id="event_id" value="<?=$event->id; ?>">
    </div>
</div>

<!-- Modal - Update Group Info -->
<form class="modal fade" id="editgroup_modal" tabindex="-1" role="dialog" aria-labelledby="" method="post" action="">
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
                        <input type="text" id="editgroup_name" name="name" value="">
                        <label for="editgroup_name" class="active">Название группы</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <textarea id="editgroup_about" name="description"></textarea>
                        <label for="editgroup_about" class="active">Описание группы</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <select multiple id="editgroup_part" name="participants">
                            <!-- options -->
                        </select>
                        <label for="editgroup_part">Состав группы</label>
                    </div>
                </div>
                <label class="btn btn_default btn_labeled" for="editgroup_logo">
                    <span class="btn_label">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <span class="btn_text">Выбрать логотип</span>
                    <input type="file" id="editgroup_logo" name="logo" accept="image/*">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                <button id="update-info" type="button" class="btn btn_primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</form>
