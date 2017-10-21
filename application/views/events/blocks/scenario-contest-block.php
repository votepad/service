<div class="block" id="contest_<?= $contest->id; ?>">

    <div class="block__heading pr-5 pb-10">
        <div class="dropdown fl_r">
            <a role="button" class="dropdown__btn pr-20">
                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
            </a>
            <div class="dropdown__menu dropdown__menu--right">
                <a role="button" class="dropdown__link" onclick="eventContests.edit(<?= $contest->id; ?>)">
                    Изменить
                </a>
                <a role="button" class="dropdown__link" onclick="eventContests.delete(<?= $contest->id; ?>)">
                    Удалить
                </a>
            </div>
        </div>
        <span class="js-contestName"><?= $contest->name; ?></span>
    </div>

    <div class="block__wrapper pb-20">

        <p class="fs-0_9">
            <span class="text-italic text-underline">Об конкурсе:</span>
            <span class="js-contestDescription"><?= $contest->description; ?></span>
        </p>

        <p class="fs-0_9">
            <span class="text-italic text-underline">Представители жюри:</span>

            <span class="js-contestJudges">
                <? foreach ($contest->judges as $judge): ?>
                    <span data-id="<?= $judge->id; ?>" class="text-comma"><?= $judge->name; ?></span>
                <? endforeach; ?>
            </span>

        </p>

        <div class="fs-0_9">
            <span class="text-italic text-underline">Формула:</span>
            <span class="formula formula-print js-contestFormula" data-items='<?= $contest->formula; ?>'></span>
        </div>

    </div>

</div>