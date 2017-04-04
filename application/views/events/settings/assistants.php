<!-- =============== PAGE STYLE ===============-->
<link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
<link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/tabs.css?v=<?= filemtime("assets/frontend/modules/css/tabs.css") ?>">
<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<div class="jumbotron block">

    <!-- Jumbotron Wrapper -->
    <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

    <!-- Jumbotron Navigation -->
    <div class="jumbotron_nav">
        <?=$jumbotron_navigation; ?>
    </div>

</div>

<section>
    <h3 class="page-header">
        Список сотрудников
    </h3>

    <?= Form::hidden('event_id', $event->id, array('id' => 'event_id')) ?>

    <div class="block" >
        <ul class="tabs__header">

            <li id="">
                <a data-toggle="tabs" data-block="assistants" class="tabs__btn tabs__btn--active">Участвуют в проведении
                    <span id="countAssistans" class="tab__count"><?= count($event->assistants) ?></span>
                </a>
            </li>

            <? if (!empty($requests)) : ?>
            <li id="">
                <a data-toggle="tabs" data-block="newAssistants" class="tabs__btn">Новые заявки
                    <span class="tab__count"><?= count($requests) ?></span>
                </a>
            </li>
            <? endif; ?>

            <button data-href="<?= $_SERVER['HTTP_HOST'] . $invite_link ?>" id="inviteBtn" class="tabs__btn btn btn_primary fl_r">Пригласить</button>

        </ul>


        <div class="tabs__content clear_fix">

            <div id="assistants" class="tabs__block tabs__block--active">

                <? foreach($event->assistants as $user): ?>
                    <div id="assistant_id<?= $user->id ?>" class="item col-xs-12 col-md-6">

                        <a class="item__img-wrap" href="">
                            <img class="item__img" alt="Assistant" src="">
                        </a>

                        <div class="item__info">
                            <div class="item__info-name">
                                <a href="/user/<?= $user->id ?>"><?= $user->surname . ' ' . $user->name . ' ' . $user->lastname ?></a>
                            </div>
                            <div class="item__info-additional">
                                <span><?= $user->email; ?></span>
                                <span><?= $user->phone ?></span>
                            </div>
                            <? if (!$event->isCreator($user->id)) :?>
                            <div class="item__info-controls clear_fix">
                                <button data-id="<?= $user->id ?>" data-name="<?= $user->surname . ' ' . $user->name; ?>" class="btn btn_default deletebtn">Исключить</button>
                            </div>
                            <? endif; ?>

                        </div>
                    </div>
                <? endforeach; ?>

            </div>

            <? if (!empty($requests)) : ?>
                <div id="newAssistants" class="tabs__block">

                    <? foreach($requests as $user): ?>
                        <div id="assistant_id<?= $user->id ?>" class="item col-xs-12 col-md-6">

                            <a class="item__img-wrap" href="">
                                <img class="item__img" alt="Co-worker" src="">
                            </a>

                            <div class="item__info">
                                <div class="item__info-name">
                                    <a href="/user/<?= $user->id ?>"><?= $user->surname . ' ' . $user->name . ' ' . $user->lastname ?></a>
                                </div>
                                <div class="item__info-additional">
                                    <span><?= $user->email; ?></span>
                                    <span><?= $user->phone ?></span>
                                </div>

                                <div class="item__info-controls clear_fix">
                                    <button data-id="<?= $user->id ?>" class="btn btn_primary acceptbtn">Принять заявку</button>
                                    <button data-id="<?= $user->id ?>" class="btn btn_text cancelbtn">Отклонить</button>
                                </div>

                            </div>
                        </div>
                    <? endforeach; ?>

                </div>
            <? endif; ?>

        </div>
    </div>
</section>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event/settings-assistants.js"></script>
<script>
    vp.tabs.init();
</script>