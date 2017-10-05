<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <title><?=$title ?> | Votepad</title>

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>

</head>

<body>

    <div class="wrapper">

        <header class="header">
            <?=View::factory('globalblocks/header'); ?>
        </header>

        <section class="section">
            <?=$mainSection; ?>
        </section>

        <footer class="footer">
            <?= View::factory('globalblocks/footer'); ?>
        </footer>

    </div>

    <? if ( !$isLogged ): ?>
        <?= View::factory('globalblocks/auth_modal'); ?>
    <? endif; ?>

</body>

<script type="text/javascript">

    $( document ).ready(function() {
        vp.init();
    });

    window.csrf = '<?= Security::token() ?>';

</script>

</html>