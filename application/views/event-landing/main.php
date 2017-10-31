<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>static/img/favicon.png" />

    <title><?=$event->name; ?> | Votepad</title>

    <meta name="description" content="<?=$event->description; ?>" />
    <meta name="keywords" content="<? $arr = array('"','[',']'); echo str_replace($arr, '', $event->tags); ?>,votepad" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/event-landing.css?v=<?= filemtime("assets/static/css/event-landing.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/parallax.css?v=<?= filemtime("assets/frontend/modules/css/parallax.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>

    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/moment/locale/ru.js"></script>

    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/event/landing.js"></script>


    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js?v=<?= filemtime("assets/frontend/bundles/votepad.bundle.js") ?>"></script>

    <script>
        $(document).ready(function () {
            vp.parallax.init();
        })
    </script>


</head>

<body>

<header class="header-landing clear_fix">

    <?=View::factory('events/landing/blocks/header', array('event' => $event)); ?>

</header>


<section>

    <?=View::factory('events/landing/blocks/jumbotron', array('event' => $event)); ?>

    <?=$mainSection; ?>

</section>


<footer class="footer">

    <?=View::factory('events/landing/blocks/footer'); ?>

</footer>


<? if ( !$isLogged ): ?>
    <?= View::factory('globalblocks/auth_modal'); ?>
<? endif; ?>

<body>

</html>
