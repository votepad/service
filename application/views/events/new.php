<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/new-org-event.css?v=<?= filemtime("assets/static/css/new-org-event.css") ?>">

    <section class="section__content m-t-100">

        <h3 class="page-header">
            Создание мероприятия
            <br>
            <small>Заполните основную информацию о мероприятие, чтобы его было проще найти в поисковых системах и на сайте!</small>
        </h3>

        <form id="newSubstance" method="POST" action="<?=URL::site('event/add'); ?>" class="form">

            <div class="form__body">
                <div class="form__wrapper">
                    <div class="input-field col-xs-12">
                        <input type="text" id="name" name="name" maxlength="100" data-percent="25" data-section="1" data-valid="false">
                        <label for="name">Название мероприятия</label>
                        <span class="help-block">Название будет отображено на странице с результатами мероприятия.</span>
                    </div>
                    <div class="input-field col-xs-12 vp-site">
                        <input type="text" id="uri" name="uri" class="vp-site__input" maxlength="20" placeholder="..." data-percent="20" data-section="1" data-valid="false" data-check="/event/check/">
                        <label for="uri">Страница мероприятия</label>
                        <span class="vp-site__placeholder">http://votepad.ru/</span>
                        <span class="help-block">По этому адресу будет доступна страница в системе votepad.</span>
                    </div>
                </div>

                <div class="form__wrapper">
                    <div class="input-field col-xs-12">
                        <textarea id="desc" name="desc" maxlength="300" tabindex="-1" data-percent="20" data-section="2" data-valid="false"></textarea>
                        <label for="desc">Описание мероприятия</label>
                        <span class="help-block">Напишите основную информацию о мероприятии. По этой информации Ваше мероприятие будет проще найти через поиск.</span>
                    </div>
                </div>

                <div class="form__wrapper">
                    <div class="input-field col-md-5 col-xs-12">
                        <input type="datetime-local" id="start" name="start" tabindex="-1" data-percent="10" data-section="3" data-valid="false">
                        <label for="start" class="active">Дата начала</label>
                    </div>
                    <div class="input-field col-md-5 col-md-offset-2 col-xs-12">
                        <input type="datetime-local" id="end" name="end" tabindex="-1" data-percent="10" data-section="3" data-valid="false">
                        <label for="end" class="active">Дата завершения</label>
                    </div>
                    <div class="input-field col-xs-12">
                        <input type="text" id="address" name="address" maxlength="200" tabindex="-1" data-percent="15" data-section="3" data-valid="false">
                        <label for="address">Адрес</label>
                        <span class="help-block">Укажите, где будет проходить мероприятие. Эта информация отразится на странице мероприятия.</span>
                    </div>
                </div>
            </div>

            <div class="progress__wrapper">
                <span id="progress" class="progress__width"></span>
            </div>

            <div class="form__footer clearfix">
                <button id="btnPrev" type="button" class="btn btn_hollow hide">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Назад
                </button>
                <button id="btnNext" type="button" class="btn btn_hollow fl_r">
                    Продолжить
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                <button id="btnSubmit" type="submit" class="btn btn_primary fl_r hide">
                    Опубликовать
                    <i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
                </button>
            </div>
            <input type="hidden" name="id_organization" value="<?=$idOrg; ?>">
        </form>

    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/new-org-event.js"></script>

    <script>
        newOrgEvent.init(3);
    </script>

</div>