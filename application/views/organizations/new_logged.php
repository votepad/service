<!DOCTYPE html>
<html ng-app="pronwe">
<head>
		<meta charset="utf-8">
		<title>Новая организация</title>

    <!-- =============== VENDOR STYLES ===============-->
    	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" href="<?=$assets; ?>vendor/angular-material/css/angular-material.min.css">
		<link rel="stylesheet" href="<?=$assets; ?>css/app1.css">
		<link rel="stylesheet" href="<?=$assets; ?>css/org.css">


    <!-- =============== VENDOR SCRIPTS ===============-->
    	<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    	<script src="<?=$assets; ?>vendor/jquery-validation/dist/jquery.validate.js"></script>
		<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>

		<script src="<?=$assets; ?>vendor/angular/angular.min.js"></script>
		<script src="<?=$assets; ?>vendor/angular/i18n/angular-locale_ru-ru.js"></script>
		<script src="<?=$assets; ?>vendor/angular/angular-aria.min.js"></script>
		<script src="<?=$assets; ?>vendor/angular/angular-animate.min.js"></script>
		<script src="<?=$assets; ?>vendor/angular/angular-ngmask.min.js"></script>
		<script src="<?=$assets; ?>vendor/angular-socialshare/angular-socialshare.js"></script>
		<script src="<?=$assets; ?>vendor/angular-material/js/angular-material.min.js"></script>
		<script src="<?=$assets; ?>js/org.js"></script>

</head>
<body ng-controller="appCtrl">
	<div class="wrapper">
		<div class="content-wrapper">
			<div class="panel panel-default" style="width: 80%; margin: auto;">
				<div class="panel-heading">Новая организация</div>
				<div class="panel-body">
					<h2>Введите информацию об организации</h2>
					<p>Заполните форму и Вы получите личный кабинет. В нём Вы сможете создавать и публиковать мероприятия.</p>
					<form class="create-org" name="newOrgForm1" method="POST" action="<?=URL::site('organization/add'); ?>">
						<div class="form-group">
							<label class="col-sm-3 control-label">Название организации<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="org_name" class="form-control" required="" ng-model="orgname">
								<span class="help-block" ng-show="newOrgForm1.orgname.$valid || newOrgForm1.orgname.$pristine">Его увидят на странице организации, где будут показаны все Ваши мероприятия.</span>
								<span class="error" ng-show="newOrgForm1.orgname.$dirty && newOrgForm1.orgname.$invalid">
  									<span ng-show="newOrgForm1.orgname.$error.required">Введите название организации</span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Сайт организации</label>
							<div class="col-sm-9">
								<div class="input-group">
									<input type="text" name="org_site" class="form-control" maxlength="25" value="">
									<span class="input-group-addon">.votepad.ru</span>
								</div>
								<span class="help-block">По этому адресу будет доступен личный кабинет организации.</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Телефон<span style="color: red">*</span></label>
							<div class="col-sm-9">
								<input type="text" name="org_phone" ng-model="phone" class="form-control" required="" mask="+9 (999) 999-9999" clean="true" placeholder="+7 (999) 987-6543" >
								<span class="help-block">Нужен для связи с Вами.</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-offset-3" style="padding: 0 15px">
								<input type="checkbox" value="" required="" name="confirmrools" ng-model="confirmrools">
								Я прочитал <md-button ng-href="" class="md-btn md-btn-xs" style="font-size: 1em; font-weight: bold; color: #64b5f6;">соглашение</md-button> об оказании услуг VotePad и согласен с ним
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
