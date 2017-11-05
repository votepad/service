<div class="section section-1">
    <div class="parallax" data-toggle="parallax">
        <img class="parallax__img" src="<?=$assets;?>static/img/welcome/bg1.jpg" alt="voting participant">
    </div>
    <div class="section__content valign section--lg ">
        <div>
            <h1 class="h1--sale text-white ml-auto mr-auto text-center">
                Автоматизированный подсчёт результатов голосования
            </h1>
            <h2 class="h3--sale text-white ml-auto mr-auto text-center mt-50">
                Создайте свое мероприятие и предоставьте доступ экспертному жюри. Получите мгновенно подсчитанные результаты и страницу с победителями.
            </h2>
            <div class="mt-50 ml-auto mr-auto text-center">
                <a data-toggle="modal" data-area="registr_modal" class="btn btn--lg btn--default btn--round btn--scaled btn--join">Присоединиться</a>
            </div>
        </div>
    </div>
    <div class="section__cover-filter"></div>
</div>

<div class="section section-2 clear-fix">
    <div class="container clear-fix">
        <div class="container-image pull-left">
            <div class="container-image-area">
                <img src="<?=$assets; ?>static/img/welcome/iphoneframe.png" alt="Automated scoring system">
                <video id=""  autoplay loop controls>
                    <source src="<?=$assets; ?>static/img/welcome/judgepanel.mov" />
                </video>
            </div>
        </div>
        <div class="container-feature pull-left valign">
            <div class="container-feature-area">
                <h4 class="container-feature-header">
                    Оценивание в один клик
                </h4>
                <p class="container-feature-text">
                    Используя votepad, Вам не составит труда проставить баллы участникам по заданным критериям. Просто предоставьте доступ жюри к системе, где они со своих устройств смогут оценить в один клик.
                </p>
                <!--<a href="/features#scoringsystem" type="button" class="btn btn_primary container-feature-button">Подробнее</a>-->
            </div>
        </div>
    </div>
    <div class="container clear-fix">
        <div class="container-image pull-right">
            <div class="container-image-area">
                <img src="<?=$assets; ?>static/img/welcome/iphoneframe.png" alt="Get the results immediately">
                <video id="" autoplay loop controls >
                    <source src="<?=$assets; ?>static/img/welcome/event_landing.mov" />
                </video>
            </div>
        </div>
        <div class="container-feature pull-left valign">
            <div class="container-feature-area">
                <h4 class="container-feature-header">
                    Получение результатов мгновенно
                </h4>
                <p class="container-feature-text">
                    Получите актуальные баллы сразу после их проставления жюри. Опубликуйте результаты на странице мероприятия в тот момент, когда вам необходимо их огласить.
                </p>
                <p class="container-feature-text">
                    Установите автоматическую публикацию результатов, чтобы гости знали актуальные баллы в режиме онлайн.
                </p>
                <!--<a href="/features#immediatelyresults" type="button" class="btn btn_primary container-feature-button">Подробнее</a>-->
            </div>
        </div>
    </div>
    <div class="container clear-fix">
        <div class="container-image pull-left">
            <div class="container-image-area">
                <img src="<?=$assets; ?>static/img/welcome/iphoneframe.png" alt="Get the correctly counted results">
                <video id="" autoplay loop>
                    <source src="<?=$assets; ?>static/img/welcome/allok.mov" />
                </video>
            </div>
        </div>
        <div class="container-feature pull-left valign">
            <div class="container-feature-area">
                <h4 class="container-feature-header">
                    Достоверные результаты
                </h4>
                <p class="container-feature-text">
                    У вас будут всегда точные и достоверные баллы, позволяющие провести справедливое мероприятие.
                </p>
                <p class="container-feature-text">
                    Используя наш продукт, гарантируется, что баллы проставленные жюри не будут искажены и подтасованы во время подсчета финального результата.
                </p>
                <!--<a href="/features#correctlyresults" type="button" class="btn btn_primary container-feature-button">Подробнее</a>-->
            </div>
        </div>
    </div>
</div>
<div class="section section-small section-3 clear-fix">
    <div class="container">
        <h2 class="container-header">Как работает Votepad?</h2>
        <p class="container-text">
            1. Создайте действующих лиц: экспертное жюри, участники и команды.
        </p>
        <p class="container-text">
            2. Создайте сценарий мероприятия: критерии, этапы и конкурсы.
        </p>
        <p class="container-text">
            3. Предоставьте доступ к системе экспертному жюри.
        </p>
        <p class="container-text">
            4. Опубликуйте результаты.
        </p>
        <a type="button" class="btn btn--lg btn--default btn--round btn--scaled btn--join" data-toggle="modal" data-area="registr_modal">зарегистрироваться</a>
    </div>
</div>
<div class="section section-4 clear-fix">
    <div class="container">
        <h2 class="container-header">Реализованные мероприятия</h2>

        <div class="event_wrapper" id="eventsWrapper">

            <? foreach ($events as $event) : ?>

                <?= View::factory('welcome/blocks/event-card', array('event' => $event)); ?>

            <? endforeach; ?>

        </div>

        <div class="width-full text-center mb-50">

            <a role="button" id="moreEvents" data-offset="<?= count($events); ?>" class="btn btn--lg btn--brand btn--round btn--scaled fs-1_5 pl-30 pr-30 pt-15 pb-15">Загрузить ещё</a>

        </div>

    </div>
</div>
