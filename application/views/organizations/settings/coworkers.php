<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

<h3 class="page-header">
	Список сотрудников
</h3>

<?= Form::hidden('org_id', $organization->id, array('id' => 'org_id')) ?>

<div class="block" >
	<ul class="tabs tabs_header clear_fix">
	    <li id="">
	        <a data-ui="tabs" aria-controls="coworkers" class="tab tab--active">Состоят в организации
				<span class="tab_count"><?= count($organization->team); ?></span>
			</a>
	    </li>
	    <li id="">
	        <a data-ui="tabs" aria-controls="newCoworkers" class="tab">Новые заявки
				<span class="tab_count"><?= count($organization->requests); ?></span>
			</a>
	    </li>
		<button data-href="http://link" id="inviteBtn" class="btn btn_primary tab_btn">Пригласить</button>
	</ul>
    <div class="tabs_content clear_fix">

        <div id="coworkers" class="tab_block tab_block--active">

            <? foreach ($organization->team as $member): ?>
                <div id="coworker_id<?= $member->id ?>" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/<?= $member->id; ?>"><?= $member->surname . ' ' . $member->name . ' ' . $member->lastname; ?></a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span><?= $member->email; ?></span>
                            <span><?= $member->phone; ?></span>
                        </div>
                        <? if (!$organization->isOwner($member->id)): ?>
                            <div class="coworker_controls clear_fix">
                                <button data-id="<?= $member->id; ?>" data-name="<?= $member->surname . ' ' . $member->name; ?>" class="btn btn_default deletebtn">Исключить</button>
                            </div>
                        <? endif; ?>
                    </div>
                </div>

            <? endforeach; ?>

        </div>



        <div id="newCoworkers" class="tab_block">

            <? foreach ($organization->requests as $request): ?>
                <div id="coworker_id<?= $request->id; ?>" class="coworker_row col-xs-12 col-md-6">
                    <div class="coworker_photo_wrap">
                        <a class="coworker_photo" href="">
                            <img class="coworker_photo_img" alt="Co-worker" src="">
                        </a>
                    </div>
                    <div class="coworker_info">
                        <div class="coworker_field coworker_field-title">
                            <a href="/user/<?= $request->id; ?>"><?= $request->surname . ' ' . $request->name . ' ' . $request->lastname; ?></a>
                        </div>
                        <div class="coworker_field coworker_field-contact">
                            <span><?= $request->email; ?></span>
                            <span><?= $request->phone; ?></span>
                        </div>
                        <div class="coworker_controls clear_fix">
                            <button data-id="<?= $request->id ?>" class="btn btn_primary acceptbtn">Принять заявку</button>
                            <button data-id="<?= $request->id ?>" class="btn btn_text cancelbtn">Отклонить</button>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>

        </div>
    </div>
</div>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>js/modules/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/modules/ajax.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organization/settings-coworkers.js"></script>
