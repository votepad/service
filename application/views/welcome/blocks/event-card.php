<div class="event_card">

    <div class="event_card-image" style="background-image: url('<?= URL::site('uploads/events/branding/o_' . $event->branding);?>')"></div>

    <a href="<?= URL::site('event/' . $event->id)?>" class="event_card-title valign text-center">
        <div class="ml-auto mr-auto"><?= $event->name; ?></div>
    </a>

    <div class="backdrop"></div>

</div>