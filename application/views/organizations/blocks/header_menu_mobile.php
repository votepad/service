<li class="mobile-menu_item">
    <a href="<?=URL::site('organization/' . $organization->id ); ?>" class="mobile-menu_item-link">
        <?=$organization->name; ?>
    </a>
</li>
<? if($isLogged && $isMember && $isOwner): ?>
    <li class="mobile-menu_item">
        <a role="button" class="mobile-menu_item-link" data-toggle="collapse" data-area="orgSettings">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Настройки
        </a>
        <ul id="orgSettings" class="mobile-menu_collapse collapse">
            <li class="mobile-menu_collapse-item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>" class="mobile-menu_collapse-link">
                    Об организации
                </a>
            </li>
            <li class="mobile-menu_collapse-item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/team' ); ?>" class="mobile-menu_collapse-link">
                    Сотрудники
                </a>
            </li>
        </ul>
    </li>

<? endif; ?>

<? if($isLogged && $isMember): ?>
    <li class="mobile-menu_item">
        <a href="<?=URL::site('event/new'); ?>" class="mobile-menu_item-link">
            Создать мероприятие
        </a>
    </li>
<? endif; ?>

<? if($isLogged && !$isMember): ?>
    <li class="mobile-menu_item">
        <a href="<?=URL::site('organization/new'); ?>"  class="mobile-menu_item-link">
            Создать организацию
        </a>
    </li>
<? endif; ?>