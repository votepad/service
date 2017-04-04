<!-- =============== PAGE STYLE ===============-->
<link type="text/css" rel="stylesheet" href="<?=$assets; ?>vendor/handsontable/handsontable.full.min.css?v=<?= filemtime("assets/vendor/handsontable/handsontable.full.min.css") ?>">



<div class="jumbotron block">

    <!-- Jumbotron Wrapper -->
    <?=View::factory('events/blocks/jumbotron_wrapper', array('organization' => $organization, 'event' => $event)); ?>

    <!-- Jumbotron Navigation -->
    <div class="jumbotron_nav">
        <?=$jumbotron_navigation; ?>
    </div>

</div>

<section>

    <h3 class="page-header">Список участников
        <a id="save" class="displaynone"><i class="fa fa-save" aria-hidden="true"></i></a>
        <a id="edit" class="displaynone"><i class="fa fa-edit" aria-hidden="true"></i></a>
    </h3>

    <div class="row" id="table_wrapper">
        <div id="preloader" class="text-center">
            <i class="fa fa-spinner fa-pulse fa-fw"></i>
            Загрузка данных
        </div>
        <div id="participants" class="displaynone"></div>
    </div>

    <input type="hidden" value="<?=$event->id; ?>" id="id_event">

</section>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event/participants.js"></script>
