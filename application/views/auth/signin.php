<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Авторизация - ProNWE.ru</title>
    <meta charset="UTF-8">
    <meta name="description" content="Страница авторизации для зарегистрированных пользователей">
    <meta name="keywords"  content="pronwe,вход,регистрация,авторизация" />
    <meta name="Resource-type" content="Document" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Иконка сайта -->

	  <link rel="icon" type="image/png" href="<?=$assets; ?>imgs/favicon.png">

	  <? foreach($css as $styles): ?>
	  	<link rel="stylesheet" href="<?=$assets;?>css/<?=$styles;?>">
	  <? endforeach;?>

  </head>
 
  <body>
    <div class="central-box">
    	<div class="panel">
    		<div class="panel-heading text-center">
    			<a href="#">
    				<img src="<?=$assets;?>img/logo.png" alt="NWE" class="">
    			</a>
    		</div>
    		<!--  AUTHTERIZATION -->
    		<div class="panel-body" id="signin">
    			<p class="text-center pv">Авторизуйтесь, чтобы продолжить</p>
				<form action="" method="POST">
					<div class="form-group">
						<input type="email" id="email" required name="login" autocomplete="off">
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					
					</div>
					<div class="form-group">
						<input type="password" id="pass" required name="password" autocomplete="off">
						<div class="label-box">
							<label>Пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
					<p class="text-right" onclick="showReset()"><span class="pronwe_Link-small color-gr">Забыли пароль?</span></p>
					<button id="sigin-button" type="submit" class="btn">Войти</button>
					
					<p class="text-center" onclick="showReg()"><span class="pronwe_Link-small">Моментальная регистрация</span></p>
					
				</form>    			
    		</div>
    		<!--  REGISTRATION -->
    		<div class="panel-body" id="signup" style="display:none;">
				<form action="" method="POST" style="">
				
					<div class="form-group">
						<input type="email" id="upemail" required>
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<input type="password" id="uppass" required>
						<div class="label-box">
							<label>Пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
					<div class="form-group">
						<input type="password" id="uppass2" required>
						<div class="label-box">
							<label>Подтвердите пароль</label>
						</div>
						<span class="fa fa-lock form-icon icon-color"></span>
					</div>
				
					<button id="signup-button" class="btn">Создать акаунт</button>
				</form>
			</div>
			<!--  PASSWORD RESET -->
			<div class="panel-body" id="reset" style="display:none;">
				<form action="" method="POST" style="">

					<div class="form-group">
						<input type="email" id="resetemail" required  autocomplete="off">
						<div class="label-box">
							<label>Email</label>
						</div>
						<span class="fa fa-envelope form-icon icon-color"></span>
					</div>
					<button id="reset-button" class="">Создать акаунт</button>
				</form>
			</div>
    	</div>

	</div>

	<!-- JS -->
	<? foreach($js as $scripts): ?>
	<script src="<?=URL::site('media/js').'/'.$scripts; ?>"></script>
	<? endforeach ; ?>
	<script>
		function showReg()
		{
			document.getElementById('signin').style.display='none';
			document.getElementById('signup').style.display='block';
		}
		function ReshowReg()
		{
			document.getElementById('signin').style.display='block';
			document.getElementById('signup').style.display='none';
		}
		function showReset()
		{
			document.getElementById('signin').style.display='none';
			document.getElementById('reset').style.display='block';
		}
	</script>
  </body>
</html>