<li class="aside__item">
    <a href="<?=URL::site('event/' . $event->id); ?>" class="aside__link">
        <?=$event->name; ?>
    </a>
</li>

<li class="aside__item <?= ($action == 'settings' || $section == 'settings') ? 'aside__item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventSettings" data-opened="false" class="aside__link <?= ($action == 'settings' || $section == 'settings') ? 'aside__link--active' : ''; ?>">
        <i class="fa fa-cog" aria-hidden="true"></i>
        Настройки
    </a>
    <ul id="eventSettings" class="aside__collapse collapse">
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/settings' ); ?>" class="aside__collapse-link <?= $action == 'settings' ? 'aside__collapse-link--active' : ''; ?>">
                Главные настройки
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/info' ); ?>" class="aside__collapse-link <?= $action == 'info' ? 'aside__collapse-link--active' : ''; ?>">
                О мероприятии
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/assistants' ); ?>" class="aside__collapse-link <?= $action == 'assistants' ? 'aside__collapse-link--active' : ''; ?>">
                Помощники
            </a>
        </li>
    </ul>
</li>

<li class="aside__item <?= ($action == 'control' || $section == 'control') ? 'aside__item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventControl" data-opened="false" class="aside__link <?= ($action == 'control' || $section == 'control') ? 'aside__link--active' : ''; ?>">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        Управление
    </a>
    <ul id="eventControl" class="aside__collapse collapse">
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/control/scores'); ?>" class="aside__collapse-link <?= $action == 'scores' ? 'aside__collapse-link--active' : ''; ?>">
                Результаты
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/control/plan' ); ?>" class="aside__collapse-link <?= $action == 'plan' ? 'aside__collapse-link--active' : ''; ?>">
                План
            </a>
        </li>
    </ul>
</li>
<li class="aside__item <?= ($action == 'scenario' || $section == 'scenario') ? 'aside__item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventPattern" data-opened="false" class="aside__link <?= ($action == 'scenario' || $section == 'scenario') ? 'aside__link--active' : ''; ?>">
        <i class="fa fa-cubes" aria-hidden="true"></i>
        Сценарий
    </a>
    <ul id="eventPattern" class="aside__collapse collapse">
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/criterias' ); ?>" class="aside__collapse-link <?= $action == 'criterias' ? 'aside__collapse-link--active' : ''; ?>">
                Критерии
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/stages' ); ?>" class="aside__collapse-link <?= $action == 'stages' ? 'aside__collapse-link--active' : ''; ?>">
                Этапы
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/contests' ); ?>" class="aside__collapse-link <?= $action == 'contests' ? 'aside__collapse-link--active' : ''; ?>">
                Конкурсы
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/scenario/result' ); ?>" class="aside__collapse-link <?= $action == 'result' ? 'aside__collapse-link--active' : ''; ?>">
                Результат
            </a>
        </li>
    </ul>
</li>

<li class="aside__item <?= ($action == 'members' || $section == 'members') ? 'aside__item--active' : ''; ?>">
    <a role="button" data-toggle="collapse" data-area="eventMembers" data-opened="false" class="aside__link <?= ($action == 'members' || $section == 'members') ? 'aside__link--active' : ''; ?>">
        <i class="fa fa-users" aria-hidden="true"></i>
        Действующие лица
    </a>
    <ul id="eventMembers" class="aside__collapse collapse">
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/members/judges' ); ?>" class="aside__collapse-link <?= $action == 'judges' ? 'aside__collapse-link--active' : ''; ?>">
                Члены жюри
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/members/participants' ); ?>" class="aside__collapse-link <?= $action == 'participants' ? 'aside__collapse-link--active' : ''; ?>">
                Участники
            </a>
        </li>
        <li class="aside__collapse-item">
            <a href="<?=URL::site('event/' . $event->id . '/members/teams' ); ?>" class="aside__collapse-link <?= $action == 'teams' ? 'aside__collapse-link--active' : ''; ?>">
                Команды
            </a>
        </li>
    </ul>
</li>