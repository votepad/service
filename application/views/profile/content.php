<div class="section__content">

    <!-- Left column -->
    <div class="width-full width-md-300 width-lg-360 mr-md-40">
        <div class="block mt-20 mt-md-0">
            <!-- Profile -->
            <div class="profile">
                <div class="profile__avatar">
                    <? if ($profile->isOwner) : ?>
                        <a onclick="profile.updateAvatar()" role="button" class="profile__upload">
                            <i class="fa fa-camera profile__upload-icon" aria-hidden="true"></i>
                        </a>
                    <? endif; ?>
                    <img class="profile__avatar-img" src="<?= URL::site('uploads/profiles/m_' . $profile->avatar); ?>" alt="Profile Avatar">
                </div>
                <a href="<?= URL::site('user/' . $profile->id)?>">
                    <h1 class="profile__name text-brand"><?= $profile->name; ?></h1>
                </a>
            </div>
            <!-- Navigation -->
            <div class="nav hidden-xs hidden-sm">
                <a href="<?= URL::site('user/' . $profile->id); ?>" class="nav__item <?= $action == 'events' ? 'nav__item--active': ''; ?>">
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
                    <a href="<?= URL::site('user/' . $profile->id . '/settings'); ?>" class="nav__item <?= $action == 'settings' ? 'nav__item--active': ''; ?>">
                        Настройки
                    </a>
                <? endif; ?>
            </div>
        </div>
    </div>


    <!-- Right column -->
    <div class="width-full width-md-640 width-lg-780">

        <div class="entry_wrapper hidden-md hidden-lg">
            <div class="tabs">
                <div class="tabs__wrapper">
                    <a href="<?= URL::site('user/' . $profile->id . '/events'); ?>" class="tabs__tab <?= $action == 'events' ? 'tabs__tab--active': ''; ?>">Мероприятия</a>
                    <a href="<?= URL::site('user/' . $profile->id . '/drafts'); ?>" class="tabs__tab <?= $action == 'drafts' ? 'tabs__tab--active': ''; ?>">Не опубл. мер.</a>
                    <a href="<?= URL::site('user/' . $profile->id . '/updates'); ?>" class="tabs__tab <?= $action == 'updates' ? 'tabs__tab--active': ''; ?>">Уведомл.</a>
                    <a href="<?= URL::site('user/' . $profile->id . '/settings'); ?>" class="tabs__tab <?= $action == 'settings' ? 'tabs__tab--active': ''; ?>">Настройки</a>
                </div>
            </div>
        </div>

        <?= $page; ?>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>static/js/profile.js?v=<?= filemtime("assets/static/js/profile.js") ?>"></script>