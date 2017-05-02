<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
    <link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.css?v=<?= filemtime("assets/vendor/sweetalert2/sweetalert2.min.css") ?>" />


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/members/jumbotron_navigation', array('id' => $event->id));; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">Список групп</h3>

        <!-- NewGroup Form-->
        <form method="POST" action="<?=URL::site('group/add/'. $event->id); ?>" class="form form_collapse" id="newgroup" enctype="multipart/form-data">
            <div class="form_body">
                <div class="col-xs-12 col-md-6">
                    <div class="row">
                        <div class="input-field">
                            <input id="newgroup_name" type="text" name="name" autocomplete="off">
                            <label for="newgroup_name">Введите название группы</label>
                        </div>
                    </div>
                    <div class="row hidden">
                        <div class="input-field">
                            <textarea id="newgroup_description" name="description"></textarea>
                            <label for="newgroup_description">Расскажите о группе</label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="row hidden">
                        <div class="radio-field clear_fix">
                            <label class="radio-label" >Группа состоит из</label>
                            <div class="radio-block">
                                <input type="radio" id="part" name="mode" checked>
                                <label for="part">участников</label>
                            </div>
                            <div class="radio-block">
                                <input type="radio" id="team" name="mode">
                                <label for="team">команд</label>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden">
                        <div id="show_participants" class="input-field">
                            <select name="participants[]" id="newgroup_participants" multiple="" class="elements_in_group">

                                    <? //foreach ($participants as $participant) : ?>
                                        <option value="<?//=$participant->id; ?>" data-logo="<?//=$participant->photo; ?>"><?//=$participant->name; ?></option>
                                    <? //endforeach; ?>

                            </select>
                            <label for="newgroup_participants">Состав группы</label>
                        </div>
                        <div id="show_teams" class="input-field displaynone">
                            <select name="teams[]" id="newgroup_teams" multiple="" class="elements_in_group">

                                    <? //foreach ($teams as $team) : ?>
                                        <option value="<?//=$team->id; ?>" data-logo="<?//=$team->logo; ?>"><?//=$team->name; ?></option>
                                    <?// endforeach; ?>

                            </select>
                            <label for="newgroup_teams">Состав группы</label>
                        </div>
                        <input type="hidden" name="id_event" value="<?=$event->id; ?>">
                        <input type="hidden" name="csrf" value="<?= Security::token(TRUE); ?>">
                    </div>
                </div>
            </div>
            <div class="form_submit hidden clear_fix">
                <button id="create_group" type="button" class="btn btn_primary col-xs-12 col-sm-auto pull-right">
                    Создать группу
                </button>
            </div>
        </form>

        <!-- List of Groups -->
        <div class="row row-col">
            <div class="col-xs-12">
                <? //foreach ($groups as $group) : ?>

                    <div class="card clear_fix" id="group_<?//=$group->id; ?>">
                        <div class="card_title">
                            <div class="card_title-text" id="name_group_<?//=$group->id; ?>">
                                <?//=$group->name; ?>
                            </div>
                            <div class="card_title-dropdown">
                                <div role="button" class="card_title-dropdown-icon">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </div>
                                <div class="card_title-dropdown-menu">
                                    <a class="card_title-dropdown-item edit">
                                        Изменить информацию
                                    </a>
                                    <a class="card_title-dropdown-item delete" data-pk="<?//=$group->id; ?>">
                                        Удалить группу
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card_content">
                            <p class="card_content-text">
                                <i><u>О группе:</u></i>
                                <span id="description_group_<?//=$group->id; ?>"><?//=$group->description; ?></span>
                            </p>
                            <p class="card_content-text">

                                <i><u>Состав группы:</u></i>

                                <?// if ($group->mode == Model_Groups::GROUP_TYPE_PARTICIPANTS) : ?>

                                    <!-- Participants in Groups, if they existed -->
                                    <span id="participants_group_<?//=$group->id; ?>">
                                        <?// foreach ($group->participants as $participant) : ?>
                                            <option value="<?//=$participant->id; ?>" data-logo="<?//=$participant->photo; ?>"><?//=$participant->name; ?></option>
                                        <?// endforeach;?>

                                    </span>

                                <? //else: ?>

                                    <!-- Teams in Groups, if they existed -->
                                    <span id="teams_group_<?//=$group->id; ?>">
                                        <? //foreach ($group->teams as $team) : ?>
                                            <option value="<?//=$team->id; ?>" data-logo="<?//=$team->logo; ?>"><?//=$team->name; ?></option>
                                        <?// endforeach;?>
                                    </span>

                                <?// endif; ?>

                            </p>
                        </div>
                    </div>
                <?// endforeach; ?>

            </div>
        </div>

        <input type="hidden" id="event_id" value="">

        <!-- Modal - Update Group Info -->
        <form class="modal fade" id="editgroup_modal" tabindex="-1" role="dialog" aria-labelledby="" method="post" action="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                        <h4 class="modal-title">Редактирование информации о группе</h4>
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
                                <textarea id="editgroup_description" name="description"></textarea>
                                <label for="editgroup_description" class="active">Описание группы</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <!-- [part || team] in group + [part || team] not_distributed -->
                                <select name="members[]" multiple id="editgroup_members">

                                </select>
                                <label for="editgroup_members">Состав группы</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_default" data-dismiss="modal">Отмена</button>
                        <button id="update-info" type="button" class="btn btn_primary">Сохранить изменения</button>
                    </div>

                    <input type="hidden" name="csrf" value="<?= Security::token(TRUE); ?>">

                </div>
            </div>
        </form>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/i18n/ru.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/groups.js"></script>

</div>