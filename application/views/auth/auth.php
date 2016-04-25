<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Авторизация - ProNWE.ru</title>
		<meta charset="UTF-8">
		<meta name="description" content="Страница авторизации для зарегистрированных пользователей">
		<meta name="keywords"  content="pronwe,вход,регистрация,авторизация" />
		<meta name="Resource-type" content="Document" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="<?=$assets; ?>img/favicon.png">

		<!-- CSS -->
		<? foreach($css as $styles): ?>
			<link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
		<? endforeach;?>


		<!-- JS -->
		<? foreach($js as $scripts): ?>
			<script src="<?=$assets.$scripts; ?>"></script>
		<? endforeach ; ?>
	</head>
 
<body>
    <div class="central-box">
    	<div class="panel">
    		<div class="panel-heading text-center">
    			<a href="">
    				<img src="<?=$assets; ?>img/ProNWE_logo.svg" alt="ProNWE logo" class="" height="100" width="200">
    			</a>
    		</div>
    		<!--  AUTHTERIZATION -->
    		<div class="panel-body animated fadeIn" id="signin">
    			<p class="text-center pv">Авторизуйтесь, чтобы продолжить</p>
				<form action="<?=URL::site('auth/signin'); ?>" method="POST">
					<div class="form-group">
						<input type="email" id="email" required name="email" autocomplete="off" axlength="100">
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					
					</div>
					<div class="form-group">
						<input type="password" class="password" id="pass" name="password" maxlength="20" required>
						<div class="label-box">
							<label>Пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
					<p class="text-right" id="showReset"><span class="pronwe_Link-small color-gr">Забыли пароль?</span></p>

					<button type="submit" id="sigin-button" type="submit" class="btn btn-primary col-xs-12 btn_area1">Войти</button>

					<p class="text-center" id="showReg"><span class="pronwe_Link-small">Быстрая регистрация</span></p>
				</form>    			
    		</div>
    		<!--  REGISTRATION -->
    		<div class="panel-body animated fadeIn" id="signup" style="display:none;">
    			<p class="text-center pv">Регистрация</p>
				<form action="<?=URL::site('signup/index');?>" method="POST" style="">
					<div class="form-group">
						<input type="email" required name="email" id="signup-email" autocomplete="off" maxlength="100">
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<input type="password" class="password" required name="password" id="password1" maxlength="20" title="Введите не менее 6 символов">
						<div class="label-box">
							<label>Пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<input type="password" class="password" required name="confirm_password" id="confirm_password" maxlength="20" title="Введите не менее 6 символов">
						<div class="label-box">
							<label>Подтвердите пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<center>Капча</center>
					</div>
					<button type="submit" class="btn btn-primary col-xs-12 btn_area1" id="signup-button" disabled="">Создать акаунт</button>
					<p class="text-center" id="ReshowReg"><span class="pronwe_Link-small">На страницу авторизации</span></p>
				</form>
			</div>
			<!--  PASSWORD RESET -->
			<div class="panel-body animated fadeIn" id="reset" style="display:none;">
				<p class="text-center pv">Введите емайл, чтобы получить инструкцию по востановлению пароля</p>
				<form action="" method="POST" style="">
					<div class="form-group">
						<input type="email" id="reset-email" required autocomplete="off" maxlength="100">
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<center>Капча</center>
					</div>
					<button type="submit" id="reset-button" class="btn btn-primary col-xs-12 btn_area1">Восставновить</button>
					<p class="text-center" id="ReshowReset"><span class="pronwe_Link-small">На страницу авторизации</span></p>
				</form>
			</div>
    	</div>
	</div>
</body>

</html>