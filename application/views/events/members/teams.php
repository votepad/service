<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/teams.js"></script>

<h3 class="page-header">Список команд</h3>

<form method="POST" action="<?=URL::site('teams/add/' . $event->id); ?>" class="form form_collapse" id="newteam" enctype="multipart/form-data">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="newteam_name" type="text" name="name" autocomplete="off">
                    <label for="newteam_name">Введите название команды</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="newteam_description" name="description"></textarea>
                    <label for="newteam_description">Расскажите о команде</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row hidden">
                <div class="input-field">
                    <select name="participants[]" id="newteam_participants" multiple="" class="participants_in_team">
                        <? foreach ($participants as $participant): ?>
                            <option value="<?=$participant->id; ?>" data-logo="<?=$participant->photo; ?>"><?=$participant->name; ?></option>
                        <? endforeach; ?>
                    </select>
                    <label for="newteam_participants">Состав команды</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form_submit hidden clear_fix">
        <label class="btn btn_default btn_labeled col-xs-12 col-sm-auto" for="newteam_logo">
            <span class="btn_label">
                <i class="fa fa-paperclip" aria-hidden="true"></i>
            </span>
        	<span class="btn_text">Выбрать логотип</span>
            <input id="newteam_logo" type="file" name="logo" accept="image/*">
        </label>
        <button id="create_team" type="button" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
        	Создать команду
        </button>
    </div>
</form>

<div class="row row-col">
    <div class="col-xs-12">

        <? foreach ($teams as $team) : ?>
            <card class="card clear_fix" id="team_<?=$team->id;?>">
                <div class="card_image" id="logo_team_1">
                    <img src="/uploads/teams/<?=$team->logo; ?>" alt="">
                </div>
                <div class="card_withimage card_title">
                    <div class="card_title-text" id="name_team_<?=$team->id; ?>">
                        <?=$team->name; ?>
                    </div>
                    <div class="card_title-dropdown">
                        <div id="create_team" role="button" class="card_title-dropdown-icon">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </div>
                        <div class="card_title-dropdown-menu">
                            <a class="card_title-dropdown-item edit">
                                Изменить информацию
                            </a>
                            <a class="card_title-dropdown-item delete" data-pk="<?=$team->id; ?>">
                                Удалить команду
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card_withimage card_content">
                    <p class="card_content-text">
                        <i><u>О команде:</u></i>
                    <span id="description_team_<?=$team->id; ?>"><?=$team->description; ?></span>
                    </p>
                    <p class="card_content-text">
                        <i><u>Состав команды:</u></i>
                    <span id="participants_team_<?=$team->id; ?>">
                        <? foreach ($team->participants as $members) : ?>
                            <option value="<?=$members->id; ?>"  data-logo="<?=$members->photo; ?>" selected=""><?=$members->name; ?></option>
                        <? endforeach; ?>
                    </span>
                    </p>
                </div>
            </card>
        <? endforeach; ?>

    </div>
</div>

<input type="hidden" id="event_id" value="<?=$event->id; ?>">

<!-- Modal - Update Team Info -->
<form action="<?=URL::site('teams/edit/' . $event->id); ?>" method="POST" class="modal fade" id="editteam_modal" tabindex="-1" role="dialog" aria-labelledby="" method="post" action="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title" id="">Редактирование информации о команде</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="input-field">
                        <input type="text" id="editteam_name" name="name" value="">
                        <label for="editteam_name" class="active">Название команды</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <textarea id="editteam_description" name="description"></textarea>
                        <label for="editteam_description" class="active">Описание команды</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <select multiple id="editteam_part" name="participants">
                            <!-- participants_in_team + participants_NOT_in_team -->
                        </select>
                        <label for="editteam_part">Состав команды</label>
                    </div>
                </div>
                <label class="btn btn_default btn_labeled" for="editteam_logo">
                    <span class="btn_label">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <span class="btn_text">Выбрать логотип</span>
                    <input type="file" id="editteam_logo" name="logo" accept="image/*">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                <button id="update_info" type="button" class="btn btn_primary">Сохранить изменения</button>
            </div>

            <input type="hidden" id="editteam_identity" name="id_team" value="">
            <input type="hidden" name="csrf" value="<?= Security::token(TRUE); ?>">

        </div>
    </div>
</form>
