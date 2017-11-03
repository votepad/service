<div class="block t-lh-50px mb-0 bb-0 pl-md-25 hidden-xs hidden-sm text-bold">
    Мероприятие пройдет <?= strftime('с %d %b %Y %H:%M', strtotime($event->dt_start)) . ' по ' . strftime('%d %b %Y %H:%M', strtotime($event->dt_end)); ?>
</div>

<form class="block">

    <div class="block__wrapper p-20">

        <div id="notPublishBlock" class="<?= $event->type == 0 ?: 'hide'?>">
            <p>
                На данный момент страница с результатами <b>не обубликована</b>.
                Рекомендуем опубликовать её, как только заполните всю необходимую информацию.
            </p>
            <a role="button" onclick="eventInfo.changeType(this)" data-id="<?= $event->id; ?>" data-type="1" class="ui-btn ui-btn--1">Обубликовать</a>
        </div>

        <div id="publishBlock" class="<?= $event->type == 1 ?: 'hide'?>">
            <p>
                Страница с результатами доступна по адресу:
                <a href="<?= URL::site('event/'.$event->id);?>" class="link">
                    <?= $_SERVER['SERVER_NAME'] . URL::site('event/'.$event->id);?>
                </a>
            </p>
            <a role="button" onclick="eventInfo.changeType(this)" data-id="<?= $event->id; ?>" data-type="0" class="ui-btn ui-btn--1">Снять с публикции</a>
        </div>

    </div>

</form>


<form class="block" id="eventInfo">

    <div class="block__heading t-lh-50px p-0 pl-25 bb-1">
        Изменение основной информации
    </div>

    <div class="block__wrapper p-20">

        <div class="form-group">
            <input type="text" id="name" name="name" maxlength="150" class="form-group__input" autocomplete="off" value="<?= $event->name; ?>">
            <label class="form-group__label form-group__label--active" for="name">Название мероприятия</label>
        </div>

        <div class="form-group">
            <textarea id="description" name="description" maxlength="300" class="form-group__textarea" autocomplete="off"><?= $event->description; ?></textarea>
            <label class="form-group__label form-group__label--active" for="description">Описание мероприятия</label>
        </div>

        <div class="form-group">
            <input id="organization" name="organization" maxlength="64" class="form-group__input" autocomplete="off" value="<?= $event->organization; ?>">
            <label class="form-group__label form-group__label--active" for="organization">Организация</label>
            <span class="form-group__help-block">Укажите организацию, которая проводит мероприятие.</span>
        </div>

        <div class="form-group">
            <input type="text" id="tags" name="tags" class="form-group__input" autocomplete="off" placeholder="Ключевые слова" value="<?= $event->tags; ?>">
            <span class="form-group__help-block">Допустимы только буквы и цифры. Эти слова помогут быстре найти ваше мероприятие в интернете.</span>
        </div>

        <div class="form-group width-sm-290 mr-sm-20 width-lg-390">
            <input type="datetime-local" id="start" name="start" class="form-group__input" autocomplete="off" value="<?= date('Y-m-d\TH:i:s', strtotime($event->dt_start)); ?>">
            <label class="form-group__label form-group__label--active" for="start">Дата начала</label>
        </div>

        <div class="form-group width-sm-290 width-lg-390">
            <input type="datetime-local" id="end" name="end" class="form-group__input" autocomplete="off" value="<?= date('Y-m-d\TH:i:s', strtotime($event->dt_end)); ?>">
            <label class="form-group__label form-group__label--active" for="end">Дата завершения</label>
        </div>

        <div class="form-group">
            <input type="text" id="address" name="address" maxlength="100" class="form-group__input" autocomplete="off" value="<?= $event->address; ?>">
            <label class="form-group__label" for="address">Адрес</label>
        </div>

    </div>

    <div class="block__footer p-20">
        <input type="hidden" name="csrf" value="<?= Security::token(); ?>">
        <input type="hidden" name="id" value="<?= $event->id; ?>">
        <button type="submit" class="ui-btn ui-btn--1 fl_r">
            Изменить информацию
        </button>
    </div>

</form>

<script type="text/javascript" src="<?=$assets; ?>vendor/choices/dist/choices.min.js?v=<?= filemtime("assets/vendor/choices/dist/choices.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-settings-info.js?v=<?= filemtime("assets/static/js/event-settings-info.js") ?>"></script>