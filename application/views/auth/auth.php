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
		  <link rel="stylesheet" href="<?=$assets;?><?=$styles;?>">
	  <? endforeach;?>
  </head>
 
  <body>
    <div class="central-box">
    	<div class="panel">
    		<div class="panel-heading text-center">
    			<a href="">
    				<img src="<?=$assets; ?>img/NWELOGO.svg" alt="NWE" class="" height="100" width="200">
    			</a>
    		</div>
    		<!--  AUTHTERIZATION -->
    		<div class="panel-body" id="signin">
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
					<p class="text-right" onclick="showReset()"><span class="pronwe_Link-small color-gr">Забыли пароль?</span></p>

					<button type="submit" id="sigin-button" type="submit" class="btn pronwe_background">Войти</button>

					<p class="text-center" onclick="showReg()"><span class="pronwe_Link-small">Быстрая регистрация</span></p>
				</form>    			
    		</div>
    		<!--  REGISTRATION -->
    		<div class="panel-body" id="signup" style="display:none;">
    			<p class="text-center pv">Регистрация</p>
				<form action="<?=URL::site('signup/index');?>" method="POST" style="">
					<div class="form-group">
						<input type="email" required name="email" id="signup-email" maxlength="100">
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
					<button type="submit" class="btn pronwe_background" id="signup-button" >Создать акаунт</button>
					<p class="text-center" onclick="ReshowReg()"><span class="pronwe_Link-small">На страницу авторизации</span></p>
				</form>
			</div>
			<!--  PASSWORD RESET -->
			<div class="panel-body" id="reset" style="display:none;">
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
					<button type="submit" id="reset-button" class="btn pronwe_background">Восставновить</button>
					<p class="text-center" onclick="ReshowReset()"><span class="pronwe_Link-small">На страницу авторизации</span></p>
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
		function ReshowReset()
		{
			document.getElementById('signin').style.display='block';
			document.getElementById('reset').style.display='none';
		}
	</script>
	<script>
		/*var button = document.getElementById("signup-button");
		$('#confirm_password').on('change', function() {
			var conf = $(this).val();
			var pass = $('#password1').val();

			if (conf == pass && pass.length > 5)
			{	
				$(this).css('background-color', 'rgba(0, 200, 0, 0.3)');
				button.disabled = false;				
			}
			else 
			{
				$(this).css('background-color', 'rgba(200, 0, 0, 0.3)');
				button.disabled = true;
			}
		});*/

		$('#password1').on('change', function() {
			var conf = $('#confirm_password').val();
			var pass = $(this).val();

			if (conf == pass && conf.length > 5)
			{	
				$('#confirm_password').css('background-color', 'rgba(0, 200, 0, 0.3)');
				button.disabled = false;
			}
			else 
			{
				$('#confirm_password').css('background-color', 'rgba(200, 0, 0, 0.3)');
				button.disabled = true;				
			}
		});
	</script>
  </body>
</html>