<div class="section__cover">
    <div class="parallax" data-toggle="parallax">
        <img id="eventBranding" src="/uploads/events/branding/o_<?=$event->branding; ?>" alt="event branding" class="parallax__img">
    </div>
    <div class="section__content valign">
        <div class="section__cover-update-wrapper">
            <a onclick="event.updateBranding()" role="button" class="section__cover-update-btn" data-pk="<?=$event->id; ?>">
                <i class="fa fa-camera section__cover-update-icon" aria-hidden="true"></i>
                <span class="section__cover-update-text">Обновить фото обложки</span>
            </a>
        </div>
        <div class="section__cover-text">
            <?= $event->name; ?>
        </div>
    </div>
    <div class="section__cover-filter"></div>
</div>


<div class="section__content">

    <div class="width-full width-md-300 mr-md-40">

        <div class="block hidden-xs hidden-sm">

            <ul class="nav">

                <li class="nav__item-group <?= $section == 'settings' ? 'nav__item-group--active': ''; ?>">
                    <a role="button" data-toggle="collapse" data-area="sectionSettings" data-opened="<?= $section == 'settings' ? 'true': 'false'; ?>" class="nav__item collapse__btn">
                        <i class="fa fa-cog nav__item-icon"></i>
                        Настройки
                        <i class="fa fa-angle-down collapse__icon-right nav__item-icon nav__item-icon--right" aria-hidden="true"></i>
                    </a>
                    <div id="sectionSettings" class="collapse nav__collapse">
                        <a href="<?= URL::site('event/' . $event->id . '/settings/info'); ?>" class="nav__item <?= $action == 'info' ? 'nav__item--active': ''; ?>">
                            Основная информация
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/settings/assistants'); ?>" class="nav__item <?= $action == 'assistants' ? 'nav__item--active': ''; ?>">
                            Помощьники
                        </a>
                    </div>
                </li>

                <li class="nav__item-group <?= $section == 'control' ? 'nav__item-group--active': ''; ?>">
                    <a role="button" data-toggle="collapse" data-area="sectionControl" data-opened="<?= $section == 'control' ? 'true': 'false'; ?>" class="nav__item collapse__btn">
                        <i class="fa fa-bar-chart nav__item-icon"></i>
                        Администрирование
                        <i class="fa fa-angle-down collapse__icon-right nav__item-icon nav__item-icon--right" aria-hidden="true"></i>
                    </a>
                    <div id="sectionControl" class="collapse nav__collapse">
                        <a href="<?= URL::site('event/' . $event->id . '/control/scores'); ?>" class="nav__item <?= $action == 'scores' ? 'nav__item--active': ''; ?>">
                            Результаты
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/control/plan'); ?>" class="nav__item <?= $action == 'plan' ? 'nav__item--active': ''; ?>">
                            План мероприятия
                        </a>
                    </div>
                </li>

                <li class="nav__item-group <?= $section == 'scenario' ? 'nav__item-group--active': ''; ?>">
                    <a role="button" data-toggle="collapse" data-area="sectionScenario" data-opened="<?= $section == 'scenario' ? 'true': 'false'; ?>" class="nav__item collapse__btn">
                        <i class="fa fa-cubes nav__item-icon"></i>
                        Сценарий
                        <i class="fa fa-angle-down collapse__icon-right nav__item-icon nav__item-icon--right" aria-hidden="true"></i>
                    </a>
                    <div id="sectionScenario" class="collapse nav__collapse">
                        <a href="<?= URL::site('event/' . $event->id . '/scenario/criterias'); ?>" class="nav__item <?= $action == 'criterias' ? 'nav__item--active': ''; ?>">
                            Критерии
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/scenario/stages'); ?>" class="nav__item <?= $action == 'stages' ? 'nav__item--active': ''; ?>">
                            Этапы
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/scenario/contests'); ?>" class="nav__item <?= $action == 'contests' ? 'nav__item--active': ''; ?>">
                            Конкуксы
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/scenario/result'); ?>" class="nav__item <?= $action == 'result' ? 'nav__item--active': ''; ?>">
                            Результат
                        </a>
                    </div>
                </li>

                <li class="nav__item-group <?= $section == 'members' ? 'nav__item-group--active': ''; ?>">
                    <a role="button" data-toggle="collapse" data-area="sectionMembers" data-opened="<?= $section == 'members' ? 'true': 'false'; ?>" class="nav__item collapse__btn">
                        <i class="fa fa-users nav__item-icon"></i>
                        Действующие лица
                        <i class="fa fa-angle-down collapse__icon-right nav__item-icon nav__item-icon--right" aria-hidden="true"></i>
                    </a>
                    <div id="sectionMembers" class="collapse nav__collapse">
                        <a href="<?= URL::site('event/' . $event->id . '/members/judges'); ?>" class="nav__item <?= $action == 'judges' ? 'nav__item--active': ''; ?>">
                            Представители жюри
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/members/participants'); ?>" class="nav__item <?= $action == 'participants' ? 'nav__item--active': ''; ?>">
                            Участники
                        </a>
                        <a href="<?= URL::site('event/' . $event->id . '/members/teams'); ?>" class="nav__item <?= $action == 'teams' ? 'nav__item--active': ''; ?>">
                            Команды
                        </a>
                    </div>
                </li>

            </ul>

        </div>

    </div>

    <div class="width-full width-md-640 width-lg-840">

        <div class="entry__wrapper hidden-md hidden-lg">
            <div class="block mb-0 bb-0 ui-tabs">
                <div class="ui-tabs__wrapper">
                    <a role="button" class="ui-tabs__tab <?= $section == 'settings' ? 'ui-tabs__tab--active': ''; ?>">
                        Настройки
                    </a>
                    <a role="button" class="ui-tabs__tab <?= $section == 'control' ? 'ui-tabs__tab--active': ''; ?>">
                        Администрирование
                    </a>
                    <a role="button" class="ui-tabs__tab <?= $section == 'scenario' ? 'ui-tabs__tab--active': ''; ?>">
                        Сценарий
                    </a>
                    <a role="button" class="ui-tabs__tab <?= $section == 'members' ? 'ui-tabs__tab--active': ''; ?>">
                        Действующие лица
                    </a>
                </div>
            </div>
            <div class="block mb-0 bb-0 ui-tabs">
                <div class="ui-tabs__wrapper">
                    <a href="<?= URL::site('event/' . $event->id . '/settings/info'); ?>" class="ui-tabs__tab <?= $action == 'info' ? 'ui-tabs__tab--active': ''; ?>">
                        Основная информация
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/settings/assistants'); ?>" class="ui-tabs__tab <?= $action == 'assistants' ? 'ui-tabs__tab--active': ''; ?>">
                        Помощьники
                    </a>
                </div>
            </div>
            <div class="block mb-0 bb-0 ui-tabs">
                <div class="ui-tabs__wrapper">
                    <a href="<?= URL::site('event/' . $event->id . '/control/scores'); ?>" class="ui-tabs__tab <?= $action == 'scores' ? 'ui-tabs__tab--active': ''; ?>">
                        Результаты
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/control/plan'); ?>" class="ui-tabs__tab <?= $action == 'plan' ? 'ui-tabs__tab--active': ''; ?>">
                        План мероприятия
                    </a>
                </div>
            </div>
            <div class="block mb-0 bb-0 ui-tabs">
                <div class="ui-tabs__wrapper">
                    <a href="<?= URL::site('event/' . $event->id . '/scenario/criterias'); ?>" class="ui-tabs__tab <?= $action == 'criterias' ? 'ui-tabs__tab--active': ''; ?>">
                        Критерии
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/scenario/stages'); ?>" class="ui-tabs__tab <?= $action == 'stages' ? 'ui-tabs__tab--active': ''; ?>">
                        Этапы
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/scenario/contests'); ?>" class="ui-tabs__tab <?= $action == 'contests' ? 'ui-tabs__tab--active': ''; ?>">
                        Конкуксы
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/scenario/result'); ?>" class="ui-tabs__tab <?= $action == 'result' ? 'ui-tabs__tab--active': ''; ?>">
                        Результат
                    </a>
                </div>
            </div>
            <div class="block mb-0 bb-0 ui-tabs">
                <div class="ui-tabs__wrapper">
                    <a href="<?= URL::site('event/' . $event->id . '/members/judges'); ?>" class="ui-tabs__tab <?= $action == 'judges' ? 'ui-tabs__tab--active': ''; ?>">
                        Представители жюри
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/members/participants'); ?>" class="ui-tabs__tab <?= $action == 'participants' ? 'ui-tabs__tab--active': ''; ?>">
                        Участники
                    </a>
                    <a href="<?= URL::site('event/' . $event->id . '/members/teams'); ?>" class="ui-tabs__tab <?= $action == 'teams' ? 'ui-tabs__tab--active': ''; ?>">
                        Команды
                    </a>
                </div>
            </div>
        </div>

        <?= $page; ?>

    </div>

</div>

<!--<script type="text/javascript" src="--><?//=$assets; ?><!--static/js/event.js?v=--><?//= filemtime("assets/static/js/event.js") ?><!--"></script>-->