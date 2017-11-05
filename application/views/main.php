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

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>

</head>

<body>

    <div class="wrapper">

        <header class="header">
            <?=View::factory('global/blocks/header'); ?>
        </header>

        <section class="section">
            <?=$mainSection; ?>
        </section>

        <footer class="footer">
            <?= View::factory('global/blocks/footer'); ?>
        </footer>

    </div>

    <? if ( !$isLogged ): ?>
        <?= View::factory('global/blocks/auth_modal'); ?>
    <? endif; ?>

    <input type="hidden" id="csrf" name="csrf" value="<?= Security::token(); ?>">

</body>

<script type="text/javascript">
    vp.init();
</script>

</html>