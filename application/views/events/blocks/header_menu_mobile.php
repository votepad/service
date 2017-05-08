<li class="mobile-aside__menu-item">
    <a href="<?=URL::site('event/' . $event->id); ?>" class="mobile-aside__menu-link">
        <?=$event->name; ?>
    </a>
</li>

<li class="mobile-aside__menu-item <?= ($action == 'settings' || $section == 'settings') ? 'mobile-aside__menu-item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventSettings" data-opened="false" class="mobile-aside__menu-link <?= ($action == 'settings' || $section == 'settings') ? 'mobile-aside__menu-link--active' : ''; ?>">
        <i class="fa fa-cog" aria-hidden="true"></i>
        Настройки
    </a>
    <ul id="eventSettings" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings' ); ?>" class="mobile-aside__collapse-link <?= $action == 'settings' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Главные настройки
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/info' ); ?>" class="mobile-aside__collapse-link <?= $action == 'info' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                О мероприятии
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/assistants' ); ?>" class="mobile-aside__collapse-link <?= $action == 'assistants' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Помощники
            </a>
        </li>
    </ul>
</li>

<li class="mobile-aside__menu-item <?= ($action == 'control' || $section == 'control') ? 'mobile-aside__menu-item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventControl" data-opened="false" class="mobile-aside__menu-link <?= ($action == 'control' || $section == 'control') ? 'mobile-aside__menu-link--active' : ''; ?>">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        Управление
    </a>
    <ul id="eventControl" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/control/results'); ?>" class="mobile-aside__collapse-link <?= $action == 'results' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Результаты
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/control/plan' ); ?>" class="mobile-aside__collapse-link <?= $action == 'plan' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                План
            </a>
        </li>
    </ul>
</li>

<li class="mobile-aside__menu-item <?= ($action == 'scenario' || $section == 'scenario') ? 'mobile-aside__menu-item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventPattern" data-opened="false" class="mobile-aside__menu-link <?= ($action == 'scenario' || $section == 'scenario') ? 'mobile-aside__menu-link--active' : ''; ?>">
        <i class="fa fa-cubes" aria-hidden="true"></i>
        Сценарий
    </a>
    <ul id="eventPattern" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/criterias' ); ?>" class="mobile-aside__collapse-link <?= $action == 'criterias' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Критерии
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/stages' ); ?>" class="mobile-aside__collapse-link <?= $action == 'stages' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Этапы
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/contests' ); ?>" class="mobile-aside__collapse-link <?= $action == 'contests' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Конкурсы
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/result' ); ?>" class="mobile-aside__collapse-link <?= $action == 'result' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Результат
            </a>
        </li>
    </ul>
</li>

<li class="mobile-aside__menu-item <?= ($action == 'members' || $section == 'members') ? 'mobile-aside__menu-item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventMembers" data-opened="false" class="mobile-aside__menu-link <?= ($action == 'members' || $section == 'members') ? 'mobile-aside__menu-link--active' : ''; ?>">
        <i class="fa fa-users" aria-hidden="true"></i>
        Действующие лица
    </a>
    <ul id="eventMembers" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/members/judges' ); ?>" class="mobile-aside__collapse-link <?= $action == 'judges' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Члены жюри
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/members/participants' ); ?>" class="mobile-aside__collapse-link <?= $action == 'participants' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Участники
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/members/teams' ); ?>" class="mobile-aside__collapse-link <?= $action == 'teams' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                Команды
            </a>
        </li>
    </ul>
</li>