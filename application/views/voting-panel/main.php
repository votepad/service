<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="author" content="Votepad" />
    <link type="image/x-icon" rel="shortcut icon" href="<?=$assets; ?>img/static/favicon.png" />

    <title>Панель оценивания | Votepad</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>vendor/fontawesome/css/font-awesome.min.css?v=<?= filemtime("assets/vendor/fontawesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/icons_fonts.css?v=<?= filemtime("assets/static/css/icons_fonts.css") ?>">
    <link rel="stylesheet" href="<?=$assets; ?>static/css/voting-panel.css?v=<?= filemtime("assets/static/css/voting-panel.css") ?>">

    <!-- =============== VENDOR SCRIPTS ===============-->
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/judgeStatus.js?v=<?= filemtime("assets/static/js/voting-panel/judgeStatus.js") ?>"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/voting-panel.js?v=<?= filemtime("assets/static/js/voting-panel/voting-panel.js") ?>"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/manager.js?v=<?= filemtime("assets/static/js/voting-panel/manager.js") ?>"></script>
    <script type="text/javascript" src="<?=$assets; ?>static/js/voting-panel/voting.js?v=<?= filemtime("assets/static/js/voting-panel/voting.js") ?>"></script>


    <!-- modules -->
    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/vp.min.css?v=<?= filemtime("assets/frontend/bundles/vp.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/vp.min.js?v=<?= filemtime("assets/frontend/bundles/vp.min.js") ?>"></script>

</head>

    <body>

        <header class="header">

            <?= View::factory('voting-panel/blocks/header', array('judge' => $judge)); ?>

        </header>


        <section class="section mb-50">

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

            <div class="section__content">

                <div class="width-full width-md-300 mr-md-40">

                    <div class="block hidden-xs hidden-sm">

                        <?= View::factory('voting-panel/blocks/navigation-large', array('contests' => $event->contests, 'cur_contest_id' => $event->cur_contest['id'])); ?>

                    </div>

                </div>

                <div class="width-full width-md-640 width-lg-840">

                    <?= View::factory('voting-panel/blocks/navigation-small', array('contests' => $event->contests, 'cur_contest_id' => $event->cur_contest['id'])); ?>

                    <?= View::factory('voting-panel/blocks/contest', array('event' => $event, 'judge' => $judge)); ?>

                </div>

            </div>

        </section>


        <footer class="footer">

            <?= View::factory('voting-panel/blocks/footer'); ?>

        </footer>

        <input type="hidden" id="navStagesHashes" value='<?= $event->stages_hashes; ?>'>
        <input type="hidden" id="curContest" value="<?= $event->cur_contest['id']; ?>">

    </body>

    <script type="text/javascript">
        vp.init();
        wsvoting.init(<?= $judge->id ?>, '<?= $_SERVER['HTTP_HOST'] ?>');
        manager.init('<?= $_SERVER['HTTP_HOST'] ?>');
        judgeStatus.init('judgeStatus');
        voting.init();
    </script>

</html>