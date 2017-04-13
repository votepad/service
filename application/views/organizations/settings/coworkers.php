<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/tabs.css?v=<?= filemtime("assets/frontend/modules/css/tabs.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">


    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('organizations/blocks/jumbotron_wrapper', array('organization' => $organization)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">
            Список сотрудников
        </h3>

        <?= Form::hidden('org_id', $organization->id, array('id' => 'org_id')) ?>

        <div class="block" >
            <ul class="tabs__header">
                <li>
                    <a role="button" data-toggle="tabs" data-block="coworkers" class="tabs__btn tabs__btn--active">Состоят в организации
                        <span id="countCowerkers" class="tabs__count"><?= count($organization->team); ?></span>
                    </a>
                </li>
                <? if(count($organization->requests)): ?>
                <li>
                    <a role="button" data-toggle="tabs" data-block="newCoworkers" class="tabs__btn">Новые заявки
                        <span class="tabs__count"><?= count($organization->requests); ?></span>
                    </a>
                </li>
                <? endif; ?>
                <button data-href="http://votepad.ru/organization/<?= $organization->id ?>" id="inviteBtn" class="tabs__btn btn btn_primary fl_r">Пригласить</button>
            </ul>
            <div class="tabs__content clear_fix">

                <div id="coworkers" class="tabs__block tabs__block--active">

                    <? foreach ($organization->team as $member): ?>
                        <div id="coworker_id<?= $member->id ?>" class="item col-xs-12 col-md-6">

                            <a class="item__img-wrap" href="<?=URL::site('user/'. $member->id);?>">
                                <img class="item__img" alt="Co-worker" src="/uploads/profiles/avatar/<?=$member->avatar; ?>">
                            </a>

                            <div class="item__info">
                                <div class="item__info-name">
                                    <a href="<?= URL::site('user/' . $member->id); ?>"><?= $member->surname . ' ' . $member->name . ' ' . $member->lastname; ?></a>
                                </div>
                                <div class="item__info-additional">
                                    <span><?= $member->email; ?></span>
                                    <span><?= $member->phone; ?></span>
                                </div>
                                <? if (!$organization->isOwner($member->id)): ?>
                                    <div class="item__info-controls clear_fix">
                                        <button data-id="<?= $member->id; ?>" data-name="<?= $member->surname . ' ' . $member->name; ?>" class="btn btn_default deletebtn">Исключить</button>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>

                    <? endforeach; ?>

                </div>

                <? if(count($organization->requests)): ?>
                <div id="newCoworkers" class="tabs__block">

                    <? foreach ($organization->requests as $request): ?>
                        <div id="coworker_id<?= $request->id; ?>" class="item col-xs-12 col-md-6">

                            <a class="item__img-wrap" href="<?= URL::site('user/' . $request->id); ?>">
                                <img class="item__img" alt="Co-worker" src="/uploads/profiles/avatar/<?=$request->avatar; ?>">
                            </a>

                            <div class="item__info">
                                <div class="item__info-name">
                                    <a href="<?= URL::site('user/' . $request->id); ?>"><?= $request->surname . ' ' . $request->name . ' ' . $request->lastname; ?></a>
                                </div>
                                <div class="item__info-additional">
                                    <span><?= $request->email; ?></span>
                                    <span><?= $request->phone; ?></span>
                                </div>
                                <div class="item__info-controls clear_fix">
                                    <button data-id="<?= $request->id ?>" class="btn btn_primary acceptbtn">Принять заявку</button>
                                    <button data-id="<?= $request->id ?>" class="btn btn_default cancelbtn">Отклонить</button>
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
    <script type="text/javascript" src="<?=$assets; ?>static/js/organization/settings-coworkers.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            vp.tabs.init();
        });
    </script>

</div>