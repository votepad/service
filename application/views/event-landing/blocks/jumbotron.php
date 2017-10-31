<div class="jumbotron-landing valign">

    <div class="container" style="z-index: 2">
        <a href="<?=URL::site('event/' . $event->id); ?>" class="jumbotron-landing__title"><?=$event->name; ?></a>
    </div>

    <div class="jumbotron-filter"></div>

    <div class="parallax" data-toggle="parallax">

        <img class="parallax__img" src="/uploads/events/branding/<?=$event->branding; ?>">

    </div>

</div>