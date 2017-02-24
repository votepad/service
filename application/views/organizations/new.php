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
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/icons_fonts.css?v=<?= filemtime("assets/css/icons_fonts.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/app_v1.css?v=<?= filemtime("assets/css/app_v1.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/organization/new.js"></script>

</head>
<body>

<?=$header; ?>

<section style="margin-top: 100px;">

	<h3 class="page-header">
		Создание организации
		<br>
		<small>Всего три простых шага отделют Вас от страницы организации! Ведь именно там, Вы сможете создать мероприятие с автоматическим получением результатов голосования!</small>
	</h3>

	<form method="POST" action="<?=URL::site('organization/add'); ?>" class="form form_neworg">

	    <div class="form_body form_neworg_body">
            <div class="form_neworg_body-wrapper">
                <div id="step1" class="row col-xs-4 form_neworg_body-wrapper-item">
                    <div class="input-field col-xs-12">
                        <input type="text" id="org_name" name="org_name" length="60">
                        <label for="org_name">Название организации</label>
                        <span class="help-block">Название увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
                    </div>
                    <div class="input-field col-xs-12">
                        <input type="text" id="org_site" name="org_site" class="vp_site" length="38">
                        <label for="org_site">Сайт организации</label>
                        <span class="help-block">По этому адресу будет доступен личный кабинет организации и видны все мероприятия, проводимые организацией.</span>
                    </div>
                </div>
                <div id="step2" class="row col-xs-4 form_neworg_body-wrapper-item">
    				<div class="input-field col-xs-12">
    					<textarea id="org_description" name="org_description" length="300" tabindex="-1"></textarea>
    					<label for="org_description">Описание организации</label>
    					<span class="help-block">Напишите основную информацию об организации. По этой информации Вашу организацию можно будет найти через поиск.</span>
    				</div>
    			</div>
    			<div id="step3" class="row col-xs-4 form_neworg_body-wrapper-item">
    				<div class="input-field col-xs-12">
    					<input type="text" id="official_org_site" name="official_org_site" tabindex="-1">
    					<label for="official_org_site">Официальный сайт организации</label>
    					<span class="help-block">Ссылка на официальный сайт или официальную группу в социальной сети.</span>
    				</div>
    				<div class="col-xs-12">
    					<input type="checkbox" id="confirmrools" name="confirmrools" tabindex="-1">
    					<label for="confirmrools">Мною прочитаны <a href="#/modal_rools" class="underlinehover" style="color:#008DA7" tabindex="-1">правила и соглашение</a> об оказании услуг Votepad</label>
    				</div>
    			</div>
            </div>
		</div>

        <div class="form_neworg_progress">
			<div class="form_neworg_progress-wrapper"></div>
		</div>

        <div class="form_submit clearfix">
			<button id="btnprevious" type="button" class="btn btn_hollow displaynone">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
				Назад
			</button>
			<button id="btnnext" type="button" class="btn btn_hollow pull-right">Продолжить
				<i class="fa fa-arrow-right" aria-hidden="true"></i>
			</button>
			<button id="btnsubmit" type="button" class="btn btn_primary pull-right displaynone">Опубликовать
				<i class="fa fa-check" aria-hidden="true" style="font-size: 1.05em;"></i>
			</button>
		</div>
	</form>

</section>

<?=$footer; ?>

</body>

</html>
