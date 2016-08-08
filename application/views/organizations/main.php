<!DOCTYPE html>
<html ng-app="pronwe">
<head>
	<meta charset="utf-8">
	<title>Организация</title>

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/angular-material/css/angular-material.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css">


	<!-- =============== VENDOR SCRIPTS ===============-->
	<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
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
	<header></header>

	<div class="content-wrapper">
		<!-- ORGANIZATION INFO -->
		<div class="org-block" ng-controller="orgInfoCtrl as org">
			<div class="org-background" style="background-image: url(../../assets/img/temp/{{org.background}});">
				<div class="org-avatar">
					<img src="../../assets/img/temp/{{org.avatar}}">
				</div>
				<div class="org-name-background"></div>
				<div class="org-name">
					<h2 class="inline">{{org.name}}</h2>
					<md-button ng-href="{{org.link}}" class="md-icon-button inline" aria-label="OrgLink" data-toggle="tooltip" data-placement="top" title="Официальный сайт" md-ink-ripple="#64b5f6">
						<md-icon md-svg-icon="../../assets/img/icons/internet.svg"></md-icon>
					</md-button>
				</div>
			</div>
			<div class="org-nav-block">
				<div class="org-nav">
					<md-button ng-href="orgpage-events.html" class="md-btn active" aria-label="tabEvents" md-ink-ripple="#64b5f6">
						Мероприятия
						<div class="active-tab"></div>
					</md-button>
					<md-button ng-href="orgpage-settings-main.html" class="md-btn" aria-label="tabSettings" md-ink-ripple="#64b5f6">
						Настройки
						<div class="active-tab"></div>
					</md-button>
				</div>
			</div>
		</div>

		<!-- SECTION -->
		<section>
			<?=$main_section; ?>
		</section>
		
	</div>

	<footer></footer>
</div>
</body>
</html>
