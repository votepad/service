<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Результаты
</div>

<div class="block">

    <div class="block__wrapper pt-10 fs-0_9">
        <? if ($contestsJSON === "[]"): ?>
            Для того, чтобы заполнить информацию о результатах, необходимо создать
            <a class="link" href="<?= URL::site('event/' . $event->id . '/scenario/stages'); ?>">конкурсы</a>.
        <? else: ?>
            <p>
                Результат мероприятия может быть как командным, так и индивидуальным.
                Заполните формулы с коэффицентами для подсчета результата.
            </p>
            <input type="hidden" id="allContests" value='<?= $contestsJSON ?>'>
            <input type="hidden" id="eventID" value="<?= $event->id; ?>">
        <? endif; ?>
    </div>

</div>


<div class="block" id="participantsResult">

    <div class="block__heading pr-5 pb-10">
        Индивидуальный результат
    </div>

    <div class="block__wrapper pb-20">

        <div class="fs-0_9" id="formulaParticipants">
            <span class="text-italic text-underline">Формула:</span>
            <? if (empty($results['participants']) || $contestsJSON === '[]') : ?>
                <span class="formula formula-print js-contestFormula" data-items='<?= $results['participants']->formula; ?>'></span>
            <? else: ?>
                не указана
            <? endif; ?>
        </div>

    </div>

</div>


<div class="block" id="teamsResult">

    <div class="block__heading pr-5 pb-10">
        Командный результат
    </div>

    <div class="block__wrapper pb-20">

        <div class="fs-0_9" id="formulaTeamsPrint">
            <span class="text-italic text-underline">Формула:</span>
            <? if (empty($results['teams']) || $contestsJSON === '[]') : ?>
                <span class="formula formula-print" data-items='<?= $results['teams']->formula; ?>'></span>
            <? else: ?>
                не указана
            <? endif; ?>
            <a role="button" class="" onclick="eventResults.toggle()">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
        </div>

        <div id="formulaTeams" class="formula fs-0_9" data-items='<?= empty($results['teams']) ? '[]' : $results['teams']->formula; ?>'>

        </div>

    </div>

</div>



<script type="text/javascript" src="<?=$assets; ?>vendor/choices/dist/choices.min.js?v=<?= filemtime("assets/vendor/choices/dist/choices.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-scenario-results.js?v=<?= filemtime("assets/static/js/event-scenario-results.js") ?>"></script>