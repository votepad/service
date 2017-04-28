<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">

    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('organizations/blocks/jumbotron_wrapper', array('organization' => $organization)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <div class="row-col events">
            <? foreach ($events as $event) : ?>
            <? if($event->is_published) : ?>
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="block event">
                    <a href="<?=URL::site('event/' . $event->id); ?>" class="event__img" style="background-image: url(<?=URL::site('uploads/events/branding/' . $event->branding); ?>)"></a>
                    <div class="event__wrapper">
                        <a href="<?=URL::site('event/' . $event->id); ?>" class="event__name"><?=$event->name; ?></a>
                        <p class="event__desc"><?=$event->description; ?></p>
                        <div class="event__actions clear_fix">
                            <div class="event__watches fl_r">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="event__watches-counter">50</span>
                            </div>

                            <div class="event__time"><?=$event->dt_start; ?></div>

                            <div class="dropdown fl_l event__dropdown" data-toggle="dropdown">
                                <a class="dropdown__btn event__dropdown-btn">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown__menu dropdown__menu--left event__dropdown-menu">
                                    <a href="<?=URL::site('event/' . $event->id . '/settings'); ?>" class="dropdown__link">
                                        Настройки
                                    </a>
                                    <a href="<?=URL::site('event/' . $event->id . '/control'); ?>" class="dropdown__link">
                                        Управление
                                    </a>
                                    <a href="<?=URL::site('event/' . $event->id . '/scenario/criterias'); ?>" class="dropdown__link">
                                        Сценарий
                                    </a>
                                    <a href="<?=URL::site('event/' . $event->id . '/members/judges'); ?>" class="dropdown__link">
                                        Действующие лица
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <? endif; ?>
            <? endforeach; ?>
        </div>


    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/locale/ru.js"></script>
    <script>
        $('.event__time').each(function () {
            this.innerHTML = moment(new Date(this.innerHTML)).format('ll');
        });
        if ( $('.event').length === 0) {
            $('.events').append(
                '<div class="text-center col-xs-12">' +
                    '<h4>Организация "<?= $organization-> name; ?>" ещё не проводила мероприятия</h4>' +
                    <? if ($isLogged && $organization->isMember($user ? $user->id : 0)): ?>
                    '<b><a class="text-brand" href="<?= URL::site('organization/' . $organization->id . '/event/new' ); ?>">Создать мероприятие</a></b>' +
                    <? endif; ?>
                '</div>');
        }
    </script>
</div>