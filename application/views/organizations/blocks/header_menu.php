
<? if($isLogged && $isMember && $isOwner): ?>
<a class="header_button" href="<?=URL::site('organization/' . $id . '/settings/main' ); ?>">
    <span class="header_text">Настройки</span>
</a>
<? endif; ?>

<? if($isLogged && $isMember): ?>
    <a class="header_button" href="<?=URL::site('event/new'); ?>">
        <span class="header_text">Создать мероприятие</span>
    </a>
<? endif; ?>

<? if($isLogged && !$isMember):     ?>
    <a class="header_button" href="<?=URL::site('organization/new'); ?>">
        <span class="header_text">Создать организацию</span>
    </a>
<? endif; ?>
