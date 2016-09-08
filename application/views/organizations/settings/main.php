<!-- =============== PAGE STYLES ===============-->
<link rel="stylesheet" href="<?=$assets; ?>vendor/cropper/dist/cropper.css">
<link rel="stylesheet" href="<?=$assets; ?>css/upload.css">

<div class="columns-area">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="panel-tabs">
				<a class="md-btn active" href="<?=URL::site('organization/' . $id . '/settings/main'); ?>">
					Организация
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/team'); ?>">
					Команда
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/logs'); ?>">
					Активности
					<div class="active-link"></div>
				</a>
				<a class="md-btn" href="<?=URL::site('organization/' . $id . '/settings/balance'); ?>">
					Оплата услуг
					<div class="active-link"></div>
				</a>
			</div>
		</div>
		<div class="panel-body">
			<form id="update_main_info">
				<div class="settings-main-c1 inline">
					<h4>Основная информация</h4>
					<div class="form-group">
						<label for="org_name" class="control-label">Название организации</label>
						<input type="text" id="org_name" name="org_name" class="form-control input-sm" value="<?=$organization->name; ?>">
					</div>
					<div class="form-group">
						<label for="org_site" class="control-label">Ссылка на страницу</label>
						<input type="text" id="org_site" name="org_site" class="form-control input-sm" value="http://<?=$organization->website; ?>.votepad.ru" disabled>
						<span class="help-block">Хотите изменить ссылку на Вашу организацию? Напишите нам <a href="">support@votepad.ru</a></span>
					</div>
					<div class="form-group">
						<label for="org_official_site" class="control-label">Ссылка на официальный сайт</label>
						<input type="text" id="org_official_site" name="org_official_site" class="form-control input-sm" value="">
					</div>
					<button type="button" id="orglogo_upload" class="md-btn md-btn-md md-btn-default upload">Обновить фото логотипа</button>
					<button type="button" id="orgback_upload" class="md-btn md-btn-md md-btn-default upload" style="float: right;">Обновить фото обложки</button>
				</div>
				<div class="settings-main-c2 inline">
					<h4>Контактная информация</h4>
					<div class="form-group">
						<label for="org_user" class="control-label">Доверенное лицо</label>
						<input type="text" id="org_user" name="org_user" class="form-control input-sm" value="<?=$creator->lastname . ' ' . $creator->name . ' ' . $creator->surname; ?>">
						<span class="help-block">Доверенное лицо - создатель организации, имеет полный доступ к ней.</span>
					</div>
					<div class="form-group">
						<label class="control-label">Электронная почта</label>
						<input type="email" name="email" class="form-control input-sm" value="<?=$creator->email; ?>">
					</div>
					<div class="form-group">
						<label for="org_phone" class="control-label">Контактный телефон</label>
						<input type="tel" id="org_phone" name="org_phone" class="form-control input-sm" value="<?=$creator->number; ?>">
					</div>
					<button type="submit" class="md-btn md-btn-md md-btn-labeled md-btn-success ">
						<span class="md-btn-icon"><i class="fa fa-check"></i></span> Сохранить
					</button>
					<button type="button" class="md-btn md-btn-md md-btn-labeled md-btn-danger" style="float: right;">
						<span class="md-btn-icon"><i class="fa fa-times"></i></span> Удалить организацию
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<script type="text/javascript" src="<?=$assets; ?>vendor/cropper/dist/cropper.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/upload.js"></script>
<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-settings-main.js"></script>