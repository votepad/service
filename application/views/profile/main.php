<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <title><?=$title; ?></title>

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets ?>vendor/sweetalert2/sweetalert2.css">

    <!-- modules -->
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/header.css?v=<?= filemtime("assets/frontend/modules/css/header.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/collapse.css?v=<?= filemtime("assets/frontend/modules/css/collapse.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>frontend/modules/css/tabs.css?v=<?= filemtime("assets/frontend/modules/css/tabs.css") ?>">


    <link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/app_v1.css?v=<?= filemtime("assets/static/css/app_v1.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?=$assets; ?>static/css/profile.css?v=<?= filemtime("assets/static/css/profile.css") ?>">


	<!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>

    <? if ( $isLogged && $isProfileOwner ) :?>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap/dist/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/cookies.js"></script>
    <? endif; ?>

    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/profile.js"></script>

</head>
<body>

<header class="header">
    <?=$header; ?>
</header>

<div class="jumbotron block jumbotron_profile">

    <!-- Jumbotron Wrapper -->
    <?=$jumbotron_wrapper; ?>

</div>


<section>

    <?= View::factory('profile/blocks/profile-info', array('profile' => $profile, 'isProfileOwner' => $isProfileOwner)); ?>

    <?= View::factory('profile/blocks/my-org-event'); ?>

</section>


<?= View::factory('profile/blocks/reset_password') ?>



<footer class="footer">
    <?=$footer; ?>
</footer>

</body>

<!-- modules -->
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/header.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/collapse.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/tabs.js"></script>
<script type="text/javascript" src="<?=$assets; ?>frontend/modules/js/ajax.js"></script>


<script type="text/javascript">
    header.init();
    collapse.init();
    tabs.init();
</script>

</html>
