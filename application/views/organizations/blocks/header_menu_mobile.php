<li class="header-mobile_menu_item">
    <a href="<?=URL::site('organization/' . $organization->id ); ?>" class="header-mobile_menu_item_btn">
        <?=$organization->name; ?>
    </a>
</li>
<? if($isLogged && $isMember && $isOwner): ?>
    <li class="header-mobile_menu_item">
        <a role="button" class="header-mobile_menu_item_btn" data-toggle="collapse" area-control="orgSettings">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Настройки
        </a>
        <ul id="orgSettings" class="collapse header-mobile_menu_item_collapse-menu">
            <li class="header-mobile_menu_item_collapse-menu_item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>" class="header-mobile_menu_item_collapse-menu_item_btn">
                    Об организации
                </a>
            </li>
            <li class="header-mobile_menu_item_collapse-menu_item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/team' ); ?>" class="header-mobile_menu_item_collapse-menu_item_btn">
                    Сотрудники
                </a>
            </li>
        </ul>
    </li>

<? endif; ?>

<? if($isLogged && $isMember): ?>
    <li class="header-mobile_menu_item">
        <a href="<?=URL::site('event/new'); ?>" class="header-mobile_menu_item_btn">
            Создать мероприятие
        </a>
    </li>
<? endif; ?>

<? if($isLogged && !$isMember): ?>
    <li class="header-mobile_menu_item">
        <a href="<?=URL::site('organization/new'); ?>"  class="header-mobile_menu_item_btn">
            Создать организацию
        </a>
    </li>
<? endif; ?>