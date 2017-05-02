<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title>Панель оценивания | Votepad</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/radioboxes.css?v=<?= filemtime("assets/static/css/radioboxes.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/voting-panel.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/slidermodule.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/radioboxes.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/stagenavigation.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/scores.js"></script>


    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/header.css?v=<?= filemtime("assets/frontend/modules/css/header.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/jumbotron.css?v=<?= filemtime("assets/frontend/modules/css/jumbotron.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/collapse.css?v=<?= filemtime("assets/frontend/modules/css/collapse.css") ?>">

    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js"></script>


    <link rel="stylesheet" href="<?=$assets; ?>static/css/voting-panel.css?v=<?= filemtime("assets/static/css/voting-panel.css") ?>">

</head>

<body>

<header class="header">
    <?=View::factory('voting-panel/blocks/header', array('judge' => $judge))?>
</header>

<div class="jumbotron jumbotron--voting-panel block">
    <?=View::factory('voting-panel/blocks/jumbotron', array('event' => $event))?>
</div>


<section class="section">

<!--    --><?//=$mainSection; ?>

</section>


</body>

</html>
