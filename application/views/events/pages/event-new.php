<div class="section__content pt-40">

    <form class="block" id="newEvent">

        <div class="block__heading ">
            <h4 class="h4 text-brand mt-0">
                Новое мероприятие
                <small>Заполните основную информацию о мероприятие, чтобы его было проще найти в поисковых системах и на сайте!</small>
            </h4>
        </div>

        <div class="block__wrapper pt-10">

            <div class="form-group">
                <input type="text" id="name" name="name" maxlength="150" class="form-group__input" autocomplete="off">
                <label class="form-group__label" for="name">Название мероприятия</label>
                <small class="form-group__help-block">Название будет отображено на странице с результатами мероприятия.</small>
            </div>

            <div class="form-group">
                <textarea id="description" name="description" maxlength="300" class="form-group__textarea" autocomplete="off"></textarea>
                <label class="form-group__label" for="description">Описание мероприятия</label>
                <span class="form-group__help-block">Напишите основную информацию о мероприятии. По этой информации Ваше мероприятие будет проще найти через поиск.</span>
            </div>

            <div class="form-group">
                <input type="text" id="tags" name="tags" class="form-group__input" autocomplete="off" placeholder="Хэштеги мероприятия">
                <span class="form-group__help-block">Допустимы только буквы и цифры.</span>
            </div>

            <div class="form-group width-sm-290 mr-sm-20 width-md-460 width-lg-560">
                <input type="datetime-local" id="start" name="start" class="form-group__input" autocomplete="off">
                <label class="form-group__label form-group__label--active" for="start">Дата начала</label>
            </div>

            <div class="form-group width-sm-290 width-md-460 width-lg-560">
                <input type="datetime-local" id="end" name="end" class="form-group__input" autocomplete="off">
                <label class="form-group__label form-group__label--active" for="end">Дата завершения</label>
            </div>

            <div class="form-group">
                <input type="text" id="address" name="address" maxlength="100" class="form-group__input" autocomplete="off">
                <label class="form-group__label" for="address">Адрес</label>
                <span class="form-group__help-block">Укажите, где будет проходить мероприятие. Эта информация отразится на странице мероприятия.</span>
            </div>

        </div>

        <div class="block__footer p-20">
            <input type="hidden" name="csrf" value="<?= Security::token(); ?>">
            <button type="submit" class="ui-btn ui-btn--1 fl_r">
                Опубликовать
            </button>
        </div>

    </form>

</div>
<script type="text/javascript" src="<?=$assets; ?>vendor/choices/dist/choices.min.js?v=<?= filemtime("assets/vendor/choices/dist/choices.min.js") ?>"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event-new.js?v=<?= filemtime("assets/static/js/event-new.js") ?>"></script>