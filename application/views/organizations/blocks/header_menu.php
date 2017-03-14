<? if($isLogged): ?>
<a class="header_button" href="<?=URL::site('event/new'); ?>">
    <span class="header_text">Создать мероприятие</span>
</a>

<a class="header_button" href="<?=URL::site('organization/' . $id . '/settings/main' ); ?>">
    <span class="header_text">Настройки</span>
</a>
<? endif; ?>
