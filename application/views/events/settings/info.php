<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">

    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron__nav">
            <?=View::factory('events/settings/jumbotron_navigation', array('id' => $event->id));; ?>
        </div>

    </div>

    <section class="section__content">

        <h3 class="page-header">
            Изменение основной информации о мероприятии
        </h3>

        <div class="row">
            <form class="form" action="<?=URL::site('event/' . $event->id . '/settings/info/update'); ?>" method="POST" id="update_main_info">
                <div class="form__body clear_fix">
                    <div class="col-xs-12">
                        <div class="row row-col">
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="name" name="name" length="60" value="<?=$event->name; ?>" placeholder="Например: <?=$event->name; ?>">
                                <label for="name" class="input-label active">Название мероприятия</label>
                            </div>

                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="site" name="site" class="vp_site" length="38" value="<?=$event->uri; ?>" placeholder="Например: http://votepad.ru/<?=$event->uri; ?>">
                                <label for="site" class="input-label active">Ссылка на страницу мероприятия</label>
                            </div>
                        </div>

                        <div class="row row-col">
                            <div class="input-field col-xs-12">
                                <textarea id="description" name="desc" length="300" placeholder="Например: <?=$event->description; ?>"><?=$event->description; ?></textarea>
                                <label for="description">Описание мероприятия</label>
                                <span class="help-block">Данная информация поможет найти Ваше мероприятие через поисковые системы.</span>
                            </div>
                        </div>

                        <div class="row row-col">
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="datetime-local" id="start" name="start"  value="<?=$event->dt_start; ?>">
                                <label for="start" class="active">Дата начала</label>
                            </div>
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="datetime-local" id="end" name="end"  value="<?=$event->dt_end; ?>">
                                <label for="end" class="active">Дата завершения</label>
                            </div>
                        </div>
                        <div class="row row-col">
                            <div class="input-field col-xs-12 col-md-6">
                                <input type="text" id="address" name="address" length="200"  placeholder="Наприсер: <?=$event->address; ?>" value="<?=$event->address; ?>">
                                <label for="address">Адрес</label>
                                <span class="help-block">Укажите, где будет проходить мероприятие. Эта информация отразится на странице мероприятия.</span>
                            </div>
                            <div class="input-field col-xs-12 col-md-6">
                                <style>
                                    .select2-dropdown {
                                        display: none !important;
                                    }
                                </style>
                                <?php
                                    $tags = json_decode($event->tags);
                                ?>
                                <select id="keywords" name="keywords[]" multiple="multiple" >
                                    <? foreach ($tags as $tag) : ?>
                                        <option value="<?=$tag; ?>" selected><?=$tag; ?></option>
                                    <? endforeach; ?>
                                </select>
                                <label for="keywords" style="padding-left: 15px">Хэш-теги меропрития</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form__footer clear_fix">
                    <button type="submit" class="btn btn_primary col-xs-12 col-md-4 col-lg-3 pull-right">
                        Обновить информацию
                    </button>
                </div>
            </form>
        </div>
    </section>


    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/settings-maininfo.js"></script>

</div>