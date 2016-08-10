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
	<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
	<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>

	<script src="<?=$assets; ?>js/organizations/org.js"></script>

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
					<form class="create-org">
						<div class="form-group">
							<label class="control-label">Название организации<span style="color: red">*</span></label>
							<input type="text" name="orgname" class="form-control" required="" >
							<span class="help-block">Его увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
						</div>
						<div class="form-group">
							<label class="control-label">Сайт организации</label>
							<div class="input-group">
								<input type="text" name="orgsite" class="form-control" maxlength="25"">
								<span class="input-group-addon">.votepad.ru</span>
							</div>
							<span class="help-block">По этому адресу будет доступен личный кабинет организации.</span>
						</div>
						<div class="form-group">
							<label class="control-label">Телефон<span style="color: red">*</span></label>
							<input type="text" name="phone" class="form-control" required="" placeholder="+7 (999) 987-6543" >
							<span class="help-block">Нужен для связи с Вами.</span>
						</div>

						<div class="form-group">
							<label class="" style="padding: 0 15px">
								<input type="checkbox" value="" required="" name="confirmrools">
								Я прочитал <a href="#/rools" class="md-btn md-btn-xs" style="font-size: 1em; font-weight: bold; color: #64b5f6;">соглашение</a> об оказании услуг VotePad и согласен с ним
							</label>
						</div>
						<div class="text-center">
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
