<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title><?=$title ?> | Votepad</title>

    <meta name="description" content="<?=$description ?>" />
    <meta name="keywords" content="страница орагнизации, votepad, organization" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>css/icons_fonts.css?v=<?= filemtime("assets/css/icons_fonts.css") ?>">

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>modules/css/header.css?v=<?= filemtime("assets/modules/css/header.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>modules/css/dropdown.css?v=<?= filemtime("assets/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>modules/css/collapse.css?v=<?= filemtime("assets/modules/css/collapse.css") ?>">

    <link rel="stylesheet" href="<?=$assets; ?>css/app_v1.css?v=<?= filemtime("assets/css/app_v1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>css/org.css?v=<?= filemtime("assets/css/org.css") ?>">

	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
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

<!-- modules -->
<script type="text/javascript" src="<?=$assets; ?>modules/js/header.js"></script>
<script type="text/javascript" src="<?=$assets; ?>modules/js/collapse.js"></script>


<script type="text/javascript">
    header.init();
    collapse.init();
</script>

</html>
