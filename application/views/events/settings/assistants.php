<!-- =============== PAGE STYLES ===============-->

<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
    Список сотрудников
</h3>

<div class="block" >
    <ul class="tabs tabs_header clear_fix">
        <li id="">
            <a data-ui="tabs" aria-controls="assistants" class="tab tab--active">Участвуют в проведении
                <span id="" class="tab_count"><?= count($event->assistants) ?></span>
            </a>
        </li>
        
        <li id="">
            <a data-ui="tabs" aria-controls="newAssistants" class="tab">Новые заявки
                <span class="tab_count"><?= count($requests) ?></span>
            </a>
        </li>
        
        <button data-href="<?= $_SERVER['HTTP_HOST'] . $invite_link ?>" id="inviteBtn" class="btn btn_primary tab_btn">Пригласить</button>
    </ul>
    <div class="tabs_content clear_fix">

        <div id="assistants" class="tab_block tab_block--active">

            <? foreach($event->assistants as $user): ?>
                <div id="assistant_id<?= $user->id ?>" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/<?= $user->id ?>"><?= $user->surname . ' ' . $user->name . ' ' . $user->lastname ?></a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span><?= $user->email; ?></span>
                            <span><?= $user->phone ?></span>
                        </div>
                        
                        <div class="coworker_controls clear_fix">
                            <button data-id="<?= $user->id ?>" data-name="FI" class="btn btn_default deletebtn">Исключить</button>
                        </div>
                        
                    </div>
                </div>
            <? endforeach; ?>

        </div>

        
        <div id="newAssistants" class="tab_block">

            <? foreach($requests as $user): ?>
                <div id="assistant_id<?= $user->id ?>" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/<?= $user->id ?>"><?= $user->surname . ' ' . $user->name . ' ' . $user->lastname ?></a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span><?= $user->email; ?></span>
                            <span><?= $user->phone ?></span>
                        </div>

                        <div class="coworker_controls clear_fix">
                            <button data-id="<?= $user->id ?>" class="btn btn_primary acceptbtn">Принять заявку</button>
                            <button data-id="<?= $user->id ?>" class="btn btn_text cancelbtn">Отклонить</button>
                        </div>

                    </div>
                </div>
            <? endforeach; ?>

        </div>

    </div>
</div>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>

<!-- modules -->
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/ajax.js"></script>
<script type="text/javascript">
    tabs.init();
</script>
