<div class="section section-1 parallax" data-toggle="parallax">
    <div class="dark-bg"></div>
    <img class="parallax__img" src="<?=$assets;?>static/img/welcome/bg1.jpg" alt="voting participant">
    <div class="section--lg valign m-t-15">
        <div class="container animated fade__in">
            <h1 class="h1--sale text-white m-l-auto m-r-auto text-center">
                Автоматизированный подсчёт результатов голосования
            </h1>
            <h2 class="h3--sale text-white m-l-auto m-r-auto text-center m-t-50">
                Создайте свое мероприятие и предоставьте доступ экспертному жюри. Получите мгновенно подсчитанные результаты и страницу с победителями.
            </h2>
            <div class="m-t-50 m-l-auto m-r-auto text-center">
                <a data-toggle="modal" data-area="registr_modal" class="btn btn--lg btn--default btn--round btn--scaled btn--join">Присоединиться</a>
            </div>
        </div>

    </div>
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

        <ul class="clear-fix list-style--none">

            <? foreach ($events as $event) : ?>

                <li class="event_wrapper col-xs-12 col-md-6 col-lg-4">

                    <div class="event_card">

                        <div class="event_card-image" style="background-image: url('<?= URL::site('uploads/events/branding/' . $event->branding);?>')"></div>

                        <a href="<?= URL::site('event/' . $event->id)?>" class="event_card-title valign">

                            <span class="center"><?= $event->name; ?></span>

                            <div class="background-dark"></div>

                        </a>

                    </div>

                </li>

            <? endforeach; ?>

        </ul>

    </div>
</div>
