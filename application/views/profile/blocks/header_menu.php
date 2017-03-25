<? if ($isLogged) : ?>
<a class="header__button header__button--hover" href="<?=URL::site('organization/new'); ?>">
    Создать организацию
</a>
<? endif; ?>

<div class="dropdown hide" data-toggle="dropdown">
    <a class="header__button dropdown__btn">
        <span style="margin-right: 5px">Ещё</span>
        <i class="fa fa-caret-down" aria-hidden="true"></i>
    </a>
    <div id="additionalMenuItem" class="dropdown__menu dropdown__menu--right">

    </div>
</div>
