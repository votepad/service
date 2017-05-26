<div class="jumbotron__wrapper">
    <div class="parallax">
        <img id="jumbotron__branding" src="/uploads/organizations/branding/<?=$organization->cover; ?>">
    </div>

    <? if($isLogged && $organization->isOwner($user->id)) : ?>
        <div class="jumbotron__edit-block">
        <a id="jumbotron__edit-btn" role="button" class="jumbotron__edit-btn" data-pk="<?=$organization->id; ?>">
            <i class="fa fa-camera jumbotron__edit-icon" aria-hidden="true"></i>
            <span class="jumbotron__edit-text">Обновить фото обложки</span>
        </a>
    </div>
    <?endif;?>


    <div class="jumbotron__logo">
        <img id="jumbotron__logo-branding" src="/uploads/organizations/logo/<?=$organization->logo; ?>">

        <? if($isLogged && $organization->isOwner($user->id)) : ?>

            <a id="jumbotron__logo-edit" role="button" class="jumbotron__logo-edit" data-pk="<?=$organization->id; ?>">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <span>Обновить логотип организации</span>
            </a>

        <?endif;?>
    </div>
    <div class="jumbotron__logo-background"></div>
    <div class="jumbotron__logo-text">
        <h2><?=$organization->name; ?></h2>
        <a href="//<?=$organization->website; ?>" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </div>
</div>

<script src="<?=$assets;?>static/js/organization/mainPage.js?v=<?= filemtime("assets/static/js/organization/mainPage.js"); ?>"></script>