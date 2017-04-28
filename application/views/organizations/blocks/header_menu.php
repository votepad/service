<?
    $isOwner = $organization->isOwner($user ? $user->id : 0);
    $isMember = $organization->isMember($user ? $user->id : 0);
?>


<a class="header__button header__button--hover" href="<?=URL::site('organization/' . $organization->id ); ?>">
    <?=$organization->name; ?>
</a>

<? if($isLogged && $isMember && $isOwner): ?>
<a class="header__button header__button--hover" href="<?=URL::site('organization/' . $organization->id . '/settings/main' ); ?>">
    Настройки
</a>
<? endif; ?>

<? if($isLogged && $isMember): ?>
    <a class="header__button header__button--hover" href="<?=URL::site('organization/' . $organization->id . '/event/new'); ?>">
        Создать мероприятие
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
