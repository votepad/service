<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">

    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('organizations/blocks/jumbotron_wrapper', array('organization' => $organization)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

        <?
            $isMember = $organization->isMember(($user && $user->id) ? $user->id : 0);
        ?>

        <div class="row-col events">
            <? foreach ($events as $event) : ?>
            <? if ( ($isMember && !$event->is_published) || $event->is_published ) : ?>
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="block event">
                    <a href="<?=URL::site('event/' . $event->id); ?>" class="event__img" style="background-image: url(<?=URL::site('uploads/events/branding/' . $event->branding); ?>)"></a>
                    <div class="event__wrapper">
                        <a href="<?=URL::site('event/' . $event->id); ?>" class="event__name"><?=$event->name; ?></a>
                        <p class="event__desc"><?=$event->description; ?></p>
                        <div class="clear_fix">
                            <div class="event__labels fl_l">
                                <? if ( $isMember ) : ?>
                                <span class="label label--brand event__label--published" style="display: <? echo $event->is_published ? '' : 'none'?>">опубликовано</span>
                                <span class="label label--brand event__label--published" style="display: <? echo $event->is_published ? 'none' : ''?>">черновик</span>
                                <? endif; ?>
                                <span class="label label--default event__time"><?=$event->dt_start; ?></span>
                            </div>

                            <? if ($isMember) : ?>
                            <div class="dropdown fl_r event__dropdown" data-toggle="dropdown">
                                <a class="dropdown__btn event__dropdown-btn">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown__menu dropdown__menu--right event__dropdown-menu">
                                    <a role="button" class="dropdown__link event__btn--publish" style="display:<? echo $event->is_published ? '' : 'none'?>">
                                        Убрать с публикации
                                    </a>
                                    <a role="button" class="dropdown__link event__btn--publish" style="display:<? echo $event->is_published ? 'none' : ''?>">
                                        Опубликовать
                                    </a>
                                    <div class="divider"></div>
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
                            <? endif; ?>

                            <div class="event__watches fl_r">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="event__watches-counter">50</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <? endif; ?>
            <? endforeach; ?>
    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/locale/ru.js"></script>
    <script>
        $('.event__time').each(function () {
            $(this).html(moment(new Date($(this).html())).format('ll'))
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
        $('.event__btn--publish').click(function () {
            $(this).parent().find('.event__btn--publish').toggle();
            $(this).parent().parent().parent().find('.event__label--published').toggle();
        });

    </script>
</div>