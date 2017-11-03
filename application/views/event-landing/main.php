<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <title><?=$event->name; ?> | Votepad</title>

    <meta name="description" content="<?=$event->description; ?>" />
    <meta name="keywords" content="<?= $event->tags; ?>,votepad" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">

    <!-- =============== PAGE STYLES ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/event-landing.css?v=<?= filemtime("assets/static/css/event-landing.css") ?>">

    <!-- =============== PAGE SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>static/js/event-landing.js?v=<?= filemtime("assets/static/js/event-landing.js") ?>"></script>

</head>

<body>

<header class="header header-landing">

    <?= View::factory('event-landing/blocks/header', array('event' => $event)); ?>

</header>


<section>

    <div class="section__cover">
        <div class="parallax" data-toggle="parallax">
            <img id="eventBranding" src="/uploads/events/branding/o_<?=$event->branding; ?>" alt="event branding" class="parallax__img">
        </div>
        <div class="section__content valign">
            <div class="section__cover-text">
                <?= $event->name; ?>
            </div>
        </div>
        <div class="section__cover-filter"></div>
    </div>

    <?= $page; ?>

</section>


<footer class="footer">

    <?=View::factory('globalblocks/footer'); ?>

</footer>


<? if ( !$isLogged ): ?>
    <?= View::factory('globalblocks/auth_modal'); ?>
<? endif; ?>

<body>

<script>
    vp.init();
</script>

</html>
