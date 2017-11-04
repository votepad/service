<div class="entry__wrapper">
    <div class="block mb-0 ui-tabs">
        <div class="ui-tabs__wrapper">
            <a role="button" data-toggle="tabs" data-area="assistantsArea" class="ui-tabs__tab ui-tabs__tab--active">
                Участвуют в проведении
                <span class="ui-tabs__counter"><?= count($event->assistants) ?></span>
            </a>
            <a role="button" data-toggle="tabs" data-area="requestsArea" class="ui-tabs__tab">
                Новые заявки
                <span class="ui-tabs__counter"><?= count($requests) ?></span>
            </a>
        </div>
    </div>
</div>

<div id="assistantsArea">

    <div class="block">

        <div class="block__wrapper pt-10 fs-0_9 t-lh-1_4">
            Помощники - это люди из команды организаторов мероприятия. Пригласив их, вы предоставляете им
            права доступа на изменеие всей информации о мероприятие.
        </div>

    </div>

    <div class="block">

        <div class="block__wrapper pb-20">

        <table id="assistantsTable">
            <thead>
                <tr>
                    <th class="text-center">Фото</th>
                    <th>Имя</th>
                    <th>Эл.почта</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($event->assistants as $assistant): ?>
                    <tr id="assistant_<?= $assistant->id ?>">
                        <td class="text-center">
                            <img class="thumb64 image--circle" alt="Assistant avatar" src="/uploads/profiles/avatar/m_<?=$assistant->avatar; ?>">
                        </td>
                        <td>
                            <a href="<?= URL::site( 'user/' . $assistant->id); ?>" class="link">
                                <?= $assistant->name; ?>
                            </a>
                        </td>
                        <td>
                            <?= $assistant->email; ?>
                        </td>
                        <td class="text-center">
                            <? if ($event->creator != $assistant->id) :?>
                                <button role="button" onclick="eventAssistants.excludeAssistant(this)" data-id="<?= $assistant->id ?>" class="ui-btn ui-btn--1">
                                    Исключить
                                </button>
                            <? endif; ?>
                        </td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>

    </div>

    </div>

</div>

<div id="requestsArea" class="hide">

    <div class="block">

        <div class="block__wrapper pt-10 fs-0_9 t-lh-1_4">
            Примите или отклоните заявку от нового помощника.
        </div>

    </div>

    <div class="block">

        <div class="pl-20 pr-20 pt-100 pb-100 text-center <?= empty($requests) ?: 'hide'; ?>" id="noRequestsBlock">
            <div class="text-bold fs-1_2 pb-10">
                Новых заявок нет
            </div>
        </div>

        <div class="block__wrapper p-20 <?= !empty($requests) ?: 'hide'; ?>" id="requestsBlock">

            <table id="requestsTable">
                <thead>
                <tr>
                    <th class="text-center">Фото</th>
                    <th>Имя</th>
                    <th>Эл.почта</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <? foreach($requests as $user): ?>
                    <tr id="request_<?= $user->id ?>">
                        <td class="text-center">
                            <img class="thumb64 image--circle" alt="Assistant avatar" src="/uploads/profiles/avatar/m_<?=$user->avatar; ?>">
                        </td>
                        <td>
                            <a href="<?= URL::site( 'user/' . $user->id); ?>" class="link">
                                <?= $user->name; ?>
                            </a>
                        </td>
                        <td>
                            <?= $user->email; ?>
                        </td>
                        <td class="text-center">
                            <button role="button" onclick="eventAssistants.acceptRequest(this)" data-id="<?= $user->id ?>" class="link mb-10">
                                Принять
                            </button>
                            <br>
                            <button role="button" onclick="eventAssistants.rejectRequest(this)" data-id="<?= $user->id ?>" class="text-danger">
                                Отклонить
                            </button>
                        </td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

<input type="hidden" id="eventID" value="<?= $event->id; ?>">

<!--  Modal For Showing Invite Link  -->
<div class="modal" id="inviteModal" tabindex="-1">
    <div class="modal__content">
        <div class="modal__wrapper">
            <div class="modal__header">
                <a role="button" data-close="modal" class="fl_r">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <h4 class="modal__title">Пригласить помощника</h4>
            </div>
            <div class="modal__body">
                <p>Сообщите ссылку людям, которым хотите предоставить доступ к этому мероприятию</p>
                <p class="link word-break--break-all"><?= $_SERVER['HTTP_HOST'] . $event->getInviteLink();?></p>
                <p>Не забудьте принять их заявки в <b>"Новых заявках"</b></p>
            </div>
            <div class="modal__footer">
                <button role="button" data-close="modal" class="ui-btn ui-btn--1 width-md-100 fl_r">Готово</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-settings-assistants.js?v=<?= filemtime("assets/static/js/event-settings-assistants.js") ?>"></script>