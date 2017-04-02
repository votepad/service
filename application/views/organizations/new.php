<!-- =============== PAGE STYLE ===============-->
<link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">

<section class="m-t-100">

    <h3 class="page-header">
        Создание организации
        <br>
        <small>Всего три простых шага отделют Вас от страницы организации! Ведь именно там, Вы сможете создать мероприятие с автоматическим получением результатов голосования!</small>
    </h3>

    <form method="POST" action="<?=URL::site('organization/add'); ?>" class="form form_neworg">

        <div class="form_body form_neworg_body">
            <div class="form_neworg_body-wrapper">
                <div id="step1" class="row col-xs-4 form_neworg_body-wrapper-item">
                    <div class="input-field col-xs-12">
                        <input type="text" id="org_name" name="org_name" length="60" placeholder="Университет ИТМО">
                        <label for="org_name">Название организации</label>
                        <span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
                    </div>
                    <div class="input-field col-xs-12">
                        <input type="text" id="org_site" name="org_site" class="vp_site" length="38" placeholder="http://votepad.ru/ifmo">
                        <label for="org_site">Сайт организации</label>
                        <span class="help-block">По этому адресу будет доступен личный кабинет организации и видны все мероприятия, проводимые организацией.</span>
                    </div>
                </div>
                <div id="step2" class="row col-xs-4 form_neworg_body-wrapper-item">
                    <div class="input-field col-xs-12">
                        <textarea type="text" id="org_description" name="org_description" length="300" tabindex="-1" placeholder="Санкт-Петербургский национальный исследовательский университет информационных технологий, механики и оптики"></textarea>
                        <label for="org_description">Описание организации</label>
                        <span class="help-block">Напишите основную информацию об организации. По этой информации Вашу организацию можно будет найти через поиск.</span>
                    </div>
                </div>
                <div id="step3" class="row col-xs-4 form_neworg_body-wrapper-item">
                    <div class="input-field col-xs-12">
                        <input type="text" id="official_org_site" name="official_org_site" tabindex="-1" placeholder="http://www.ifmo.ru/">
                        <label for="official_org_site">Официальный сайт организации</label>
                        <span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
                    </div>
                    <div class="col-xs-12">
                        <input type="checkbox" id="confirmrools" name="confirmrools" tabindex="-1">
                        <label for="confirmrools">Мною прочитаны <a href="#/modal_rools" class="underlinehover" style="color:#008DA7" tabindex="-1">правила и соглашение</a> об оказании услуг Votepad</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form_neworg_progress">
            <div class="form_neworg_progress-wrapper"></div>
        </div>

        <div class="form_submit clearfix">
            <button id="btnprevious" type="button" class="btn btn_hollow displaynone">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Назад
            </button>
            <button id="btnnext" type="button" class="btn btn_hollow pull-right">Продолжить
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </button>
            <button id="btnsubmit" type="button" class="btn btn_primary pull-right displaynone">Опубликовать
                <i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
            </button>
        </div>
    </form>
</section>
<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/organization/new.js"></script>

