<div class="jumbotron__wrapper parallax" data-toggle="parallax">
    <div class="bg--dark"></div>
    <img id="event-background-uploaded" src="/uploads/events/branding/<?=$event->branding; ?>" class="parallax__img">
    <div class="jumbotron__edit-block" data-pk="<?=$event->id; ?>">
        <a id="updateCover" role="button" class="jumbotron__edit-btn">
            <i class="fa fa-camera jumbotron__edit-icon" aria-hidden="true"></i>
            <span class="jumbotron__edit-text">Обновить фото обложки</span>
        </a>
    </div>
    <div class="jumbotron__text valign">
        <div class="center">
            <span class="jumbotron__text-event-name">
                <?=$event->name; ?>
            </span>
        </div>
    </div>
</div>

<script src="<?=$assets;?>static/js/event/mainPage.js?v=<?= filemtime("assets/static/js/event/mainPage.js"); ?>"></script>