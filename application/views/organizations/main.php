<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title><?=$organization->name; ?> | Votepad.ru</title>

    <meta name="description" content="" />
    <meta name="keywords" content="страница орагнизации, votepad, organization" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css?v=<?= filemtime("assets/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css?v=<?= filemtime("assets/css/app_v1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>js/app_v1.js"></script>

</head>
<body>

<header class="header">
    <?=$header; ?>
</header>


<div class="jumbotron block">

    <!-- Jumbotron Wrapper -->
    <?=$jumbotron_wrapper; ?>

    <!-- Jumbotron Navigation -->
    <div class="jumbotron_nav">
        <?=$jumbotron_navigation; ?>
    </div>

</div>


<section>
    <?=$main_section; ?>
</section>

<footer class="footer">
    <?=$footer; ?>
</footer>

</body>
</html>
