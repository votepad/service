<div class="block">

    <div class="block__heading pr-0 fs-0_75 t-lh-1_5">

        <time class="text-brand-2"><?= strftime('%d %b %Y в %H:%M', strtotime($event->dt_start)); ?></time>

        <? if ($event->type == 0): ?>
            <a role="button" class="label label--black ml-10 fs-0_8" data-type="draft">черновик</a>
        <? elseif(strtotime($event->dt_start) > time()): ?>
            <a role="button" class="label label--warning ml-10 fs-0_8" data-type="not-conduct">не проведено</a>
        <? elseif(strtotime($event->dt_start) < time() && strtotime($event->dt_end) > time()): ?>
            <a role="button" class="label label--brand ml-10 fs-0_8" data-type="conducting">проводится</a>
        <? else: ?>
            <a role="button" class="label label--brand ml-10 fs-0_8" data-type="conducted">завершено</a>
        <? endif; ?>

    </div>

    <div class="block__wrapper">
        <a href="<?= URL::site('event/' . $event->id); ?>" class="link">
            <h2 class="h3 mt-0"><?= $event->name; ?></h2>
        </a>
        <p><?= $event->description; ?></p>
        <? if ($profile->isOwner) : ?>
            <div>
                <a href="<?= URL::site('event/' . $event->id . '/settings/info'); ?>" class="ui-btn ui-btn--1 ui-btn--margin">Редктировать</a>
                <a href="<?= URL::site('event/' . $event->id . '/control/scores'); ?>" class="ui-btn ui-btn--1 ui-btn--margin">Администрирование</a>
                <a href="<?= URL::site('event/' . $event->id . '/scenario/criterions'); ?>" class="ui-btn ui-btn--1 ui-btn--margin">Сценарий</a>
                <a href="<?= URL::site('event/' . $event->id . '/members/judges'); ?>" class="ui-btn ui-btn--1 ui-btn--margin">Действующие лица</a>
            </div>
        <? endif; ?>
    </div>

</div>