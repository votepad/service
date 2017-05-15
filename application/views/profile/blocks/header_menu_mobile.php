<? if ($isLogged) : ?>
    <li class="mobile-aside__menu__item">
        <a href="<?=URL::site('organization/new'); ?>" class="mobile-aside__menu-link">
            Создать организацию
        </a>
    </li>
<? else: ?>
    <li class="mobile-aside__menu__item">
        <a role="button" class="mobile-aside__menu-link" data-toggle="modal" data-target="#auth_modal">
            Войти
        </a>
    </li>
    <li class="mobile-aside__menu__item">
        <a role="button" class="mobile-aside__menu-link" data-toggle="modal" data-target="#registr_modal">
            Регистрация
        </a>
    </li>
<? endif; ?>
