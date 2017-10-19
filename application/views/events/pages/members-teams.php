<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Команды мероприятия
</div>

<div class="block">

    <div class="block__wrapper pt-10 fs-0_9">
        Для изменения логотипа команды нажмите на соответствующее изображение.
    </div>

</div>


<div class="block">

    <div class="block__wrapper pb-20">

        <table id="teamTable">
            <thead>
                <tr>
                    <th width="15%" class="text-center">Логотип</th>
                    <th width="30%">Название команды</th>
                    <th width="40%">О команде</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($teams as $key => $team): ?>
                    <tr id="team_<?= $team->id ?>">
                        <td class="text-center">
                            <a role="button" onclick="eventTeams.updatePhoto(this)" data-id="<?= $team->id; ?>">
                                <img id="teamLogo_<?= $team->id ?>" class="thumb64 image--circle" alt="Team logo" src="/uploads/teams/m_<?=$team->logo; ?>">
                            </a>
                        </td>
                        <td><?= $team->name; ?></td>
                        <td><?= $team->description; ?></td>
                        <td class="text-center">
                            <a role="button" class="text-brand text-center m-5" onclick="eventTeams.edit(this)" data-id="<?= $team->id; ?>">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a role="button" class="text-danger text-center m-5" onclick="eventTeams.delete(this)" data-id="<?= $team->id; ?>">
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
<script type="text/javascript" src="<?=$assets; ?>static/js/event-members-teams.js?v=<?= filemtime("assets/static/js/event-members-teams.js") ?>"></script>