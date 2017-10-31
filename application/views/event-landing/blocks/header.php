<div class="container">
    <div class="header-landing__menu-icon fl_l">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="header-landing__menu animated fl_l">
        <a href="<?=URL::site('event/' . $event->id); ?>" class="header-landing__link">
            Главная
        </a>
        <!--            <a role="button" class="header-landing__link toDescription">-->
        <!--                О мероприятие-->
        <!--            </a>-->
        <!--            <a href="" class="header-landing__link">-->
        <!--                Новости-->
        <!--            </a>-->
        <a href="<?=URL::site('event/' . $event->id . '/results'); ?>" class="header-landing__link">
            Результаты
        </a>
    </div>

    <div class="fl_r dropdown" data-toggle="dropdown">
        <? if ( !$isLogged ): ?>
            <a role="button" class="header-landing__link fl_r" data-toggle="modal" data-target="#auth_modal">
                Войти
            </a>
        <? else: ?>
            <a class="header-landing__link dropdown__btn fl_r">
                <?=$user->name; ?>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </a>
            <div class="dropdown__menu dropdown__menu--right">
                <a href="<?=URL::site('event/' . $event->id . '/settings'); ?>" class="dropdown__link">
                    <i class="fa fa-cubes dropdown__icon" aria-hidden="true"></i>
                    Настройки
                </a>
                <div class="divider"></div>
                <a href="<?= URL::site('user/'.$user->id); ?>" class="dropdown__link">
                    <i class="fa fa-user dropdown__icon" aria-hidden="true"></i>
                    Профиль
                </a>
                <a href="<?=URL::site('sign/organizer/logout'); ?>" class="dropdown__link">
                    <i class="fa fa-sign-out dropdown__icon" aria-hidden="true"></i>
                    Выйти
                </a>
            </div>
        <? endif; ?>
    </div>

</div>