<div class="block" id="stage_<?= $stage->id; ?>">

    <div class="block__heading pr-5 pb-10">
        <div class="dropdown fl_r">
            <a role="button" class="dropdown__btn pr-20">
                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
            </a>
            <div class="dropdown__menu dropdown__menu--right">
                <a role="button" class="dropdown__link" onclick="eventStages.edit(<?= $stage->id; ?>)">
                    Изменить
                </a>
                <a role="button" class="dropdown__link" onclick="eventStages.delete(<?= $stage->id; ?>)">
                    Удалить
                </a>
            </div>
        </div>
        <span class="js-stageName"><?= $stage->name; ?></span>
    </div>

    <div class="block__wrapper pb-20">

        <p class="fs-0_9">
            <span class="text-italic text-underline">Об этапе:</span>
            <span class="js-stageDescription"><?= $stage->description; ?></span>
        </p>

        <p class="fs-0_9">
            <span class="text-italic text-underline">Жюри оценивает:</span>

            <? if ($stage->mode == Methods_Stages::MEMBERS_PARTICIPANTS): ?>

                <span class="js-stageMembers" data-mode="participants">
                    <? foreach ($stage->members as $participant): ?>
                        <span data-id="<?= $participant->id ?>" class="text-comma"><?= $participant->name ?></span>
                    <? endforeach; ?>
                </span>

            <? elseif ($stage->mode == Methods_Stages::MEMBERS_TEAMS): ?>

                <span class="js-stageMembers" data-mode="teams">
                    <? foreach ($stage->members as $team): ?>
                        <span data-id="<?= $team->id ?>" class="text-comma"><?= $team->name ?></span>
                    <? endforeach; ?>
                </span>

            <? endif; ?>
        </p>

        <div class="fs-0_9">
            <span class="text-italic text-underline">Формула:</span>
            <span class="formula formula-print js-stageFormula" data-items='<?= $stage->formula ?>'></span>
        </div>

    </div>

</div>