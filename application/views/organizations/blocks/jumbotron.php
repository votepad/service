<div class="edit-org-back">
  <i class="fa fa-camera" aria-hidden="true"></i>
  <a id="edit_org_back" href="#" role="button">Обновить фото обложки</a>
</div>
<div class="org-avatar">
    <img src="<?=$assets; ?>img/temp/bg4.jpg">
    <div class="edit-org-avatar">
      <i class="fa fa-camera" aria-hidden="true"></i>
      <a id="edit_org_avatar" href="#" role="button">Обновить логотип организации</a>
    </div>
</div>
<div class="org-name-background"></div>
<div class="org-name">
    <h2>
        <?=$organization->name; ?>
        <a href="http://<?=$organization->website; ?>" class="inline" data-toggle="tooltip" data-placement="top" title="Официальный сайт">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    </h2>
</div>
