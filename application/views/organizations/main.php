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

</head>
<body>
<div class="wrapper">

    <header></header>

	<div class="content-wrapper">

        <!-- ORGANIZATION INFO -->

        <div class="org-block">
			<div class="org-background" style="background-image: url(<?=$assets; ?>img/temp/bg2.jpg);">
				<?=$jumbotron; ?>
			</div>

            <div class="org-nav-block">
				<?=$navigation; ?>
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
