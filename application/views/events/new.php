<div class="section__wrapper">

    <!-- =============== PAGE STYLES ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">

    <section class="section__content m-t-100">

        <h3 class="page-header">
            Создание мероприятия
            <br>
            <small>Заполните основную информацию о мероприятие, чтобы его было проще найти в поисковых системах и на сайте!</small>
        </h3>

        <form id="form_newevent" method="POST" action="<?=URL::site('event/add'); ?>" class="form form_newevent">

            <div class="form_body form_newevent_body">
                <div class="form_newevent_body-wrapper">

                    <div id="step1" class="row col-xs-4 form_newevent_body-wrapper-item">
                        <div class="input-field col-xs-12">
                            <input type="text" id="name" name="name" length="100" placeholder="Например: Мисс ИТМО">
                            <label for="name">Название мероприятия</label>
                            <span class="help-block">Название будет отображено на странице с результатами мероприятия.</span>
                        </div>
                        <div class="input-field col-xs-12">
                            <input type="text" id="site" name="site" class="vp_site vp_site-org" length="38" data-orgwebsite="" placeholder="Например: http://votepad.ru/miss2017">
                            <label for="site">Страница мероприятия</label>
                            <span class="help-block">По этому адресу будет доступна страница в системе votepad.</span>
                        </div>
                    </div>

                    <div id="step2" class="row col-xs-4 form_newevent_body-wrapper-item">
                        <div class="input-field col-xs-12">
                            <textarea id="desc" name="desc" length="300" tabindex="-1" placeholder="Расскажите о мероприятии"></textarea>
                            <label for="desc">Описание мероприятия</label>
                            <span class="help-block">Напишите основную информацию о мероприятии. По этой информации Ваше мероприятие будет проще найти через поиск.</span>
                        </div>
                        <div class="input-field col-xs-12">
                            <style>
                                .select2-dropdown {
                                    display: none !important;
                                }
                            </style>
                            <select id="keywords" name="keywords[]" multiple="multiple" tabindex="-1"></select>
                            <label for="keywords" style="padding-left: 15px">Хэш-теги меропрития</label>
                        </div>
                    </div>

                    <div id="step3" class="row col-xs-4 form_newevent_body-wrapper-item">
                        <div class="input-field col-md-5 col-xs-12">
                            <input type="datetime-local" id="start" name="start" tabindex="-1" placeholder=" ">
                            <label for="start" class="active">Дата начала</label>
                        </div>
                        <div class="input-field col-md-5 col-md-offset-2 col-xs-12">
                            <input type="datetime-local" id="end" name="end" tabindex="-1" placeholder=" ">
                            <label for="end" class="active">Дата завершения</label>
                        </div>
                        <div class="input-field col-xs-12">
                            <input type="text" id="address" name="address" length="200" tabindex="-1" placeholder="Наприсер: Кронверкский пр. 49">
                            <label for="address">Адрес</label>
                            <span class="help-block">Укажите, где будет проходить мероприятие. Эта информация отразится на странице мероприятия.</span>
                        </div>
                        <div class="col-xs-12">
                            <input type="checkbox" id="confirmrools" name="confirmrools" tabindex="-1">
                            <label for="confirmrools">
                                Мною прочитаны <a href="#/modal_rools" class="underlinehover" style="color:#008DA7" tabindex="-1">правила публикации мероприятия</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form_newevent_progress">
                <div class="form_newevent_progress-wrapper"></div>
            </div>

            <div class="form_submit clearfix">
                <button id="btnprevious" type="button" class="btn btn_hollow displaynone">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Назад
                </button>
                <button id="btnnext" type="button" class="btn btn_hollow pull-right">
                    Продолжить
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                <button id="btnsubmit" type="submit" class="btn btn_primary pull-right displaynone">
                    Опубликовать
                    <i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
                </button>
            </div>
            <input type="hidden" name="id_organization" value="<?=$idOrg; ?>">
        </form>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/new.js"></script>

</div>