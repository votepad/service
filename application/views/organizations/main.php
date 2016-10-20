<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$organization->name; ?> | NWE</title>

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app.css?v=<?= filemtime("assets/css/app.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/organizations/org.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/app.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<!--  ORGANIZATION MENU   -->
	<div class="user-menu bg_grey_800">
		<ul class="ls_none">
			<!-- SIGN IN -->
			<li data-toggle="tooltip" data-placement="right" data-original-title="Создать организацию"><a href="<?=URL::site('organization/new'); ?>"><i class="fa fa-sitemap" aria-hidden="true"></i></a></li>
			<li data-toggle="tooltip" data-placement="right" data-original-title="Авторизация"><a data-toggle="modal" data-target="#modal_auth"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
			<!-- NOT SIGN IN -->
			<li data-toggle="tooltip" data-placement="right" data-original-title="Профиль"><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
			<li data-toggle="tooltip" data-placement="right" data-original-title="Выйти"><a href="<?=URL::site('auth'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
		</ul>
	</div>

	<div class="content-wrapper clearfix">

		<!-- ORGANIZATION INFO START -->
	  <div class="org-block">
			<?=$jumbotron; ?>
	    <div class="org-nav-block">
				<?=$navigation; ?>
			</div>
		</div>
		<!-- ORGANIZATION INFO END -->

		<!-- SECTION START -->
		<?=$main_section; ?>
		<!-- SECTION END -->
	</div>

	<footer class="bg_grey_800">
		<ul class="fl_l nwe_links ls_none">
			<li><a href="#">EventStream</a></li>
			<li><a href="#">Правила</a></li>
			<li><a href="#">Помощь</a></li>
			<li><a href="#">Связаться со службой поддержки</a></li>
		</ul>
		<div class="fl_r nwe_copyright">
			<a href="//pronwe.ru">VotePad | NWE</a>
		</div>
	</footer>

	<!-- Authorization Modal -->
	<div class="modal" id="modal_auth" tabindex="-1"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-body"  style="min-height: 250px;"><form class="sign_in_form window displayblock clearfix" style="position: relative;width: 100%;padding: 0 20px;" action="<?=URL::site('auth/signin'); ?>" method="POST"><h4 style="font-size: 1.4em;margin: 10px auto; letter-spacing: .05em;text-align: center">Авторизация</h4><div class="input-field with-icon-label"><input type="email" id="email" name="email" class="input-area" placeholder="E-mail" required=""><label for="email" class="icon-label"><i aria-hidden="true" class="fa fa-user"></i></label></div><div class="input-field with-icon-label"><input type="password" id="password" name="password" class="input-area" placeholder="Пароль" required="" minlength="6"><label for="email" class="icon-label"><i aria-hidden="true" class="fa fa-lock"></i></label></div><button type="button" id="sign_in" class="btn btn-md btn-primary col-xs-5">Войти</button><button type="button" id="to_forget_password_form" class="btn btn-md col-xs-offset-1 col-xs-6" style="font-size: .8em;padding: 10px 15px;">Забыли пароль?</button></form><from class="forget_password_form window displaynone clearfix" style="position: relative;width: 100%;padding: 0 20px;"><h4 style="font-size: 1.4em;margin: 10px auto; letter-spacing: .05em;text-align: center">Восстановление пароля</h4><div class="input-field with-icon-label"><input type="email" id="email" name="email" class="input-area" placeholder="E-mail" required=""><label for="email" class="icon-label"><i aria-hidden="true" class="fa fa-user"></i></label></div><div class="g-recaptcha" data-sitekey="6LdR4BgTAAAAAIuvZ3UsCQ_xpLkQFC79B8bVVs9C" style="margin-bottom:24px"></div><button type="button" id="to_sign_in_form" class="btn btn-md col-xs-4" style="font-size: .8em;padding: 10px 15px; margin-bottom:0">Назад</button><button type="button" id="forget_password" class="btn btn-md btn-primary col-xs-7 col-xs-offset-1" style=" margin-bottom:0">Восстановить</button></form></div><div class="modal-footer text-center"><a href="<?=URL::site('organization/new'); ?>" class="link underlinehover">Создать организацию</a></div></div></div></div>

</body>
</html>
