<div class="event-info clear_fix">
    <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">

        <i class="fa fa-clock-o event-info__icon text-brand" aria-hidden="true"></i>
        <input id="eventStartTime" type="hidden" value="<?=$event->dt_start; ?>">
        <input id="eventEndTime" type="hidden" value="<?=$event->dt_end; ?>">
        <span id="eventTimeCounter" class="event-info__h1"></span>
        <span id="eventTime" class="event-info__h2"></span>
    </div>
    <div class="col-xs-12 col-md-4 event-info__block event-info__block--border">
        <i class="fa fa-map-marker event-info__icon text-brand" aria-hidden="true"></i>
        <span class="event-info__h1"><?=$event->address; ?></span>
    </div>
    <div class="col-xs-12 col-md-4 event-info__block">
        <i class="fa fa-flag event-info__icon text-brand" aria-hidden="true"></i>
        <a href="<?=URL::site('organization/' . $organization->id); ?>" class="event-info__h1"><?=$organization->name; ?></a>
        <span class="event-info__h2"></span>
    </div>
</div>



<!--<section id="eventDescription" class="container">

</section>-->


<section id="eventResult" class="container">
    <h1 class="text-brand m-t-50 m-b-50">
        Результаты мероприятия
        <br>
        <small><a href="">sda</a></small>
    </h1>

</section>