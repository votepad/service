<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Участники мероприятия
</div>

<div class="block">

    <div class="block__wrapper pt-10 fs-0_9">
        Для изменения фотографии участника нажмите на соответствующее изображение.
    </div>

</div>


<div class="block">

    <div class="block__wrapper pb-20">

        <table id="participantTable">
            <thead>
                <tr>
                    <th width="15%" class="text-center">Фото</th>
                    <th width="30%">Имя</th>
                    <th width="40%">Об участнике</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($participants as $key => $participant): ?>
                    <tr id="participant_<?= $participant->id ?>">
                        <td class="text-center">
                            <a role="button" onclick="eventParticipants.updatePhoto(this)" data-id="<?= $event->id; ?>">
                                <img class="thumb64 image--circle" alt="Participant logo" src="/uploads/participants/m_<?=$participant->logo; ?>">
                            </a>
                        </td>
                        <td><?= $participant->name; ?></td>
                        <td><?= $participant->about; ?></td>
                        <td class="text-center">
                            <a role="button" class="text-brand text-center m-5" onclick="eventParticipants.edit(this)" data-id="<?= $participant->id; ?>">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a role="button" class="text-danger text-center m-5" onclick="eventParticipants.delete(this)" data-id="<?= $participant->id; ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>

    </div>

</div>

<input type="hidden" id="eventID" value="<?= $event->id; ?>">

<script type="text/javascript" src="<?=$assets; ?>vendor/vanilla-datatables/dist/vanilla-dataTables.min.js?v=<?= filemtime("assets/vendor/vanilla-datatables/dist/vanilla-dataTables.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-members-participants.js?v=<?= filemtime("assets/static/js/event-members-participants.js") ?>"></script>