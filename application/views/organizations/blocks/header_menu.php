<a class="header-menu_btn" href="<?=URL::site('organization/' . $organization->id ); ?>">
    <?=$organization->name; ?>
</a>

<? if($isLogged && $isMember && $isOwner): ?>
<a class="header-menu_btn" href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>">
    Настройки
</a>
<? endif; ?>

<? if($isLogged && $isMember): ?>
    <a class="header-menu_btn" href="<?=URL::site('event/new'); ?>">
        Создать мероприятие
    </a>
<? endif; ?>

<? if($isLogged && !$isMember):     ?>
    <a class="header-menu_btn" href="<?=URL::site('organization/new'); ?>">
        Создать организацию
    </a>
<? endif; ?>
