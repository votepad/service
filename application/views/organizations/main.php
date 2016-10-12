<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$organization->name; ?> | NWE</title>

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/animate.css/animate.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css?v=<?= filemtime("assets/css/app1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
	<script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/organizations/org.js"></script>
	<script type="text/javascript" src="<?=$assets; ?>js/app.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

	<!--  ORGANIZATION MENU   -->
	<div class="user-menu">
		<ul class="ls_none">
			<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
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
</body>
</html>
