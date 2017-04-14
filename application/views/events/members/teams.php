<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css?v=<?= filemtime("assets/vendor/sweetalert2/sweetalert2.min.css") ?>" />


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
           <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">Список команд</h3>

        <form method="POST" action="<?=URL::site('teams/add/' . $event->id); ?>" class="form form_collapse" id="newteam" enctype="multipart/form-data">
            <div class="form_body clear_fix">
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="input-field">
                            <input id="newteam_name" type="text" name="name" autocomplete="off">
                            <label for="newteam_name">Введите название новой команды</label>
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
                <button type="submit" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
                    Создать команду
                </button>
            </div>
            <?=Form::hidden('csrf', Security::token()); ?>
        </form>

        <div class="row row-col">
            <div class="col-xs-12">

                <? foreach ($teams as $team) : ?>
                    <card class="card clear_fix" id="team_<?=$team->id;?>">
                        <div class="card_image" id="logo_team_<?=$team->id;?>">
                            <img src="/uploads/teams/<?=$team->logo; ?>" alt="">
                        </div>
                        <div class="card_withimage card_title">
                            <div class="card_title-text" id="name_team_<?=$team->id; ?>">
                                <?=$team->name; ?>
                            </div>
                            <div class="card_title-dropdown">
                                <div role="button" class="card_title-dropdown-icon">
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
                                <select name="participants[]" id="editteam_part" multiple="">
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
                        <button type="submit" class="btn btn_primary">Сохранить изменения</button>
                    </div>

                    <input type="hidden" id="editteam_identity" name="id_team" value="">
                    <?=Form::hidden('csrf', Security::token())?>

                </div>
            </div>
        </form>

    </section>


    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/teams.js"></script>

</div>