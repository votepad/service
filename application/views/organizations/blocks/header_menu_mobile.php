<li class="mobile__menu__item">
    <a href="<?=URL::site('organization/' . $organization->id ); ?>" class="mobile__menu__link">
        <?=$organization->name; ?>
    </a>
</li>
<? if($isLogged && $isMember && $isOwner): ?>
    <li class="mobile__menu__item">
        <a role="button" class="mobile__menu__link" data-toggle="collapse" data-area="orgSettings" data-opened="false">
            <i class="fa fa-cog" aria-hidden="true"></i>
            Настройки
        </a>
        <ul id="orgSettings" class="mobile__collapse collapse">
            <li class="mobile__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>" class="mobile__collapse__link">
                    Об организации
                </a>
            </li>
            <li class="mobile__collapse__item">
                <a href="<?=URL::site('organization/' . $organization->id . '/settings/team' ); ?>" class="mobile__collapse__link">
                    Сотрудники
                </a>
            </li>
        </ul>
    </li>

<? endif; ?>

<? if($isLogged && $isMember): ?>
    <li class="mobile__menu__item">
        <a href="<?=URL::site('event/new'); ?>" class="mobile__menu__link">
            Создать мероприятие
        </a>
    </li>
<? endif; ?>

<? if($isLogged && !$isMember): ?>
    <li class="mobile__menu__item">
        <a href="<?=URL::site('organization/new'); ?>"  class="mobile__menu__link">
            Создать организацию
        </a>
    </li>
<? endif; ?>