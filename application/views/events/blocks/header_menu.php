<a class="header__button header__button--hover <?= ($action == 'settings' || $section == 'settings') ? 'header__button--active' : ''; ?>" href="<?=URL::site('event/' . $event->id . '/settings'); ?>">
    Настройки
</a>

<a class="header__button header__button--hover <?= ($action == 'scores' || $section == 'control') ? 'header__button--active' : ''; ?>" href="<?=URL::site('event/' . $event->id . '/control/scores'); ?>">
    Управление
</a>

<a class="header__button header__button--hover <?= ($action == 'criterias' || $section == 'scenario') ? 'header__button--active' : ''; ?>" href="<?=URL::site('event/' . $event->id . '/scenario/criterias'); ?>">
    Сценарий
</a>

<a class="header__button header__button--hover <?= ($action == 'judges' || $section == 'members') ? 'header__button--active' : ''; ?>" href="<?=URL::site('event/' . $event->id . '/members/judges'); ?>">
    Действующие лица
</a>

<div class="dropdown hide" data-toggle="dropdown">
    <a class="header__button dropdown__btn">
        <span style="margin-right: 5px">Ещё</span>
        <i class="fa fa-caret-down" aria-hidden="true"></i>
    </a>
    <div id="additionalMenuItem" class="dropdown__menu dropdown__menu--right">

    </div>
</div>
