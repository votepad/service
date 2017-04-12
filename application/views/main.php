<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title><?=$title ?> | Votepad</title>

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>


    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/header.css?v=<?= filemtime("assets/frontend/modules/css/header.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/footer.css?v=<?= filemtime("assets/frontend/modules/css/footer.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/collapse.css?v=<?= filemtime("assets/frontend/modules/css/collapse.css") ?>">

    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js?v=<?= filemtime("assets/frontend/bundles/votepad.bundle.js") ?>"></script>

</head>
<body>

<header class="header">

    <?=$header; ?>

</header>

<section>

    <?=$mainSection; ?>

</section>

<footer class="footer">

    <?= View::factory('globalblocks/footer'); ?>

</footer>

<? if ( !$isLogged ): ?>
    <?= View::factory('globalblocks/auth_modal'); ?>
<? endif; ?>


</body>

<script type="text/javascript">

    $( document ).ready(function() {
        vp.header.init();
        vp.collapse.init();
    });

</script>

</html>