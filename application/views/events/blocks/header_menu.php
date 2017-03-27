<a class="header__button header__button--hover" href="<?=URL::site('event/' . $event->id ); ?>">
    <?=$event->title; ?>
</a>

<a class="header__button header__button--hover" href="<?=URL::site('event/' . $event->id . '/settings'); ?>">
    Настройки
</a>

<a class="header__button header__button--hover" href="<?=URL::site('event/' . $event->id . '/control'); ?>">
    Управление
</a>

<a class="header__button header__button--hover" href="<?=URL::site('event/' . $event->id . '/app/result'); ?>">
    Сценарий
</a>

<a class="header__button header__button--hover" href="<?=URL::site('event/' . $event->id . '/app/judges'); ?>">
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
