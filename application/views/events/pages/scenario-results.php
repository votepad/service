<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Результаты
</div>

<div class="block">

    <div class="block__wrapper pt-10 fs-0_9 t-lh-1_4">
        <? if ($contestsJSON === "[]"): ?>
            Для того, чтобы заполнить информацию о результатах, необходимо создать
            <a class="link" href="<?= URL::site('event/' . $event->id . '/scenario/stages'); ?>">конкурсы</a>.
        <? else: ?>
            Результат мероприятия может быть как командным, так и индивидуальным. Заполните формулы с коэффицентами для
            подсчета результата. После того, как сценарий создан, предоставьте доступ к системе представителям жюри,
            опубликуйте страницу с результатами
            (<a href="<?= URL::site('event/' . $event->id . '/settings/info'); ?>" class="link">в основных настройках</a>),
            и переходите во вкладку
            <a href="<?= URL::site('event/' . $event->id . '/control/scores'); ?>" class="link">управление</a>)
            для контроля и публикации результатов.
            <input type="hidden" id="allPartFormula" value='<?= json_encode($contestsJSON['participants']); ?>'>
            <input type="hidden" id="allTeamFormula" value='<?= json_encode($contestsJSON['teams']); ?>'>
            <input type="hidden" id="eventID" value="<?= $event->id; ?>">
        <? endif; ?>
    </div>

</div>

<div class="block" id="participantsResult">

    <div class="block__heading pr-5 pb-10">
        Индивидуальный результат
    </div>

    <div class="block__wrapper pb-20 fs-0_9">

        <div id="formulaParts" class="formula" data-id="<?= $results['participants']->id; ?>" data-items='<?= empty($results['participants']->id) ? '[]' : $results['participants']->formula; ?>'></div>

        <span id="formulaPartsPrint" class="formula" data-items='<?= $results['participants']->formula; ?>'>
            <span class="text-italic text-underline">Формула:</span>
            не указана
        </span>

        <a role="button" class="link ml-5" onclick="eventResults.edit(this)" data-type="Parts">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>

    </div>

</div>


<div class="block" id="teamsResult">

    <div class="block__heading pr-5 pb-10">
        Командный результат
    </div>

    <div class="block__wrapper pb-20">

        <div id="formulaTeams" class="formula fs-0_9" data-id="<?= $results['teams']->id; ?>" data-items='<?= empty($results['teams']->id) ? '[]' : $results['teams']->formula; ?>'></div>

        <span id="formulaTeamsPrint" class="formula" data-items='<?= $results['teams']->formula; ?>'>
            <span class="text-italic text-underline">Формула:</span>
            не указана
        </span>

        <a role="button" class="link ml-5" onclick="eventResults.edit(this)" data-type="Teams">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>

    </div>

</div>



<script type="text/javascript" src="<?=$assets; ?>vendor/choices/dist/choices.min.js?v=<?= filemtime("assets/vendor/choices/dist/choices.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-scenario-results.js?v=<?= filemtime("assets/static/js/event-scenario-results.js") ?>"></script>