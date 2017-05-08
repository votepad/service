<?
    $isOwner = $organization->isOwner(($user && $user->id) ? $user->id : 0);
    $isMember = $organization->isMember(($user && $user->id) ? $user->id : 0);
?>

<li class="mobile-aside__menu__item <?= $action == 'show' ? 'mobile-aside__menu-item--active' : ''; ?>">
    <a href="<?=URL::site('organization/' . $organization->id ); ?>" class="mobile-aside__menu-link <?= $action == 'show' ? 'mobile-aside__menu-link--active' : ''; ?>">
        <?=$organization->name; ?>
    </a>
</li>

<? if($isLogged && $isMember): ?>
    <li class="mobile-aside__menu__item <?= $action == 'new_event' ? 'mobile-aside__menu-item--active' : ''; ?>">
        <a href="<?=URL::site('organization/' . $organization->id . '/event/new'); ?>" class="mobile-aside__menu-link <?= $action == 'new_event' ? 'mobile-aside__menu-link--active' : ''; ?>">
            Создать мероприятие
        </a>
    </li>
<? endif; ?>

<? if($isLogged && $isMember && $isOwner): ?>
    <li class="mobile-aside__menu__item <?= ($action == 'main' || $action == 'team') ? 'mobile-aside__menu-item--active' : ''; ?>">
        <a role="button" data-toggle="collapse" data-area="orgSettings" data-opened="false" class="mobile-aside__menu-link <?= ($action == 'main' || $action == 'team') ? 'mobile-aside__menu-link--active' : ''; ?>">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Настройки
        </a>
        <ul id="orgSettings" class="mobile-aside__collapse collapse">
            <li class="mobile-aside__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>" class="mobile-aside__collapse-link <?= $action == 'main' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                    Об организации
                </a>
            </li>
            <li class="mobile-aside__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/team' ); ?>" class="mobile-aside__collapse-link <?= $action == 'team' ? 'mobile-aside__collapse-link--active' : ''; ?>">
                    Сотрудники
                </a>
            </li>
        </ul>
    </li>

<? endif; ?>
