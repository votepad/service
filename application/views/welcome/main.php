<!DOCTYPE html>
<html lang="ru">
<head>
    <title> <?=$title; ?> </title>
    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />

    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/favicon.png" />

    <meta name="description" content="<?=$description; ?>" />
    <meta name="keywords" content="<?=$keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/header.css?v=<?= filemtime("assets/frontend/modules/css/header.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/dropdown.css?v=<?= filemtime("assets/frontend/modules/css/dropdown.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>frontend/modules/css/collapse.css?v=<?= filemtime("assets/frontend/modules/css/collapse.css") ?>">

    <script src="<?=$assets; ?>frontend/bundles/votepad.bundle.js"></script>

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$assets; ?>vendor/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/app_v1.css">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/welcome.css">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>vendor/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/bootstrap-notify/bootstrap-notify.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>vendor/sweetalert2/sweetalert2.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/welcome.js"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/app_v1.js"></script>


</head>

 <body>
    <header class="header header-home">
        <?=$header; ?>
    </header>

    <?=$section; ?>

    <footer class="footer">

        <?= View::factory('globalblocks/footer'); ?>

    </footer>

    <div id="toTop" class="toTop">
        <i class="fa fa-4x fa-angle-double-up" aria-hidden="true"></i>
    </div>

    <?= View::factory('globalblocks/auth_modal'); ?>

</body>

<script type="text/javascript">

    $( document ).ready(function() {
        vp.header.init();
        vp.collapse.init();
    });

</script>

<!-- Yandex.Metrika counter --
<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter42856294 = new Ya.Metrika({ id:42856294, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42856294" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</html>
