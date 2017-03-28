<div class="jumbotron_wrapper parallax-container">
    <div class="parallax">
        <img id="" src="/uploads/events/<? ?>.jpg">
    </div>
    <div class="jumbotron_wrapper-background"></div>
    <div class="jumbotron_wrapper_edit">
        <a id="updateCover" role="button" class="jumbotron_wrapper_edit-btn">
            <i class="fa fa-camera jumbotron_wrapper_edit-icon" aria-hidden="true"></i>
            <span class="jumbotron_wrapper_edit-text">Обновить фото обложки</span>
        </a>
    </div>
    <div class="jumbotron_wrapper_text valign">
        <div class="center">
                <span class="jumbotron_wrapper_text-eventname">
                    <?=$event->name; ?>
                </span>
            <a href="<?=URL::site('organization/' . $organization->id); ?>" class="jumbotron_wrapper_text-orgname">
                <?=$organization->name; ?>
            </a>
        </div>
    </div>
</div>