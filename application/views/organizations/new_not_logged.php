<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Новая организация | NWE</title>

    <!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/animate.css/animate.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css">


    <!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-new.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/app.js"></script>

</head>
<body>
	<div class="content-wrapper neworg-wrapper clearfix">
		<form method="POST" action="<?=URL::site('organization/add'); ?>" class="block block-default">
			<div class="block-heading bg_grey_600">
				<div class="info">Заполните информацию об организации</div>
				<div class="pb_neworg">
					Готовность: <span>0%</span>
					<div class="pb_wrapper"></div>
				</div>
			</div>
			<div class="block-body">
				<div class="step displayblock">
					<div class="input-field">
						<input type="text" id="org_name" name="org_name" class="input-area" length="60">
						<label for="org_name" class="input-label">Название организации</label>
						<span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
					</div>
					<div class="input-field">
						<input type="text" id="org_site" name="org_site" class="input-area" length="20">
						<label for="org_site" class="input-label">Сайт организации</label>
						<span class="help-block">По этому адресу будет доступен личный кабинет организации.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input type="text" id="org_user" name="org_user" class="input-area" placeholder="Иванов Иван Иванович">
						<label for="org_user" class="input-label active">Доверенное лицо</label>
						<span class="help-block">Доверенное лицо - создатель организации, имеет полный доступ к ней.</span>
					</div>
					<div class="input-field">
						<input type="tel" id="org_phone" name="org_phone" class="input-area">
						<label for="org_phone" class="input-label active">Телефон</label>
						<span class="help-block">Нужен для связи с Вами.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input id="email" type="email" name="email" class="input-area">
						<label for="email" class="input-label">E-mail</label>
						<span class="help-block">Используется для доступа в личный кабинет организации вместе с паролем.</span>
					</div>
					<div class="input-field">
						<input type="password" id="password" name="password" class="input-area">
						<label for="password" class="input-label">Пароль</label>
						<span class="help-block">Используется для доступа в личный кабинет организации вместе с email.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input type="text" id="official_org_site" name="official_org_site" class="input-area">
						<label for="org_site" class="input-label">Официальный сайт организации</label>
						<span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
					</div>
					<div class="input-field">
						<input type="checkbox" id="confirmrools" name="confirmrools" class="input-area">
						<label for="confirmrools" class="">Официальный сайт организации
						Я прочитал(а) <a href="#/rools" class="md-btn md-btn-xs" style="font-size: 1em; font-weight: bold; color: #64b5f6;">соглашение</a> об оказании услуг VotePad и согласен(а) с ним
						</label>
					</div>
				</div>
			</div>
			<div class="block-footer clearfix">
				<button id="previous" type="button" name="button" class="fl_l displaynone">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
					Назад</button>
				<button id="next" type="button" name="button" class="fl_r">Продолжить
					<i class="fa fa-arrow-right" aria-hidden="true"></i>
				</button>
				<button id="submit" type="button" name="button" class="fl_r displaynone">Опубликовать
					<i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
				</button>
			</div>
		</form>
	</div>
	<footer class="bg_grey_800">
		<ul class="fl_l nwe_links ls_none">
			<li><a href="#">EventStream</a></li>
			<li><a href="#">Правила</a></li>
			<li><a href="#">Помощь</a></li>
			<li><a href="#">Связаться со службой поддержки</a></li>
		</ul>
		<div class="fl_r nwe_copyright">
			<a href="//pronwe.ru">NewOrg | NWE</a>
		</div>
	</footer>
</body>
</html>
