<div class="entry__wrapper ">
    <div class="block mb-0 ui-tabs">
        <div class="ui-tabs__wrapper">
            <a role="button" data-toggle="tabs" data-area="assistantsArea" class="ui-tabs__tab ui-tabs__tab--active">
                Участвуют в проведении
                <span id="countAssistants" class="ui-tabs__counter"><?= count($event->assistants) ?></span>
            </a>
            <a role="button" data-toggle="tabs" data-area="requestsArea" class="ui-tabs__tab">
                Новые заявки
                <span class="ui-tabs__counter"><?= count($requests) ?></span>
            </a>
            <a role="button" class="ui-btn ui-btn--1 m-10" data-href="<?= $_SERVER['HTTP_HOST'] . $event->getInviteLink();?>" id="inviteBtn" >
                Пригласить
            </a>
        </div>
    </div>
</div>

<div id="assistantsArea">

    <? foreach($event->assistants as $assistant): ?>
        <div class="block" id="assistant_<?= $assistant->id ?>">

            <div class="block__wrapper pt-10 ">
                <img class="thumb64 image--circle mr-20" alt="Assistant avatar" src="/uploads/profiles/avatar/m_<?=$assistant->avatar; ?>">
                <div>
                    <a href="<?= URL::site( 'user/' . $assistant->id); ?>" class="link">
                        <?= $assistant->name; ?>
                    </a>
                    <? if ($event->creator == $user->id && $event->creator != $assistant->id) :?>
                        <div class="mt-5">
                            <button data-id="<?= $assistant->id ?>" data-name="<?= $assistant->name; ?>" class="ui-btn ui-btn--1">
                                Исключить
                            </button>
                        </div>
                    <? endif; ?>
                </div>
            </div>

        </div>

    <? endforeach; ?>

</div>


<div id="requestsArea" class="hide">

    <? if (empty($requests)) : ?>

        <div class="block">

            <div class="pl-20 pr-20 pt-100 pb-100 text-center">

                <div class="text-bold fs-1_2 pb-10">
                    Новых заявок нет
                </div>

            </div>

        </div>

    <? else: ?>
        <? foreach($requests as $user): ?>
            <div class="block">

                <div class="block__wrapper p-20">
                    <button data-id="<?= $user->id ?>" class="btn btn_primary acceptbtn">Принять заявку</button>
                    <button data-id="<?= $user->id ?>" class="btn btn_default cancelbtn">Отклонить</button>
                </div>

            </div>
        <? endforeach; ?>
    <? endif; ?>

</div>


<!--<script type="text/javascript" src="--><?//=$assets; ?><!--static/js/event-settings-assistants.js?v=--><?//= filemtime("assets/static/js/event-settings-assistants.js") ?><!--"></script>-->