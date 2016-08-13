<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Организация</title>

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css">

	<!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/organizations/org.js"></script>
</head>
<body>
<div class="wrapper">
	<header></header>

	<div class="content-wrapper">
		<!-- ORGANIZATION INFO -->
		<div class="org-block">
				<div class="org-background" style="background-image: url(<?=$assets; ?>img/temp/bg2.jpg);">
					<div class="org-avatar">
						<img src="<?=$assets; ?>img/temp/bg4.jpg">
					</div>
					<div class="org-name-background"></div>
					<div class="org-name">
						<h2>
							Университет ИТМО
							<a href="http://ifmo.ru" class="inline" data-toggle="tooltip" data-placement="top" title="Официальный сайт">
								<i class="fa fa-external-link" aria-hidden="true"></i>
							</a>
						</h2>
					</div>
				</div>
				<div class="org-nav-block">
					<div class="org-nav">
						<a href="http://pronwe.local/organization/10/" class="md-btn active">
							Мероприятия
							<div class="active-tab"></div>
						</a>
						<a href="http://pronwe.local/organization/10/settings/main" class="md-btn">
							Настройки
							<div class="active-tab"></div>
						</a>
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

<!-- =============== VENDOR SCRIPTS ===============-->
<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
<script src="<?=$assets; ?>js/org.js"></script>

</body>
</html>
