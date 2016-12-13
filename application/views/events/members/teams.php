<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-transition.js"></script>

<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>

<script type="text/javascript" src="<?=$assets; ?>js/event/teams.js"></script>

<h3 class="page-header">Список команд</h3>

<form method="POST" action="<?=URL::site('teams/add/' . $event->id); ?>" class="form form_collapse" id="new_team" enctype="multipart/form-data">
    <div class="form_body">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="input-field">
                    <input id="name-0" type="text" name="name" autocomplete="off">
                    <label for="name-0">Введите название команды</label>
                </div>
            </div>
            <div class="row hidden">
                <div class="input-field">
                    <textarea id="description-0" name="description"></textarea>
                    <label for="description-0">Расскажите о команде</label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row hidden">
                <div class="input-field">
                    <select name="participants[]" id="participants-0" multiple="" class="participants_in_team">
                        <? foreach ($participants as $participant): ?>
                            <option value="<?=$participant->id; ?>"><?=$participant->name; ?></option>
                        <? endforeach; ?>
                    </select>
                    <label for="participants-0">Состав команды</label>
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
        <button id="create_team" type="button" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
        	Создать команду
        </button>
    </div>
</form>

<div class="row row-col">
    <div class="col-xs-12">

        <? foreach ($teams as $team) : ?>
            <div class="card clear_fix" action="" id="team-<?=$team->id;?>">
                <div class="card_image" id="logo_team-1">
                    <img src="/uploads/teams/<?=$team->logo; ?>" alt="">
                </div>
                <div class="card_title">
                    <div class="card_title-text" id="name_team-<?=$team->id; ?>">
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
                <div class="card_content">
                    <div class="card_content-text">
                        <i><u>О команде:</u></i>
                    <span id="description_team-<?=$team->id; ?>"><?=$team->description; ?></span>
                    </div>
                    <p class="card_content-text">
                        <i><u>Состав команды:</u></i>
                    <span id="participants_team-1">
                        <? foreach ($team->participants as $members) : ?>
                            <option value=""><?=$members->name; ?></option>
                        <? endforeach; ?>
                    </span>
                    </p>
                </div>
            </div>
        <? endforeach; ?>
        <input type="hidden" id="event_id" value="<?=$event->id; ?>">
    </div>
</div>