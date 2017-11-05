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

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">

    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>

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

        <?= View::factory('event-landing/pages/' . $page, array('event' => $event)); ?>

    </section>


    <footer class="footer">
        <?= View::factory('global/blocks/footer'); ?>
    </footer>


    <? if ( !$isLogged ): ?>
        <?= View::factory('global/blocks/auth_modal'); ?>
    <? endif; ?>

<body>

<script type="text/javascript">
    vp.initLanding();
</script>

<? if ( getenv('KOHANA_ENV') == 'PRODUCTION' ): ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter42856294 = new Ya.Metrika({ id:42856294, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42856294" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<? endif; ?>

</html>
