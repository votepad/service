<div class="section__cover">
    <div class="parallax">
        <img id="profileBranding" src="/uploads/profiles/branding/b_<?=$profile->branding; ?>" alt="Profile cover" class="parallax__img parallax__img--show">
    </div>
    <div class="section__content valign">
        <? if ($isLogged && $profile->isOwner) :?>
            <div class="section__cover-update-wrapper">
                <a onclick="profile.updateCover()" role="button" class="section__cover-update-btn" data-pk="<?=$profile->id; ?>">
                    <i class="fa fa-camera section__cover-update-icon" aria-hidden="true"></i>
                    <span class="section__cover-update-text">Обновить фото обложки</span>
                </a>
            </div>
        <? endif; ?>
    </div>
    <div class="section__cover-filter"></div>
</div>


<div class="section__content profile">

    <div class="width-full width-md-300 mr-md-40">

        <div class="profile__block">
            <div class="profile__avatar thumb80">
                <? if ($profile->isOwner) : ?>
                    <a onclick="profile.updateAvatar()" role="button" class="profile__upload">
                        <i class="fa fa-camera profile__upload-icon" aria-hidden="true"></i>
                    </a>
                <? endif; ?>
                <img class="profile__avatar-img" src="<?= URL::site('uploads/profiles/avatar/m_' . $profile->avatar); ?>" alt="Profile Avatar">
            </div>
            <a class="profile__name link" href="<?= URL::site('user/' . $profile->id); ?>">
                <?= $profile->name; ?>
            </a>
            <? if ($profile->isOwner) : ?>
                <div class="profile__btn-group">
                    <a href="<?=URL::site('event/new'); ?>" class="ui-btn ui-btn--1 profile__btn">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-xs">Новое мероприятие</span>
                    </a>
                    <a href="<?= URL::site('user/' . $profile->id . '/settings'); ?>" class="ui-btn ui-btn--2 profile__btn profile__btn--settings">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span class="hidden-xs">Настройки</span>
                    </a>
                    <a href="<?= URL::site('sign/organizer/logout'); ?>" class="ui-btn ui-btn--2 profile__btn profile__btn--logout">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="hidden-xs">Выйти</span>
                    </a>
                </div>
            <? endif; ?>
        </div>

        <div class="profile__nav nav hidden-xs hidden-sm">
            <a href="<?= URL::site('user/' . $profile->id); ?>" class="nav__item <?= $action == 'index' ? 'nav__item--active nav__item-group--active': ''; ?>">
                Мероприятия
            </a>
            <? if ($profile->isOwner) : ?>
                <a href="<?= URL::site('user/' . $profile->id . '/drafts'); ?>" class="nav__item <?= $action == 'drafts' ? 'nav__item--active nav__item-group--active': ''; ?>">
                    Не опубликованные мероприятия
                </a>
            <? endif; ?>
        </div>

    </div>

    <div class="width-full width-md-640 width-lg-840">

        <div class="entry__wrapper">
            <div class="block mb-0 bb-0 ui-tabs hidden-md hidden-lg">
                <div class="ui-tabs__wrapper">
                    <a href="<?= URL::site('user/' . $profile->id); ?>" class="ui-tabs__tab <?= $action == 'index' ? 'ui-tabs__tab--active': ''; ?>">
                        Мероприятия
                    </a>
                    <? if ($profile->isOwner) : ?>
                        <a href="<?= URL::site('user/' . $profile->id . '/drafts'); ?>" class="ui-tabs__tab <?= $action == 'drafts' ? 'ui-tabs__tab--active': ''; ?>">
                            Не опублик. меропр.
                        </a>
                    <? endif; ?>
                </div>
            </div>
        </div>

        <?= $page; ?>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>static/js/profile.js?v=<?= filemtime("assets/static/js/profile.js") ?>"></script>