<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/new-org-event.css?v=<?= filemtime("assets/static/css/new-org-event.css") ?>">

    <section class="section__content m-t-100">

        <h3 class="page-header">
            Создание организации
            <br>
            <small>Всего три простых шага отделют Вас от страницы организации! Ведь именно там, Вы сможете создать мероприятие с автоматическим получением результатов голосования!</small>
        </h3>

        <form id="newSubstance" method="POST" action="<?=URL::site('organization/add'); ?>" class="form">

            <div class="form__body">
                <div class="form__wrapper">
                    <div class="input-field col-xs-12">
                        <input type="text" id="name" name="name" maxlength="60" data-percent="30" data-section="1" data-valid="false">
                        <label for="name">Название организации</label>
                        <span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
                    </div>
                    <div class="input-field col-xs-12 vp-site">
                        <input class="vp-site__input" type="text" id="uri" name="uri" maxlength="20" placeholder="..." data-percent="25" data-section="1" data-valid="false" data-check="/organization/checkwebsite/">
                        <label for="uri">Сайт организации</label>
                        <span class="vp-site__placeholder">http://votepad.ru/</span>
                        <span class="help-block">По этому адресу будет доступен личный кабинет организации и видны все мероприятия, проводимые организацией.</span>
                    </div>
                </div>
                <div class="form__wrapper">
                    <div class="input-field col-xs-12">
                        <textarea id="description" name="description" maxlength="300" tabindex="-1" data-percent="25" data-section="2" data-valid="false"></textarea>
                        <label for="description">Описание организации</label>
                        <span class="help-block">Напишите основную информацию об организации. По этой информации Вашу организацию можно будет найти через поиск.</span>
                    </div>
                    <div class="input-field col-xs-12">
                        <input type="text" id="site" name="site" tabindex="-1" placeholder="http://site.ru/" data-percent="20" data-section="2" data-valid="false">
                        <label for="site">Официальный сайт организации</label>
                        <span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
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
                <button id="btnNext" type="button" class="btn btn_hollow fl_r">Продолжить
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                <button id="btnSubmit" type="submit" class="btn btn_primary fl_r hide">Опубликовать
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </section>

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>static/js/new-org-event.js"></script>

    <script>
        newOrgEvent.init(2);
    </script>

</div>