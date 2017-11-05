<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Этапы
</div>

<div class="block">

    <div class="block__wrapper pt-10 t-lh-1_4 fs-0_9">
        <? if ($criterions === "[]" || (empty($members['participants']) && empty($members['teams']))): ?>
            Для того, чтобы создать этап, необходимо внести информацию о
            <a class="link" href="<?= URL::site('event/' . $event->id . '/scenario/criterions'); ?>">критериях</a>,
            <a class="link" href="<?= URL::site('event/' . $event->id . '/members/participants'); ?>">участниках</a> и/или
            <a class="link" href="<?= URL::site('event/' . $event->id . '/members/teams'); ?>">командах</a>.
        <? else: ?>
            <p>
                Создайте этапы на которых будут выступать участники или команды. Каждый этап оценивается по одному или нескольким
                критериям, которые указываются в формуле с соответствующими коэффициентами.
            </p>
            <a role="button" class="ui-btn ui-btn--1 collapse__btn" data-toggle="collapse" data-area="newStage" data-opened="false" data-textopened="Отмена создания" data-textclosed="Создать новый этап"></a>
            <input type="hidden" id="allCriterions" value='<?= $criterions ?>'>
            <input type="hidden" id="eventID" value="<?= $event->id; ?>">
        <? endif; ?>
    </div>

</div>


<div id="newStage" class="collapse">

    <form class="block">

        <div class="block__wrapper p-20">

            <div class="form-group">
                <input type="text" id="newStageName" name="name" class="form-group__input" maxlength="60" autocomplete="off">
                <label for="newStageName" class="form-group__label">Название этапа</label>
            </div>

            <div class="form-group">
                <textarea id="newStageDescription" name="description" class="form-group__textarea" maxlength="500" autocomplete="off"></textarea>
                <label for="newStageDescription" class="form-group__label">Описание этапа</label>
            </div>

            <div class="form-group">
                <div class="fs-0_8 pb-5 text-bold text-brand-2">Жюри будут оценивать</div>

                <span>
                    <input type="radio" id="newStageMode1" name="mode" class="radio" checked value="participants" onclick="eventStages.selectPart()">
                    <label for="newStageMode1" class="radio-label">участников</label>
                </span>

                <span class="ml-15">
                    <input type="radio" id="newStageMode2" name="mode" class="radio" value="teams" onclick="eventStages.selectTeams()">
                    <label for="newStageMode2" class="radio-label">команды</label>
                </span>

                <div id="newStageParticipantsArea">
                    <select id="newStageParticipants" name="participants[]" class="form-group__input" multiple placeholder="выбрать">
                        <? foreach ($members['participants'] as $participant): ?>
                            <option value="<?= $participant->id; ?>"><?=$participant->name; ?></option>
                        <? endforeach; ?>
                    </select>
                </div>

                <div id="newStageTeamsArea" class="hide">
                    <select id="newStageTeams" name="teams[]" class="form-group__input" multiple placeholder="выбрать">
                        <? foreach ($members['teams'] as $team): ?>
                            <option value="<?= $team->id; ?>"><?=$team->name; ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="formula" id="newStageFormula"></div>
            </div>

        </div>

        <div class="block__footer pt-10 pb-10 pl-20 pr-20">
            <button type="submit" class="fl_r ui-btn ui-btn--1">Создать</button>
        </div>

    </form>

</div>

<div id="stagesArea">

    <? foreach ($stages as $stage): ?>

        <?= View::factory('events/blocks/scenario-stage-block', array('stage' => $stage)); ?>

    <? endforeach; ?>

</div>


<script type="text/javascript" src="<?=$assets; ?>vendor/choices/dist/choices.min.js?v=<?= filemtime("assets/vendor/choices/dist/choices.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-scenario-stages.js?v=<?= filemtime("assets/static/js/event-scenario-stages.js") ?>"></script>