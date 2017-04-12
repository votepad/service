<div class="section__wrapper">

    <!-- =============== PAGE STYLE ===============-->
    <link rel="stylesheet" href="<?=$assets; ?>static/css/org.css?v=<?= filemtime("assets/static/css/org.css") ?>">

    <div class="jumbotron block">

        <!-- Jumbotron Wrapper -->
        <?=View::factory('organizations/blocks/jumbotron_wrapper', array('organization' => $organization)); ?>

        <!-- Jumbotron Navigation -->
        <div class="jumbotron_nav">
            <?=$jumbotron_navigation; ?>
        </div>

    </div>

    <section class="section__content">

    </section>

</div>