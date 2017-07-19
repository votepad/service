<div class="section__content">

    <!-- Left column -->
    <div class="width-xs-full width-md-300 width-lg-360 mr-md-40">
        <div class="block mt-20 mt-md-0">
            <!-- Profile -->
            <div class="profile">
                <div class="profile__avatar">
                    <? if ($profile->isOwner) : ?>
                        <a id="profileAvatarUploadBtn" role="button" class="profile__upload">
                            <i class="fa fa-camera profile__upload-icon" aria-hidden="true"></i>
                        </a>
                    <? endif; ?>
                    <img class="profile__avatar-img" src="<?= URL::site('uploads/profiles/' . $profile->avatar); ?>" alt="Profile Avatar">
                </div>
                <a href="<?= URL::site('user/' . $profile->id)?>">
                    <h1 class="profile__name text-brand"><?= $profile->name; ?></h1>
                </a>
                <? if ($profile->isOwner) : ?>
                    <div class="profile__buttons">
                        <a class="btn btn--lg btn--gray profile__buttons--settings" href="<?= URL::site('user/' . $profile->id . '/settings'); ?>">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span>Настройки</span>
                        </a>
                    </div>
                <? endif; ?>
            </div>

            <!-- Navigation -->
            <div class="nav hidden-xs hidden-sm">
                <a href="<?= URL::site('user/' . $profile->id . '/events'); ?>" class="nav__item <?= $action == 'events' ? 'nav__item--active': ''; ?>">
                    Мероприятия
                    <span class="nav__counter">
                        <span>0</span>
                        <i class="fa fa-angle-right icon"></i>
                    </span>
                </a>
                <? if ($profile->isOwner) : ?>
                    <a href="<?= URL::site('user/' . $profile->id . '/drafts'); ?>" class="nav__item <?= $action == 'drafts' ? 'nav__item--active': ''; ?>">
                        Не опубликованные мероприятия
                        <span class="nav__counter">
                            <span>0</span>
                            <i class="fa fa-angle-right icon"></i>
                        </span>
                    </a>
                    <a href="<?= URL::site('user/' . $profile->id . '/updates'); ?>" class="nav__item <?= $action == 'updates' ? 'nav__item--active': ''; ?>">
                        Уведомления
                        <span class="nav__counter">
                            <span>0</span>
                            <i class="fa fa-angle-right icon"></i>
                        </span>
                    </a>
                <? endif; ?>
            </div>
        </div>

    </div>


    <!-- Right column -->
    <div class="width-xs-full width-md-640 width-lg-780">

        <div class="block">
            2
        </div>

    </div>

</div>