<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Страница организации - <?=$organization->name; ?></title>

	<!-- =============== VENDOR STYLES ===============-->
	<link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=$assets; ?>vendor/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?=$assets; ?>css/app1.css?v=<?= filemtime("assets/css/app1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
	<script src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
	<script src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-tooltip.js"></script>
	<script src="<?=$assets; ?>js/organizations/org.js"></script>
	<script src="<?=$assets; ?>js/app.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="user-menu">
		<ul class="no-li">
			<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-cubes" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
		</ul>
	</div>
	<div class="wrapper">

		<div class="content-wrapper">

			<!-- ORGANIZATION INFO -->
	  <div class="org-block">

			<?=$jumbotron; ?>

	    <div class="org-nav-block">
				<?=$navigation; ?>
			</div>
		</div>


			<!-- SECTION -->
			<section>
				<?=$main_section; ?>
			</section>

		<footer></footer>
	</div>
</body>
</html>
