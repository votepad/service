<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Критерии
</div>

<div class="block">

    <div class="block__wrapper pt-10 fs-0_9">
        Создайте критерии по которым будут оцениваться участники и команды. В поле "название" укажите точный и
        краткий критерий, по которому будет выставляться балл. Поле "описание" служит для дополнительной информации,
        которая будет полезна представителю жюри, для точного понимания названия критерия .
    </div>

</div>


<div class="block">

    <div class="block__wrapper pb-20">

        <table id="criterionsTable">
            <thead>
                <tr>
                    <th width="30%">Название</th>
                    <th width="30%">Описание</th>
                    <th width="10%">Мин.балл</th>
                    <th width="10%">Макс.балл</th>
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                <? foreach($criterions as $key => $criterion): ?>
                    <tr id="criterion_<?= $criterion->id ?>">
                        <td><?= $criterion->name; ?></td>
                        <td><?= $criterion->desciption; ?></td>
                        <td><?= $criterion->min_score; ?></td>
                        <td><?= $criterion->max_score; ?></td>
                        <td class="text-center">
                            <a role="button" class="text-brand text-center m-5" onclick="eventCriterion.edit(this)" data-id="<?= $criterion->id; ?>">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a role="button" class="text-danger text-center m-5" onclick="eventCriterion.delete(this)" data-id="<?= $criterion->id; ?>">
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
<script type="text/javascript" src="<?=$assets; ?>static/js/event-scenario-criterions.js?v=<?= filemtime("assets/static/js/event-scenario-criterions.js") ?>"></script>