<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    <?= count($events) . ' ' . Methods_Plural::getWithPlural(count($events),'events'); ?>
</div>

<? if (count($events) == 0): ?>

    <?= View::factory('profiles/blocks/event-block--empty-draft'); ?>

<? else: ?>

    <? foreach ($events as $event): ?>

        <?= View::factory('profiles/blocks/event-block', array('event' => $event, 'profile' => $profile)); ?>

    <? endforeach;?>

<? endif; ?>


