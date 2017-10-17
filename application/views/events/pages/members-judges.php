<div class="block t-lh-50px pl-25 text-bold">
    Код мероприятия: <span class="pl-10 text-brand letter-spacing--5" id="eventCode"><?= $event->code; ?></span>
</div>

<div class="block">

    <div class="block__wrapper pb-20">

        <table id="judgesTable">
            <thead>
                <tr>
                    <th width="35%">Имя</th>
                    <th width="10%">Код мероприятия</th>
                    <th width="35%">Пароль</th>
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($judges as $key => $judge): ?>
                    <tr id="judge_<?= $judge->id ?>">
                        <td><?= $judge->name; ?></td>
                        <td><?= $event->code; ?></td>
                        <td><?= $judge->password; ?></td>
                        <td class="text-center">
                            <a role="button" class="text-brand text-center m-5" onclick="eventJudges.edit(this)" data-id="<?= $judge->id; ?>">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a role="button" class="text-danger text-center m-5" onclick="eventJudges.delete(this)" data-id="<?= $judge->id; ?>">
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
<script type="text/javascript" src="<?=$assets; ?>static/js/event-members-judges.js?v=<?= filemtime("assets/static/js/event-members-judges.js") ?>"></script>