
<div class="jumbotron_wrapper parallax-container">
    <div class="parallax jumbotron_cover">
        <img id="org-background-uploaded" src="/uploads/organizations/o_<?=$organization->cover; ?>">
    </div>

    <div class="jumbotron_wrapper_edit">
        <a id="jumbotron_org-cover-edit" role="button" class="jumbotron_wrapper_edit-btn">
            <i class="fa fa-camera jumbotron_wrapper_edit-icon" aria-hidden="true"></i>
            <span class="jumbotron_wrapper_edit-text">Обновить фото обложки</span>
        </a>
    </div>


    <div class="jumbotron_org-avatar">
        <img id="jumbotron_org-avatar-uploaded" src="/uploads/organizations/m_<?=$organization->logo; ?>">

        <div class="jumbotron_org-avatar-edit">
            <a id="jumbotron_org-avatar-edit" href="#" role="button">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <span>Обновить логотип организации</span>
            </a>
        </div>
    </div>
    <div class="jumbotron_org-name-background"></div>
    <div class="jumbotron_org-name">
        <h2><?=$organization->name; ?></h2>
        <a href="//<?=$organization->website; ?>" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </div>
</div>
