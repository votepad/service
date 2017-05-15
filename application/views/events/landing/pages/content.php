<div class="section__wrapper">

    <div class="jumbotron-landing valign">
        <div class="container" style="z-index: 2">
            <a href="<?=URL::site('event/' . $event->id); ?>" class="jumbotron-landing__title"><?=$event->name; ?></a>
        </div>
        <div class="jumbotron-filter"></div>

        <div class="parallax">
            <img id="" src="/uploads/events/branding/<?=$event->branding; ?>">
        </div>

    </div>


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
            <small><a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="underlinehover">Подробный рейтинг</a></small>
        </h1>
        <ul id="stage_1" class="col-xs-12">

            <? foreach ($participants as $participant) : ?>
            <li class="member col-xs-12 col-md-4 col-lg-3">
                <div class="member__area">
                    <span class="member__name"><?=$participant->name; ?></span>
                    <div class="member__logo">
                        <img src="/uploads/profiles/avatar/<?=$participant->photo ?: 'no-avatar.png'; ?>" alt="" class="member__img">
                        <div class="member__position">2</div>
                    </div>
                    <div class="member__rating-area">
                        <div data-pk="2" class="member__rating-bar" style="width:50%">
                            <span class="member__bar">10/20</span>
                        </div>
                    </div>
                </div>
            </li>
            <? endforeach; ?>
            
        </ul>

        <div class="m-t-50 col-xs-12 text-center">
            <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="btn btn_primary btn-result">Подробный рейтинг</a>
        </div>
    </section>
</div>