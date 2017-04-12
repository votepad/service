<li class="mobile-aside__menu__item">
    <a href="<?=URL::site('event/' . $event->id); ?>" class="mobile-aside__menu-link">
        <?=$event->name; ?>
    </a>
</li>

<li class="mobile-aside__menu__item">
    <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="eventSettings" data-opened="false">
        <i class="fa fa-cog" aria-hidden="true"></i>
        Настройки
    </a>
    <ul id="eventSettings" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings' ); ?>" class="mobile-aside__collapse-link">
                Главные настройки
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/info' ); ?>" class="mobile-aside__collapse-link">
                О мероприятии
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/settings/assistants' ); ?>" class="mobile-aside__collapse-link">
                Помощники
            </a>
        </li>
    </ul>
</li>

<li class="mobile-aside__menu__item">
    <a href="<?=URL::site('event/' . $event->id . '/control'); ?>" class="mobile-aside__menu-link">
        Управление
    </a>
</li>

<li class="mobile-aside__menu__item">
    <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="eventPattern" data-opened="false">
        <i class="fa fa-cubes" aria-hidden="true"></i>
        Сценарий
    </a>
    <ul id="eventPattern" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/result' ); ?>" class="mobile-aside__collapse-link">
                Результат
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/contests' ); ?>" class="mobile-aside__collapse-link">
                Конкурсы
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/stages' ); ?>" class="mobile-aside__collapse-link">
                Этапы
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/criterias' ); ?>" class="mobile-aside__collapse-link">
                Критерии
            </a>
        </li>
    </ul>
</li>

<li class="mobile-aside__menu__item">
    <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="eventMembers" data-opened="false">
        <i class="fa fa-users" aria-hidden="true"></i>
        Действующие лица
    </a>
    <ul id="eventMembers" class="mobile-aside__collapse collapse">
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/judges' ); ?>" class="mobile-aside__collapse-link">
                Члены жюри
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/participants' ); ?>" class="mobile-aside__collapse-link">
                Участники
            </a>
        </li>
        <li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/teams' ); ?>" class="mobile-aside__collapse-link">
                Команды
            </a>
        </li>
        <!--<li class="mobile-aside__collapse__item">
            <a href="<?=URL::site('event/' . $event->id . '/app/groups' ); ?>" class="mobile-aside__collapse-link">
                Группы
            </a>
        </li>-->
    </ul>
</li>