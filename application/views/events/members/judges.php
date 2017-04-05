<!-- =============== PAGE STYLE ===============-->
<link rel="stylesheet" href="<?=$assets; ?>static/css/event.css?v=<?= filemtime("assets/static/css/event.css") ?>">
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
    <div id="eventID" data-id="456987" class="eventID">
        <h2>Код мероприятия</h2>
    </div>


    <h3 class="page-header">Представители жюри
        <a id="save" class="displaynone"><i class="fa fa-save" aria-hidden="true"></i></a>
        <a id="edit" class="pull-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
        <br><small>Для входа в систему сообщите представителям жюри код мероприятия и пароль. Пароль у каждого представителя жюри должен быть различен.</small>
    </h3>

    <div class="row" id="table_wrapper">
        <div id="judges"></div>
    </div>
</section>


<!-- =============== PAGE SCRIPTS ===============-->
<script type="text/javascript" src="<?=$assets; ?>vendor/handsontable/handsontable.full.min.js"></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/event/judges.js"></script>