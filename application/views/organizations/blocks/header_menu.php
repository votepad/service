
<? if($isLogged && $isMember && $isOwner): ?>
<a class="header-wrapper_menu_btn" href="<?=URL::site('organization/' . $id . '/settings/main' ); ?>">
    Настройки
</a>
<? endif; ?>

<? if($isLogged && $isMember): ?>
    <a class="header-wrapper_menu_btn" href="<?=URL::site('event/new'); ?>">
        Создать мероприятие
    </a>
<? endif; ?>

<? if($isLogged && !$isMember):     ?>
    <a class="header-wrapper_menu_btn" href="<?=URL::site('organization/new'); ?>">
        Создать организацию
    </a>
<? endif; ?>
