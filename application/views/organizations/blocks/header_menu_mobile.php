<li class="mobile-aside__menu__item">
    <a href="<?=URL::site('organization/' . $organization->id ); ?>" class="mobile-aside__menu-link">
        <?=$organization->name; ?>
    </a>
</li>
<? if($isLogged && $isMember && $isOwner): ?>
    <li class="mobile-aside__menu__item">
        <a role="button" class="mobile-aside__menu-link" data-toggle="collapse" data-area="orgSettings" data-opened="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Настройки
        </a>
        <ul id="orgSettings" class="mobile-aside__collapse collapse">
            <li class="mobile-aside__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>" class="mobile-aside__collapse-link">
                    Об организации
                </a>
            </li>
            <li class="mobile-aside__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/team' ); ?>" class="mobile-aside__collapse-link">
                    Сотрудники
                </a>
            </li>
        </ul>
    </li>

<? endif; ?>

<? if($isLogged && $isMember): ?>
    <li class="mobile-aside__menu__item">
        <a href="<?=URL::site('event/new'); ?>" class="mobile-aside__menu-link">
            Создать мероприятие
        </a>
    </li>
<? endif; ?>

<? if($isLogged && !$isMember): ?>
    <li class="mobile-aside__menu__item">
        <a href="<?=URL::site('organization/new'); ?>"  class="mobile-aside__menu-link">
            Создать организацию
        </a>
    </li>
<? endif; ?>