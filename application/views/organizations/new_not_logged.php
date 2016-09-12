<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Новая организация</title>

    <!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css">


    <!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/organizations/org-new.js"></script>

</head>
<body>
	<div class="wrapper">
		<header>
			<a href="">Возможности и цены</a>
			<br>
			<a href="">Задать вопрос</a>
		</header>
		<div class="content-wrapper">
			<div class="panel panel-default neworg-wrapper">
				<div class="panel-body">
					<h2>Введите информацию об организации</h2>
					<p>Заполните форму и Вы получите личный кабинет. В нём Вы сможете создавать и публиковать мероприятия.</p>
					<form id="new_org_not_logged" method="POST" action="<?=URL::site('organization/add'); ?>">
						<div class="form-group">
							<label for="org_name" class="control-label">Название организации</label>
							<div class="input-area">
								<input type="text" id="org_name" name="org_name" class="form-control">
								<label id="org_name-error" class="error-input" for="org_name" style="display:none"></label>
								<span class="help-block">Его увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
							</div>
						</div>
						<div class="form-group">
							<label for="org_user" class="control-label">Доверенное лицо</label>
							<div class="input-area">
								<input type="text" id="org_user" name="org_user" class="form-control" placeholder="Иванов Иван Иванович">
								<label id="org_user-error" class="error-input" for="org_user" style="display:none"></label>
								<span class="help-block">Доверенное лицо - создатель организации, имеет полный доступ к ней.</span>
							</div>
						</div>
						<div class="form-group">
							<label far="email" class="control-label">E-mail</label>
							<div class="input-area">
								<input type="email" name="email" class="form-control" placeholder="email@address.ru">
								<label id="email-error" class="error-input" for="email" style="display:none"></label>
								<span class="help-block">Используется для доступа в личный кабинет организации вместе с email.</span>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Пароль</label>
							<div class="input-area">
								<input type="password" id="password" name="password" class="form-control">
								<label id="password-error" class="error-input" for="password" style="display:none"></label>
								<span class="help-block">Используется для доступа в личный кабинет организации вместе с email.</span>
							</div>
						</div>
						<div class="form-group">
							<label for="org_site" class="control-label">Сайт организации</label>
							<div class="input-area">
								<div class="input-group">
									<input type="text" id="org_site" name="org_site" class="form-control">
									<span class="input-group-addon">.votepad.ru</span>
								</div>
								<label id="org_site-error" class="error-input" for="org_site" style="display:none"></label>
								<span class="help-block">По этому адресу будет доступен личный кабинет организации.</span>
							</div>
						</div>
						<div class="form-group">
							<label for="org_phone" class="control-label">Телефон</label>
							<div class="input-area">
								<input type="tel" id="org_phone" name="org_phone" class="form-control">
								<label id="org_phone-error" class="error-input" for="org_phone" style="display:none"></label>
								<span class="help-block">Нужен для связи с Вами.</span>
							</div>
						</div>
						<div class="form-group text-center">
							<label class="confirm-rools">
								<input type="checkbox" id="confirmrools" name="confirmrools">
								Я прочитал(а) <a href="#/rools" class="md-btn md-btn-xs" style="font-size: 1em; font-weight: bold; color: #64b5f6;">соглашение</a> об оказании услуг VotePad и согласен(а) с ним
								<br>
								<label id="confirmrools-error" class="error-input" for="confirmrools" style="display:none"></label>
							</label>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="md-btn md-btn-lg md-btn-success">Перейти к публикации мероприятия</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<footer></footer>
	</div>
</body>
</html>
