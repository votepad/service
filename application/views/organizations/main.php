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
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/header.css?v=<?= filemtime("assets/frontend/modules/css/header.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/collapse.css?v=<?= filemtime("assets/frontend/modules/css/collapse.css") ?>">

    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">
	<link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
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
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/header.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/collapse.js"></script>


<script type="text/javascript">
    header.init();
    collapse.init();
</script>

</html>
