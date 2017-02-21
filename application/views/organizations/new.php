<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title>Новая организация | Votepad.ru</title>

    <meta name="description" content="" />
    <meta name="keywords" content="создать орагнизацию, новая организация, new organization, create organization, votepad, organization" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css?v=<?= filemtime("assets/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css?v=<?= filemtime("assets/css/app_v1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/organizations/new.js"></script>

</head>
<body>

<?=$header; ?>

<section class="" style="margin-top: 100px;">

	<h3 class="page-header">
		Создание организации
		<br>
		<small>Всего три простых шага отделют Вас от страницы организации! Ведь именно там, Вы сможете создать мероприятие с автоматическим получением результатов голосования!</small>
	</h3>

	<form method="POST" action="<?=URL::site('organization/add'); ?>" class="form form_neworg">
		<div class="form_heading pb_neworg">
			<div class="pb_wrapper"></div>
		</div>

	    <div class="form_body">
			<div class="step displayblock">
				<div class="input-field col-xs-12">
					<input type="text" id="org_name" name="org_name" length="60">
					<label for="org_name">Название организации</label>
					<span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
				</div>
				<div class="input-field col-xs-12">
					<input type="text" id="org_site" name="org_site" class="nwe_site" length="34">
					<label for="org_site">Сайт организации</label>
					<span class="help-block">По этому адресу будет доступен личный кабинет организации и видны все мероприятия, проводимые организацией.</span>
				</div>
			</div>
			<!--<div class="step displaynone">
				<div class="input-field">
					<input type="text" id="org_user" name="org_user" class="input-area" autocomplete="off" placeholder="Иванов Иван Иванович">
					<label for="org_user" class="input-label active">Доверенное лицо</label>
					<span class="help-block">Доверенное лицо - создатель организации, имеет полный доступ к ней.</span>
				</div>
				<div class="input-field">
					<input type="tel" id="org_phone" name="org_phone" class="input-area" autocomplete="off">
					<label for="org_phone" class="input-label">Телефон</label>
					<span class="help-block">Нужен для связи с Вами.</span>
				</div>
			</div>-->
			<!--<div class="step displaynone">
				<div class="input-field">
					<input type="text" id="email" name="email" class="input-area" autocomplete="off">
					<label for="email" class="input-label">E-mail</label>
					<span class="help-block">Используется для доступа в личный кабинет организации вместе с паролем.</span>
				</div>
				<div class="input-field">
					<input type="password" id="password" name="password" class="input-area" autocomplete="off">
					<label for="password" class="input-label">Пароль</label>
					<span class="help-block">Используется для доступа в личный кабинет организации вместе с email. Минимум 6 символов</span>
				</div>
			</div>-->
			<div class="row step displaynone">
				<div class="input-field col-xs-12">
					<textarea id="org_description" name="org_description" length="300"></textarea>
					<label for="org_description">Описание организации</label>
					<span class="help-block">Напишите основную информацию об организации. По этой информации Вашу организацию можно будет найти через поиск.</span>
				</div>
			</div>
			<div class="row step displaynone">
				<div class="input-field col-xs-12">
					<input type="text" id="official_org_site" name="official_org_site">
					<label for="official_org_site">Официальный сайт организации</label>
					<span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
				</div>
				<div class="col-xs-12">
					<input type="checkbox" id="confirmrools" name="confirmrools">
					<label for="confirmrools">
						Мною прочитаны<a href="#/modal_rools" class="link_uppercase underlinehover">правила и соглашение</a>об оказании услуг NWE
					</label>
				</div>
			</div>
		</div>
		<div class="form_submit clearfix">
			<button id="btnprevious" type="button" class="nav_button fl_l displaynone">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
				Назад
			</button>
			<button id="btnnext" type="button" class="nav_button fl_r">Продолжить
				<i class="fa fa-arrow-right" aria-hidden="true"></i>
			</button>
			<button id="btnsubmit" type="button" class="nav_button fl_r displaynone">Опубликовать
				<i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
			</button>
		</div>
	</form>

</section>

<?=$footer; ?>

</body>


<!--<body>
	<div class="content-wrapper neworg-wrapper clearfix">
		<form method="POST" action="<?=URL::site('organization/add'); ?>" class="block block-default">
			<div class="block-heading bg_grey_600">
				<div class="info">Заполните информацию об организации</div>
				<div class="pb_neworg">
					<div class="pb_wrapper"></div>
				</div>
			</div>
			<div class="block-body">
				<div class="step displayblock">
					<div class="input-field">
						<input type="text" id="org_name" name="org_name" class="input-area" length="60" autocomplete="off">
						<label for="org_name" class="input-label">Название организации</label>
						<span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
					</div>
					<div class="input-field">
						<input type="text" id="org_site" name="org_site" class="input-area nwe_site" length="34" autocomplete="off">
						<label for="org_site" class="input-label">Сайт организации</label>
						<span class="help-block">По этому адресу будет доступен личный кабинет организации.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input type="text" id="org_user" name="org_user" class="input-area" autocomplete="off" placeholder="Иванов Иван Иванович">
						<label for="org_user" class="input-label active">Доверенное лицо</label>
						<span class="help-block">Доверенное лицо - создатель организации, имеет полный доступ к ней.</span>
					</div>
					<div class="input-field">
						<input type="tel" id="org_phone" name="org_phone" class="input-area" autocomplete="off">
						<label for="org_phone" class="input-label">Телефон</label>
						<span class="help-block">Нужен для связи с Вами.</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input type="text" id="email" name="email" class="input-area" autocomplete="off">
						<label for="email" class="input-label">E-mail</label>
						<span class="help-block">Используется для доступа в личный кабинет организации вместе с паролем.</span>
					</div>
					<div class="input-field">
						<input type="password" id="password" name="password" class="input-area" autocomplete="off">
						<label for="password" class="input-label">Пароль</label>
						<span class="help-block">Используется для доступа в личный кабинет организации вместе с email. Минимум 6 символов</span>
					</div>
				</div>
				<div class="step displaynone">
					<div class="input-field">
						<input type="text" id="official_org_site" name="official_org_site" class="input-area" autocomplete="off">
						<label for="official_org_site" class="input-label">Официальный сайт организации</label>
						<span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
					</div>
					<div class="input-field">
						<input type="checkbox" id="confirmrools" name="confirmrools" class="input-area">
						<label for="confirmrools">
							Мною прочитаны<a href="#/modal_rools" class="link_uppercase underlinehover">правила и соглашение</a>об оказании услуг NWE
						</label>
					</div>
				</div>
			</div>
			<div class="block-footer clearfix">
				<button id="btnprevious" type="button" class="nav_button fl_l displaynone">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
					Назад</button>
				<button id="btnnext" type="button" class="nav_button fl_r">Продолжить
					<i class="fa fa-arrow-right" aria-hidden="true"></i>
				</button>
				<button id="btnsubmit" type="button" class="nav_button fl_r displaynone">Опубликовать
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
</body>-->
</html>
